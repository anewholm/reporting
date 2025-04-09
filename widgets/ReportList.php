<?php namespace Acorn\Reporting\Widgets;

use BackendAuth;
use Backend\Models\User;
use Str;
use File;
use Input;
use Request;
use Cms\Classes\Theme;
use Backend\Classes\WidgetBase;
use Exception;
use Winter\Storm\Support\Facades\Mail;
use ApplicationException;

/**
 * Report list widget.
 * This widget displays messages, emails and groups.
 *
 * @package acorn/messaging
 * @author sz
 */
class ReportList extends WidgetBase
{
    const SORTING_DATE = 'created_at';

    use \Backend\Traits\SelectableWidget;
    use \Backend\Traits\CollapsableWidget;

    protected $searchTerm = FALSE;
    protected $dataSource;
    protected $theme;
    public $titleProperty = 'subject';
    public $descriptionProperties = ['to'];
    public $descriptionProperty = 'to';
    public $noRecordsMessage = 'cms::lang.template.no_list_records';
    public $controlClass;
    public $sortingProperties = [];

    public function __construct($controller, $alias, callable $dataSource)
    {
        $this->alias = $alias;
        $this->dataSource = $dataSource; // Messages and Groups
        $this->theme = Theme::getEditTheme();
        $this->selectionInputName = 'template';
        $this->collapseSessionKey = $this->getThemeSessionKey('groups');

        parent::__construct($controller, []);

        if (!Request::isXmlHttpRequest()) {
            $this->resetSelection();
        }

        $configFile = 'config_' . snake_case($alias) .'.yaml';
        $config = $this->makeConfig($configFile);

        foreach ($config as $field => $value) {
            if (property_exists($this, $field)) {
                $this->$field = $value;
            }
        }

        $this->bindToController();
    }

    /**
     * Renders the widget.
     * @return string
     */
    public function render()
    {
        $toolbarClass = Str::contains($this->controlClass, 'hero') ? 'separator' : null;
        $authUser     = BackendAuth::user();

        $this->vars['toolbarClass'] = $toolbarClass;

        $result = '';
        $reports = $this->getData();
        if (!$reports) {
            // TODO: This is only for the initial get
            // for testing purposes
            $authUser = BackendAuth::user();
            try {
                $reports = $this->getData();
            } catch (Exception $ex) {}
        }
        $result = $this->makePartial('body', [
            'authUser' => $authUser,
            'reports'  => $reports,
        ]);

        return $result;
    }

    /*
     * Event handlers
     */
    public function onWebSocket()
    {
        // This event expects exactly 1 context only
        // and returns 1 HTML _report partial
        $result    = array('result' => 'error');
        $post      = post();
        $conv      = NULL;

        // Trap errors, label reports with IDs
        if (isset($post['context']) 
            && is_array($post['context'])
            && count($post['context']) == 4
        ) {
            $context    = &$post['context'];
            $userFromID = &$context[2];
            $userToID   = &$context[3];
            if ($withUser = User::find($userToID)) {
                // This returns an array:
                //   result => success
                //   report => HTML from the _report partial
                $result = $this->onRefreshReport($withUser);
            }
        } else {
            throw new ApplicationException('Malformed Message');
        }

        return $result;
    }

    public function onSearch()
    {
        $this->setSearchTerm(Input::get('search'));
        $this->extendSelection();

        return $this->updateList();
    }

    public function onUpdate()
    {
        $this->extendSelection();

        return $this->updateList();
    }

    public function onApplySorting()
    {
        $this->setSortingProperty(Input::get('sortProperty'));

        $result = $this->updateList();
        $result['#'.$this->getId('sorting-options')] = $this->makePartial('sorting-options');

        return $result;
    }

    //
    // Methods for the internal use
    //

    public function getData()
    {
        $items = call_user_func($this->dataSource);

        if ($items instanceof \Winter\Storm\Support\Collection) {
            $items = $items->all();
        }

        $items = array_map([$this, 'normalizeItem'], $items);

        $this->sortItems($items);

        /*
         * Apply the search
         */
        $filteredItems = [];
        $searchTerm = Str::lower($this->getSearchTerm());

        if (strlen($searchTerm)) {
            /*
             * Exact
             */
            foreach ($items as $index => $item) {
                if ($this->itemContainsWord($searchTerm, $item, true)) {
                    $filteredItems[] = $item;
                    unset($items[$index]);
                }
            }

            /*
             * Fuzzy
             */
            $words = explode(' ', $searchTerm);
            foreach ($items as $item) {
                if ($this->itemMatchesSearch($words, $item)) {
                    $filteredItems[] = $item;
                }
            }
        }
        else {
            $filteredItems = $items;
        }

        return $filteredItems;
    }

    protected function sortItems(&$items)
    {
        $sortingProperty = $this->getSortingProperty();

        // Integer and DateTime sort DESC by default
        // Strings sort ASC
        usort($items, function ($a, $b) use ($sortingProperty) {
            return (property_exists($a, $sortingProperty)
                ? (is_int($b->$sortingProperty) || $b->$sortingProperty instanceof \DateTime
                    ? $b->$sortingProperty > $a->$sortingProperty
                    : strcmp($a->$sortingProperty, $b->$sortingProperty)
                  )
                : 0
            );
        });
    }

    protected function normalizeItem($item)
    {
        $description = null;
        if ($descriptionProperty = $this->descriptionProperty) {
            $description = $item->$descriptionProperty;
        }

        $descriptions = [];
        foreach ($this->descriptionProperties as $property => $title) {
            if ($item->$property) {
                $descriptions[$title] = $item->$property;
            }
        }

        $result = [
            'id'           => $item->id,
            'title'        => $this->getItemTitle($item), // subject
            'body'         => $item->body,
            'description'  => $description,
            'descriptions' => $descriptions,
            'itemType'     => $item->item_type,
        ];

        foreach ($this->sortingProperties as $property => $name) {
            $result[$property] = $item->$property;
        }

        return (object) $result;
    }

    protected function getItemTitle($item)
    {
        $titleProperty = $this->titleProperty; // subject

        if ($titleProperty) {
            return $item->$titleProperty ?: 'No Name';
        }

        return 'No Name';
    }

    protected function setSearchTerm($term)
    {
        $this->searchTerm = trim($term);
        $this->putSession('search', $this->searchTerm);
    }

    protected function getSearchTerm()
    {
        return $this->searchTerm !== false ? $this->searchTerm : $this->getSession('search');
    }

    protected function updateList()
    {
        // getId(suffix) returns class_basename()-alias-suffix
        // e.g. MessageList-messageList-messages
        $searchSystemId   = '#' . $this->getId('reports');
        $authUser         = BackendAuth::user();
        $reports    = $this->getData();
        $reportList = $this->makePartial('report_list', [
            'authUser' => $authUser,
            'reports'  => $reports,
        ]);

        // TODO: Very bad!!!!! We need to bring the systems in to line
        // One wants the partial name as a key, the other the CSS path
        return [
            'report_list' => $reportList,
            $searchSystemId     => $reportList,
        ];
    }

    protected function itemMatchesSearch($words, $item)
    {
        foreach ($words as $word) {
            $word = trim($word);
            if (!strlen($word)) {
                continue;
            }

            if (!$this->itemContainsWord($word, $item)) {
                return false;
            }
        }

        return true;
    }

    protected function itemContainsWord($word, $item, $exact = false)
    {
        $operator = $exact ? 'is' : 'contains';

        if (strlen($item->title) && Str::$operator(Str::lower($item->title), $word)) {
            return true;
        }

        if (Str::$operator(Str::lower($item->title), $word)) {
            return true;
        }

        if (Str::$operator(Str::lower($item->body), $word) && strlen($item->body)) {
            return true;
        }

        foreach ($item->descriptions as $value) {
            if (Str::$operator(Str::lower($value), $word) && strlen($value)) {
                return true;
            }
        }

        return false;
    }

    protected function getThemeSessionKey($prefix)
    {
        return $prefix . $this->theme->getDirName();
    }

    protected function getSortingProperty()
    {
        $property = $this->getSession($this->getThemeSessionKey('sorting_property'), self::SORTING_DATE);

        if (!array_key_exists($property, $this->sortingProperties)) {
            return self::SORTING_DATE;
        }

        return $property;
    }

    protected function setSortingProperty($property)
    {
        $this->putSession($this->getThemeSessionKey('sorting_property'), $property);
    }
}

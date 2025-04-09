<?php namespace AcornAssociated\Reporting\Controllers;

use BackendAuth;
use Backend\Models\User;
use Backend\Models\UserGroup;
use Backend\Classes\Controller;
use BackendMenu;
use Flash;
use Cms\Classes\Theme; // TODO: Themes come from the CMS copied plugin. Necessary?
use DB;
use Request;
use ApplicationException;
use Carbon\Carbon;
use Winter\Storm\Database\Collection;

use AcornAssociated\Reporting\Widgets\ReportList;

class Reports extends Controller
{
    // Builder implemented behaviors:
    // We do not use these for Messaging
    // because we implement our own view endpoints and widgets below
    public $implement = ['Backend\Behaviors\FormController'];

    // Builder implemented behavior configuaration files:
    // Ours uses the config_message_list.yaml in the widget below
    //
    public $formConfig = 'config_form.yaml';
    // public $listConfig = 'config_list.yaml';
    // public $reorderConfig = 'config_reorder.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('AcornAssociated.Reporting', 'reporting-menu-item', 'reporting-side-menu-item');

        $widget = new ReportList($this, 'reportList', function(){
            $authUser  = BackendAuth::user();
            $ID        = (int) $authUser->id; // For SQL injection security
            $reports   = array();
            return $reports;
        });
        $widget->bindToController(); // Set $this->widget->reportList
    }

    /**
     * View endpoints
     * These are necessary because we are not using the in-built Builder Behaviors
     */
    public function index()
    {
        $this->addJs('/plugins/acornassociated/reporting/assets/js/acornassociated.reporting.js');
        $this->addCss('/plugins/acornassociated/reporting/assets/css/acornassociated.reporting.css', 'core');

        $this->bodyClass = 'compact-container';
        $this->pageTitle = 'Reporting';
    }

    /**
     * AJAX events
     * NOTE: We are using the TemplateList AJAX events here
     * because we are using winter.cmspage.js which has the event names hard-coded
     */
    // TODO: Move these handlers on to the reportList widget
    public function onCreateReport()
    {
        /*
        // Create Message => open tab with form
        $message      = new Message();
        $widgetConfig = $this->makeConfig('~/plugins/acornassociated/messaging/models/message/fields.yaml');
        $widgetConfig->model = $message;
        $widget       = $this->makeWidget('Backend\Widgets\Form', $widgetConfig);

        $this->vars['templatePath'] = Request::input('path');
        $this->vars['lastModified'] = date('U');
        $this->vars['canCommit']    = TRUE;
        $this->vars['canReset']     = TRUE;

        $tabTitle = "New Report";
        return [
            'tabTitle' => $tabTitle,
            'tab' => $this->makePartial('form_message', [
                'form' => $widget,
                'type' => 'Message',
                'templateType'  => 'report',
                'templateTheme' => 'default',
            ])
        ];
        */
        return;
    }

    public function onLoadReport()
    {
        /*
        $post     = post();
        $authUser = BackendAuth::user();

        // New message
        $message = new Message();
        $post['user_from'] = $authUser;
        $message->fill($post);
        $message->save();

        // Result and partial update
        $result        = 'success';
        $reports = $this->widget->reportList->getData();
        Flash::success('Message Sent');

        return array(
            'result' => $result,
            'reports' => $this->makePartial('reports', [
                'authUser'      => $authUser,
                'reports' => $reports,
            ]),
        );
        */
        return;
    }
}

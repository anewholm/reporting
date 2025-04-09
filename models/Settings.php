<?php namespace AcornAssociated\Reporting\Models;

use Model;
use BackendMenu;
use System\Classes\SettingsManager;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'acornassociated_reporting_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    // Optional - sets the TTL for the settings cache
    public $settingsCacheTtl = 3600;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        BackendMenu::setContext('AcornAssociated.Reporting', 'system', 'settings');
        SettingsManager::setContext('AcornAssociated.Reporting', 'settings');
    }

    public function initSettingsData()
    {
    }
}

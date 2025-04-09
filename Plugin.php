<?php namespace AcornAssociated\Reporting;

use System\Classes\PluginBase;
use Backend\Controllers\Users;
use BackendAuth;
use AcornAssociated\Messaging\Models\Settings;

class Plugin extends PluginBase
{
    public $require = ['AcornAssociated.User'];

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Reporting Settings',
                'description' => 'Manage reporting based settings.',
                'category'    => 'AcornAssociated',
                'icon'        => 'icon-cog',
                'class'       => 'AcornAssociated\Reporting\Models\Settings',
                'order'       => 500,
                'keywords'    => 'OLAP reporting system',
                'permissions' => ['acornassociated_reporting_settings']
            ]
        ];
    }
}

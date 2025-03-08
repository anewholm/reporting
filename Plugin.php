<?php namespace Acorn\Reporting;

use System\Classes\PluginBase;
use Backend\Controllers\Users;
use BackendAuth;
use Acorn\Messaging\Models\Settings;

class Plugin extends PluginBase
{
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Reporting Settings',
                'description' => 'Manage reporting based settings.',
                'category'    => 'Acorn',
                'icon'        => 'icon-cog',
                'class'       => 'Acorn\Reporting\Models\Settings',
                'order'       => 500,
                'keywords'    => 'OLAP reporting system',
                'permissions' => ['acorn_reporting_settings']
            ]
        ];
    }
}

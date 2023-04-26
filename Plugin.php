<?php

namespace Sixgweb\ListSaverUsers;

use Event;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'ListSaverUsers',
            'description' => 'No description provided yet...',
            'author' => 'Sixgweb',
            'icon' => 'icon-leaf'
        ];
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
        \RainLab\User\Controllers\Users::extend(function ($controller) {
            $controller->implement[] = \Sixgweb\ListSaver\Behaviors\ListSaverController::class;
        });

        Event::listen('rainlab.user.view.extendListToolbar', function ($controller) {
            return $controller->listSaverRender();
        });
    }
}

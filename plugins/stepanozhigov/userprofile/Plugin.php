<?php namespace Stepanozhigov\Userprofile;

use Backend;
use RainLab\User\Controllers\Users;
use RainLab\User\Models\User;
use Stepanozhigov\Userprofile\Models\UserProfile;
use System\Classes\PluginBase;

/**
 * userprofile Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'userprofile',
            'description' => 'No description provided yet...',
            'author'      => 'stepanozhigov',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        User::extend(function($model) {
            $model->hasOne['profile'] = ['StepanOzhigov\UserProfile\Models\UserProfile'];
        });
        Users::extendFormFields(function($form,$model,$context) {

            if(!$model instanceof User)
                return;

            if(!$model->exists)
                return;

            UserProfile::getFromUser($model);

            $form->addTabFields([
                'profile[about]' => [
                    'label' => 'About',
                    'tab' => 'Profile',
                    'type' => 'textarea'
                ],
                'profile[interests]' => [
                    'label' => 'Interests',
                    'tab' => 'Profile',
                    'type' => 'textarea'
                ],
                'profile[skills]' => [
                    'label' => 'Skills',
                    'tab' => 'Profile',
                    'type' => 'textarea'
                ],
                'profile[qualifications]' => [
                    'label' => 'Qualifications',
                    'tab' => 'Profile',
                    'type' => 'textarea'
                ]
            ]);
        });
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Stepanozhigov\Userprofile\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'stepanozhigov.userprofile.some_permission' => [
                'tab' => 'userprofile',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'userprofile' => [
                'label'       => 'userprofile',
                'url'         => Backend::url('stepanozhigov/userprofile/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['stepanozhigov.userprofile.*'],
                'order'       => 500,
            ],
        ];
    }
}

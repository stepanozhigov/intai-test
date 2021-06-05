<?php namespace StepanOzhigov\Usergroups;

use phpDocumentor\Reflection\Type;
use System\Classes\PluginBase;
use RainLab\User\Controllers\Users as UsersController;
use RainLab\User\Models\User as UserModel;

class Plugin extends PluginBase
{

    public $require = ['RainLAb.User'];

    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }

    public function boot() {
        UsersController::extendListColumns(function($list,$model) {
            if(!$model instanceof UserModel) return;

            $list->addColumns([
                'group_name'=>[
                    'label' => 'Groups',
                    'relation' => 'groups',
                    'select' => 'name'
                ]
            ]);

            // dd($list);
        });
    }
}
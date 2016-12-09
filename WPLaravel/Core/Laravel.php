<?php
namespace WPLaravel\Core;

use Config;

class Laravel {

    /**
     * [capsule description]
     * @param  array  $options [description]
     * @return [type]          [description]
     * @author drewjbartlett
     */
    public static function bootEloquent($options = []) {

        $defaults = [
            'global' => true,

            'config' => [
                'database' => [
                    'user'     => '',
                    'password' => '',
                    'name'     => '',
                    'host'     => ''
                ],

                'prefix' => 'wp_'
            ],

            'events' => false
        ];

        $options = array_merge($defaults, $options);

        $capsule = new \Illuminate\Database\Capsule\Manager();

        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => $options['config']['database']['host'],
            'database'  => $options['config']['database']['name'],
            'username'  => $options['config']['database']['user'],
            'password'  => $options['config']['database']['password'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => $options['config']['prefix']
        ]);

        $capsule->bootEloquent();

        if($options['events']) $capsule->setEventDispatcher(new \Illuminate\Events\Dispatcher);

        if($options['global']) $capsule->setAsGlobal();

        return $capsule;
    }
}
?>

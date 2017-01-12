<?php
namespace WPEloquent\Core;

use Config;

class Laravel {

    protected static $_capsule;

    /**
     * [capsule description]
     * @param  array  $options [description]
     * @return [type]          [description]
     * @author drewjbartlett
     */
    public static function connect($options = []) {

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

            'events' => false,

            'log'    => true
        ];

        $options = array_merge($defaults, $options);

        if(is_null(self::$_capsule)) {

            self::$_capsule = new \Illuminate\Database\Capsule\Manager();

            self::$_capsule->addConnection([
                'driver'    => 'mysql',
                'host'      => $options['config']['database']['host'],
                'database'  => $options['config']['database']['name'],
                'username'  => $options['config']['database']['user'],
                'password'  => $options['config']['database']['password'],
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => $options['config']['prefix']
            ]);

            self::$_capsule->bootEloquent();

            if($options['events']) self::$_capsule->setEventDispatcher(new \Illuminate\Events\Dispatcher);

            if($options['global']) self::$_capsule->setAsGlobal();

            if($options['log']) self::$_capsule->getConnection()->enableQueryLog();

        }

        return self::$_capsule;
    }

    public static function getConnection() {
        return self::$_capsule->getConnection();
    }

    public static function queryLog() {
        return self::getConnection()->getQueryLog();
    }
}
?>

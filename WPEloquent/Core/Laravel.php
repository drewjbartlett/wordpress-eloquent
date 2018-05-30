<?php
namespace WPEloquent\Core;

use Config;

class Laravel
{

    protected static $_capsule;

    /**
     * [capsule description]
     *
     * @param  array $options [description]
     * @return [type]          [description]
     * @author drewjbartlett
     */
    public static function connect($options = [])
    {

        if (is_null(self::$_capsule)) {

            self::$_capsule = new \Illuminate\Database\Capsule\Manager();
            if (array_key_exists('multiple_connections', $options) && $options['multiple_connections']) {
                self::addMultipleConnections($options);
            } else {
                self::addSingleConnection($options);
            }

            self::$_capsule->bootEloquent();

            if ($options['events']) {
                self::$_capsule->setEventDispatcher(new \Illuminate\Events\Dispatcher);
            }

            if ($options['global']) {
                self::$_capsule->setAsGlobal();
            }

            if ($options['log']) {
                self::$_capsule->getConnection()->enableQueryLog();
            }

        }

        return self::$_capsule;
    }

    public static function getConnection($name = null)
    {
        return self::$_capsule->getConnection($name);
    }

    public static function queryLog()
    {
        return self::getConnection()->getQueryLog();
    }

    /**
     * @param mixed $capsule
     */
    public static function addSingleConnection($options)
    {
        $defaults = [
            'global' => true,
            'config' => [
                'database' => [
                    'user'     => '',
                    'password' => '',
                    'name'     => '',
                    'host'     => '',
                    'port'     => '3306',
                ],
                'prefix' => 'wp_',
            ],
            'events' => false,
            'log' => true,
        ];
        $options = array_replace_recursive($defaults, $options);
        self::$_capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => $options['config']['database']['host'],
            'database'  => $options['config']['database']['name'],
            'username'  => $options['config']['database']['user'],
            'password'  => $options['config']['database']['password'],
            'port'      => $options['config']['database']['port'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => $options['config']['prefix'],
        ]);
    }

    /**
     * @param mixed $capsule
     */
    public static function addMultipleConnections($options)
    {
        $defaults = [
            'global' => true,

            'config' => [
                'database' => [
                    'default' => [
                        'user'     => '',
                        'password' => '',
                        'name'     => '',
                        'host'     => '',
                        'port'     => '3306',
                    ]
                ],

                'prefix' => '',
            ],

            'events' => false,

            'log' => true,
        ];
        $options = array_replace_recursive($defaults, $options);

        foreach ($options['config']['database'] as $name => $config) {
            if (count($options['config']['database']) === 1) {
                $name = 'default';
            }
            self::$_capsule->addConnection([
                'driver'    => 'mysql',
                'host'      => $config['host'],
                'database'  => $config['name'],
                'username'  => $config['user'],
                'password'  => $config['password'],
                'port'      => $config['port'],
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => isset($config['prefix']) ? $config['prefix'] : null,
            ], $name);
        }
    }
}

?>

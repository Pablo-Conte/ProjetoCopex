<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitd988f7ba09e6fb89532f903f6b0ddf02
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitd988f7ba09e6fb89532f903f6b0ddf02', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitd988f7ba09e6fb89532f903f6b0ddf02', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitd988f7ba09e6fb89532f903f6b0ddf02::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}

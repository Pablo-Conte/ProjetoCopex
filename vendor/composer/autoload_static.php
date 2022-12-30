<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd988f7ba09e6fb89532f903f6b0ddf02
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twilio\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twilio\\' => 
        array (
            0 => __DIR__ . '/..' . '/twilio/sdk/src/Twilio',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd988f7ba09e6fb89532f903f6b0ddf02::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd988f7ba09e6fb89532f903f6b0ddf02::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd988f7ba09e6fb89532f903f6b0ddf02::$classMap;

        }, null, ClassLoader::class);
    }
}
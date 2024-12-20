<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc934005f2537e7135bd5cbdf4337ec44
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'F' => 
        array (
            'Facebook\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Facebook\\' => 
        array (
            0 => __DIR__ . '/..' . '/facebook/graph-sdk/src/Facebook',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc934005f2537e7135bd5cbdf4337ec44::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc934005f2537e7135bd5cbdf4337ec44::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc934005f2537e7135bd5cbdf4337ec44::$classMap;

        }, null, ClassLoader::class);
    }
}

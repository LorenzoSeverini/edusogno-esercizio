<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbca7374cb2d7d67d48bd7c44687a5e86
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbca7374cb2d7d67d48bd7c44687a5e86::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbca7374cb2d7d67d48bd7c44687a5e86::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbca7374cb2d7d67d48bd7c44687a5e86::$classMap;

        }, null, ClassLoader::class);
    }
}

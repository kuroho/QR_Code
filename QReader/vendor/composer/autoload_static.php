<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit09010da22fc30868f1cb3fcb28bd2ce1
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Libern\\QRCodeReader\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Libern\\QRCodeReader\\' => 
        array (
            0 => __DIR__ . '/..' . '/libern/qr-code-reader/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit09010da22fc30868f1cb3fcb28bd2ce1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit09010da22fc30868f1cb3fcb28bd2ce1::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}

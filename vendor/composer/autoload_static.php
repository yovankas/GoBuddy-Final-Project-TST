<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit992f601ccaba34d1842bb63c0d2df214
{
    public static $files = array (
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/..' . '/symfony/deprecation-contracts/function.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        'e69f7f6ee287b969198c3c9d6777bd38' => __DIR__ . '/..' . '/symfony/polyfill-intl-normalizer/bootstrap.php',
        'f598d06aa772fa33d905e87be6398fb1' => __DIR__ . '/..' . '/symfony/polyfill-intl-idn/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'U' => 
        array (
            'User\\CodeIgniter4Develop\\' => 25,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Intl\\Normalizer\\' => 33,
            'Symfony\\Polyfill\\Intl\\Idn\\' => 26,
            'Symfony\\Polyfill\\Ctype\\' => 23,
            'Symfony\\Contracts\\Service\\' => 26,
            'Symfony\\Contracts\\HttpClient\\' => 29,
            'Symfony\\Component\\Mime\\' => 23,
            'Symfony\\Component\\HttpClient\\' => 29,
            'Symfony\\Component\\DomCrawler\\' => 29,
            'Symfony\\Component\\CssSelector\\' => 30,
            'Symfony\\Component\\BrowserKit\\' => 29,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'Psr\\Container\\' => 14,
        ),
        'M' => 
        array (
            'Masterminds\\' => 12,
        ),
        'G' => 
        array (
            'Goutte\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'User\\CodeIgniter4Develop\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Intl\\Normalizer\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-intl-normalizer',
        ),
        'Symfony\\Polyfill\\Intl\\Idn\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-intl-idn',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'Symfony\\Contracts\\Service\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/service-contracts',
        ),
        'Symfony\\Contracts\\HttpClient\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/http-client-contracts',
        ),
        'Symfony\\Component\\Mime\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/mime',
        ),
        'Symfony\\Component\\HttpClient\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/http-client',
        ),
        'Symfony\\Component\\DomCrawler\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/dom-crawler',
        ),
        'Symfony\\Component\\CssSelector\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/css-selector',
        ),
        'Symfony\\Component\\BrowserKit\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/browser-kit',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/src',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'Masterminds\\' => 
        array (
            0 => __DIR__ . '/..' . '/masterminds/html5/src',
        ),
        'Goutte\\' => 
        array (
            0 => __DIR__ . '/..' . '/fabpot/goutte/Goutte',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Normalizer' => __DIR__ . '/..' . '/symfony/polyfill-intl-normalizer/Resources/stubs/Normalizer.php',
        'simplehtmldom\\Debug' => __DIR__ . '/..' . '/simplehtmldom/simplehtmldom/Debug.php',
        'simplehtmldom\\HtmlDocument' => __DIR__ . '/..' . '/simplehtmldom/simplehtmldom/HtmlDocument.php',
        'simplehtmldom\\HtmlNode' => __DIR__ . '/..' . '/simplehtmldom/simplehtmldom/HtmlNode.php',
        'simplehtmldom\\HtmlWeb' => __DIR__ . '/..' . '/simplehtmldom/simplehtmldom/HtmlWeb.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit992f601ccaba34d1842bb63c0d2df214::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit992f601ccaba34d1842bb63c0d2df214::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit992f601ccaba34d1842bb63c0d2df214::$classMap;

        }, null, ClassLoader::class);
    }
}

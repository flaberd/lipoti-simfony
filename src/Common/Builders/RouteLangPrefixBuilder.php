<?php

declare(strict_types=1);

namespace Lipoti\Shop\Common\Builders;

class RouteLangPrefixBuilder
{
    private const LANG_PREFIX = [
        'uk' => '/',
        'en' => '/{_locale}',
    ];

    public static function routeBuild($route): array
    {
        $langPrefix = self::LANG_PREFIX;
        array_walk($langPrefix, 'self::concatLink', $route);

        return $langPrefix;
    }

    private static function concatLink(&$item1, $key, $rout): void
    {
        $item1 = $item1 . $rout;
    }
}

<?php

declare(strict_types=1);

namespace Lipoti\Shop\Common\Helpers;

class ArrayHelper
{
    public static function multiSearchByValue($array, $value)
    {
        if (\is_array($array)) {
            foreach ($array as $item) {
                if (\is_array($item)) {
                    return self::multiSearchByValue($item, $value);
                }

                if ($item === $value) {
                    return true;
                }
            }
        }

        return false;
    }
}

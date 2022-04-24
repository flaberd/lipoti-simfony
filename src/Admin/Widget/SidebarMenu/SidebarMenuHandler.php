<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Widget\SidebarMenu;

class SidebarMenuHandler
{
    public function checkActive(array $children, string $path): bool
    {
        /** @var SidebarMenuItem $child */
        foreach ($children as $child) {
            if (\in_array($path, $child->getIndicatorPath(), true)) {
                return true;
            }
        }

        return false;
    }
}

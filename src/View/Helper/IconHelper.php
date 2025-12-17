<?php

namespace Bakeoff\DKFDS\View\Helper;

use Cake\View\View;

class IconHelper extends \Cake\View\Helper
{
    /**
     * Returns plugin-aware path to icons SVG sprite, pointing to specific icon
     * See full list of icons at: designsystem.dk/styleguide/ikoner/
     *
     * @param string $name Icon name inside sprite (e.g. "chevron-right")
     */
    public function href(string $name): string
    {
        return $this->getView()->Url->assetUrl('dkfds.img/all-svg-icons.svg') . '#' . $name;
    }

    /**
     * Returns SVG tag for specific icon
     * See full list of icons at: designsystem.dk/styleguide/ikoner/
     *
     * @param string $name Icon name inside sprite (e.g. "chevron-right")
     */
    public function svg(string $name): string
    {
        return sprintf(
            '<svg class="icon-svg" aria-hidden="true" focusable="false"><use href="%s"></use></svg>',
            h($this->href($name))
        );
    }
}

<?php

namespace Bakeoff\DKFDS\View\Helper;

class BreadcrumbsHelper extends \Cake\View\Helper\BreadcrumbsHelper
{

    protected array $helpers = ['Url', 'Icon'];

    /**
     * @inheritDoc
     */
    protected array $_defaultConfig = [
        'ariaCurrent' => 'last',
        'templates' => [
            'wrapper' => '<nav class="breadcrumbs container" aria-label="breadcrumb"><ol{{attrs}}>{{content}}</ol></nav>',
            'item' => '<li{{attrs}}><a href="{{url}}"{{innerAttrs}}>{{title}}</a></li>{{separator}}',
            'itemWithoutLink' => '<li{{attrs}}>{{title}}</li>',
            'separator' => '', // will be replaced with IconHelper output in initialize() below
        ],
    ];

    public function initialize(array $config): void
    {
        $templates = $this->getTemplates();
        $templates['separator'] = $this->Icon->svg('chevron-right');
        $this->setTemplates($templates);
    }

    /**
     * @inheritDoc
     */
    public function add(array|string $title, array|string|null $url = null, array $options = [])
    {
        $options = $this->addClass($options, 'breadcrumbs__list-item');
        $innerAttrs = $options['innerAttrs'] ?? [];
        $innerAttrs = $this->addClass($innerAttrs, 'breadcrumbs__link');
        $options['innerAttrs'] = $innerAttrs;
        if (is_string($title)) {
            return parent::add($title, $url, $options);
        }
        foreach ($title as $breadcrumb) {
            $result = parent::add($breadcrumb['title'], $breadcrumb['url'], $breadcrumb['options'] ?? $options);
        }
        return $result;
    }

    /**
     * @inheritDoc
     */
    public function render(array $attributes = [], array $separator = []): string
    {
        $attributes = $this->addClass($attributes, 'breadcrumbs__list');
        $separator = [true]; // renders nothing if we just pass []
        return parent::render($attributes, $separator);
    }
}

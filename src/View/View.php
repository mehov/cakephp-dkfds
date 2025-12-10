<?php

namespace Bakeoff\DKFDS\View;

class View extends \Cake\View\View {

    public function initialize(array $options = []): void
    {
        $helpers = [
        ];
        $this->helpers = array_merge($helpers, $this->helpers);

        parent::initialize();
    }

}
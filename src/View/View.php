<?php

namespace Bakeoff\DKFDS\View;

class View extends \Cake\View\View {

    public function initialize(array $options = []): void
    {
        $this->addHelper('Icon', ['className' => 'Bakeoff/DKFDS.Icon']);
        parent::initialize();
    }

}
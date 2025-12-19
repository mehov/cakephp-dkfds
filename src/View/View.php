<?php

namespace Bakeoff\DKFDS\View;

class View extends \Cake\View\View {

    public function initialize(array $options = []): void
    {
        $this->addHelper('Icon', ['className' => 'Bakeoff/DKFDS.Icon']);
        $this->addHelper('Form', [
            'className' => 'Bakeoff/DKFDS.Form',
            'templates' => 'Bakeoff/DKFDS.form_templates',
        ]);
        $this->addHelper('Breadcrumbs', ['className' => 'Bakeoff/DKFDS.Breadcrumbs']);
        parent::initialize($options);
    }

}
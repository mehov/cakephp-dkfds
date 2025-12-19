<?php

return array(
    'help' => '<span{{attrs}}>{{content}}</span>',
    'error' => '<span class="form-error-message" id="{{id}}">{{content}}</span>',
    'label' => '<label class="form-label"{{attrs}}>{{text}}</label>',
    'input' => '<input class="form-input" type="{{type}}" name="{{name}}"{{attrs}}>',
    'formGroup' => '{{label}}{{help}}{{error}}{{input}}',


    'containerClass' => 'form-group',
    'inputContainer' => '<div{{containerAttrs}} class="{{containerClass}}">{{content}}</div>',
    'inputContainerError' => '<div{{containerAttrs}} class="{{containerClass}} form-error">{{content}}</div>',


    // Label element used for radio and multi-checkbox inputs.
    // FDS wants inputs outside of their labels
    'nestingLabel' => '<label class="form-label"{{attrs}}>{{text}}</label>',


    'radioContainer' =>
        '<div class="{{containerClass}}"><fieldset{{containerAttrs}} aria-labelledby="{{groupId}}">{{legend}}{{help}}{{content}}</fieldset></div>',
    'radioContainerError' =>
        '<div class="{{containerClass}} form-error"><fieldset{{containerAttrs}} aria-labelledby="{{groupId}}">{{legend}}{{help}}{{error}}{{content}}</fieldset></div>',
    'radioLegend' => '<legend class="{{class}}" id="{{id}}">{{text}}</legend>',
    'radioWrapper' => '<div class="form-group-radio">{{input}}{{label}}</div>',
    'radioFormGroup' => '{{label}}{{input}}',
    'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',


    'checkboxContainerClass' => 'form-group-checkbox',
    'checkboxContainer' =>
        '<div class="{{containerClass}}"><div class="{{checkboxContainerClass}}"{{containerAttrs}}>{{content}}</div></div>',
    'checkboxContainerError' =>
        '<div class="{{containerClass}} form-error">{{error}}<div class="{{checkboxContainerClass}}"{{containerAttrs}}>{{content}}</div></div>',
    'checkboxFormGroup' => '{{input}}{{label}}{{help}}',
    'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',


    'submitContainer' => '<div class="mt-5">{{content}}</div>',
    'inputSubmit' => '<input type="{{type}}"{{attrs}}>',
);
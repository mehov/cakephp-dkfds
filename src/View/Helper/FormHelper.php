<?php

namespace Bakeoff\DKFDS\View\Helper;

class FormHelper extends \Cake\View\Helper\FormHelper
{

    public function __construct(\Cake\View\View $View, array $config = [])
    {
        parent::__construct($View, $config);
    }

    /**
     * {@inheritDoc}
     *
     * Additionally to the core form helper options, the following DKFDS related options are supported:
     * - `help` - Help text to include in the input container.
     */
    public function control(string $fieldName, array $options = []): string
    {
        // Ensure all options are present before we continue
        $options = $this->_parseOptions($fieldName, $options);
        // See if a type-specific callback has been defined
        $method_name = '_' . $options['type'] . 'Options';
        if (method_exists($this, $method_name)) {
            $options = $this->{$method_name}($fieldName, $options);
        }
        // Parse and render {{help}}, if provided
        $options = $this->_helpOption($fieldName, $options);

        $result = parent::control($fieldName, $options);
        return $result;
    }

    /**
     * Provides rendered HTML for {{help}} placeholder
     *
     * @param string $fieldName Field name.
     * @param array $options Options. See `$options` argument of `control()` method.
     * @return array
     */
    protected function _helpOption(string $fieldName, array $options): array
    {
        // If no help text provided, return early
        if (!isset($options['help']) || !$options['help']) {
            return $options;
        }
        // Force array structure with help text inside 'content' key
        if (!is_array($options['help'])) {
            $options['help'] = [
                'content' => $options['help'],
            ];
        }
        // Ensure rendered help element has a DOM ID
        if (!isset($options['help']['id'])) {
            $options['help']['id'] = $this->_domId($fieldName . '-hint');
        }
        // Ensure rendered help element has a DOM class
        $options['help']['class'] = 'form-hint';
        // Render HTML for help element and put it where Cake expects value for {{help}} placeholder
        $options['templateVars']['help'] = $this->templater()->format('help', [
            'content' => $options['help']['content'],
            'attrs' => $this->templater()->formatAttributes($options['help'], ['content']),
        ]);
        // Clean up
        unset($options['help']);

        return $options;
    }

    protected function _radioOptions(string $fieldName, array $options): array
    {
        // Ensure the radio always has .form-radio
        $options = $this->addClass($options, 'form-radio');
        // Remove the hidden input as it comes between the legend and radios
        // That breaks DKFDS margins and there's no easy way to move it above legend
        $options['hiddenField'] = false;
        // Render legend instead of label for the whole group
        if (isset($options['label'])) {
            $options['templateVars']['legend'] = $this->templater()->format('radioLegend', [
                'text' => $options['label'],
                'class' => 'form-label',
                'id' => $this->_domId($fieldName . '-legend'),
            ]);
            $options['label'] = false;
        }

        return $options;
    }

    protected function _selectOptions(string $fieldName, array $options): array
    {
        // Ensure the select always has .form-radio
        $options = $this->addClass($options, 'form-select');

        return $options;
    }

    protected function _checkboxOptions(string $fieldName, array $options): array
    {
        // Fetch and pass checkboxContainerClass value
        $options['templateVars']['checkboxContainerClass'] = $this->templater()->get('checkboxContainerClass');
        // Ensure the checkbox always has .form-checkbox
        $options = $this->addClass($options, 'form-checkbox');
        // FDS wants inputs outside of their labels
        // Same idea when we removed {{input}} from the 'nestingLabel' template
        // If this is not set to false, the checkbox never renders
        $options['nestedInput'] = false;

        return $options;
    }

    /**
     * @inheritDoc
     */
    public function submit(?string $caption = null, array $options = []): string
    {
        $options = $this->addClass($options, 'button');
        $options = $this->addClass($options, 'button-primary');

        $result = parent::submit($caption, $options);
        return $result;
    }

}


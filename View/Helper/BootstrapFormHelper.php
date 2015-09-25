<?php

/**
 * Copyright 2014, George Mponos
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2014, George Mponos
 * @author    George Mponos, <gmponos@gmail.com>
 * @link      http://github.com/gmponos/CakeTwitterBootstrap
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @todo      The functions for the horizontal elements must be removed
 *            horizontal elements must be created with an option
 */
App::uses('FormHelper', 'View/Helper');

/**
 * Bootstrap Form Helper
 * A helper to create forms compatibles
 * with the bootstrap front end framework
 */
class BootstrapFormHelper extends FormHelper
{
    /**
     * Added an array_merge_recursive for labels to combine $_inputDefaults
     * with specific view markup for labels like custom text.
     * Also removed null array for options existing in $_inputDefaults.
     *
     * @param array $options Description
     */
    protected function _parseOptions($options)
    {
        if (!empty($options['label']) && $options['label']) {
            if (!is_array($options['label'])) {
                $options['label'] = ['text' => $options['label']];
            }
            $options['label'] = array_merge_recursive($options['label'], ['class' => 'control-label']);
        }
        return parent::_parseOptions($options);
    }

    /**
     * Starts a new form with input defaults.
     *
     * @param string $model
     * @param array  $options
     * @return string
     */
    public function create($model = null, $options = [])
    {
        if (isset($options['horizontal']) && $options['horizonta']) {
            $this->horizontal = true;
        }
        $defaults = [
            'inputDefaults' => [
                'div' => [
                    'class' => 'form-group',
                ],
                'label' => [
                    'class' => 'control-label',
                ],
                'class' => 'form-control',
                'error' => [
                    'attributes' => [
                        'wrap' => 'p',
                        'class' => 'text-danger',
                    ],
                ],
            ],
            'class' => null,
            'role' => 'form',
        ];

        if (!empty($options['inputDefaults'])) {
            $options = array_merge_recursive($defaults['inputDefaults'], $options['inputDefaults']);
        } else {
            $options = array_merge_recursive($defaults, $options);
        }
        return parent::create($model, $options);
    }

    /**
     * Returns a formatted LABEL element for HTML FORMs. Will automatically generate
     * a `for` attribute if one is not provided.
     *
     * @param string       $fieldName This should be "Modelname.fieldname"
     * @param string       $text      Text that will appear in the label field. If
     *                                $text is left undefined the text will be inflected from the
     *                                fieldName.
     * @param array|string $options   An array of HTML attributes, or a string, to be used as a class name.
     * @return string The formatted label element
     */
    public function label($fieldName = null, $text = null, $options = [])
    {
        if (empty($options)) {
            $options = 'control-label';
        }
        return parent::label($fieldName, $text, $options);
    }

    /**
     * input method
     *
     * @param string $fieldName
     * @param array  $options
     * @return string
     */
    public function input($fieldName, $options = [])
    {
        $defaults = [
            'class' => 'form-control',
            'label' => [
                'class' => 'control-label',
            ],
        ];
        //** we need to make the input combine with <span class="input-group-addon">@</span>
        if (isset($options['icon'])) {
            $icon = $this->Html->icon($options['icon']);

            $between = '<div class="input-group">' . '<span class="input-group-addon">' . $icon . '</span>';

            $after = '</div>';
            $options = [
                'between' => $between,
                'after' => $after,
            ];
        }
        if (!isset($options['placeholder'])) {
            $options['placeholder'] = __(Inflector::humanize(Inflector::underscore($fieldName)));
        }
        return parent::input($fieldName, $options);
    }

    /**
     * file method
     *
     * @param string $fieldName
     * @param array  $options
     * @return string
     */
    public function file($fieldName, $options = [])
    {
        $defaults = [
            'div' => [
                'class' => 'form-group',
            ],
        ];
        $options = array_merge($defaults, $options);
        return parent::input($fieldName, $options);
    }

    /**
     * datepicker method
     *
     * @param string $fieldName
     * @param array  $options
     * @return string
     */
    public function datepicker($fieldName, $options = [])
    {
        $defaults = [
            'class' => 'form-control form-control-datepicker',
            'type' => 'text',
        ];
        $options = array_merge($defaults, $options);
        return parent::input($fieldName, $options);
    }

    /**
     * Clockpicker method
     *
     * @param string $fieldName
     * @param array  $options
     * @return string
     */
    public function clockpicker($fieldName, $options = [])
    {
        $options = [
            'div' => [
                'class' => 'form-group',
            ],
            'label' => [
                'class' => 'control-label form-control-label',
            ],
            'class' => 'form-control form-control-clockpicker',
            'type' => 'time',
            'interval' => 30,
            'timeFormat' => 24,
        ];

        return parent::input($fieldName, $options);
    }

    /**
     * Chosen
     *
     * @param string $fieldName
     * @param array  $options
     * @return string
     */
    public function chosen($fieldName, $options = [])
    {
        $defaults = [
            'div' => [
                'class' => 'form-group',
            ],
            'class' => 'form-control form-control-chosen',
            'empty' => true,
        ];

        if (isset($options['class'])) {
            $defaults = parent::addClass($defaults, $options['class']);
            unset($options['class']);
        }
        $options = array_merge($defaults, $options);
        return parent::input($fieldName, $options);
    }

    /**
     * Creates a reset button for a form
     *
     * @param string $title
     * @param array  $options
     * @return string
     */
    public function btnReset($title = '', $options = [])
    {
        $title = empty($title) ? __('Reset') : $title;
        $defaults = [
            'class' => 'btn btn-success btn-sm',
            'type' => 'reset',
        ];
        $options = array_merge($defaults, $options);
        return parent::button($title, $defaults);
    }

    /**
     * Creates a submit button for a form
     *
     * @param string $title
     * @param array  $options
     * @return string
     */
    public function btnSubmit($title = '', $options = [])
    {
        $title = empty($title) ? __('Submit') : $title;
        $defaults = [
            'class' => 'btn btn-success btn-sm',
            'type' => 'submit',
        ];
        $options = array_merge($defaults, $options);
        return parent::button($title, $defaults);
    }

    /**
     * Creates a cancel button. Used to dismiss modals
     *
     * @param string $title
     * @param array  $options
     * @return string
     */
    public function btnCancel($title = '', $options = [])
    {
        $title = empty($title) ? __('Cancel') : $title;
        $defaults = [
            'class' => 'btn btn-danger btn-sm',
            'type' => 'reset',
            'data-dismiss' => 'modal',
        ];
        $options = array_merge($defaults, $options);
        return parent::button($title, $defaults);
    }

    /**
     * Add divs and classes necessary for bootstrap to end form.
     *
     * @param array $options
     * @param array $secureAttributes
     * @return string
     */
    public function end($options = null, $secureAttributes = [])
    {
        if (!empty($options)) {
            if (!is_array($options)) {
                $options = ['label' => $options];
            }
            $defaults = [
                'class' => 'btn btn-success',
            ];
            $options = array_merge($defaults, $options);
        }
        return parent::end($options, $secureAttributes);
    }

}

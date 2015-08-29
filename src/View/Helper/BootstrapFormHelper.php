<?php

/**
 * Copyright 2014, George Mponos
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2014, George Mponos
 * @author    George Mponos, <gmponos@gmail.com>
 * @link      http://github.com/gmponos/CakeTwitterBootstrap
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @todo      The functions for the horizontal elements must be removed
 * horizontal elements must be created with an option
 */
namespace Cake\TwitterBootstrap;

use Cake\View\Helper\FormHelper;

/**
 * Bootstrap Form Helper
 *
 * A helper to create forms compatibles
 * with the bootstrap front end framework
 */
class BootstrapFormHelper extends FormHelper
{

    /**
     * bool
     * @var bool
     */
    protected $horizontal = false;

    /**
     * Added an array_merge_recursive for labels to combine $_inputDefaults
     * with specific view markup for labels like custom text.
     * Also removed null array for options existing in $_inputDefaults.
     *
     * @param  string $fieldName
     * @param  array  $options   Description
     * @return array
     */
    protected function _parseOptions($fieldName, $options)
    {
        if (!empty($options['label']) && $options['label']) {
            if (!is_array($options['label'])) {
                $options['label'] = array('text' => $options['label']);
            }
            $options['label'] = array_merge_recursive($options['label'], array('class' => 'control-label'));
        }
        return parent::_parseOptions($fieldName, $options);
    }

    /**
     * Starts a new form with input defaults.
     *
     * @param  string $model
     * @param  array  $options
     * @return string
     */
    public function create($model = null, $options = array())
    {
        if (isset($options['horizontal']) && $options['horizonta']) {
            $this->horizontal = true;
        }
        $defaults = [
            'inputDefaults' => [
                'div' => [
                    'class' => 'form-group'
                ],
                'label' => [
                    'class' => 'control-label',
                ],
                'class' => 'form-control',
                'error' => [
                    'attributes' => [
                        'wrap' => 'p',
                        'class' => 'text-danger'
                    ]
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
     * Starts a new form with input defaults for horizontal forms
     *
     * @param  string $model
     * @param  array  $options
     * @return string
     */
    public function createHorizontal($model = null, $options = array())
    {
        $defaults = [
            'inputDefaults' => [
                'div' => [
                    'class' => 'form-group'
                ],
                'label' => [
                    'class' => 'col-lg-3 control-label'
                ],
                'between' => '<div class="col-lg-9">',
                'after' => '</div>',
                'class' => 'form-control',
                'error' => [
                    'attributes' => [
                        'wrap' => 'p',
                        'class' => 'text-danger'
                    ]
                ],
            ],
            'class' => 'form-horizontal',
            'role' => 'form',
        ];

        if (!empty($options['inputDefaults'])) {
            $options = array_merge($defaults['inputDefaults'], $options['inputDefaults']);
        } else {
            $options = array_merge($defaults, $options);
        }
        return parent::create($model, $options);
    }

    /**
     * Returns a formatted LABEL element for HTML FORMs. Will automatically generate
     * a `for` attribute if one is not provided.
     *
     * @param  string       $fieldName This should be "Modelname.fieldname"
     * @param  string       $text      Text that will appear in the label field. If $text is left undefined the text will be inflected from the fieldName. $text is left undefined the text will be inflected from the fieldName.
     *   $text is left undefined the text will be inflected from the
     *   fieldName.
     * @param  array|string $options   An array of HTML attributes, or a string, to be used as a class name.
     * @return string The formatted LABEL element
     */
    public function label($fieldName = null, $text = null, $options = array())
    {
        if (empty($options)) {
            $options = 'control-label';
        }
        return parent::label($fieldName, $text, $options);
    }

    /**
     * input method
     *
     * @param  string $fieldName
     * @param  array  $options
     * @return string
     */
    public function input($fieldName, $options = array())
    {
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
            //$options['placeholder'] = __(Inflector::humanize(Inflector::underscore($fieldName)));
        }
        return parent::input($fieldName, $options);
    }

    /**
     * file method
     *
     * @param  string $fieldName
     * @param  array  $options
     * @return string
     */
    public function file($fieldName, $options = array())
    {
        $defaults = [
            'div' => [
                'class' => 'form-group'
            ],
        ];
        $options = array_merge($defaults, $options);
        return parent::input($fieldName, $options);
    }

    /**
     * datepicker method
     *
     * @param  string $fieldName
     * @param  array  $options
     * @return string
     */
    public function datepicker($fieldName, $options = array())
    {
        $defaults = [
            'class' => 'form-control form-control-datepicker',
            'type' => 'text'
        ];
        $options = array_merge($defaults, $options);
        return parent::input($fieldName, $options);
    }

    /**
     * Timepicker method
     *
     * @param  string $fieldName
     * @param  array  $options
     * @return string
     */
    public function timepicker($fieldName, array $options = [])
    {
        $options = [
            'div' => [
                'class' => 'form-group'
            ],
            'label' => [
                'class' => 'control-label form-control-label'
            ],
            'class' => 'form-control form-control-time',
            'type' => 'time',
            'interval' => 30,
            'timeFormat' => 24
        ];

        return parent::input($fieldName, $options);
    }

    /**
     * Chosen
     *
     * @param  string $fieldName
     * @param  array  $options
     * @return string
     */
    public function chosen($fieldName, array $options = [])
    {
        $defaults = [
            'div' => [
                'class' => 'form-group'
            ],
            'class' => 'form-control form-control-chosen',
            'empty' => true
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
     * @param  string $title
     * @param  array  $options
     * @return string
     */
    public function btnReset($title = '', $options = array())
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
     * @param  string $title
     * @param  array  $options
     * @return string
     */
    public function btnSubmit($title = '', array $options = [])
    {
        $title = empty($title) ? __('Submit') : $title;
        $options = array_merge(
            [
            'class' => 'btn btn-success btn-sm',
            'type' => 'submit',
            ], $options
        );
        return parent::button($title, $options);
    }

    /**
     * Creates a cancel button. Used to dismiss modals
     *
     * @param  string $title
     * @param  array  $options
     * @return string
     */
    public function btnCancel($title = '', array $options = [])
    {
        $title = empty($title) ? __('Cancel') : $title;
        $options = array_merge(
            [
            'class' => 'btn btn-danger btn-sm',
            'type' => 'reset',
            'data-dismiss' => 'modal'
            ], $options
        );
        return parent::button($title, $options);
    }

    /**
     * Add divs and classes necessary for bootstrap
     * to end form.
     *
     * @param  array $options
     * @return string
     */
    public function end($options = null)
    {
        if (!empty($options)) {
            if (!is_array($options)) {
                $options = ['label' => $options];
            }
            $defaults = [
                'class' => 'btn btn-success'
            ];
            $options = array_merge($defaults, $options);
        }
        return parent::end($options);
    }

}

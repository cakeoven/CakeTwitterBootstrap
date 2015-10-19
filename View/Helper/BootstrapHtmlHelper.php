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
 */

App::uses('HtmlHelper', 'View/Helper');

/**
 * BootstrapHtml Helper
 *
 * @name BootstrapHtml
 */
class BootstrapHtmlHelper extends HtmlHelper
{

    /**
     * Icon prefix
     *
     * @var string
     */
    private $iconPrefix = 'fa';

    /**
     * Displays an h1 tag wrapped in a div with the page-header class
     *
     * @param  string $title
     * @param  string $h
     * @return string
     */
    public function pageHeader($title, $h)
    {
        if (!$this->_isHeader($h)) {
            return false;
        }
        return parent::tag("div", "<$h>$title</$h>", ["class" => "page-header"]);
    }

    /**
     * Returns a panel header
     *
     * @param  string $title
     * @param  string $h
     * @return string
     */
    public function panelHeader($title, $h = 'h1')
    {
        $panelTitle = parent::tag($h, $title, ['class' => 'panel-title']);
        return parent::tag("div", $panelTitle, ['class' => 'panel-heading']);
    }

    /**
     * Returns a modal header
     *
     * @param  string $title
     * @param  string $h
     * @return string
     */
    public function modalHeader($title, $h = 'h4')
    {
        $modalTitle = parent::tag($h, $title, ['class' => 'modal-title']);
        return parent::tag("div", $modalTitle, ["class" => 'modal-header']);
    }

    /**
     * returns a dl element
     *
     * @param  array $data
     * @param  array $options
     * @param  bool  $skipEmpty
     * @return string
     */
    public function descriptionList(array $data, array $options = [], $skipEmpty = false)
    {
        if (empty($data)) {
            return false;
        }

        $out = [];
        foreach ($data as $descr => $value) {
            if ($skipEmpty && empty($value)) {
                continue;
            }
            $out[] = parent::tag('dt', $descr);
            $out[] = parent::tag('dd', $value);
        }

        return parent::tag('dl', implode("\n", $out), $options);;
    }

    /**
     * creates a div with well properties
     *
     * @param  string $text
     * @param  string $size
     * @param  array  $options
     * @return string
     */
    public function well($text, $size = null, array $options = [])
    {
        $options = ['class' => 'well'];

        if (!empty($size)) {
            switch ($size) {
                case 'lg':
                case 'large':
                    $options = parent::addClass($options, 'well-lg');
                    break;
                case 'sm':
                case 'small':
                    $options = parent::addClass($options, 'well-sm');
                    break;
            }
        }
        return parent::tag('div', $text, $options);
    }

    /**
     * Creates a paragraph with lead class
     *
     * @param  string $content
     * @param  array  $options
     * @return string
     */
    public function lead($content, $options = [])
    {
        $options = array_merge(['class' => 'lead'], $options);
        return parent::tag('p', $content, $options);
    }

    /**
     * Creates a Bootstrap label with $message and optionally the $type. Any
     * options that could get passed to HtmlHelper::tag can be passed in the
     * third param.
     *
     * @param  string $text
     * @param  string $contextual
     * @param  array  $options
     * @return string
     */
    public function label($text, $contextual, array $options = [])
    {
        if (isset($options['icon']) && !empty($options['icon'])) {
            $text = $this->_icon($text, $options['icon']);
            unset($options['icon']);
        }

        $classes = "label label-$contextual";
        if (isset($options['class']) && !empty($options['class'])) {
            $classes .= " " . $options['class'];
        }

        $options['class'] = $classes;
        return parent::tag('span', $text, $options);
    }

    /**
     * Creates an HTML link.
     * If $url starts with "http://" this is treated as an external link. Else,
     * it is treated as a path to controller/action and parsed with the
     * HtmlHelper::url() method.
     * If the $url is empty, $title is used instead.
     * ## `options`
     * - `escape` Set to false to disable escaping of title and attributes.
     * - `escapeTitle` Set to false to disable escaping of title. (Takes precedence over value of `escape`)
     * - `confirm` JavaScript confirmation message.
     * - `icon` Sets properties to wrap an icon inside the link if it is not an array the value is used for type
     *  - `class` set the class of the icon
     *
     * @param  string       $title          The content to be wrapped by <a> tags.
     * @param  string|array $url            Cake-relative URL or array of URL parameters, or external URL (starts with
     *                                      http://)
     * @param  array        $options        Array of options and HTML attributes.
     * @param string|bool   $confirmMessage JavaScript confirmation message.
     * @return string An `<a />` element.
     */
    public function link($title, $url = null, $options = [], $confirmMessage = false)
    {
        if (empty($url)) {
            $url = $title;
        }

        if (isset($options['icon']) && !empty($options['icon'])) {
            $title = $this->_icon($title, $options['icon']);
            $options['escape'] = false;
            unset($options['icon']);
        }
        return parent::link($title, $url, $options, $confirmMessage);
    }

    /**
     * Creates a button element
     * ## `options`
     *  - `icon` Sets an icon to wrap inside the button if string you set the type
     *    of the icon
     *   - `class` Sets additional classes for the icon
     *
     * @param  string $text Set the title of the button
     * @param  array  $options
     * @return string
     */
    public function button($text, $options = [])
    {
        if (isset($options['icon']) && !empty($options['icon'])) {
            $text = $this->_icon($text, $options['icon']);
            unset($options['icon']);
        }

        if (!isset($options['type']) || empty($options['type'])) {
            $options['type'] = 'button';
        }
        return parent::tag('button', $text, $options);
    }

    /**
     * @param string $text
     * @param string $target
     * @param array  $options
     * @return string
     */
    public function tab($text, $target, $options = [])
    {
        $defaults = [
            'data-toggle' => 'tab',
            'role' => 'tab',
            'li' => '',
        ];

        $options = Hash::merge($defaults, $options);
        $liOptions = $options['li'];
        unset($options['li']);

        $link = $this->link($text, $target, $options);
        return $this->tag('li', $link, $liOptions);
    }

    /**
     * return a badge
     *
     * @param  string $text
     * @param  array  $options
     * @return string
     */
    public function badge($text, $options = [])
    {
        $defaults = array_merge(['class' => 'badge'], $options);
        return parent::tag('span', $text, $defaults);
    }

    /**
     * Returns a well formatted check. Used special for booleans
     *
     * @param  string $value
     * @param  array  $url
     * @return string
     */
    public function status($value, $url = [])
    {
        $icon = $value == true ? 'check' : 'times';
        $contextual = $value == true ? 'success' : 'danger';
        return $this->label('', $contextual, ['icon' => $icon]);
    }

    /**
     * Returns an icon element followed by a text
     *
     * @example `<i class="fa fa-search"></i> Text`
     * @param   string $type
     * @param   string $text
     * @param   array  $options
     * @return  string
     */
    public function icon($type, $text = '', array $options = [])
    {
        $icon = $this->iconPrefix;
        $class = "$icon $icon-$type";

        if (isset($options['class']) && !empty($class)) {
            $options['class'] = $class . ' ' . $options['class'];
        } else {
            $options['class'] = $class;
        }
        $tag = parent::tag('i', '', $options);
        return trim($tag . ' ' . $text);
    }

    /**
     * Returns an icon element followed by a text.
     * This function is used for generating an icon for internal functions inside this
     * helper.
     *
     * @param  string       $title
     * @param  string|array $options
     * @return string
     * todo We need to refactor this function in order to load an array of icon class with no prefix on the class
     */
    protected function _icon($title, $options)
    {
        if (is_array($options)) {
            if (!isset($options['class']) || empty($options['class'])) {
                return $title;
            }

            $tag = parent::tag('i', '', $options);
            return trim($tag . ' ' . $title);
        }

        if (is_string($options)) {
            if (empty($options)) {
                return $title;
            }
            $icon = $this->iconPrefix;
            $options = ["class" => "$icon $icon-$options"];
        }

        $tag = parent::tag('i', '', $options);
        return trim($tag . ' ' . $title);
    }

    /**
     * Returns true if the tag is a header
     *
     * @param  string $tag
     * @return boolean
     */
    protected function _isHeader($tag)
    {
        if (in_array($tag, ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'])) {
            return true;
        }
        return false;
    }

}

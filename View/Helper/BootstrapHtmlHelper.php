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
 *            horizontal elements must be created with an option
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
        return parent::tag("div", "<$h>$title</$h>", array("class" => "page-header"));
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
        $panelTitle = parent::tag($h, $title, array('class' => 'panel-title'));
        return parent::tag("div", $panelTitle, array('class' => 'panel-heading'));
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
        $modalTitle = parent::tag($h, $title, array('class' => 'modal-title'));
        return parent::tag("div", $modalTitle, array("class" => 'modal-header'));
    }

    /**
     * returns a dl element
     *
     * @param  string $data
     * @param  array  $options
     * @param  array  $dtOpts
     * @param  array  $ddOpts
     * @return string
     */
    public function descriptionList($data, $options = array(), $dtOpts = array(), $ddOpts = array())
    {
        if (empty($data) || !is_array($data)) {
            return false;
        }
        $out = array();

        $dtOptions = parent::_parseAttributes($dtOpts);
        $ddOptions = parent::_parseAttributes($ddOpts);

        foreach ($data as $descr => $value) {
            $out[] = sprintf($this->_tags['dt'], $dtOptions, $descr);
            $out[] = sprintf($this->_tags['dd'], $ddOptions, $value);
        }
        $dl = sprintf($this->_tags['dl'], parent::_parseAttributes($options), implode("\n", $out));
        return $dl;
    }

    /**
     * creates a div with well properties
     *
     * @param  string $text
     * @param  string $size
     * @param  array  $options
     * @return string
     */
    public function well($text, $size = null, $options = array())
    {
        $options = array('class' => 'well');

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
    public function lead($content, $options = array())
    {
        $options = array_merge(array('class' => 'lead'), $options);
        return parent::tag('p', $content, $options);
    }

    /**
     * Creates a Bootstrap label with $messsage and optionally the $type. Any
     * options that could get passed to HtmlHelper::tag can be passed in the
     * third param.
     *
     * @param  string $text
     * @param  string $contextual
     * @param  array  $options
     * @return string
     */
    public function label($text, $contextual = '', $options = array())
    {
        $class = $prefix = 'label';
        $contextuals = array(
            'default',
            'primary',
            'success',
            'warning',
            'danger',
            'info',
        );

        if (isset($options['icon'])) {
            $content = $this->_icon($text, $options);
            unset($options['icon']);
        } else {
            $content = $text;
        }
        if (!empty($contextual) && in_array($contextual, $contextuals)) {
            $class .= " $prefix-$contextual";
        }
        $classes = $class;
        if (isset($options['class']) && !empty($options['class'])) {
            $classes .= " " . $options['class'];
        }
        $options['class'] = $classes;
        return parent::tag('span', $content, $options);
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
     * @param string        $confirmMessage JavaScript confirmation message.
     * @return string An `<a />` element.
     */
    public function link($title, $url = null, $options = array(), $confirmMessage = false)
    {
        if (empty($url)) {
            $url = $title;
        }
        if (isset($options['icon'])) {
            $title = $this->_icon($title, $options);
            $options['escape'] = false;
            unset($options['icon']);
        }
        return parent::link($title, $url, $options, $confirmMessage);
    }

    /**
     * Create a link list item
     *
     * @param  array  $url
     * @param  string $title
     * @param  array  $options
     * @return string
     */
    public function listGroupItemLink($url, $title, $options = array())
    {
        $class = 'list-group-item';
        if (isset($options['active']) && $options['active']) {
            $class = "$class active";
        }
        $defaults = array(
            'class' => $class,
        );
        $text = $this->_generateListGroupText($title);
        $options = array_merge($defaults, $options);
        return $this->link($text, $url, $options);
    }

    /**
     * Create a link list item
     *
     * @param  array $title
     * @param  array $options
     * @return string
     */
    public function listGroupItem($title, $options = array())
    {
        $class = 'list-group-item';
        if (isset($options['active']) && $options['active']) {
            $class = "$class active";
        }
        $defaults = array(
            'class' => $class,
        );
        $text = $this->_generateListGroupText($title);
        $options = array_merge($defaults, $options);
        return $this->div('list-group-item', $text, $options);
    }

    /**
     * _generateListGroupText
     * Generates the text for the list group item
     *
     * @param  string $title
     * @return string
     */
    protected function _generateListGroupText($title)
    {
        if (is_array($title)) {
            $text = '';
            if (!empty($title['header'])) {
                $text .= $this->tag('h4', $title['header'], array('class' => 'list-group-item-heading'));
            }
            if (!empty($title['text'])) {
                $text .= $this->para('list-group-item-text', $title['text']);
            }
        } else {
            $text = $title;
        }
        return $text;
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
    public function button($text, $options = array())
    {
        if (isset($options['icon'])) {
            $text = $this->_icon($text, $options);
            unset($options['icon']);
        }
        if (!isset($options['type']) || empty($options['type'])) {
            $options['type'] = 'button';
        }
        return parent::tag('button', $text, $options);
    }

    /**
     * return a badge
     *
     * @param  string $text
     * @param  array  $options
     * @return string
     */
    public function badge($text, $options = array())
    {
        $defaults = array_merge(array('class' => 'badge'), $options);
        return parent::tag('span', $text, $defaults);
    }

    /**
     * @param string $text
     * @param string $target
     * @param array  $options
     * @return string
     */
    public function tab($text, $target, $options = array())
    {
        $defaults = array(
            'data-toggle' => 'tab',
        );
        $liOptions = array();
        if (isset($options['active'])) {
            $liOptions['class'] = 'active';
            unset($options['active']);
        }
        $options = array_merge($defaults, $options);
        $link = $this->link($text, $target, $options);
        return $this->tag('li', $link, $liOptions);
    }

    /**
     * Returns a well formatted check. Used special for booleans
     *
     * @param  string $value
     * @param  array  $url
     * @return string
     */
    public function status($value, $url = array())
    {
        $icon = $value == true ? 'check' : 'times';
        $contextual = $value == true ? 'success' : 'danger';
        return $this->label('', $contextual, array('icon' => $icon));
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
    public function icon($type, $text = '', $options = array())
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
     * This function is used for generating an icon for the functions inside this
     * helper.
     *
     * @param  string       $title
     * @param  string|array $options
     * @return string
     */
    protected function _icon($title, $options = '')
    {
        if (empty($options)) {
            $options = $title;
        }
        if (is_array($options) && array_key_exists('icon', $options)) {
            $options = $options['icon'];
        }
        if (is_array($options)) {
            if (!isset($options['class']) || empty($options['class'])) {
                return $title;
            }
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
        if (in_array($tag, array('h1', 'h2', 'h3', 'h4', 'h5', 'h6'))) {
            return true;
        }
        return false;
    }

}

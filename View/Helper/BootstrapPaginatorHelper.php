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
App::uses('PaginatorHelper', 'View/Helper');

/**
 * BootstrapHtml Helper
 *
 * @name BootstrapHtml
 */
class BootstrapPaginatorHelper extends PaginatorHelper
{
    /**
     * Helper dependencies
     *
     * @var array
     */
    public $helpers = ['Html'];

    public function first($first = '«', array $options = [])
    {
        $defaults = ['class' => 'first', 'tag' => 'li'];
        $options = Hash::merge($defaults, $options);
        return parent::first($first, $options);
    }

    public function prev($title = '‹', array $options = [], $disabledTitle = null, array $disabledOptions = [])
    {
        $defaults = ['tag' => 'li'];
        $disabledOptions = ['class' => 'prev disabled', 'tag' => 'li', 'disabledTag' => 'a'];
        return parent::prev($title, $options, $disabledTitle, $disabledOptions);
    }

    public function numbers(array $options = [])
    {
        $defaults = ['separator' => '', 'tag' => 'li', 'currentTag' => 'a'];
        $options = Hash::merge($defaults, $options);
        return parent::numbers($options);
    }

    public function next($title = '›', array $options = [], $disabledTitle = null, array $disabledOptions = [])
    {
        $defaults = ['tag' => 'li'];
        $disabledOptions = ['class' => 'prev disabled', 'tag' => 'li', 'disabledTag' => 'a'];
        return parent::next($title, $options, $disabledTitle, $disabledOptions);
    }

    public function last($last = '»', array $options = [])
    {
        $defaults = ['class' => 'last', 'tag' => 'li'];
        return parent::last($last, $options);
    }
}
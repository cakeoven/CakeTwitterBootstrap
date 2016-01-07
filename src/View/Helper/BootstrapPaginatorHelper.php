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
namespace CakeBootstrap\View\Helper;

use Cake\Utility\Hash;
use Cake\View\Helper\PaginatorHelper;

/**
 * BootstrapPaginator Helper
 *
 * @name BootstrapPaginator
 */
class BootstrapPaginatorHelper extends PaginatorHelper
{

    public function first($first = '«', array $options = [])
    {
        $defaults = ['class' => 'first', 'tag' => 'li'];
        $options = Hash::merge($defaults, $options);
        return parent::first($first, $options);
    }

    public function prev($title = '‹', array $options = [])
    {
        $defaults = ['tag' => 'li'];
        $options = Hash::merge($defaults, $options);
        return parent::prev($title, $options);
    }

    public function numbers(array $options = [])
    {
        $defaults = ['separator' => '', 'tag' => 'li', 'currentTag' => 'a'];
        $options = Hash::merge($defaults, $options);
        return parent::numbers($options);
    }

    public function next($title = '›', array $options = [])
    {
        $defaults = ['tag' => 'li'];
        $options = Hash::merge($defaults, $options);
        return parent::next($title, $options);
    }

    public function last($last = '»', array $options = [])
    {
        $defaults = ['class' => 'last', 'tag' => 'li'];
        $options = Hash::merge($defaults, $options);
        return parent::last($last, $options);
    }
}
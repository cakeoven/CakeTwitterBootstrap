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
 * @name BootstrapIcon
 */
class BootstrapIconHelper extends HtmlHelper
{
    /**
     * @param        $type
     * @param        $text
     * @param array  $classes
     * @param string $family
     * @return string
     */
    public function icon($type, $text, array $classes = [], $family = 'fa')
    {
        $options = [
            'class' => [
                "$family",
                "$family-$type",
            ],
        ];

        if (!empty($classes)) {
            foreach ($classes as $ext) {
                $options['class'][] = "$family-$ext";
            }
        }
        $tag = parent::tag('i', '', $options);
        return trim($tag . ' ' . $text);
    }
}
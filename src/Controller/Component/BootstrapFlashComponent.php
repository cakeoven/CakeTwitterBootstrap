<?php

namespace CakeBootstrap\Controller\Component;

use Cake\Controller\Component\FlashComponent;

/**
 * Class BootstrapFlashComponent
 *
 * @package CakeBootstrap\Controller\Component
 * @method success($message, array $options = [])
 * @method error($message, array $options = [])
 */
class BootstrapFlashComponent extends FlashComponent
{

    /**
     * Magic function call
     *
     * @param string $name Element name to use.
     * @param array  $args Parameters to pass when calling `FlashComponent::set()`.
     * @return void
     */
    public function __call($name, $args)
    {
        if (!isset($args[1]['plugin']) || empty($args[1]['plugin'])) {
            $args[1]['plugin'] = "CakeBootstrap";
        }

        parent::__call($name, $args);
    }
}

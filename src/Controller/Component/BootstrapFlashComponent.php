<?php

namespace CakeBootstrap\Controller\Component;

use Cake\Controller\Component\FlashComponent;

/**
 * Class BootstrapFlashComponent
 *
 * @package CakeBootstrap\Controller\Component
 * @method success($message, array $options = [])
 * @method info($message, array $options = [])
 * @method warning($message, array $options = [])
 * @method danger($message, array $options = [])
 * @method error($message, array $options = [])
 */
class BootstrapFlashComponent extends FlashComponent
{

    /**
     * @inheritdoc
     */
    public function set($message, array $options = [])
    {
        if (!isset($options['element'])) {
            return parent::set($message, $options);
        }

        list($plugin, $element) = pluginSplit($options['element']);
        if (!$plugin) {
            $options['element'] = sprintf('CakeBootstrap.%s', $element);
        }

        return parent::set($message, $options);
    }

    /**
     * Magic function call
     *
     * @todo review if this is needed or the bug from CakePHP is fixed
     * @param string $name Element name to use.
     * @param array  $args Parameters to pass when calling `FlashComponent::set()`.
     * @return void
     */
    public function __call($name, $args)
    {
        if (!isset($args[1]['plugin']) || empty($args[1]['plugin'])) {
            $args[1]['plugin'] = 'CakeBootstrap';
        }

        parent::__call($name, $args);
    }
}

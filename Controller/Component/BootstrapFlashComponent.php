<?php

App::uses('FlashComponent', 'Controller/Component');

/**
 * BootstrapFlash Component
 *
 * @author George Mponos <gmponos@gmail.com>
 * @method danger($message, $options = [])
 * @method error($message, $options = [])
 * @method info($message, $options = [])
 * @method success($message, $options = [])
 * @method warning($message, $options = [])
 */
class BootstrapFlashComponent extends FlashComponent
{

    /**
     * Default configuration
     *
     * @var array
     */
    protected $_defaultConfig = [
        'key' => 'flash',
        'element' => 'default',
        'params' => [],
        'plugin' => 'CakeBootstrap',
    ];

    /**
     * Magic method for verbose flash methods based on element names.
     * For example: $this->Flash->success('My message') would use the
     * success.ctp element under `app/View/Element/Flash` for rendering the
     * flash message.
     *
     * @param string $name Element name to use.
     * @param array  $args Parameters to pass when calling `FlashComponent::set()`.
     * @return void
     * @throws InternalErrorException If missing the flash message.
     */
    public function __call($name, $args)
    {
        $options = [
            'element' => Inflector::underscore($name),
            'plugin' => 'CakeBootstrap',
        ];

        if (count($args) < 1) {
            throw new InternalErrorException('Flash message missing.');
        }

        if (!empty($args[1])) {
            $options += (array)$args[1];
        }

        $this->set($args[0], $options);
    }

    /**
     * Used to set a session variable that can be used to output messages in the view.
     * In your controller: $this->Flash->set('This has been saved');
     * ### Options:
     * - `key` The key to set under the session's Flash key
     * - `element` The element used to render the flash message. Default to 'default'.
     * - `params` An array of variables to make available when using an element
     *
     * @param string $message Message to be flashed. If an instance
     *                        of Exception the exception message will be used and code will be set
     *                        in params.
     * @param array  $options An array of options.
     * @return void
     */
    public function set($message, $options = [])
    {
        $options += $this->_defaultConfig;

        if ($message instanceof Exception) {
            $options['params'] += ['code' => $message->getCode()];
            $message = $message->getMessage();
        }

        list($plugin, $element) = pluginSplit($options['element']);

        if ($plugin) {
            $options['plugin'] = $plugin;
        }

        if (!empty($options['plugin'])) {
            $options['element'] = $options['plugin'] . '.Flash/' . $element;
        } else {
            $options['element'] = 'Flash/' . $element;
        }

        CakeSession::write('Message.' . $options['key'], [
            'message' => $message,
            'key' => $options['key'],
            'element' => $options['element'],
            'params' => $options['params'],
        ]);
    }
}
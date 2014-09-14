<?php

App::uses('HtmlHelper', 'View/Helper');

/**
 * BootstrapHtml Helper
 *
 * @name BootstrapHtml
 */
class BootstrapHtmlHelper extends HtmlHelper {

/**
 * Displays an h1 tag wrapped in a div with the page-header class
 *
 * @param string $title
 * @return string
 */
	public function pageHeader($title, $h) {
		if (!$this->_isHeader($h)) {
			return false;
		}
		return parent::tag("div", "<$h>$title</$h>", array("class" => "page-header"));
	}

/**
 * Returns a section header
 *
 * @param string $title
 * @param string $h
 * @return string
 */
	public function sectionHeader($title, $h = 'h5') {
		if (!$this->_isHeader($h)) {
			return false;
		}
		return parent::tag($h, $title, array('class' => 'section-header'));
	}

/**
 * Returns a panel header
 *
 * @param string $title
 * @param string $h
 * @return string
 */
	public function panelHeader($title, $h = 'h1') {
		$panelTitle = parent::tag($h, $title, array('class' => 'panel-title'));
		return parent::tag("div", $panelTitle, array('class' => 'panel-heading'));
	}

/**
 * Returns a modal header
 *
 * @param string $title
 * @param string $h
 * @return string
 */
	public function modalHeader($title, $h = 'h4') {
		$modalTitle = parent::tag($h, $title, array('class' => 'modal-title'));
		return parent::tag("div", $modalTitle, array("class" => 'modal-header'));
	}

/**
 * returs a dl element
 *
 * @param type $data
 * @param type $options
 * @param type $dtOpts
 * @param type $ddOpts
 * @return string
 */
	public function descriptionList($data, $options = array(), $dtOpts = array(), $ddOpts = array()) {
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
 * @param string $text
 * @param string $size
 * @param array $options
 * @return string
 */
	public function well($text, $size = null, $options = array()) {
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
 * Creates a Bootstrap paragraph with lead class
 *
 * @param string $content
 * @param array $options
 * @return type
 */
	public function lead($content, $options = array()) {
		$defaults = array('class' => 'lead');
		$options = array_merge($defaults, $options);
		return parent::tag('p', $content, $defaults);
	}

/**
 * Creates a Bootstrap label with $messsage and optionally the $type. Any
 * options that could get passed to HtmlHelper::tag can be passed in the
 * third param.
 *
 * @param string $content
 * @param string $contextual
 * @param array $options
 * @return string
 */
	public function label($text, $contextual = '', $options = array()) {
		$class = $prefix = 'label';
		$contextuals = array(
			'success',
			'important',
			'warning',
			'info',
			'inverse',
		);

		if (isset($options['icon'])) {
			$content = $this->_icon($text, $options);
			unset($options['icon']);
		}
		if (!empty($contextual) && in_array($contextual, $contextuals)) {
			$class .= " $prefix-$contextual";
		}
		$classes = $class;
		if (isset($options['class']) && !empty($options['class'])) {
			$classes .= " " . $options['class'];
			unset($options['class']);
		}
		return parent::tag('span', $content, $options);
	}

/**
 * Creates an HTML link.
 *
 * If $url starts with "http://" this is treated as an external link. Else,
 * it is treated as a path to controller/action and parsed with the
 * HtmlHelper::url() method.
 *
 * If the $url is empty, $title is used instead.
 *
 * ## `options`
 * - `escape` Set to false to disable escaping of title and attributes.
 * - `escapeTitle` Set to false to disable escaping of title. (Takes precedence over value of `escape`)
 * - `confirm` JavaScript confirmation message.
 * - `icon` Sets properties to wrap an icon inside the link if it is not an array the value is used for type
 *  - `class` set the class of the icon
 *
 * @param string $title The content to be wrapped by <a> tags.
 * @param string|array $url Cake-relative URL or array of URL parameters, or external URL (starts with http://)
 * @param array $options Array of options and HTML attributes.
 * @param string $confirmMessage JavaScript confirmation message.
 * @return string An `<a />` element.
 */
	public function link($title, $url = null, $options = array(), $confirmMessage = false) {
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
 * btnLinkEdit
 *
 * @param integer|array $url Insert the id or the url
 * @param type $title
 * @param type $options
 * @return string
 */
	public function btnLinkEdit($url, $title = '', $options = array()) {
		$defaults = array(
			'class' => 'btn btn-primary btn-xs',
			'icon' => 'edit',
		);
		if(!is_array($url)){
			$url = array('action' => 'edit', $url);
		}
		$options = array_merge($defaults, $options);
		return $this->link($title, $url, $options);
	}

/**
 * btnLinkView
 *
 * @param integer|array $url Insert the id or the url
 * @param type $title
 * @param type $options
 * @return string
 */
	public function btnLinkView($url, $title = '', $options = array()) {
		$defaults = array(
			'class' => 'btn btn-primary btn-xs',
			'icon' => 'search',
		);
		if(!is_array($url)){
			$url = array('action' => 'view', $url);
		}
		$options = array_merge($defaults, $options);
		return $this->link($title, $url, $options);
	}

/**
 * btnLinkMail
 *
 * @param integer|array $url Insert the id or the url
 * @param type $title
 * @param type $options
 * @return string
 */
	public function btnLinkMail($url, $title = '', $options = array()) {
		$defaults = array(
			'class' => 'btn btn-primary btn-xs',
			'icon' => 'envelope',
			'data-toggle' => 'email',
		);
		if(!is_array($url)){
			$url = array('admin' => false, 'action' => 'mail', $url);
		}
		$options = array_merge($defaults, $options);
		return $this->link($title, $url, $options);
	}

/**
 * btnLinkDelete
 *
 * @param integer|array $url Insert the id or the url
 * @param type $title
 * @param type $options
 * @return string
 */
	public function btnLinkDelete($url, $title = '', $options = array()) {
		$defaults = array(
			'class' => 'btn btn-danger btn-delete btn-xs',
			'icon' => 'times',
			'data-toggle' => 'delete',			
		);
		if(!is_array($url)){
			$url = array('action' => 'delete', $url);
		}
		$options = array_merge($defaults, $options);
		return $this->link($title, $url, $options);
	}

/**
 * Create a List Item
 * 
 * @param array $url
 * @param string $title
 * @param array $options
 * @return string
 */
	public function listItemLink($url, $title, $options = array()) {
		$defaults = array(
			'class' => 'list-group-item'			
		);
		$options = array_merge($defaults, $options);
		return $this->link($title, $url, $options);
	}

/**
 * Create a List Item redirecting to an add action
 * 
 * @param string $title
 * @param array $options
 * @return string
 */
	public function listItemLinkAdd($title = '', $options = array()) {
		$defaults = array(
			'class' => 'list-group-item',
			'icon' => array('class' => 'icon icon-plus icon-fw'),
		);
		if (empty($title)) {
			$title = __('Add');
		}
		$options = array_merge($defaults, $options);
		return $this->link($title, array('action' => 'add'), $options);
	}

/**
 *
 * @param array $url
 * @param string $title
 * @param array $options
 * @return string
 */
	public function listItemLinkEdit($url, $title = '', $options = array()) {
		$defaults = array(
			'class' => 'list-group-item',
			'icon' => array('class' => 'icon icon-pencil icon-fw'),
		);
		if(!is_array($url)){
			$url = array('action' => 'edit', $url);
		}		
		if (empty($title)) {
			$title = __('Edit');
		}
		$options = array_merge($defaults, $options);
		return $this->link($title, $url, $options);
	}

/**
 *
 * @param array $url
 * @param string $title
 * @param array $options
 * @return string
 */
	public function listItemLinkMail($url, $title = '', $options = array()) {
		$defaults = array(
			'class' => 'list-group-item',
			'icon' => array('class' => 'icon icon-envelope icon-fw'),
			'data-toggle' => 'email',
		);
		if(!is_array($url)){
			$url = array('action' => 'mail', $url);
		}
		if (empty($title)) {
			$title = __('Mail');
		}
		$options = array_merge($defaults, $options);
		return $this->link($title, $url, $options);
	}

/**
 *
 * @param array $url
 * @param string $title
 * @param array $options
 * @return string
 */
	public function listItemLinkDelete($url, $title = '', $options = array()) {
		$defaults = array(
			'class' => 'list-group-item',
			'icon' => array('class' => 'icon icon-times icon-fw'),
		);
		if(!is_array($url)){
			$url = array('action' => 'delete', $url);
		}		
		if (empty($title)) {
			$title = __('Delete');
		}
		$options = array_merge($defaults, $options);
		return $this->link($title, $url, $options);
	}

/**
 * Creates a button element
 *
 * ## `options`
 *  - `icon` Sets an icon to wrap inside the button if string you set the type
 * 	of the icon
 *   - `class` Sets additional classes for the icon
 *
 * @param string $text Set the title of the button
 * @param array $options
 * @return string
 */
	public function button($text, $options = array()) {
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
 * Returns an element followed by a text
 *
 * @example `<i class="icon icon-search"></i> Text`
 * @param string $type
 * @param array $options
 * @return string
 */
	public function icon($type, $text = '', $options = array()) {
		$class = "icon icon-$type";

		if (isset($options['class']) && !empty($class)) {
			$options['class'] = $class . ' ' . $options['class'];
		} else {
			$options['class'] = $class;
		}
		$tag = parent::tag('i', '', $options);
		return trim($tag . ' ' . $text);
	}

/**
 * Returns an icon.
 *
 * @param string $title
 * @param string|array $options
 * @return string|null
 */
	protected function _icon($title, $options = '') {
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
			$options = array('class' => "icon icon-$options");
		}
		$tag = parent::tag('i', '', $options);
		return trim($tag . ' ' . $title);
	}

/**
 * Returns true if the tag is a header
 *
 * @param string $tag
 * @return boolean
 */
	protected function _isHeader($tag) {
		if (in_array($tag, array('h1', 'h2', 'h3', 'h4', 'h5', 'h6'))) {
			return true;
		}
		return false;
	}

}

<?php

App::uses('HtmlHelper', 'View/Helper');

/**
 * Dna Html Helper
 *
 * @package Dna.Dna.View.Helper
 */
class DnaHtmlHelper extends HtmlHelper {

    public function __construct(View $View, $settings = array()) {
        parent::__construct($View, $settings);

        $this->_tags['beginbox'] =
                '<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-title">
							<i class="icon-list"></i>
							%s
						</div>
						<div class="box-content %s">';
        $this->_tags['endbox'] =
                '</div>
					</div>
				</div>
			</div>';
        $this->_tags['icon'] = '<i class="%s"%s></i> ';
        
        $this->_tags['less'] = '<link type="text/css" rel="%s" href="%s" %s/>';
    }

    public function beginBox($title, $isHidden = false, $isLabelHidden = false) {
        $isHidden = $isHidden ? 'hidden' : '';
        $isLabelHidden = $isLabelHidden ? 'label-hidden' : '';
        $class = $isHidden . ' ' . $isLabelHidden;
        return $this->useTag('beginbox', $title, $class);
    }

    public function endBox() {
        return $this->useTag('endbox');
    }

    public function icon($name, $options = array()) {
        $defaults = array('class' => '');
        $options = array_merge($defaults, $options);
        $class = '';
        foreach ((array) $name as $iconName) {
            $class .= ' icon-' . $iconName;
        }
        $class .= ' ' . $options['class'];
        $class = trim($class);
        unset($options['class']);
        $attributes = '';
        foreach ($options as $attr => $value) {
            $attributes .= $attr . '="' . $value . '" ';
        }
        if ($attributes) {
            $attributes = ' ' . $attributes;
        }
        return sprintf($this->_tags['icon'], $class, $attributes);
    }

    public function status($value, $url = array()) {
        $icon = $value == 1 ? 'glyphicons no-js ok' : 'glyphicons no-js remove';
        $class = $value == 1 ? 'green' : 'red';

        if (empty($url)) {
            return '<span class="'.$icon.' '.$class.'"><i></i></span>';
        } else {
            return $this->link('', 'javascript:void(0);', array(
                        'data-url' => $this->url($url),
                        'class' => '' . $icon . ' ' . $class . ' ajax-toggle',
            ));
        }
    }

    /**
     * Add possibilities to parent::link() method
     *
     * ### Options
     *
     * - `escape` Set to true to enable escaping of title and attributes.
     * - `button` 'primary', 'info', 'success', 'warning', 'danger', 'inverse', 'link'. http://twitter.github.com/bootstrap/base-css.html#buttons
     * - `icon` 'ok', 'remove' ... http://fortawesome.github.com/Font-Awesome/
     *
     * @param string $title The content to be wrapped by <a> tags.
     * @param string|array $url Cake-relative URL or array of URL parameters, or external URL (starts with http://)
     * @param array $options Array of HTML attributes.
     * @param string $confirmMessage JavaScript confirmation message.
     * @return string An `<a />` element.
     */
    public function link($title, $url = null, $options = array(), $confirmMessage = false) {
        $defaults = array('escape' => false);
        $options = is_null($options) ? array() : $options;
        $options = array_merge($defaults, $options);

        if (!empty($options['button'])) {
            $buttons = array('btn');
            foreach ((array) $options['button'] as $button) {
                if ($button == 'default') {
                    continue;
                }
                $buttons[] = 'btn-' . $button;
            }
            $options['class'] = trim(join(' ', $buttons));
            unset($options['button']);
        }

        if (isset($options['icon'])) {
            $iconSize = 'icon-large';
            if (isset($options['iconSize']) && $options['iconSize'] === 'small') {
                $iconSize = '';
                unset($options['iconSize']);
            }
            if (empty($options['iconInline'])) {
                $title = $this->icon($options['icon'], array('class' => $iconSize)) . $title;
            } else {
                $icon = trim($iconSize . ' icon-' . $options['icon']);
                if (isset($options['class'])) {
                    $options['class'] .= ' ' . $icon;
                } else {
                    $options['class'] = ' ' . $icon;
                }
                unset($options['iconInline']);
            }
            unset($options['icon']);
        }

        if (isset($options['tooltip'])) {
            $tooltipOptions = array(
                'rel' => 'tooltip',
                'data-placement' => 'top',
                'data-trigger' => 'hover',
            );
            if (is_string($options['tooltip'])) {
                $tooltipOptions = array_merge(array(
                    'data-title' => $options['tooltip'],
                        ), $tooltipOptions);
                $options = array_merge($options, $tooltipOptions);
            } else {
                $options['tooltip'] = array_merge($tooltipOptions, $options['tooltip']);
                $options = array_merge($options, $options['tooltip']);
            }
            unset($options['tooltip']);
        }

        return parent::link($title, $url, $options, $confirmMessage);
    }

    public function addPath($path, $separator) {
        $path = explode($separator, $path);
        $currentPath = '';
        foreach ($path as $p) {
            if (!is_null($p)) {
                $currentPath .= $p . $separator;
                $this->addCrumb($p, $currentPath);
            }
        }
        return $this;
    }

    public function addCrumb($name, $link = null, $options = null) {
        parent::addCrumb($name, $link, $options);
        return $this;
    }

    public function hasCrumbs() {
        return !empty($this->_crumbs);
    }

    public function getDnaCrumbs($separator = '&raquo;', $startText = false,$element='li') {
        $crumbs = $this->_prepareCrumbs($startText);
        if (!empty($crumbs)) {
                $out = array();
                foreach ($crumbs as $crumb) {
                    if (!empty($crumb[1])) {
                            $out[] = (!empty($element) ? '<'.$element.'>':'') . $this->link($crumb[0], $crumb[1], $crumb[2]) .(!empty($element) ? '</'.$element.'>':'');
                    } else {
                            $out[] = (!empty($element) ? '<'.$element.'>':'') . $crumb[0] . (!empty($element) ? '</'.$element.'>':'');
                    }
                }
                return implode($separator, $out);
        }
        return null;
    }
    /**
     * Creates a link element for CSS stylesheets.
     *
     * ### Usage
     *
     * Include one CSS file:
     *
     * `echo $this->Html->css('styles.css');`
     *
     * Include multiple CSS files:
     *
     * `echo $this->Html->css(array('one.css', 'two.css'));`
     *
     * Add the stylesheet to the `$scripts_for_layout` layout var:
     *
     * `$this->Html->css('styles.css', null, array('inline' => false));`
     *
     * Add the stylesheet to a custom block:
     *
     * `$this->Html->css('styles.css', null, array('block' => 'layoutCss'));`
     *
     * ### Options
     *
     * - `inline` If set to false, the generated tag will be appended to the 'css' block,
     *   and included in the `$scripts_for_layout` layout variable. Defaults to true.
     * - `block` Set the name of the block link/style tag will be appended to. This overrides the `inline`
     *   option.
     * - `plugin` False value will prevent parsing path as a plugin
     * - `fullBase` If true the url will get a full address for the css file.
     *
     * @param string|array $path The name of a CSS style sheet or an array containing names of
     *   CSS stylesheets. If `$path` is prefixed with '/', the path will be relative to the webroot
     *   of your application. Otherwise, the path will be relative to your CSS path, usually webroot/css.
     * @param string $rel Rel attribute. Defaults to "stylesheet". If equal to 'import' the stylesheet will be imported.
     * @param array $options Array of HTML attributes.
     * @return string CSS <link /> or <style /> tag, depending on the type of link.
     * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/html.html#HtmlHelper::css
     */
    public function less($path, $rel = null, $options = array()) {
        $options += array('block' => null, 'inline' => true);
        if (!$options['inline'] && empty($options['block'])) {
            $options['block'] = __FUNCTION__;
        }
        unset($options['inline']);

        if (is_array($path)) {
            $out = '';
            foreach ($path as $i) {
                $out .= "\n\t" . $this->less($i, $rel, $options);
            }
            if (empty($options['block'])) {
                return $out . "\n";
            }
            return;
        }

        if (strpos($path, '//') !== false) {
            $url = $path;
        } else {
            $url = $this->assetUrl($path, $options + array('pathPrefix' => CSS_URL, 'ext' => '.less'));
            $options = array_diff_key($options, array('fullBase' => null));

            if (Configure::read('Asset.filter.css')) {
                $pos = strpos($url, CSS_URL);
                if ($pos !== false) {
                    $url = substr($url, 0, $pos) . 'ccss/' . substr($url, $pos + strlen(CSS_URL));
                }
            }
        }

        if ($rel === 'import') {
            $out = sprintf($this->_tags['style'], $this->_parseAttributes($options, array('inline', 'block'), '', ' '), '@import url(' . $url . ');');
        } else {
            if (!$rel) {
                $rel = 'stylesheet/less';
            }
            $out = sprintf($this->_tags['less'], $rel,$url, $this->_parseAttributes($options, array('inline', 'block'), '', ' '));
        }

        if (empty($options['block'])) {
            return $out;
        }
        $this->_View->append($options['block'], $out);
    }

}

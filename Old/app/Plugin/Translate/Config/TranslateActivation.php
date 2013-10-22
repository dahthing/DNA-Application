<?php
/**
 * Translate Activation
 *
 * @package  Dna.Translate
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.dna.org
 */
class TranslateActivation {

/**
 * onActivate will be called if this returns true
 *
 * @param  object $controller Controller
 * @return boolean
 */
	public function beforeActivation(&$controller) {
		return true;
	}

/**
 * Called after activating the plugin in ExtensionsPluginsController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
	public function onActivation(&$controller) {
		$controller->Dna->addAco('Translate/Translate/admin_index');
		$controller->Dna->addAco('Translate/Translate/admin_edit');
		$controller->Dna->addAco('Translate/Translate/admin_delete');
		App::uses('DnaPlugin', 'Extensions.Lib');
		$DnaPlugin = new DnaPlugin();
		$DnaPlugin->migrate('Translate');
	}

/**
 * onDeactivate will be called if this returns true
 *
 * @param  object $controller Controller
 * @return boolean
 */
	public function beforeDeactivation(&$controller) {
		return true;
	}

/**
 * Called after deactivating the plugin in ExtensionsPluginsController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
	public function onDeactivation(&$controller) {
		$controller->Dna->removeAco('Translate');
	}
}

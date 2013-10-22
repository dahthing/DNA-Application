<?php

App::uses('ExtensionsAppController', 'Extensions.Controller');
App::uses('ExtensionsInstaller', 'Extensions.Lib');
App::uses('DnaPlugin', 'Extensions.Lib');
App::uses('Sanitize', 'Utility');

/**
 * Extensions Plugins Controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  Dna.Extensions.Controller
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.dna.org
 */
class ExtensionsPluginsController extends ExtensionsAppController {

/**
 * Controller name
 *
 * @var string
 * @access public
 */
	public $name = 'ExtensionsPlugins';

/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
	public $uses = array(
		'Settings.Setting',
		'Users.User',
	);

/**
 * BC compatibility
 */
	public function __get($name) {
		if ($name == 'corePlugins') {
			return $this->_DnaPlugin->corePlugins;
		}
	}

/**
 * beforeFilter
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();

		$this->_DnaPlugin = new DnaPlugin();
		$this->_DnaPlugin->setController($this);

		$this->Security->requirePost[] = 'admin_moveup';
		$this->Security->requirePost[] = 'admin_movedown';
	}

/**
 * admin_index
 *
 * @return void
 */
	public function admin_index() {
		$this->set('title_for_layout', __d('dna', 'Plugins'));

		$plugins = $this->_DnaPlugin->plugins();
		$this->set('corePlugins', $this->_DnaPlugin->corePlugins);
		$this->set('bundledPlugins', $this->_DnaPlugin->bundledPlugins);
		$this->set(compact('plugins'));
	}

/**
 * admin_add
 *
 * @return void
 */
	public function admin_add() {
		$this->set('title_for_layout', __d('dna', 'Upload a new plugin'));

		if (!empty($this->request->data)) {
			$file = $this->request->data['Plugin']['file'];
			unset($this->request->data['Plugin']['file']);

			$Installer = new ExtensionsInstaller;
			try {
				$Installer->extractPlugin($file['tmp_name']);
			} catch (CakeException $e) {
				$this->Session->setFlash($e->getMessage(), 'default', array('class' => 'error'));
				$this->redirect(array('action' => 'add'));
			}
			$this->redirect(array('action' => 'index'));
		}
	}

/**
 * admin_delete
 *
 * @param string $plugin
 * @return void
 */
	public function admin_delete($plugin = null) {
		if (!$plugin) {
			$this->Session->setFlash(__d('dna', 'Invalid plugin'), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->_DnaPlugin->isActive($plugin)) {
			$this->Session->setFlash(__d('dna', 'You cannot delete a plugin that is currently active.'), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));
		}

		$result = $this->_DnaPlugin->delete($plugin);
		if ($result === true) {
			$this->Session->setFlash(__d('dna', 'Plugin "%s" deleted successfully.', $plugin), 'default', array('class' => 'success'));
		} elseif (!empty($result[0])) {
			$this->Session->setFlash($result[0], 'default', array('class' => 'error'));
		} else {
			$this->Session->setFlash(__d('dna', 'Plugin could not be deleted.'), 'default', array('class' => 'error'));
		}

		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_toggle
 *
 * @param string $plugin
 * @return void
 */
	public function admin_toggle($plugin = null) {
		if (!$plugin) {
			$this->Session->setFlash(__d('dna', 'Invalid plugin'), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));
		}

		if ($this->_DnaPlugin->isActive($plugin)) {
			$result = $this->_DnaPlugin->deactivate($plugin);
			if ($result === true) {
				$this->Session->setFlash(__d('dna', 'Plugin "%s" deactivated successfully.', $plugin), 'default', array('class' => 'success'));
			} elseif (is_string($result)) {
				$this->Session->setFlash($result, 'default', array('class' => 'error'));
			} else {
				$this->Session->setFlash(__d('dna', 'Plugin could not be deactivated. Please, try again.'), 'default', array('class' => 'error'));
			}
		} else {
			$result = $this->_DnaPlugin->activate($plugin);
			if ($result === true) {
				$this->Session->setFlash(__d('dna', 'Plugin "%s" activated successfully.', $plugin), 'default', array('class' => 'success'));
			} elseif (is_string($result)) {
				$this->Session->setFlash($result, 'default', array('class' => 'error'));
			} else {
				$this->Session->setFlash(__d('dna', 'Plugin could not be activated. Please, try again.'), 'default', array('class' => 'error'));
			}
		}
		$this->redirect(array('action' => 'index'));
	}

/**
 * Migrate a plugin (database)
 *
 * @param type $plugin
 */
	public function admin_migrate($plugin = null) {
		if (!$plugin) {
			$this->Session->setFlash(__d('dna', 'Invalid plugin'), 'default', array('class' => 'error'));
		} elseif ($this->_DnaPlugin->migrate($plugin)) {
			$this->Session->setFlash(__d('dna', 'Plugin "%s" migrated successfully.', $plugin), 'default', array('class' => 'success'));
		} else {
			$this->Session->setFlash(
				__d('dna', 'Plugin "%s" could not be migrated. Error: %s', $plugin, implode('<br />', $this->_DnaPlugin->migrationErrors)),
				'default',
				array('class' => 'success')
			);
		}
		$this->redirect(array('action' => 'index'));
	}

/**
 * Move up a plugin in bootstrap order
 *
 * @param string $plugin
 * @throws CakeException
 */
	public function admin_moveup($plugin = null) {
		if ($plugin === null) {
			throw new CakeException(__d('dna', 'Invalid plugin'));
		}

		$class = 'success';
		$result = $this->_DnaPlugin->move('up', $plugin);
		if ($result === true) {
			$message = __d('dna', 'Plugin %s has been moved up', $plugin);
		} else {
			$message = $result;
			$class = 'error';
		}
		$this->Session->setFlash($message, 'default', array('class' => $class));

		$this->redirect($this->referer());
	}

/**
 * Move down a plugin in bootstrap order
 *
 * @param string $plugin
 * @throws CakeException
 */
	public function admin_movedown($plugin = null) {
		if ($plugin === null) {
			throw new CakeException(__d('dna', 'Invalid plugin'));
		}

		$class = 'success';
		$result = $this->_DnaPlugin->move('down', $plugin);
		if ($result === true) {
			$message = __d('dna', 'Plugin %s has been moved down', $plugin);
		} else {
			$message = $result;
			$class = 'error';
		}
		$this->Session->setFlash($message, 'default', array('class' => $class));

		$this->redirect($this->referer());
	}

}

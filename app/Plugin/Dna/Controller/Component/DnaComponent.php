<?php

App::uses('Component', 'Controller');
App::uses('DnaPlugin', 'Extensions.Lib');
App::uses('DnaTheme', 'Extensions.Lib');
App::uses('Dna', 'Dna.Lib');

/**
 * Dna Component
 *
 * PHP version 5
 *
 * @category Component
 * @package  Dna.Dna.Controller.Component
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.dna.org
 */
class DnaComponent extends Component {

/**
 * Other components used by this component
 *
 * @var array
 * @access public
 */
	public $components = array(
		'Session',
	);

/**
 * Role ID of current user
 *
 * Default is 3 (public)
 *
 * @var integer
 * @access public
 */
	public $roleId = 3;

/**
 * Blocks data: contains parsed value of bb-code like strings
 *
 * @var array
 * @access public
 */
	public $blocksData = array(
		'menus' => array(),
		'vocabularies' => array(),
		'nodes' => array(),
	);

/**
 * controller
 *
 * @var Controller
 */
	protected $_controller = null;

/**
 * Method to lazy load classes
 *
 * @return Object
 */
	public function __get($name) {
		switch ($name) {
			case '_DnaPlugin':
			case '_DnaTheme':
				if (!isset($this->{$name})) {
					$class = substr($name, 1);
					$this->{$name} = new $class();
					if (method_exists($this->{$name}, 'setController')) {
						$this->{$name}->setController($this->_controller);
					}
				}
				return $this->{$name};
			default:
				return parent::__get($name);
		}
	}

/**
 * Startup
 *
 * @param object $controller instance of controller
 * @return void
 */
	public function startup(Controller $controller) {
		$this->_controller = $controller;

		if ($this->Session->check('Auth.User.id')) {
			$this->roleId = $this->Session->read('Auth.User.role_id');
		}

		if (!isset($this->_controller->request->params['admin']) && !isset($this->_controller->request->params['requested'])) {
		} else {
			$this->_adminData();
		}
	}

/**
 * Set variables for admin layout
 *
 * @return void
 */
	protected function _adminData() {
		if (!Configure::read('Dna.version')) {
			if (CakePlugin::loaded('Settings')) {
				if ($this->_controller->Setting instanceof Model) {
					$this->_controller->Setting->write('Dna.version', trim(file_get_contents(APP . 'VERSION.txt')));
				}
			}
		}
	}

/**
 * Extracts parameters from 'filter' named parameter.
 *
 * @return array
 * @deprecated use Search plugin to perform filtering
 */
	public function extractFilter() {
		$filter = explode(';', $this->_controller->request->params['named']['filter']);
		$filterData = array();
		foreach ($filter as $f) {
			$fData = explode(':', $f);
			$fKey = $fData['0'];
			if ($fKey != null) {
				$filterData[$fKey] = $fData['1'];
			}
		}
		return $filterData;
	}

/**
 * Get URL relative to the app
 *
 * @param array $url
 * @return array
 * @deprecated Use Dna::getRelativePath
 */
	public function getRelativePath($url = '/') {
		return Dna::getRelativePath($url);
	}

/**
 * ACL: add ACO
 *
 * Creates ACOs with permissions for roles.
 *
 * @param string $action possible values: ControllerName, ControllerName/method_name
 * @param array $allowRoles Role aliases
 * @return void
 */
	public function addAco($action, $allowRoles = array()) {
		$this->_controller->DnaAccess->addAco($action, $allowRoles);
	}

/**
 * ACL: remove ACO
 *
 * Removes ACOs and their Permissions
 *
 * @param string $action possible values: ControllerName, ControllerName/method_name
 * @return void
 */
	public function removeAco($action) {
		$this->_controller->DnaAccess->removeAco($action);
	}

/**
 * Dna flavored redirect
 * If 'save' pressed, redirect to action 'index' instead of 'edit'
 *
 * @param string $url
 * @param integer $status
 * @param boolean $exit
 * @return void
 */
	public function redirect($url, $status = null, $exit = true) {
		if (is_array($url)) {
			if (isset($url['action']) && $url['action'] === 'edit' && !isset($this->_controller->request->data['apply'])) {
				$url = array('action' => 'index');
			}
		}
		$this->_controller->redirect($url, $status, $exit);
	}

/**
 * Toggle field status
 *
 * @param $model Model instance
 * @param $id integer Model id
 * @param $status integer current status
 * @param $field string field name to toggle
 * @throws CakeException
 */
	public function fieldToggle(Model $model, $id, $status, $field = 'status') {
		if (empty($id) || $status === null) {
			throw new CakeException(__d('dna', 'Invalid content'));
		}
		$model->id = $id;
		$status = !$status;
		$this->_controller->layout = 'ajax';
		if ($model->saveField($field, $status)) {
			$this->_controller->set(compact('id', 'status'));
			$this->_controller->render('Common/admin_toggle');
		} else {
			throw new CakeException(__d('dna', 'Failed toggling field %s to %s', $field, $status));
		}
	}

/**
 * Loads plugin's bootstrap.php file
 *
 * @param string $plugin Plugin name (underscored)
 * @return void
 * @deprecated use DnaPlugin::addBootstrap()
 */
	public function addPluginBootstrap($plugin) {
		$this->_DnaPlugin->addBootstrap($plugin);
	}

/**
 * Plugin name will be removed from Hook.bootstraps
 *
 * @param string $plugin Plugin name (underscored)
 * @return void
 * @deprecated use DnaPlugin::removeBootstrap()
 */
	public function removePluginBootstrap($plugin) {
		$this->_DnaPlugin->removeBootstrap($plugin);
	}

/**
 * Get theme aliases (folder names)
 *
 * @return array
 * @deprecated use DnaTheme::getThemes()
 */
	public function getThemes() {
		return $this->_DnaTheme->getThemes();
	}

/**
 * Get the content of theme.json file from a theme
 *
 * @param string $alias theme folder name
 * @return array
 * @deprecated use DnaTheme::getData()
 */
	public function getThemeData($alias = null) {
		return $this->_DnaTheme->getData($alias);
	}

/**
 * Get plugin alises (folder names)
 *
 * @return array
 * @deprecated use DnaPlugin::getPlugins()
 */
	public function getPlugins() {
		return $this->_DnaPlugin->getPlugins();
	}

/**
 * Get the content of plugin.json file of a plugin
 *
 * @param string $alias plugin folder name
 * @return array
 * @deprecated use DnaPlugin::getData
 */
	public function getPluginData($alias = null) {
		return $this->_DnaPlugin->getData($alias);
	}

/**
 * Check if plugin is dependent on any other plugin.
 * If yes, check if that plugin is available in plugins directory.
 *
 * @param  string $plugin plugin alias (underscrored)
 * @return boolean
 * @deprecated use DnaPlugin::checkDependency()
 */
	public function checkPluginDependency($plugin = null) {
		return $this->_DnaPlugin->checkDependency($plugin);
	}

/**
 * Check if plugin is active
 *
 * @param  string $plugin Plugin name (underscored)
 * @return boolean
 * @deprecated use DnaPlugin::isActive
 */
	public function pluginIsActive($plugin) {
		return $this->_DnaPlugin->isActive($plugin);
	}

}

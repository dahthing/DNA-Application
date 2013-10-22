<?php

App::uses('AppShell', 'Console/Command');
App::uses('CakeRequest', 'Network');
App::uses('CakeResponse', 'Network');
App::uses('Controller', 'Controller');
App::uses('AppController', 'Controller');
App::uses('DnaPlugin', 'Extensions.Lib');
App::uses('DnaTheme', 'Extensions.Lib');

/**
 * Ext Shell
 *
 * Activate/Deactivate Plugins/Themes
 *	./Console/dna ext activate plugin Example
 *	./Console/dna ext activate theme minimal
 *	./Console/dna ext deactivate plugin Example
 *	./Console/dna ext deactivate theme
 *
 * @category Shell
 * @package  Dna.Dna.Console.Command
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.dna.org
 */
class ExtShell extends AppShell {

/**
 * Models we use
 *
 * @var array
 */
	public $uses = array('Settings.Setting');

/**
 * DnaPlugin class
 *
 * @var DnaPlugin
 */
	protected $_DnaPlugin = null;

/**
 * DnaTheme class
 *
 * @var DnaTheme
 */
	protected $_DnaTheme = null;

/**
 * Controller
 *
 * @var Controller
 * @todo Remove this when PluginActivation dont need controllers
 */
	protected $_Controller = null;

/**
 * Initialize
 *
 * @param type $stdout
 * @param type $stderr
 * @param type $stdin
 */
	public function __construct($stdout = null, $stderr = null, $stdin = null) {
		parent::__construct($stdout, $stderr, $stdin);
		$this->_DnaPlugin = new DnaPlugin();
		$this->_DnaTheme = new DnaTheme();
		$CakeRequest = new CakeRequest();
		$CakeResponse = new CakeResponse();
		$this->_Controller = new AppController($CakeRequest, $CakeResponse);
		$this->_Controller->constructClasses();
		$this->_Controller->startupProcess();
		$this->_DnaPlugin->setController($this->_Controller);
		$this->initialize();
	}

/**
 * Call the appropriate command
 *
 * @return void
 */
	public function main() {
		$args = $this->args;
		$this->args = array_map('strtolower', $this->args);
		$method = $this->args[0];
		$type = $this->args[1];
		$ext = isset($args[2]) ? $args[2] : null;
		$force = isset($this->params['force']) ? $this->params['force'] : false;
		if ($type == 'theme') {
			$extensions = $this->_DnaTheme->getThemes();
			$theme = Configure::read('Site.theme');
			$active = !empty($theme) ? $theme == 'default' : true;
		} elseif ($type == 'plugin') {
			$extensions = $this->_DnaPlugin->getPlugins();
			if ($force) {
				$plugins = array_combine($p = App::objects('plugins'), $p);
				$extensions += $plugins;
			}
			$active = CakePlugin::loaded($ext);
		}
		if ($type == 'theme' && $method == 'deactivate') {
			$this->err(__d('dna', 'Theme cannot be deactivated, instead activate another theme.'));
			return false;
		}
		if (!empty($ext) && !in_array($ext, $extensions) && !$active && !$force) {
			$this->err(__d('dna', '%s "%s" not found.', ucfirst($type), $ext));
			return false;
		}
		switch ($method) {
			case 'list':
				$call = Inflector::pluralize($type);
				return $this->{$call}($ext);
			default:
				if (empty($ext)) {
					$this->err(__d('dna', '%s name must be provided.', ucfirst($type)));
					return false;
				}
				return $this->{'_' . $method . ucfirst($type)}($ext);
		}
	}

/**
 * Display help/options
 */
	public function getOptionParser() {
		return parent::getOptionParser()
			->description(__d('dna', 'Activate Plugins & Themes'))
			->addArguments(array(
				'method' => array(
					'help' => __d('dna', 'Method to perform'),
					'required' => true,
					'choices' => array('list', 'activate', 'deactivate'),
				),
				'type' => array(
					'help' => __d('dna', 'Extension type'),
					'required' => true,
					'choices' => array('plugin', 'theme'),
				),
				'extension' => array(
					'help' => __d('dna', 'Name of extension'),
				),
			))
			->addOption('all', array(
				'short' => 'a',
				'boolean' => true,
				'help' => 'List all extensions',
			))
			->addOption('force', array(
				'short' => 'f',
				'boolean' => true,
				'help' => 'Force method operation even when plugin does not provide a `plugin.json` file.'
			));
	}

/**
 * Activate a plugin
 *
 * @param string $plugin
 * @return boolean
 */
	protected function _activatePlugin($plugin) {
		$result = $this->_DnaPlugin->activate($plugin);
		if ($result === true) {
			$this->out(__d('dna', 'Plugin "%s" activated successfully.', $plugin));
			return true;
		} elseif (is_string($result)) {
			$this->err($result);
		} else {
			$this->err(__d('dna', 'Plugin "%s" could not be activated. Please, try again.', $plugin));
		}
		return false;
	}

/**
 * Deactivate a plugin
 *
 * @param string $plugin
 * @return boolean
 */
	protected function _deactivatePlugin($plugin) {
		$result = $this->_DnaPlugin->deactivate($plugin);
		if ($result === true) {
			$this->out(__d('dna', 'Plugin "%s" deactivated successfully.', $plugin));
			return true;
		} elseif (is_string($result)) {
			$this->err($result);
		} else {
			$this->err(__d('dna', 'Plugin "%s" could not be deactivated. Please, try again.', $plugin));
		}
		if ($result !== true && isset($this->params['force'])) {
			$this->_DnaPlugin->removeBootstrap($plugin);
		}
		return false;
	}

/**
 * Activate a theme
 *
 * @param string $theme Name of theme
 * @return boolean
 */
	protected function _activateTheme($theme) {
		if ($this->_DnaTheme->activate($theme)) {
			$this->out(__d('dna', 'Theme "%s" activated successfully.', $theme));
		} else {
			$this->err(__d('dna', 'Theme "%s" activation failed.', $theme));
		}
		return true;
	}

/**
 * List plugins
 */
	public function plugins($plugin = null) {
		App::uses('DnaPlugin', 'Extensions.Lib');
		$all = $this->params['all'];
		$plugins = $plugin == null ? App::objects('plugins') : array($plugin);
		$loaded = CakePlugin::loaded();
		$DnaPlugin = new DnaPlugin();
		$this->out(__d('dna', 'Plugins:'), 2);
		$this->out(__d('dna', '%-20s%-50s%s', __d('dna', 'Plugin'), __d('dna', 'Author'), __d('dna', 'Status')));
		$this->out(str_repeat('-', 80));
		foreach ($plugins as $plugin) {
			$status = '<info>inactive</info>';
			if ($active = in_array($plugin, $loaded)) {
				$status = '<success>active</success>';
			}
			if (!$active && !$all) {
				continue;
			}
			$data = $DnaPlugin->getPluginData($plugin);
			$author = isset($data['author']) ? $data['author'] : '';
			$this->out(__d('dna', '%-20s%-50s%s', $plugin, $author, $status));
		}
	}

/**
 * List themes
 */
	public function themes($theme = null) {
		$DnaTheme = new DnaTheme();
		$all = $this->params['all'];
		$current = Configure::read('Site.theme');
		$themes = $theme == null ? $DnaTheme->getThemes() : array($theme);
		$this->out("Themes:", 2);
		$default = empty($current) || $current == 'default';
		$this->out(__d('dna', '%-20s%-50s%s', __d('dna', 'Theme'), __d('dna', 'Author'), __d('dna', 'Status')));
		$this->out(str_repeat('-', 80));
		foreach ($themes as $theme) {
			$active = $theme == $current || $default && $theme == 'default';
			$status = $active ? '<success>active</success>' : '<info>inactive</info>';
			if (!$active && !$all) {
				continue;
			}
			$data = $DnaTheme->getThemeData($theme);
			$author = isset($data['author']) ? $data['author'] : '';
			$this->out(__d('dna', '%-20s%-50s%s', $theme, $author, $status));
		}
	}

}
<?php
/**
 * Default Acl plugin.  Custom Acl plugin should override this value.
 */
Configure::write('Site.acl_plugin', 'Acl');

/**
 * Admin theme
 */
//Configure::write('Site.admin_theme', 'sample');

/**
 * Cache configuration
 */
App::uses('DnaCache', 'Dna.Cache');
$defaultEngine = Configure::read('Cache.defaultEngine');
$defaultPrefix = Configure::read('Cache.defaultPrefix');
$cacheConfig = array(
	'duration' => '+1 hour',
	'path' => CACHE . 'queries' . DS,
	'engine' => $defaultEngine,
	'prefix' => $defaultPrefix,
);
Configure::write('Cache.defaultConfig', $cacheConfig);

/**
 * Settings
 */
App::uses('DnaJsonReader', 'Dna.Configure');
Configure::config('settings', new DnaJsonReader());
if (file_exists(APP . 'Config' . DS . 'settings.json')) {
	Configure::load('settings', 'settings');
}

/**
 * Locale
 */
Configure::write('Config.language', Configure::read('Site.locale'));

/**
 * Setup custom paths
 */
$dnaPath = CakePlugin::path('Dna');
App::build(array(
	'Console/Command' => array($dnaPath . 'Console' . DS . 'Command' . DS),
	'Controller' => array($dnaPath . 'Controller' . DS),
	'Controller/Component' => array($dnaPath . 'Controller' . DS . 'Component' . DS),
	'Lib' => array($dnaPath . 'Lib' . DS),
	'Model' => array($dnaPath . 'Model' . DS),
	'Model/Behavior' => array($dnaPath . 'Model' . DS . 'Behavior' . DS),
	'View' => array($dnaPath . 'View' . DS),
	'View/Helper' => array($dnaPath . 'View' . DS . 'Helper' . DS),
), App::APPEND);
if ($theme = Configure::read('Site.theme')) {
	App::build(array(
		'View/Helper' => array(App::themePath($theme) . 'Helper' . DS),
	));
}

/**
 * List of core plugins
 */

Configure::write('Core.corePlugins', array(
	'Settings', 'Acl', 'Blocks', 'Comments', 'Contacts', 'Menus', 'Meta',
	'Nodes', 'Taxonomy', 'Users',
));

/**
 * Plugins
 */
$aclPlugin = Configure::read('Site.acl_plugin');
$pluginBootstraps = Configure::read('Hook.bootstraps');
$plugins = array_filter(explode(',', $pluginBootstraps));

if (!in_array($aclPlugin, $plugins)) {
	$plugins = Hash::merge((array)$aclPlugin, $plugins);
}
foreach ($plugins as $plugin) {
	$pluginName = Inflector::camelize($plugin);
	$pluginPath = APP . 'Plugin' . DS . $pluginName;
	if (!file_exists($pluginPath)) {
		CakeLog::error('Plugin not found during bootstrap: ' . $pluginName);
		continue;
	}
	$option = array(
		$pluginName => array(
			'bootstrap' => true,
			'routes' => true,
			'ignoreMissing' => true,
		)
	);
	DnaPlugin::load($option);
}
DnaEventManager::loadListeners();

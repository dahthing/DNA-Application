<?php
App::uses('DnaNav', 'Dna.Lib');
App::uses('DnaTestCase', 'Dna.TestSuite');

class DnaNavTest extends DnaTestCase {

	protected static $_menus = array();

	public function setUp() {
		parent::setUp();
		self::$_menus = DnaNav::items();
	}

	public function tearDown() {
		parent::tearDown();
		DnaNav::items(self::$_menus);
	}

	public function testNav() {
		$saved = DnaNav::items();

		// test clear
		DnaNav::clear();
		$items = DnaNav::items();
		$this->assertEqual($items, array());

		// test first level addition
		$defaults = DnaNav::getDefaults();
		$extensions = array('title' => 'Extensions');
		DnaNav::add('extensions', $extensions);
		$result = DnaNav::items();
		$expected = array('extensions' => Hash::merge($defaults, $extensions));
		$this->assertEqual($result, $expected);

		// tested nested insertion (1 level)
		$plugins = array('title' => 'Plugins');
		DnaNav::add('extensions.children.plugins', $plugins);
		$result = DnaNav::items();
		$expected['extensions']['children']['plugins'] = Hash::merge($defaults, $plugins);
		$this->assertEqual($result, $expected);

		// 2 levels deep
		$example = array('title' => 'Example');
		DnaNav::add('extensions.children.plugins.children.example', $example);
		$result = DnaNav::items();

		$expected['extensions']['children']['plugins']['children']['example'] = Hash::merge($defaults, $example);
		$this->assertEqual($result, $expected);

		DnaNav::items($saved);
		$this->assertEquals($saved, DnaNav::items());
	}

	public function testNavMerge() {
		$foo = array('title' => 'foo', 'access' => array('public', 'admin'));
		$bar = array('title' => 'bar', 'access' => array('admin'));
		DnaNav::clear();
		DnaNav::add('foo', $foo);
		DnaNav::add('foo', $bar);
		$items = DnaNav::items();
		$expected = array('admin', 'public');
		sort($expected);
		sort($items['foo']['access']);
		$this->assertEquals($expected, $items['foo']['access']);
	}

	public function testNavOverwrite() {
		$defaults = DnaNav::getDefaults();

		$items = DnaNav::items();
		$expected = Hash::merge($defaults, array(
			'title' => 'Permissions',
			'url' => array(
				'admin' => true,
				'plugin' => 'acl',
				'controller' => 'acl_permissions',
				'action' => 'index',
				),
			'weight' => 30,
			));
		$this->assertEquals($expected, $items['users']['children']['permissions']);

		$item = array(
			'title' => 'Permissions',
			'url' => array(
				'admin' => true,
				'plugin' => 'acl_extras',
				'controller' => 'acl_extras_permissions',
				'action' => 'index',
				),
			'weight' => 30,
			);
		DnaNav::add('users.children.permissions', $item);
		$items = DnaNav::items();

		$expected = Hash::merge($defaults, array(
			'title' => 'Permissions',
			'url' => array(
				'admin' => true,
				'plugin' => 'acl_extras',
				'controller' => 'acl_extras_permissions',
				'action' => 'index',
				),
			'weight' => 30,
			));

		$this->assertEquals($expected, $items['users']['children']['permissions']);
	}

}

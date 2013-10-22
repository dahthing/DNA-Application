<?php

App::uses('MigrationVersion', 'Migrations.Lib');
App::uses('DnaPlugin', 'Extensions.Lib');
App::uses('DnaTestCase', 'Dna.Lib/TestSuite');

class DnaPluginTest extends DnaTestCase {

/**
 * DnaPlugin class
 * @var DnaPlugin
 */
	public $DnaPlugin;

	public function setUp() {
		parent::setUp();
		App::build(array(
			'Plugin' => array(CakePlugin::path('Extensions') . 'Test' . DS . 'test_app' . DS . 'Plugin' . DS),
		), App::PREPEND);

		$this->DnaPlugin = $this->getMock('DnaPlugin', array(
			'_writeSetting',
			'needMigration',
		));

		$this->_mapping = array(
			1346748762 => array(
				'version' => 1346748762,
				'name' => '1346748762_first',
				'class' => 'First',
				'type' => 'app',
				'migrated' => '2012-09-04 10:52:42'
			),
			1346748933 => array(
				'version' => 1346748933,
				'name' => '1346748933_addstatus',
				'class' => 'AddStatus',
				'type' => 'app',
				'migrated' => '2012-09-04 10:55:33'
			)
		);
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->DnaPlugin);
	}

	protected function _getMockMigrationVersion() {
		return $this->getMockBuilder('MigrationVersion')
			->disableOriginalConstructor()
			->getMock();
	}

	public function testGetDataPluginNotActive() {
		$actives = Configure::read('Hook.bootstraps');
		Configure::write('Hook.bootstraps', '');

		$suppliers = $this->DnaPlugin->getData('Suppliers');

		$needed = array(
			'name' => 'Suppliers',
			'description' => 'Suppliers plugin',
			'active' => false,
			'needMigration' => false
		);
		$this->assertEquals($needed, $suppliers);

		Configure::write('Hook.bootstraps', $actives);
	}

	public function testGetDataPluginActive() {
		$actives = Configure::read('Hook.bootstraps');
		Configure::write('Hook.bootstraps', 'suppliers');

		$migrationVersion = $this->_getMockMigrationVersion();
		$dnaPlugin = new DnaPlugin($migrationVersion);

		$suppliers = $dnaPlugin->getData('Suppliers');

		$needed = array(
			'name' => 'Suppliers',
			'description' => 'Suppliers plugin',
			'active' => true,
			'needMigration' => false
		);
		$this->assertEquals($needed, $suppliers);

		Configure::write('Hook.bootstraps', $actives);
	}

	public function testGetDataPluginNotExists() {
		$data = $this->DnaPlugin->getData('NotARealPlugin');
		$this->assertEquals(false, $data);
	}

	public function testGetDataWithEmptyJson() {
		$data = $this->DnaPlugin->getData('EmptyJson');
		$this->assertEquals(array(), $data);
	}

	public function testNeedMigrationPluginNotExists() {
		$migrationVersion = $this->_getMockMigrationVersion();
		$migrationVersion->expects($this->any())
			->method('getMapping')
			->will($this->returnValue(false));
		$dnaPlugin = new DnaPlugin($migrationVersion);
		$this->assertEquals(false, $dnaPlugin->needMigration('Anything', true));
	}

	public function testNeedMigrationPluginNotActive() {
		$dnaPlugin = new DnaPlugin();
		$this->assertEquals(false, $dnaPlugin->needMigration('Anything', false));
	}

	public function testNeedMigrationPluginNoMigration() {
		$migrationVersion = $this->_getMockMigrationVersion();
		$migrationVersion->expects($this->any())
			->method('getMapping')
			->will($this->returnValue($this->_mapping));
		$migrationVersion->expects($this->any())
			->method('getVersion')
			->will($this->returnValue(1346748933));
		$dnaPlugin = new DnaPlugin($migrationVersion);
		$this->assertEquals(false, $dnaPlugin->needMigration('app', true));
	}

	public function testNeedMigrationPluginWithMigration() {
		$migrationVersion = $this->_getMockMigrationVersion();
		$migrationVersion->expects($this->any())
			->method('getMapping')
			->will($this->returnValue($this->_mapping));
		$migrationVersion->expects($this->any())
			->method('getVersion')
			->will($this->returnValue(1346748762));
		$dnaPlugin = new DnaPlugin($migrationVersion);
		$this->assertEquals(true, $dnaPlugin->needMigration('app', true));
	}

	public function testMigratePluginNotNeedMigration() {
		$actives = Configure::read('Hook.bootstraps');
		Configure::write('Hook.bootstraps', 'Suppliers');

		$migrationVersion = $this->_getMockMigrationVersion();
		$migrationVersion->expects($this->any())
			->method('getMapping')
			->will($this->returnValue($this->_mapping));
		$dnaPlugin = new DnaPlugin($migrationVersion);

		$this->assertEquals(false, $dnaPlugin->migrate('Suppliers'));

		Configure::read('Hook.bootstraps', $actives);
	}

	public function testMigratePluginWithMigration() {
		$actives = Configure::read('Hook.bootstraps');
		Configure::write('Hook.bootstraps', 'Suppliers');

		$migrationVersion = $this->_getMockMigrationVersion();
		$migrationVersion->expects($this->any())
			->method('getMapping')
			->will($this->returnValue($this->_mapping));
		$migrationVersion->expects($this->any())
			->method('run')
			->with($this->logicalAnd($this->arrayHasKey('version'), $this->arrayHasKey('type')))
			->will($this->returnValue(true));

		$dnaPlugin = new DnaPlugin($migrationVersion);

		$this->assertEquals(true, $dnaPlugin->migrate('Suppliers'));

		Configure::read('Hook.bootstraps', $actives);
	}

	public function testMigratePluginWithMigrationError() {
		$actives = Configure::read('Hook.bootstraps');
		Configure::write('Hook.bootstraps', 'Suppliers');

		$migrationVersion = $this->_getMockMigrationVersion();
		$migrationVersion->expects($this->any())
			->method('getMapping')
			->will($this->returnValue($this->_mapping));
		$migrationVersion->expects($this->any())
			->method('run')
			->will($this->returnValue('An error message'));

		$dnaPlugin = new DnaPlugin($migrationVersion);

		$expectedErrors = array('An error message');
		$this->assertEquals(false, $dnaPlugin->migrate('Suppliers'));
		$this->assertEquals($expectedErrors, $dnaPlugin->migrationErrors);

		Configure::read('Hook.bootstraps', $actives);
	}

	public function testUnmigrate() {
		$actives = Configure::read('Hook.bootstraps');
		Configure::write('Hook.bootstraps', 'Suppliers');

		$migrationVersion = $this->_getMockMigrationVersion();
		$migrationVersion->expects($this->once())
			->method('getMapping')
			->will($this->returnValue($this->_mapping));
		$migrationVersion->expects($this->once())
			->method('run')
			->with($this->arrayHasKey('version', 'type', 'direction'))
			->will($this->returnValue(true));

		$dnaPlugin = new DnaPlugin($migrationVersion);

		$this->assertEquals(true, $dnaPlugin->unmigrate('Suppliers'));

		Configure::read('Hook.bootstraps', $actives);
	}

	public function testUnmigrateNoMapping() {
		$actives = Configure::read('Hook.bootstraps');
		Configure::write('Hook.bootstraps', 'Suppliers');

		$migrationVersion = $this->_getMockMigrationVersion();
		$migrationVersion->expects($this->once())
			->method('getMapping')
			->will($this->returnValue(array()));
		$migrationVersion->expects($this->never())
			->method('run')
			->will($this->returnValue(false));

		$dnaPlugin = new DnaPlugin($migrationVersion);

		$this->assertEquals(false, $dnaPlugin->unmigrate('Suppliers'));

		Configure::read('Hook.bootstraps', $actives);
	}

/**
 * testReorderBootstraps
 */
	public function testReorderBootstraps() {
		$bootstraps = explode(',', 'Settings,Taxonomy,Sites,Example');

		$expected = 'Example is already at the last position';
		$result = $this->DnaPlugin->move('down', 'Example', $bootstraps);
		$this->assertEquals($expected, $result);

		// core and bundled plugins must not be reordered
		$result = $this->DnaPlugin->move('up', 'Sites', $bootstraps);
		$this->assertEquals('Sites is already at the first position', $result);

		$bootstraps = explode(',', 'Example,Settings,Taxonomy,Sites');
		$result = $this->DnaPlugin->move('up', 'Example', $bootstraps);
		$this->assertEquals('Example is already at the first position', $result);
	}

/**
 * testReorderBootstrapsWithDependency
 */
	public function testReorderBootstrapsWithDependency() {
		$bootstraps = explode(',', 'Widgets,Editors');

		$expected = 'Plugin Editors depends on Widgets';
		$result = $this->DnaPlugin->move('up', 'Editors', $bootstraps);
		$this->assertEquals($expected, $result);

		$expected = 'Plugin Editors depends on Widgets';
		$result = $this->DnaPlugin->move('down', 'Widgets', $bootstraps);
		$this->assertEquals($expected, $result);
	}

/**
 * testDeleteEmptyPlugin
 * @expectedException InvalidArgumentException
 */
	public function testDeleteEmptyPlugin() {
		$this->DnaPlugin->delete(null);
	}

}
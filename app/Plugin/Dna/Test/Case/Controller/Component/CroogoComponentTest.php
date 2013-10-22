<?php

App::uses('DnaComponent', 'Controller/Component');
App::uses('Component', 'Controller');
app::uses('ComponentCollection', 'Controller/Component');
App::uses('AppController', 'Controller');
App::uses('DnaTestCase', 'Dna.TestSuite');
app::uses('DnaComponent', 'Dna.Controller/Component');

class MockDnaComponent extends DnaComponent {

	public function startup(Controller $controller) {
		$this->_controller = $controller;
		$this->_DnaPlugin = new DnaPlugin();
		$this->_DnaPlugin->Setting->writeConfiguration();
	}

}

class DnaTestController extends AppController {
}

class DnaComponentTest extends DnaTestCase {

	public $fixtures = array(
		'plugin.users.aco',
		'plugin.users.aro',
		'plugin.users.aros_aco',
		'plugin.settings.setting',
		'plugin.menus.menu',
		'plugin.menus.link',
		'plugin.users.role',
		'plugin.taxonomy.type',
		'plugin.taxonomy.vocabulary',
		'plugin.taxonomy.types_vocabulary',
	);

	public function setUp() {
		parent::setUp();

		$this->Controller = new DnaTestController(new CakeRequest(), new CakeResponse());
		$this->Controller->constructClasses();
		$this->Controller->Dna = new MockDnaComponent($this->Controller->Components);
		$this->Controller->Components->unload('Blocks');
		$this->Controller->Components->unload('Menus');
		$this->Controller->Components->set('Dna', $this->Controller->Dna);
		$this->Controller->startupProcess();
	}

	public function testAddRemoveAcos() {
		$Aco = ClassRegistry::init('Aco');

		$this->Controller->Dna->addAco('DnaTestController');
		$parent = $Aco->findByAlias('DnaTestController');
		$this->assertNotEmpty($parent);

		$this->Controller->Dna->addAco('DnaTestController/index');
		$child = $Aco->findByParentId($parent['Aco']['id']);
		$this->assertNotEmpty($child);

		$this->Controller->Dna->removeAco('DnaTestController/index');
		$child = $Aco->findByParentId($parent['Aco']['id']);
		$this->assertEmpty($child);

		$this->Controller->Dna->removeAco('DnaTestController');
		$parent = $Aco->findByAlias('DnaTestController');
		$this->assertEmpty($parent);
	}

	public function testPluginIsActive() {
		$result = $this->Controller->Dna->pluginIsActive('Example');
		$this->assertTrue($result);
		$result = $this->Controller->Dna->pluginIsActive('example');
		$this->assertTrue($result);
		$result = $this->Controller->Dna->pluginIsActive('Shops');
		$this->assertFalse($result);
	}

/**
 * testRedirect
 *
 * @return void
 * @dataProvider redirectData
 */
	public function testRedirect($expected, $url, $data = array()) {
		$Controller = $this->getMock('DnaTestController', array('redirect'), array(new CakeRequest(), new CakeResponse()));
		$Controller->request->data = $data;
		$Controller->expects($this->once())
			->method('redirect')
			->with($this->equalTo($expected));
		$DnaComponent = new DnaComponent(new ComponentCollection());
		$DnaComponent->startup($Controller);
		$DnaComponent->redirect($url);
	}

/**
 * redirectData
 *
 * @return array
 */
	public function redirectData() {
		return array(
			array('dna.org', 'dna.org'),
			array(array('action' => 'index'), array('action' => 'edit', 1)),
			array(array('action' => 'edit', 1), array('action' => 'edit', 1), array('apply' => 'Apply')),
		);
	}

}

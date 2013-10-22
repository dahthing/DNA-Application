<?php
App::uses('DnaHelper', 'Dna.View/Helper');
App::uses('SessionComponent', 'Controller/Component');
App::uses('AuthComponent', 'Controller/Component');
App::uses('CakeSession', 'Model/Datasource');
App::uses('Controller', 'Controller');
App::uses('DnaTestCase', 'Dna.TestSuite');
App::uses('AclHelper', 'Acl.View/Helper');

class TheDnaTestController extends Controller {

	public $uses = null;

	public $components = array();

}

class DnaHelperTest extends DnaTestCase {

	public $fixtures = array(
		'plugin.users.aco',
		'plugin.users.aro',
		'plugin.users.aros_aco',
		'plugin.settings.setting',
		'plugin.users.role',
	);

/**
 * setUp
 */
	public function setUp() {
		parent::setUp();
		$this->ComponentCollection = new ComponentCollection();

		$request = new CakeRequest('nodes/index');
		$request->params = array(
			'controller' => 'nodes',
			'action' => 'index',
			'named' => array(),
		);
		$view = new View(new TheDnaTestController($request, new CakeResponse()));
		$this->Dna = new DnaHelper($view);
		$aclHelper = Configure::read('Site.acl_plugin') . 'Helper';
		$this->Dna->Acl = $this->getMock(
			$aclHelper,
			array('linkIsAllowedByRoleId'),
			array($view)
		);
		$this->Dna->Acl
			->expects($this->any())
			->method('linkIsAllowedByRoleId')
			->will($this->returnValue(true));
		$this->menus = DnaNav::items();
		DnaNav::clear();
	}

/**
 * tearDown
 */
	public function tearDown() {
		ClassRegistry::flush();
		DnaNav::items($this->menus);
		unset($this->Dna);
	}

/**
 * testAdminMenus
 */
	public function testAdminMenus() {
		CakeSession::write('Auth.User', array('id' => 1, 'role_id' => 1));
		DnaNav::add('contents', array(
			'title' => 'Contents',
			'url' => '#',
			)
		);
		$items = DnaNav::items();
		$expected = '<ul class="nav nav-stacked"><li><a href="#" class="menu-contents sidebar-item"><i class="icon-white icon-large"></i> <span>Contents</span></a></li></ul>';
		$result = $this->Dna->adminMenus(DnaNav::items());
		$this->assertEquals($expected, $result);
	}

/**
 * testAdminRowActions
 */
	public function testAdminRowActions() {
		$this->Dna->params = array(
			'controller' => 'test',
			'action' => 'action',
		);
		Configure::write('Admin.rowActions.Test/action', array(
			'Title' => 'plugin:example/controller:example/action:index/:id',
		));
		$result = $this->Dna->adminRowActions(1);
		$expected = array(
			'a' => array(
				'href' => '/example/example/index/1',
				'class',
			),
			'Title',
			'/a',
		);
		$this->assertTags($result, $expected);

		// test row actions with options
		Configure::write('Admin.rowActions.Test/action', array(
			'Title' => array(
				'plugin:example/controller:example/action:index/:id' => array(
					'options' => array(
						'icon' => 'key',
						'title' => false,
					),
				),
			)
		));
		$result = $this->Dna->adminRowActions(1);
		$expected = array(
			'a' => array(
				'href' => '/example/example/index/1',
				'class',
			),
			'i' => array(
				'class',
			),
			'/i',
			' Title',
			'/a',
		);
		$this->assertTags($result, $expected);

		// test row actions with no title + icon
		Configure::write('Admin.rowActions.Test/action', array(
			'Title' => array(
				'plugin:example/controller:example/action:edit/:id' => array(
					'title' => false,
					'options' => array(
						'icon' => 'edit',
						'title' => false,
					),
				),
			)
		));
		$result = $this->Dna->adminRowActions(1);
		$expected = array(
			'a' => array(
				'href' => '/example/example/edit/1',
				'class' => 'edit',
			),
			'i' => array(
				'class' => 'icon-edit icon-large',
			),
			'/i',
			' ',
			'/a',
		);
		$this->assertTags($result, $expected);
	}

/**
 * testAdminTabs
 */
	public function testAdminTabs() {
		$this->Dna->params = array(
			'controller' => 'test',
			'action' => 'action',
		);
		Configure::write('Admin.tabs.Test/action', array(
			'Title' => array(
				'element' => 'blank',
				'options' => array(),
			),
		));
		$result = $this->Dna->adminTabs();
		$expected = '<li><a href="#test-title" data-toggle="tab">Title</a></li>';
		$this->assertEquals($expected, $result);

		$result = $this->Dna->adminTabs(true);
		$this->assertContains('test-title', $result);
	}

	public function testAdminBoxes() {
		$this->Dna->params = array(
			'controller' => 'test',
			'action' => 'action',
		);
		Configure::write('Admin.boxes.Test/action', array(
			'Title' => array(
				'element' => 'blank',
				'options' => array(),
			),
		));

		$result = $this->Dna->adminBoxes('Title');
		$this->assertContains('class="box"', $result);
	}

	public function testAdminBoxesAlreadyPrinted() {
		$this->Dna->params = array(
			'controller' => 'test',
			'action' => 'action',
		);
		Configure::write('Admin.tabs.Test/action', array(
			'Title' => array(
				'element' => 'blank',
				'options' => array(),
			),
		));

		$this->Dna->adminBoxes('Title');
		$result = $this->Dna->adminBoxes('Title');
		$this->assertEquals('', $result);
	}

	public function testAdminBoxesAll() {
		$this->Dna->params = array(
			'controller' => 'test',
			'action' => 'action',
		);
		Configure::write('Admin.boxes.Test/action', array(
			'Title' => array(
				'element' => 'blank',
				'options' => array(),
			),
			'Content' => array(
				'element' => 'blank',
				'options' => array(),
			),
		));

		$result = $this->Dna->adminBoxes();
		$this->assertContains('Title', $result);
		$this->assertContains('Content', $result);
	}

	public function testSettingsInputCheckbox() {
		$setting['Setting']['input_type'] = 'checkbox';
		$setting['Setting']['value'] = 0;
		$setting['Setting']['description'] = 'A description';
		$result = $this->Dna->settingsInput($setting, 'MyLabel', 0);
		$this->assertContains('type="checkbox"',$result);
	}

	public function testSettingsInputCheckboxChecked() {
		$setting['Setting']['input_type'] = 'checkbox';
		$setting['Setting']['value'] = 1;
		$setting['Setting']['description'] = 'A description';
		$result = $this->Dna->settingsInput($setting, 'MyLabel', 0);
		$this->assertContains('type="checkbox"', $result);
		$this->assertContains('checked="checked"', $result);
	}

	public function testSettingsInputTextbox() {
		$setting['Setting']['input_type'] = '';
		$setting['Setting']['description'] = 'A description';
		$setting['Setting']['value'] = 'Yes';
		$result = $this->Dna->settingsInput($setting, 'MyLabel', 0);
		$this->assertContains('type="text"', $result);
	}

	public function testSettingsInputTextarea() {
		$setting['Setting']['input_type'] = 'textarea';
		$setting['Setting']['description'] = 'A description';
		$setting['Setting']['value'] = 'Yes';
		$result = $this->Dna->settingsInput($setting, 'MyLabel', 0);
		$this->assertContains('</textarea>', $result);
	}

/**
 * testAdminRowAction
 */
	public function testAdminRowAction() {
		$url = array('controller' => 'users', 'action' => 'edit', 1);
		$expected = array(
			'a' => array(
				'href' => '/users/edit/1',
				'class' => 'edit',
			),
			'Edit',
			'/a',
		);
		$result = $this->Dna->adminRowAction('Edit', $url);
		$this->assertTags($result, $expected);

		$options = array('class' => 'test-class');
		$message = 'Are you sure?';
		$expected = array(
			'a' => array(
				'href' => '/users/edit/1',
				'class' => 'test-class edit',
				'onclick' => "return confirm('" . $message . "');",
			),
			'Edit',
			'/a',
		);
		$result = $this->Dna->adminRowAction('Edit', $url, $options, $message);
		$this->assertTags($result, $expected);
	}

/**
 * testAdminRowActionBulkDelete
 */
	public function testAdminRowActionBulkDelete() {
		$url = '#Node1Id';
		$options = array(
			'rowAction' => 'delete',
		);
		$message = 'Delete this?';
		$expected = array(
			'a' => array(
				'href' => '#Node1Id',
				'data-row-action' => 'delete',
				'data-confirm-message',
			),
			'Delete',
			'/a',
		);
		$result = $this->Dna->adminRowAction('Delete', $url, $options, $message);
		$this->assertTags($result, $expected);
	}

}

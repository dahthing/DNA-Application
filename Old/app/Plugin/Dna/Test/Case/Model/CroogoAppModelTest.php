<?php
App::uses('DnaTestCase', 'Dna.TestSuite');
App::uses('Model', 'Model');
App::uses('DnaAppModel', 'Dna.Model');
App::uses('User', 'Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * DnaAppModelTest file
 *
 * This file is to test the DnaAppModel
 *
 * @category Test
 * @package  Dna
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.dna.org
 */
class DnaAppModelTest extends DnaTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.users.aco',
		'plugin.users.aro',
		'plugin.users.aros_aco',
		'plugin.users.role',
		'plugin.users.user',
		'plugin.settings.setting',
	);

/**
 * User instance
 *
 * @var TestUser
 */
	public $User;

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->User = ClassRegistry::init('Users.User');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		parent::tearDown();
		unset($this->User);
	}

/**
 * testValidName
 */
	public function testValidName() {
		$this->assertTrue($this->User->validName(array('name' => 'Kyle')));
		$this->assertFalse($this->User->validName(array('name' => 'what%is@this#i*dont!even')));
	}

/**
 * testValidAlias
 */
	public function testValidAlias() {
		$this->assertTrue($this->User->validAlias(array('name' => 'Kyle')));
		$this->assertFalse($this->User->validAlias(array('name' => 'Not an Alias')));
	}

}
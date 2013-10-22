<?php

App::uses('DnaTheme', 'Extensions.Lib');
App::uses('DnaTestCase', 'Dna.Lib/TestSuite');

class DnaThemeTest extends DnaTestCase {

/**
 * DnaTheme class
 * @var DnaTheme
 */
	public $DnaTheme;

	public function setUp() {
		parent::setUp();
		$this->DnaTheme = $this->getMock('DnaTheme', null);
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->DnaTheme);
	}

/**
 * testDeleteEmptyTheme
 * @expectedException InvalidArgumentException
 */
	public function testDeleteEmptyTheme() {
		$this->DnaTheme->delete(null);
	}

/**
 * testDeleteBogusTheme
 * @expectedException UnexpectedValueException
 */
	public function testDeleteBogusTheme() {
		$this->DnaTheme->delete('Bogus');
	}

}
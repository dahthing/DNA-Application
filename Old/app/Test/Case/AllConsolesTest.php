<?php
App::uses('DnaTestCase', 'Dna.TestSuite');

class AllConsolesTests extends PHPUnit_Framework_TestSuite {

	public static function suite() {
		$suite = new CakeTestSuite('All commands tests');
		$path = APP . 'Test' . DS . 'Case' . DS . 'Console' . DS . 'Command' . DS;
		$suite->addTestDirectory($path);
		return $suite;
	}

}

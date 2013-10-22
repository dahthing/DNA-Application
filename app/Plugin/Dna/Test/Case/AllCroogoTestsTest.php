<?php
App::uses('DnaTestCase', 'Dna.TestSuite');

class AllDnaTestsTest extends PHPUnit_Framework_TestSuite {

/**
 * suite
 *
 * @return CakeTestSuite
 */
	public static function suite() {
		$suite = new CakeTestSuite('All Dna tests');
		$suite->addTestDirectoryRecursive(CakePlugin::path('Dna') . 'Test' . DS . 'Case' . DS);
		return $suite;
	}

}

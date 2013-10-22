<?php
App::uses('DnaTestCase', 'Dna.TestSuite');

class AllTaxonomyTestsTest extends PHPUnit_Framework_TestSuite {

/**
 * suite
 *
 * @return CakeTestSuite
 */
	public static function suite() {
		$suite = new CakeTestSuite('All Taxonomy tests');
		$suite->addTestDirectoryRecursive(CakePlugin::path('Taxonomy') . 'Test' . DS . 'Case' . DS);
		return $suite;
	}

}

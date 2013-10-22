<?php

App::uses('DnaTestCase', 'Dna.TestSuite');
App::uses('DnaJsonReader', 'Dna.Configure');

class MockDnaJsonReader extends DnaJsonReader {

	public $written = null;

	public function getPath() {
		return $this->_path;
	}

}

class DnaJsonReaderTest extends DnaTestCase {

/**
 * setUp
 */
	public function setUp() {
		parent::setUp();
		$this->DnaJsonReader = $this->getMock('MockDnaJsonReader',
			null,
			array(CakePlugin::path('Dna') . 'Test' . DS . 'test_app' . DS . 'Config' . DS)
			);
		$this->testFile = $this->DnaJsonReader->getPath() . 'test.json';
	}

/**
 * tearDown
 */
	public function tearDown() {
		if (file_exists($this->testFile)) {
			unlink($this->testFile);
		}
	}

/**
 * testDefaultPath
 */
	public function testDefaultPath() {
		$path = $this->DnaJsonReader->getPath();
		$this->assertEquals(CakePlugin::path('Dna') . 'Test' . DS . 'test_app' . DS . 'Config' . DS, $path);
	}

/**
 * testRead
 */
	public function testRead() {
		$settings = $this->DnaJsonReader->read('settings', 'settings');
		$expected = array(
			'acl_plugin' => 'Acl',
			'email' => 'you@your-site.com',
			'feed_url' => '',
			'locale' => 'eng',
			'status' => 1,
			'tagline' => 'A CakePHP powered Content Management System.',
			'theme' => '',
			'timezone' => 0,
			'title' => 'Dna - Test',
		);
		$this->assertEquals($expected, $settings['Site']);
	}

/**
 * testDump
 */
	public function testDump() {
		$settings = array(
			'Site' => array(
				'title' => 'Dna - Test (Edited)',
			),
			'Reading' => array(
				'date_time_format' => 'Y m d',
				'nodes_per_page' => 20,
			),
			'Nested' => array(
				'StringValue' => 'Is Fine',
				'AnotherArray' => array(
					'should' => 'be',
					'persisted' => 'correctly',
				),
			),
			'Hook' => array(
				'someKey' => 'value',
				'model_properties' => array('ignored', 'to', 'oblivion'),
				'controller_properties' => array('ignored', 'to', 'oblivion'),
			),
		);
		$this->DnaJsonReader->dump(basename($this->testFile), $settings);
		$expected = <<<END
{
\s+"Site": {
\s+"title": "Dna - Test \(Edited\)"
\s+},
\s+"Reading": {
\s+"date_time_format": "Y m d",
\s+"nodes_per_page": 20
\s+},
\s+"Nested": {
\s+"StringValue": "Is Fine",
\s+"AnotherArray": {
\s+"should": "be",
\s+"persisted": "correctly"
\s+}
\s+},
\s+"Hook": {
\s+"someKey": "value"
\s+}
}
END;
		$this->assertRegExp($expected, file_get_contents($this->testFile));
	}

}

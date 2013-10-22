<?php

App::uses('DnaComposer', 'Extensions.Lib');
App::uses('DnaTestCase', 'Dna.Lib/TestSuite');

/**
 * Dna Composer Test
 *
 * PHP version 5
 *
 * @category Test
 * @package  Dna
 * @version  1.4
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.dna.org
 */
class DnaComposerTest extends DnaTestCase {

/**
 * setUp
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		App::build(array(
			'Plugin' => array(CakePlugin::path('Extensions') . 'Test' . DS . 'test_app' . DS . 'Plugin' . DS),
			'View' => array(CakePlugin::path('Extensions') . 'Test' . DS . 'test_app' . DS . 'View' . DS),
		), App::PREPEND);
		$this->testPlugin = CakePlugin::path('Extensions') . 'Test' . DS . 'test_files' . DS . 'example_plugin.zip';
		$this->testTheme = CakePlugin::path('Extensions') . 'Test' . DS . 'test_files' . DS . 'example_theme.zip';
		$this->DnaComposer = new DnaComposer();
		$this->DnaComposer->appPath = CakePlugin::path('Extensions') . 'Test' . DS . 'test_app' . DS;
	}

/**
 * tearDown
 *
 * @return void
 */
	public function tearDown() {
		parent::tearDown();
		$path = CakePlugin::path('Extensions') . 'Test' . DS . 'test_app' . DS . 'Plugin' . DS . 'Example';
		$Folder = new Folder($path);
		$Folder->delete();
		$path = CakePlugin::path('Extensions') . 'Test' . DS . 'test_app' . DS . 'View' . DS . 'Themed' . DS . 'Minimal';
		$Folder = new Folder($path);
		$Folder->delete();
		$File = new File(CakePlugin::path('Extensions') . 'Test' . DS . 'test_app' . DS . 'composer.json');
		$File->delete();
	}

/**
 * testGetComposer
 *
 * @return void
 */
	public function testGetComposer() {
		$DnaComposer = $this->getMock('DnaComposer', array('_shellExec'));
		$DnaComposer->appPath = $this->DnaComposer->appPath;
		$DnaComposer->expects($this->any())
			->method('_shellExec')
			->with(
				$this->equalTo('curl -s http://getcomposer.org/installer | php -- --install-dir=' . $DnaComposer->appPath)
			)
			->will($this->returnValue(true));
		$DnaComposer->getComposer();
	}

/**
 * testRunComposer
 *
 * @return void
 */
	public function testRunComposer() {
		$DnaComposer = $this->getMock('DnaComposer', array('_shellExec'));
		$DnaComposer->appPath = $this->DnaComposer->appPath;
		$DnaComposer->getComposer();
		$DnaComposer->expects($this->once())
			->method('_shellExec')
			->with(
				$this->equalTo('php ' . $DnaComposer->composerPath . ' install')
			)
			->will($this->returnValue(true));
		$DnaComposer->runComposer();
	}

/**
 * testSetConfig
 *
 * @return void
 */
	public function testSetConfig() {
		$result = $this->DnaComposer->setConfig(array(
			'shama/ftp' => '*',
		));
		$this->assertTrue($result);
		$File = new File($this->DnaComposer->appPath . 'composer.json');
		$result = $File->read();
		$File->close();
		$expected = <<<END
{
\s+"minimum-stability": "dev",
\s+"config": {
\s+"vendor-dir": "Vendor",
\s+"bin-dir": "Vendor/bin"
\s+},
\s+"require": {
\s+"composer/installers": "\*",
\s+"shama/ftp": "\*"
\s+}
}
END;
		$this->assertRegExp($expected, trim($result));
	}
}
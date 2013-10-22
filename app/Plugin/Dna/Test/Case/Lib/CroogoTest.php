<?php
App::uses('DnaTestCase', 'Dna.TestSuite');

class DnaTest extends DnaTestCase {

	public function testCrossPluginHooks() {
		CakePlugin::load(array('Shops', 'Suppliers'), array(
			'bootstrap' => true,
			));
		$Order = ClassRegistry::init('Shops.Order');
		$this->assertTrue($Order->monitored);
	}

}
<?php

App::uses('DnaHelper', 'Dna.View/Helper');
App::uses('DnaHtmlHelper', 'Dna.View/Helper');
App::uses('Controller', 'Controller');
App::uses('DnaTestCase', 'Dna.TestSuite');
App::uses('View', 'View');
App::uses('HtmlHelper', 'View/Helper');

class DnaHtmlHelperTest extends DnaTestCase {

	public function setUp() {
		$controller = null;
		$this->View = new View($controller);
		$this->DnaHtml = new DnaHtmlHelper($this->View);
	}

	public function tearDown() {
		unset($this->View);
		unset($this->DnaHtml);
	}

	public function testIcon() {
		$result = $this->DnaHtml->icon('remove');
		$this->assertContains('<i class="icon-remove"></i>', $result);
	}

	public function testStatusOk() {
		$result = $this->DnaHtml->status(1);
		$this->assertContains('<i class="icon-ok green"></i>', $result);
	}

	public function testStatusOkWithUrl() {
		$result = $this->DnaHtml->status(1, array(
			'admin' => true,
			'plugin' => 'nodes',
			'controller' => 'nodes',
			'action' => 'toggle',
		));
		$expected = array(
			'a' => array(
				'href',
				'data-url' => '/admin/nodes/nodes/toggle',
				'class' => 'icon-ok green ajax-toggle',
			),
			'/a',
		);
		$this->assertTags($result, $expected);
	}

	public function testStatusRemove() {
		$result = $this->DnaHtml->status(0);
		$this->assertContains('<i class="icon-remove red"></i>', $result);
	}

	public function testStatusRemoveWithUrl() {
		$result = $this->DnaHtml->status(0, array(
			'admin' => true,
			'plugin' => 'nodes',
			'controller' => 'nodes',
			'action' => 'delete',
		));
		$expected = array(
			'a' => array(
				'href',
				'data-url' => '/admin/nodes/nodes/delete',
				'class' => 'icon-remove red ajax-toggle',
			),
			'/a',
		);
		$this->assertTags($result, $expected);
	}

	public function testLink() {
		$result = $this->DnaHtml->link('', '/remove', array('icon' => 'remove', 'button' => 'danger'));
		$this->assertContains('class="btn btn-danger"', $result);
		$this->assertContains('<i class="icon-remove icon-large"></i>', $result);
	}

/**
 * testLinkWithSmallIcon
 */
	public function testLinkWithSmallIcon() {
		$result = $this->DnaHtml->link('', '/remove', array(
			'icon' => 'remove',
			'iconSize' => 'small',
			'button' => 'danger'
		));
		$this->assertContains('class="btn btn-danger"', $result);
		$this->assertContains('<i class="icon-remove"></i>', $result);
	}

/**
 * testLinkWithInlineIcon
 */
	public function testLinkWithInlineIcon() {
		$result = $this->DnaHtml->link('', '/remove', array(
			'icon' => 'remove',
			'iconSize' => 'small',
			'iconInline' => true,
			'button' => 'danger'
		));
		$expected = array(
			'a' => array(
				'href',
				'class' => 'btn btn-danger icon-remove',
			),
		);
		$this->assertTags($result, $expected);

		$result = $this->DnaHtml->link('', '/remove', array(
			'icon' => 'remove',
			'iconInline' => true,
			'button' => 'danger'
		));
		$expected = array(
			'a' => array(
				'href',
				'class' => 'btn btn-danger icon-large icon-remove',
			),
		);
		$this->assertTags($result, $expected);
	}

	public function testLinkDefaultButton() {
		$result = $this->DnaHtml->link('Remove', '/remove', array('button' => 'default'));
		$this->assertContains('<a href="/remove" class="btn">Remove</a>', $result);
	}

	public function testLinkOptionsIsNull() {
		$result = $this->DnaHtml->link('Remove', '/remove', null);
	}

	public function testLinkTooltip() {
		$result = $this->DnaHtml->link('', '/remove', array('tooltip' => 'remove it'));
		$expected = array(
			'a' => array(
				'href',
				'rel' => 'tooltip',
				'data-placement',
				'data-trigger',
				'data-title' => 'remove it',
			),
			'/a',
		);
		$this->assertTags($result, $expected);
	}

	public function testLinkButtonTooltipWithArrayOptions() {
		$result = $this->DnaHtml->link('', '/remove', array(
			'button' => array('success'),
			'tooltip' => array(
				'data-title' => 'remove it',
				'data-placement' => 'left',
				'data-trigger' => 'focus',
			),
		));
		$expected = array(
			'a' => array(
				'href',
				'class' => 'btn btn-success',
				'rel' => 'tooltip',
				'data-placement' => 'left',
				'data-trigger' => 'focus',
				'data-title' => 'remove it',
			),
			'/a',
		);
		$this->assertTags($result, $expected);
	}

	public function testAddPathAndGetCrumbList() {
		$this->DnaHtml->addPath('/yes/we/can', '/');
		$result = $this->DnaHtml->getCrumbList();
		$this->assertContains('<a href="/yes/">yes</a>', $result);
		$this->assertContains('<a href="/yes/we/">we</a>', $result);
		$this->assertContains('<a href="/yes/we/can/">can</a>', $result);
	}
}

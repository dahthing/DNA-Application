<?php

App::uses('SettingsAppController', 'Settings.Controller');

/**
 * Languages Controller
 *
 * PHP version 5
 *
 * @category Settings.Controller
 * @package  Dna.Settings
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.dna.org
 */
class LanguagesController extends SettingsAppController {

/**
 * Controller name
 *
 * @var string
 * @access public
 */
	public $name = 'Languages';

/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
	public $uses = array('Settings.Language');

/**
 * Admin index
 *
 * @return void
 * @access public
 */
	public function admin_index() {
		$this->set('title_for_layout', __d('dna', 'Languages'));

		$this->Language->recursive = 0;
		$this->paginate['Language']['order'] = 'Language.weight ASC';
		$this->set('languages', $this->paginate());
	}

/**
 * Admin add
 *
 * @return void
 * @access public
 */
	public function admin_add() {
		$this->set('title_for_layout', __d('dna', "Add Language"));

		if (!empty($this->request->data)) {
			$this->Language->create();
			if ($this->Language->save($this->request->data)) {
				$this->Session->setFlash(__d('dna', 'The Language has been saved'), 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('dna', 'The Language could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		}
	}

/**
 * Admin edit
 *
 * @param integer $id
 * @return void
 * @access public
 */
	public function admin_edit($id = null) {
		$this->set('title_for_layout', __d('dna', "Edit Language"));

		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__d('dna', 'Invalid Language'), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Language->save($this->request->data)) {
				$this->Session->setFlash(__d('dna', 'The Language has been saved'), 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('dna', 'The Language could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Language->read(null, $id);
		}
	}

/**
 * Admin delete
 *
 * @param integer $id
 * @return void
 * @access public
 */
	public function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d('dna', 'Invalid id for Language'), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Language->delete($id)) {
			$this->Session->setFlash(__d('dna', 'Language deleted'), 'default', array('class' => 'success'));
			$this->redirect(array('action' => 'index'));
		}
	}

/**
 * Admin moveup
 *
 * @param integer $id
 * @param integer $step
 * @return void
 * @access public
 */
	public function admin_moveup($id, $step = 1) {
		if ($this->Language->moveUp($id, $step)) {
			$this->Session->setFlash(__d('dna', 'Moved up successfully'), 'default', array('class' => 'success'));
		} else {
			$this->Session->setFlash(__d('dna', 'Could not move up'), 'default', array('class' => 'error'));
		}

		$this->redirect(array('action' => 'index'));
	}

/**
 * Admin movedown
 *
 * @param integer $id
 * @param integer $step
 * @return void
 * @access public
 */
	public function admin_movedown($id, $step = 1) {
		if ($this->Language->moveDown($id, $step)) {
			$this->Session->setFlash(__d('dna', 'Moved down successfully'), 'default', array('class' => 'success'));
		} else {
			$this->Session->setFlash(__d('dna', 'Could not move down'), 'default', array('class' => 'error'));
		}

		$this->redirect(array('action' => 'index'));
	}

/**
 * Admin select
 *
 * @param integer $id
 * @param string $modelAlias
 * @return void
 * @access public
 */
	public function admin_select($id = null, $modelAlias = null) {
		if ($id == null ||
			$modelAlias == null) {
			$this->redirect(array('action' => 'index'));
		}

		$this->set('title_for_layout', __d('dna', 'Select a language'));
		$languages = $this->Language->find('all', array(
			'conditions' => array(
				'Language.status' => 1,
			),
			'order' => 'Language.weight ASC',
		));
		$this->set(compact('id', 'modelAlias', 'languages'));
	}

}

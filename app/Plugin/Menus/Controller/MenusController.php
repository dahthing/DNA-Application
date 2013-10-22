<?php

App::uses('MenusAppController', 'Menus.Controller');

/**
 * Menus Controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  Dna.Menus.Controller
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.dna.org
 */
class MenusController extends MenusAppController {

/**
 * Controller name
 *
 * @var string
 * @access public
 */
	public $name = 'Menus';

/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
	public $uses = array('Menus.Menu');

/**
 * afterConstruct
 */
	public function afterConstruct() {
		parent::afterConstruct();
		$this->_setupAclComponent();
	}

/**
 * Admin index
 *
 * @return void
 * @access public
 */
	public function admin_index() {
		$this->set('title_for_layout', __d('dna', 'Menus'));

		$this->Menu->recursive = 0;
		$this->paginate['Menu']['order'] = 'Menu.id ASC';
		$this->set('menus', $this->paginate());
	}

/**
 * Admin add
 *
 * @return void
 * @access public
 */
	public function admin_add() {
		$this->set('title_for_layout', __d('dna', 'Add Menu'));

		if (!empty($this->request->data)) {
			$this->Menu->create();
			if ($this->Menu->save($this->request->data)) {
				$this->Session->setFlash(__d('dna', 'The Menu has been saved'), 'default', array('class' => 'success'));
				$this->Dna->redirect(array('action' => 'edit', $this->Menu->id));
			} else {
				$this->Session->setFlash(__d('dna', 'The Menu could not be saved. Please, try again.'), 'default', array('class' => 'error'));
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
		$this->set('title_for_layout', __d('dna', 'Edit Menu'));

		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__d('dna', 'Invalid Menu'), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Menu->save($this->request->data)) {
				$this->Session->setFlash(__d('dna', 'The Menu has been saved'), 'default', array('class' => 'success'));
				$this->Dna->redirect(array('action' => 'edit', $this->Menu->id));
			} else {
				$this->Session->setFlash(__d('dna', 'The Menu could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Menu->read(null, $id);
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
			$this->Session->setFlash(__d('dna', 'Invalid id for Menu'), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Menu->delete($id)) {
			$this->Session->setFlash(__d('dna', 'Menu deleted'), 'default', array('class' => 'success'));
			$this->redirect(array('action' => 'index'));
		}
	}

}

<?php

App::uses('UsersAppController', 'Users.Controller');

/**
 * Roles Controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  Dna.Users.Controller
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.dna.org
 */
class RolesController extends UsersAppController {

/**
 * Controller name
 *
 * @var string
 * @access public
 */
	public $name = 'Roles';

/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
	public $uses = array('Users.Role');

/**
 * Admin index
 *
 * @return void
 * @access public
 */
	public function admin_index() {
		$this->set('title_for_layout', __d('dna', 'Roles'));

		$this->Role->recursive = 0;
		$this->paginate['Role']['order'] = "Role.id ASC";
		$this->set('roles', $this->paginate());
		$this->set('displayFields', $this->Role->displayFields());
	}

/**
 * Admin add
 *
 * @return void
 * @access public
 */
	public function admin_add() {
		$this->set('title_for_layout', __d('dna', 'Add Role'));

		if (!empty($this->request->data)) {
			$this->Role->create();
			if ($this->Role->save($this->request->data)) {
				$this->Session->setFlash(__d('dna', 'The Role has been saved'), 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('dna', 'The Role could not be saved. Please, try again.'), 'default', array('class' => 'error'));
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
		$this->set('title_for_layout', __d('dna', 'Edit Role'));

		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__d('dna', 'Invalid Role'), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Role->save($this->request->data)) {
				$this->Session->setFlash(__d('dna', 'The Role has been saved'), 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('dna', 'The Role could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Role->read(null, $id);
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
			$this->Session->setFlash(__d('dna', 'Invalid id for Role'), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Role->delete($id)) {
			$this->Session->setFlash(__d('dna', 'Role deleted'), 'default', array('class' => 'success'));
			$this->redirect(array('action' => 'index'));
		}
	}

}

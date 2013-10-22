<?php

App::uses('BlocksAppController', 'Blocks.Controller');

/**
 * Blocks Controller
 *
 * PHP version 5
 *
 * @category Blocks.Controller
 * @package  Dna.Blocks.Controller
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.dna.org
 */
class BlocksController extends BlocksAppController {

/**
 * Controller name
 *
 * @var string
 * @access public
 */
	public $name = 'Blocks';

/**
 * Components
 *
 * @var array
 * @access public
 */
	public $components = array(
		'Search.Prg' => array(
			'presetForm' => array(
				'paramType' => 'querystring',
			),
			'commonProcess' => array(
				'paramType' => 'querystring',
				'filterEmpty' => true,
			),
		),
	);

/**
 * Preset Variables Search
 *
 * @var array
 * @access public
 */
	public $presetVars = true;

/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
	public $uses = array('Blocks.Block', 'Users.Role');

/**
 * afterConstruct
 * @see AppController::afterConstruct()
 */
	public function afterConstruct() {
		parent::afterConstruct();
		$this->_setupAclComponent();
	}

/**
 * beforeFilter
 *
 * @return void
 * @access public
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Security->unlockedActions[] = 'admin_toggle';
	}

/**
 * Toggle Block status
 *
 * @param $id string Block id
 * @param $status integer Current Block status
 * @return void
 */
	public function admin_toggle($id = null, $status = null) {
		$this->Dna->fieldToggle($this->Block, $id, $status);
	}

/**
 * Admin index
 *
 * @return void
 * @access public
 * $searchField : Identify fields for search
 */
	public function admin_index() {
		$this->set('title_for_layout', __d('dna', 'Blocks'));
		$this->Prg->commonProcess();
		$searchFields = array('region_id', 'title');

		$this->Block->recursive = 0;
		$this->paginate['Block']['order'] = array('Block.weight' => 'ASC');

		$this->set('blocks', $this->paginate($this->Block->parseCriteria($this->request->query)));
		$this->set('regions', $this->Block->Region->find('list'));
		$this->set('searchFields', $searchFields);
		if (isset($this->request->query['chooser'])) {
			$this->layout = 'admin_popup';
		}
	}

/**
 * Admin add
 *
 * @return void
 * @access public
 */
	public function admin_add() {
		$this->set('title_for_layout', __d('dna', 'Add Block'));

		if (!empty($this->request->data)) {
			$this->Block->create();
			$this->request->data['Block']['visibility_roles'] = $this->Block->encodeData($this->request->data['Role']['Role']);
			$this->request->data['Block']['visibility_paths'] = $this->Block->encodeData(explode("\n", $this->request->data['Block']['visibility_paths']));
			if ($this->Block->save($this->request->data)) {
				$this->Session->setFlash(__d('dna', 'The Block has been saved'), 'default', array('class' => 'success'));
				$this->Dna->redirect(array('action' => 'edit', $this->Block->id));
			} else {
				$this->Session->setFlash(__d('dna', 'The Block could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		}
		$regions = $this->Block->Region->find('list');
		$roles = $this->Role->find('list');
		$this->set(compact('regions', 'roles'));
	}

/**
 * Admin edit
 *
 * @param integer $id
 * @return void
 * @access public
 */
	public function admin_edit($id = null) {
		$this->set('title_for_layout', __d('dna', 'Edit Block'));

		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__d('dna', 'Invalid Block'), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			$this->request->data['Block']['visibility_roles'] = $this->Block->encodeData($this->request->data['Role']['Role']);
			$this->request->data['Block']['visibility_paths'] = $this->Block->encodeData(explode("\n", $this->request->data['Block']['visibility_paths']));
			if ($this->Block->save($this->request->data)) {
				$this->Session->setFlash(__d('dna', 'The Block has been saved'), 'default', array('class' => 'success'));
				$this->Dna->redirect(array('action' => 'edit', $id));
			} else {
				$this->Session->setFlash(__d('dna', 'The Block could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		}
		if (empty($this->request->data)) {
			$data = $this->Block->read(null, $id);
			$data['Role']['Role'] = $this->Block->decodeData($data['Block']['visibility_roles']);
			if ($data['Block']['visibility_paths'] != '') {
				$data['Block']['visibility_paths'] = implode("\n", $this->Block->decodeData($data['Block']['visibility_paths']));
			}
			$this->request->data = $data;
		}
		$regions = $this->Block->Region->find('list');
		$roles = $this->Role->find('list');
		$this->set(compact('regions', 'roles'));
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
			$this->Session->setFlash(__d('dna', 'Invalid id for Block'), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Block->delete($id)) {
			$this->Session->setFlash(__d('dna', 'Block deleted'), 'default', array('class' => 'success'));
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
		if ($this->Block->moveUp($id, $step)) {
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
		if ($this->Block->moveDown($id, $step)) {
			$this->Session->setFlash(__d('dna', 'Moved down successfully'), 'default', array('class' => 'success'));
		} else {
			$this->Session->setFlash(__d('dna', 'Could not move down'), 'default', array('class' => 'error'));
		}

		$this->redirect(array('action' => 'index'));
	}

/**
 * Admin process
 *
 * @return void
 * @access public
 */
	public function admin_process() {
		$action = $this->request->data['Block']['action'];
		$ids = array();
		foreach ($this->request->data['Block'] as $id => $value) {
			if ($id != 'action' && $value['id'] == 1) {
				$ids[] = $id;
			}
		}

		if (count($ids) == 0 || $action == null) {
			$this->Session->setFlash(__d('dna', 'No items selected.'), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));
		}

		if ($action == 'delete' &&
			$this->Block->deleteAll(array('Block.id' => $ids), true, true)) {
			$this->Session->setFlash(__d('dna', 'Blocks deleted'), 'default', array('class' => 'success'));
		} elseif ($action == 'publish' &&
			$this->Block->updateAll(array('Block.status' => true), array('Block.id' => $ids))) {
			$this->Session->setFlash(__d('dna', 'Blocks published'), 'default', array('class' => 'success'));
		} elseif ($action == 'unpublish' &&
			$this->Block->updateAll(array('Block.status' => false), array('Block.id' => $ids))) {
			$this->Session->setFlash(__d('dna', 'Blocks unpublished'), 'default', array('class' => 'success'));
		} else {
			$this->Session->setFlash(__d('dna', 'An error occurred.'), 'default', array('class' => 'error'));
		}

		$this->redirect(array('action' => 'index'));
	}

}

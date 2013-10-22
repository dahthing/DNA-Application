<?php

/**
 * Comments Helper
 *
 * PHP version 5
 *
 * @category Comments.View/Helper
 * @package  Dna.Comments.View.Helper
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.dna.org
 */
class CommentsHelper extends AppHelper {

/**
 * beforeRender
 */
	public function beforeRender($viewFile) {
		if (isset($this->request->params['admin']) && !$this->request->is('ajax')) {
			$this->_adminTabs();
		}
	}

/**
 * Hook admin tabs when type allows commenting
 */
	protected function _adminTabs() {
		if (empty($this->_View->viewVars['type']['Type']['comment_status'])) {
			return;
		}
		$controller = Inflector::camelize($this->request->params['controller']);
		$title = __d('dna', 'Comments');
		$element = 'Comments.admin/comments_tab';
		Dna::hookAdminTab("$controller/admin_add", $title, $element);
		Dna::hookAdminTab("$controller/admin_edit", $title, $element);
	}

}

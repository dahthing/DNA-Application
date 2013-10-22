<?php

App::uses('Helper', 'View');

/**
 * Dna Application helper
 *
 * This file is the base helper of all other helpers
 *
 * PHP version 5
 *
 * @category Helpers
 * @package  Dna.Dna.View.Helper
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.dna.org
 */
class DnaAppHelper extends Helper {

/**
 * Url helper function
 *
 * @param string $url
 * @param bool $full
 * @return mixed
 * @access public
 */
	public function url($url = null, $full = false) {
		if (isset($this->params['locale'])) {
                    if(is_array($url) && !isset($url['locale']) )

                        $url['locale'] = $this->params['locale'];

                    else{

                        $url = ltrim($url, '/');

                        $base_url =  preg_replace('/'.$this->params['locale'].'/', '', $url);
                        $url = sprintf('/%s/%s', $this->params['locale'], $base_url);                                                
                    }

                }
		return parent::url($url, $full);
	}

}

<?php

App::uses('CakePlugin', 'Core');

class AssetGenerator extends Object {

    protected $_dnaPath;
    protected $_dnaWebroot;
    protected $_tags = array();
    protected $_repos = array();

    public function __construct() {
        $this->_dnaPath = CakePlugin::path('Dna');
        $this->_dnaWebroot = $this->_dnaPath . 'webroot' . DS;

        $this->_readMakefile();
    }

    /**
     * read settings from Makefile
     */
    protected function _readMakefile() {
        $fp = fopen($this->_dnaPath . 'Makefile', 'r');
        $lines = fread($fp, 1024);

        preg_match('/REPO_BOOTSTRAP=(.*)/', $lines, $matches);
        if (empty($matches[1])) {
            $this->log('Cannot find repo spec for bootstrap', LOG_ERR);
            $this->_stop();
        }
        $this->_repos['bootstrap'] = $matches[1];

        preg_match('/BOOTSTRAP_TAG=(.*)/', $lines, $matches);
        if (empty($matches[1])) {
            $this->log('Cannot find tag spec for bootstrap', LOG_ERR);
            $this->_stop();
        }
        $this->_tags['bootstrap'] = $matches[1];

        preg_match('/REPO_FONTAWESOME=(.*)/', $lines, $matches);
        if (empty($matches[1])) {
            $this->log('Cannot find repo spec for FontAwesome', LOG_ERR);
            $this->_stop();
        }
        $this->_repos['fontAwesome'] = $matches[1];

        preg_match('/FONTAWESOME_TAG=(.*)/', $lines, $matches);
        if (empty($matches[1])) {
            $this->log('Cannot find tag spec for fontAwesome', LOG_ERR);
            $this->_stop();
        }
        $this->_tags['fontAwesome'] = $matches[1];
    }

    /**
     * Compile CSS files used by admin ui
     *
     * @throws Exception
     */
    protected function _compileCss() {
        $bootstrapPath = $this->_dnaWebroot . 'bootstrap';
        if (!file_exists($bootstrapPath)) {
            if (!$this->_clone) {
                throw new Exception('You don\'t have "bootstrap" directory in ' . WWW_ROOT);
            }
            chdir($this->_dnaPath);
            CakeLog::info('Cloning Bootstrap...');
            $command = sprintf('git clone -b %s %s %s', escapeshellarg($this->_tags['bootstrap']), escapeshellarg($this->_repos['bootstrap']), escapeshellarg($bootstrapPath)
            );
            CakeLog::info("	$command");
            exec($command);
        }
        chdir($bootstrapPath);
        exec(sprintf('git checkout -f %s', escapeshellarg($this->_tags['bootstrap'])));

        App::import('Vendor', 'Dna.Lessc', array(
            'file' => 'lessphp' . DS . 'lessc.inc.php',
        ));
        $lessc = new lessc();
        $formatter = new lessc_formatter_lessjs();
        $formatter->compressColors = false;
        ini_set('precision', 16);
        $lessc->setFormatter($formatter);

        $files = array(
            'less' . DS . 'admin.less' => 'css' . DS . 'dna-bootstrap.css',
            'less' . DS . 'admin-responsive.less' => 'css' . DS . 'dna-bootstrap-responsive.css',
        );
        foreach ($files as $file => $output) {
            $file = $this->_dnaWebroot . $file;
            $output = $this->_dnaWebroot . $output;
            $out = str_replace(APP, '', $output);
            if ($lessc->compileFile($file, $output)) {
                $text = __d('dna', 'CSS : %s created', $out);
                CakeLog::info($text);
            } else {
                $text = __d('dna', 'CSS : %s failed', $out);
                CakeLog::error($text);
            }
        }
    }

    /**
     * Compile javascripts
     */
    protected function _compileJs() {
        $bootstrapPath = $this->_dnaWebroot . 'bootstrap';
        $outputFile = $this->_dnaWebroot . 'js' . DS . 'dna-bootstrap.js';
        chdir($bootstrapPath);
        $rc = exec('cat js/bootstrap-transition.js js/bootstrap-alert.js js/bootstrap-button.js js/bootstrap-carousel.js js/bootstrap-collapse.js js/bootstrap-dropdown.js js/bootstrap-modal.js js/bootstrap-tooltip.js js/bootstrap-popover.js js/bootstrap-scrollspy.js js/bootstrap-tab.js js/bootstrap-typeahead.js js/bootstrap-affix.js > ' . escapeshellarg($outputFile));

        $out = str_replace(APP, '', $outputFile);
        if ($rc == 0) {
            $text = __d('dna', 'JS  : %s created', $out);
            CakeLog::info($text);
        } else {
            $text = __d('dna', 'JS  : %s failed', $out);
            CakeLog::error($text);
        }
    }

    /**
     * Copy font files used by admin ui
     *
     * @throws Exception
     */
    protected function _copyFonts() {
        $dnaPath = CakePlugin::path('Dna');
        $fontAwesomePath = $dnaPath . 'webroot' . DS . 'fontAwesome';
        if (!file_exists($fontAwesomePath)) {
            if (!$this->_clone) {
                throw new Exception('You don\'t have "fontAwesome" in ' . WWW_ROOT);
            }
            CakeLog::info('Cloning FontAwesome...');
            $command = sprintf('git clone -b %s %s %s', escapeshellarg($this->_tags['fontAwesome']), escapeshellarg($this->_repos['fontAwesome']), escapeshellarg($fontAwesomePath)
            );
            CakeLog::info("	$command");
            exec($command);
        }
        chdir($fontAwesomePath);
        exec(sprintf('git checkout -f %s', escapeshellarg($this->_tags['fontAwesome'])));
        $targetPath = $dnaPath . 'webroot' . DS . 'font' . DS;
        $Folder = new Folder($targetPath, true);
        $fontPath = $dnaPath . 'webroot' . DS . 'fontAwesome' . DS . 'font';
        $Folder = new Folder($fontPath);
        $files = $Folder->read();
        if (empty($files[1])) {
            CakeLog::error('No font files found');
            $this->_stop();
        }
        foreach ($files[1] as $file) {
            $File = new File($fontPath . DS . $file);
            $newFile = $targetPath . $file;
            $displayFilename = str_replace(APP, '', $newFile);
            if ($File->copy($newFile)) {
                $text = __d('dna', 'Font: %s copied', $displayFilename);
                CakeLog::info($text);
            } else {
                $text = __d('dna', 'File: %s not copied', $file);
                CakeLog::error($text);
            }
        }
    }

    public function generate($options = array()) {
        $options = array_merge(array(
            'clone' => false,
                ), $options);
        $this->_clone = $options['clone'];
        $this->_compileCss();
        $this->_compileJs();
        $this->_copyFonts();
    }

}

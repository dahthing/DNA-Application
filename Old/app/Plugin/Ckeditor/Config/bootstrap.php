<?php

/**
 * Hook helper
 */
foreach ((array)Configure::read('Wysiwyg.actions') as $action => $settings) {
	$actionE = explode('/', $action);
	Dna::hookHelper($actionE['0'], 'Ckeditor.Ckeditor');
}
Dna::hookHelper('Attachments', 'Ckeditor.Ckeditor');

<?php

// Basic
DnaRouter::connect('/', array(
	'plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'promoted'
));

DnaRouter::connect('/promoted/*', array(
	'plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'promoted'
));

DnaRouter::connect('/search/*', array(
	'plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'search'
));

// Content types
DnaRouter::contentType('blog');
DnaRouter::contentType('node');
if (Configure::read('Install.installed')) {
	DnaRouter::routableContentTypes();
}

// Page
DnaRouter::connect('/about', array(
	'plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'view',
	'type' => 'page', 'slug' => 'about'
));
DnaRouter::connect('/page/:slug', array(
	'plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'view',
	'type' => 'page'
));

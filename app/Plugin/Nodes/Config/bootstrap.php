<?php

$cacheConfig = array_merge(
        Configure::read('Cache.defaultConfig'), array('groups' => array('nodes'))
);
DnaCache::config('nodes', $cacheConfig);
DnaCache::config('nodes_view', $cacheConfig);
DnaCache::config('nodes_promoted', $cacheConfig);
DnaCache::config('nodes_term', $cacheConfig);
DnaCache::config('nodes_index', $cacheConfig);

Dna::hookComponent('*', 'Nodes.Nodes');

Dna::hookHelper('*', 'Nodes.Nodes');

// Configure Wysiwyg
Dna::mergeConfig('Wysiwyg.actions', array(
    'Nodes/admin_add' => array(
        array(
            'elements' => 'NodeBody',
        ),
    ),
    'Nodes/admin_edit' => array(
        array(
            'elements' => 'NodeBody',
        ),
    ),
    'Translate/admin_edit' => array(
        array(
            'elements' => 'NodeBody',
        ),
    ),
));

DnaNav::add('content', array(
    'icon' => 'glyphicons home',
    'title' => __d('dna', 'Pages'),
    'url' => array(
        'plugin' => 'nodes',
        'admin' => true,
        'controller' => 'nodes',
        'action' => 'index',
    ),
    'weight' => 10,
    'children' => array(
        'list' => array(
            'title' => __d('dna', 'List'),
            'url' => array(
                'plugin' => 'nodes',
                'admin' => true,
                'controller' => 'nodes',
                'action' => 'index',
            ),
            'weight' => 10,
        ),
        'create' => array(
            'title' => __d('dna', 'Create'),
            'url' => array(
                'plugin' => 'nodes',
                'admin' => true,
                'controller' => 'nodes',
                'action' => 'create',
            ),
            'weight' => 20,
        ),
    )
));

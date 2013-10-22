<?php

Dna::hookComponent('Nodes', array('Meta.Meta' => array('priority' => 8)));

Dna::hookHelper('*', 'Meta.Meta');

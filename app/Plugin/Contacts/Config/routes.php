<?php

// Contact
DnaRouter::connect('/contact', array(
	'plugin' => 'contacts', 'controller' => 'contacts', 'action' => 'view', 'contact'
));

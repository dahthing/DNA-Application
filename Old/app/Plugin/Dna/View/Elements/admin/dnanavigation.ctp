<?php

echo $this->Dna->adminDnaMenus(DnaNav::items(), array(
    'htmlAttributes' => array(
        'id' => 'sidebar-menu',
    ),
));
?>
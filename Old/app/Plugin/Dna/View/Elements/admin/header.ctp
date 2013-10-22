<?php

$dashboardUrl = array(
	'admin' => true,
	'plugin' => 'dashboard',
	'controller' => 'dashboard',
	'action' => 'index',
);
?>
<div class="navbar main">
    <?php
    echo $this->Html->link(
            __d('Nomeatus DNA', 'Nomeatus DNA').' '.strval(Configure::read('Dna.version')), $dashboardUrl, array('class' => 'appbrand')
    );
    ?>
    <button type="button" class="btn btn-navbar">
        <span class="icon-bar"></span> 
        <span class="icon-bar"></span> 
        <span class="icon-bar"></span>
    </button>
    
    <ul class="topnav pull-left tn1">
        <li><?php echo $this->Html->link($this->Html->Tag('i','').__d('dna', 'Visit website'), '/', array('target' => '_blank','class'=>'glyphicons link')); ?></li>
    </ul>
    <ul class="topnav pull-right">
        <li class="visible-desktop">
            <ul class="notif">
                <li><a href="#" class="glyphicons envelope"         data-toggle="tooltip"       data-placement="bottom"       data-original-title="5 new messages"><i></i> 5</a></li>
                <li><a href="#" class="glyphicons shopping_cart"    data-toggle="tooltip"       data-placement="bottom"       data-original-title="1 new orders"><i></i> 1</a></li>
                <li><a href="#" class="glyphicons log_book"         data-toggle="tooltip"       data-placement="bottom"       data-original-title="3 new activities"><i></i> 3</a></li>
            </ul>
        </li>
        <li class="hidden-phone">
            <a data-toggle="dropdown" href="#"><img alt="en" src="/dna/img/flags/en.png"></a>
            <ul class="dropdown-menu pull-left">
                <li class="active"><?php
                    echo $this->Html->link(
                            $this->Html->image('/dna/img/flags/en.png', array('alt' => 'English', 'width' => '24')) . ' English', '/en'
                    );
                    ?></li>
                <li><?php
                    echo $this->Html->link(
                            $this->Html->image('/dna/img/flags/pt.png', array('alt' => 'Portugues', 'width' => '24')) . ' Portugues', '/pt'
                    );
                    ?></li>
                <li><?php
                    echo $this->Html->link(
                            $this->Html->image('/dna/img/flags/es.png', array('alt' => 'Spain', 'width' => '24')) . ' Spain', '/es'
                    );
                    ?></li>
            </ul>
        </li>
        <?php if ($this->Session->read('Auth.User.id')): ?>
            <li class="account">
                <a data-toggle="dropdown" href="#" class="glyphicons logout lock"><span class="hidden-phone text"><?php echo $this->Session->read('Auth.User.username')?></span><i></i></a>
                <ul class="dropdown-menu pull-right">
                    <li><a href="#" class="glyphicons cogwheel">Settings<i></i></a></li>
                    <li><a href="#" class="glyphicons camera">My Photos<i></i></a></li>
                    <li class="highlight profile">
                        <span>
                            <span class="heading">Profile <a href="#" class="pull-right">edit</a></span>
                            <span class="img"><?php echo $this->Html->image($this->Session->read('Auth.User.image')); ?></span>
                            <span class="details">
                                <a href="index.php?lang=en&page=my_account"><?php echo $this->Session->read('Auth.User.name')?></a>
                                <?php echo $this->Session->read('Auth.User.email')?>
                            </span>
                            <span class="clearfix"></span>
                        </span>
                    </li>
                    <li>
                        <span>
                            
                            <?php echo $this->Html->link(
                                    __d('dna', "Log out"), 
                                    array('plugin' => 'users', 
                                        'controller' => 'users', 
                                        'action' => 'logout'),
                                    array('class'=>'btn btn-default btn-small pull-right')); ?>
                        </span>
                    </li>
                </ul>
            </li>
        <?php endif; ?>

    </ul>
</div>

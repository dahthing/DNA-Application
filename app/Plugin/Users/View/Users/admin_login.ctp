<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login')));?>
<?php

    $this->Form->inputDefaults(array(
        'label' => false,
        ));
    
    echo $this->Form->input('username', array(
        'placeholder' => __d('dna', 'Your Username'),
        'before' => false,
        'div' => false,
        'class' => 'input-block-level',
        'label'=>__d('dna', 'Username'),
        ));
    
    echo $this->Form->input('password', array(
        'placeholder' => 'Your Password',
        'before' => '',
        'div' => false,
        'class' => 'input-block-level margin-none',
        'label'=>__d('dna', 'Password').' '.
                $this->Html->link(__d('dna', 'forgot it?'), array(
			'admin' => false,
			'controller' => 'users',
			'action' => 'forgot',
			), array(
			'class' => 'password'
		)),
        ));
    
    echo $this->Html->div('separator bottom','<!-- -->');
    echo '<div class="row-fluid">';
        if (Configure::read('Access Control.autoLoginDuration')):
            echo $this->Html->div('span8',
                
                $this->Form->input('remember', array(
                    'label' => array('text'=>__d('dna', 'Remember me?'),'class'=>'checkbox'),
                    'type' => 'checkbox',
                    'default' => false,
                    'div'=>'uniformjs'
                ))
            );
        endif;
        echo $this->Html->div('span4 center',
            $this->Form->button(__d('dna', 'Log In'),array('class'=>'btn btn-block btn-inverse'))
        );
    echo '</div>';
    
?>

<?php echo $this->Form->end(); ?>


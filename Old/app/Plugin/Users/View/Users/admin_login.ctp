<?php echo $this->Form->create('User', 
        array(
            'url' => array('controller' => 'users', 'action' => 'login'),
            'class'=>'form-signin'
        ));?>
        <h3 class="glyphicons unlock form-signin-heading"><i></i> <?php echo __d('dna', 'DNA Login')?></h3>
        <div class="uniformjs">
        <?php
            $this->Form->inputDefaults(array(
                'label' => false,
                'div'=>false,
            ));
            
            echo $this->Form->input('username', array(
                'placeholder' => __d('dna', 'Username'),
                'class' => 'input-block-level',
                'div'=>false,
            ));
            
            echo $this->Form->input('password', array(
                'placeholder' => 'Password',
                'class' => 'input-block-level',
                'div'=>false,
            ));
            if (Configure::read('Access Control.autoLoginDuration')):
                echo '<label class="checkbox" for="UserRemember">';
                    echo $this->Form->input('remember', array(
                        'label' => false,
                        'type' => 'checkbox',
                        'default' => false,
                        'div'=>false,
                    ));
                    echo __d('dna','Remenber me?');
                echo '</label>';
            endif;
        ?>
        </div>
        <?php
            echo $this->Form->button(__d('dna', 'Log In'), array(
                    'class'=>'btn btn-large btn-primary',
                    'default' => false,
                    'div'=>false,
                ));
        ?>

<?php echo $this->Form->end(); ?>
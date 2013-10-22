<?php echo $this->Html->doctype('html5'); ?>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo Configure::read('Site.title'); ?> :: <?php echo $title_for_layout; ?></title>
        <meta http-equiv="content-language" content="<?php echo Configure::read('Site.locale') ?>"/>
        <?php
        echo $this->Meta->meta(array(
            'viewport' => 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no',
            'rating' => 'general',
            'expires' => 'never',
            'revisit-after' => '15 days',
        ));
        echo $this->Layout->feed();
        
        echo $this->Html->css(array(
            '/css/bootstrap.min',
        ), null, array('fullBase' => true));
       
        echo $this->WHtml->less(array(
            '/less/main',
        ));
        
        echo $this->Layout->js();
        echo $this->Html->script(array(
            '/js/modernizr.2.6.2',
            '/js/less.1.4.1'
        ), array('fullBase' => true));

        echo $this->Blocks->get('css');
        echo $this->Blocks->get('script');
        ?>

    </head>
    <body>
        <?php echo $this->element('header');?>
        
        <?php echo $this->element('slider'); ?>
        
        <div class="container">
            <?php
               // echo $this->Layout->sessionFlash();
                echo $content_for_layout;
            ?>
        </div>

        <?php echo $this->element('footer');?>
        
        <?php
        echo $this->Html->script(array(
            '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'
        ));
        echo $this->Html->scriptBlock("window.jQuery || document.write('<script src=\"js/vendor/jquery-1.10.2.min.js\"><\/script>')");

        echo $this->Html->script(array(
            '/js/bootstrap.min'
        ), array('fullBase' => true));
        ?>
        <?php
        echo $this->Blocks->get('scriptBottom');
        echo $this->Js->writeBuffer();
        ?>
    </body>
</html>
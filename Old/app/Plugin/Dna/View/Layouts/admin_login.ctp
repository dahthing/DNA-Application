<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html> <!--<![endif]-->
    <head>
        <title><?php echo __d('dna', 'Dna'); ?> - <?php echo $title_for_layout; ?></title>

        <!-- Meta -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <?php
        echo $this->Html->css(array(
            '/dna/css/bootstrap/bootstrap.min',
            '/dna/css/bootstrap/bootstarp-responsive.min',
            '/dna/css/bootstrap/extends/jasny-bootstrap.min',
            '/dna/css/bootstrap/extends/jasny-bootstrap-responsive.min',
            '/dna/css/bootstrap/extends/bootstrap-wysihtml5-0.0.2',
            '/dna/css/components/glyphicons',
            '/dna/css/components/uniform/uniform.default.min',
        ));
        echo $this->Html->less(array(
            '/dna/less/style',
        ));
       
        echo $this->Layout->js();
        
        echo $this->Html->script(array(
            '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js',
            '/dna/js/lib/modernizr.2.6.2.min',
            '/dna/js/components/less.1.4.1',
        ));
        ?>
    </head>
    <body>
        <!-- Start Content -->
        <div class="container-fluid login">
            <div class="navbar main">
                <?php
                echo $this->Html->link(
                        __d('Nomeatus DNA', 'Nomeatus DNA'), '/', array('class' => 'appbrand')
                );
                ?>
                <ul class="topnav pull-right">
                    <li class="hidden-phone">
                        <a data-toggle="dropdown" href="#"><img alt="en" src="/dna/img/flags/en.png"></a>
                        <ul class="dropdown-menu pull-left">
                            <li class="active"><?php
                                echo $this->Html->link(
                                    $this->Html->image('/dna/img/flags/en.png',array('alt'=>'English','width'=>'24')).' English',  
                                    '/en'
                                );
                            ?></li>
                            <li><?php
                                echo $this->Html->link(
                                    $this->Html->image('/dna/img/flags/pt.png',array('alt'=>'Portugues','width'=>'24')).' Portugues',  
                                    '/pt'
                                );
                            ?></li>
                            <li><?php
                                echo $this->Html->link(
                                    $this->Html->image('/dna/img/flags/es.png',array('alt'=>'Spain','width'=>'24')).' Spain',  
                                    '/es'
                                );
                            ?></li>
                        </ul>
                    </li>
                    <li class="account">
                        <?php
                        echo $this->Html->link(
                            '<span class="hidden-phone text">'.__d('dna', 'Welcome').'<strong> '.__d('dna', 'guest').'</strong></span><i></i>', 
                             array(
                                'admin' => true,
                                'controller' => 'users',
                                'action' => 'login',
                            ), 
                            array('class' => 'glyphicons logout lock')
                        );
                        ?>
                    </li>
                </ul>
            </div>

            <div id="push"></div>
            <div id="login">
                <?php
                    //echo $this->Layout->sessionFlash();
                    echo $this->fetch('content');
                ?>
            </div>
        </div>
        
        <!-- Scripts -->
        <?php 
        echo $this->Html->script(array(
            
            'http://code.jquery.com/ui/1.10.3/jquery-ui.js',
            '/dna/js/components/uniform/jquery.uniform.min',
            '/dna/js/bootstarp/bootstrap.min',
            
            '/dna/js/script',
        ));
        ?>
    </body>
</html>
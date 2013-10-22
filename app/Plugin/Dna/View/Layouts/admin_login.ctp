<?php echo $this->HTML->doctype('html5'); ?>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 fluid top-full sidebar sidebar-full"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 fluid top-full sticky-top sidebar sidebar-full"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 fluid top-full sticky-top sidebar sidebar-full"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8 fluid top-full sticky-top sidebar sidebar-full"> <![endif]-->
<!--[if !IE]><!--><html class="fluid top-full sticky-top sidebar sidebar-full"><!-- <![endif]-->

    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?> - <?php echo __d('dna', 'Dna'); ?> (v<?php echo strval(Configure::read('Dna.version')); ?>)</title>
        <?php
        echo $this->Meta->meta(array(
            'viewport' => 'width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0',
            'apple-mobile-web-app-capable' => 'yes',
            'apple-mobile-web-app-status-bar-style' => 'black'
        ));

        echo $this->Html->css(array(
            '/dna/css/bootstrap/bootstrap',
            '/dna/css/bootstrap/responsive',
            '/dna/fonts/glyphicons/css/glyphicons',
            '/dna/fonts/font-awesome/css/font-awesome.min',
            '/dna/css/pixelmatrix-uniform/uniform.default',
        ));
        ?>

        <!--[if IE 7]>
        <?php
        echo $this->Html->css(array(
            '/dna/fonts/font-awesome/css/font-awesome-ie7.min',
        ));
        ?>
        <![endif]-->

        <?php
        echo $this->Html->css(array(
            '/dna/css/style-default',
        ));
        echo $this->Layout->js();
        echo $this->Html->script(array(
            'http://code.jquery.com/jquery-1.10.1.min.js',
            'http://code.jquery.com/jquery-migrate-1.2.1.min.js',
        ));

        //echo $this->fetch('script');
        //echo $this->fetch('css');
        ?>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <?php
        echo $this->Html->script(array(
            '/dna/js/plugins/html5shiv',
        ));
        ?>
        <![endif]-->

        <?php
        echo $this->Html->script(array(
            '/dna/js/plugins/less.min',
        ));
        ?>

    </head>
    <body class="login">
        <!-- Wrapper -->
        <div id="login">

            <div class="container">

                <div class="wrapper">

                    <h1 class="glyphicons lock"><?php echo __d('dna', 'Dna Framework'); ?> <i></i></h1>

                    <!-- Box -->
                    <div class="widget widget-heading-simple widget-body-gray">

                        <div class="widget-body">
                        <?php
                            echo $this->fetch('content');
                        ?>
                        </div>
                       
                    </div>
                    
                </div>

            </div>

        </div>
        <!-- // Wrapper END -->


        <?php
        echo $this->Html->script(array(
            //'/dna/js/plugins/js-beautify/beautify',
            //'/dna/js/plugins/js-beautify/beautify-html',
            '/dna/js/plugins/modernizr',
            '/dna/js/bootstrap/bootstrap.min',
            '/dna/js/plugins/pixelmatrix-uniform/jquery.uniform.min',
            '/dna/js/common',
            '/dna/js/admin_login',
        ));
        
        echo $this->Blocks->get('scriptBottom');
        echo $this->Js->writeBuffer();
        ?>
    </body>
</html>
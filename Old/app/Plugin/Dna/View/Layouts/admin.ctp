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
        <div class="container-fluid"> <!-- Start Content -->
            <?php echo $this->element('admin/header'); ?>
            
            
            <div id="wrapper"> <!-- Start Wrapper -->
                <div id="menu" class="hidden-phone"> <!-- Start menu -->
                    <span class="profile clearfix">
                        <a class="img" href="#">
                           <?php echo $this->Html->image($this->Session->read('Auth.User.image')); ?>
                        </a>
                        <span>
                            <strong><?php echo $this->Session->read('Auth.User.name'); ?></strong>
                            <a href="#">edit account</a>
                        </span>
                    </span>
                    
                    <?php echo $this->element('admin/dnanavigation'); ?>
                    
                </div><!-- End Menu -->
                
                <div id="content"> <!-- Start Content -->
                    <?php echo $this->element('admin/breadcrumb'); ?>
                    
                    <div class="separator bottom"></div>
                    
                    <div class="innerLR">
                        <?php echo $this->Layout->sessionFlash(); ?>
                        <?php echo $this->fetch('content'); ?>
                    </div>    
                </div><!-- End Content -->
                
            </div> <!-- End Wrapper -->
            
        </div> <!-- End Content -->

        <!-- Scripts -->
        <?php 
        
        
        echo $this->Html->script(array(
            
            'http://code.jquery.com/ui/1.10.3/jquery-ui.js',
            '/dna/js/components/jquery.ba-resize',
            '/dna/js/components/uniform/jquery.uniform.min',
            '/dna/js/bootstarp/bootstrap.min',
            
            '/dna/js/script',
        ));
        
        echo $this->Blocks->get('scriptBottom');
        ?>
    </body>
</html>
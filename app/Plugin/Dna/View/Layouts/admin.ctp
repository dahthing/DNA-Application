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

    echo $this->fetch('script');
    echo $this->fetch('css');
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
<body>
    
    <!-- Main Container Fluid -->
    <div class="container-fluid fluid menu-left">
        
        <!-- Sidebar menu & content wrapper -->
        <div id="wrapper">
            <!-- Sidebar Menu -->
            <div id="menu" class="hidden-phone hidden-print">
                <!-- Brand -->
                <a href="#" class="appbrand"><?php echo Configure::read('Site.title')?> <?php echo __d('dna', 'Admin'); ?></a>
                
                <!-- Scrollable menu wrapper with Maximum height -->
                <div class="slim-scroll" data-scroll-height="800px">
                    <!-- Sidebar Profile -->
                    <span class="profile center">
                        <a href="#"><img data-src="holder.js/36x36/white" alt="Avatar" /></a>
                    </span>
                    <!-- // Sidebar Profile END -->
                    <ul>
                        <li class="active"><a href="index.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-default&amp;sidebar-sticky=false&amp;top_style=full&amp;sidebar_style=full" class="glyphicons dashboard"><i></i> Dashboard</a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Content -->
            <div id="content">
                <!-- Top navbar -->
                <div class="navbar main">
                    
                    <!-- Menu Toggle Button -->
                    <button type="button" class="btn btn-navbar pull-left">
                        <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                    </button>
                    <!-- // Menu Toggle Button END -->
                    
                    <!-- Full Top Style -->
                    <ul class="topnav pull-left">
                        <li class="active"><a href="#" class="glyphicons dashboard"><i></i> <?php echo __d('dna', 'Visit Site'); ?></a></li>
                    </ul>
                    
                    <!-- Top Menu Right -->
                    <ul class="topnav pull-right hidden-phone hidden-tablet hidden-desktop-1">
                        
                        <!-- Language menu -->
                        <li class="hidden-tablet hidden-phone hidden-desktop-1 dropdown dd-1 dd-flags" id="lang_nav">
                            <a href="#" data-toggle="dropdown"><img src="eng.png" alt="en" /></a>
                            <ul class="dropdown-menu pull-left">
                                <li class="active"><a href="?module=admin&amp;page=index&amp;url_rewrite=&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-default&amp;sidebar-sticky=false&amp;sidebar_style=full&amp;top_style=full&amp;lang=en" title="English"><img src="../../../../../common/theme/images/lang/en.png" alt="English"> English</a></li>
                                <li><a href="?module=admin&amp;page=index&amp;url_rewrite=&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-default&amp;sidebar-sticky=false&amp;sidebar_style=full&amp;top_style=full&amp;lang=ro" title="Romanian"><img src="../../../../../common/theme/images/lang/ro.png" alt="Romanian"> Romanian</a></li>
                                <li><a href="?module=admin&amp;page=index&amp;url_rewrite=&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-default&amp;sidebar-sticky=false&amp;sidebar_style=full&amp;top_style=full&amp;lang=it" title="Italian"><img src="../../../../../common/theme/images/lang/it.png" alt="Italian"> Italian</a></li>
                                <li><a href="?module=admin&amp;page=index&amp;url_rewrite=&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-default&amp;sidebar-sticky=false&amp;sidebar_style=full&amp;top_style=full&amp;lang=fr" title="French"><img src="../../../../../common/theme/images/lang/fr.png" alt="French"> French</a></li>
                                <li><a href="?module=admin&amp;page=index&amp;url_rewrite=&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-default&amp;sidebar-sticky=false&amp;sidebar_style=full&amp;top_style=full&amp;lang=pl" title="Polish"><img src="../../../../../common/theme/images/lang/pl.png" alt="Polish"> Polish</a></li>
                            </ul>
                        </li>
                        <!-- // Language menu END -->
                        
                        <!-- Profile / Logout menu -->
                        <li class="account dropdown dd-1">
                            <a data-toggle="dropdown" href="my_account_advanced.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-default&amp;sidebar-sticky=false&amp;top_style=full&amp;sidebar_style=full" class="glyphicons logout lock"><span class="hidden-tablet hidden-phone hidden-desktop-1">mosaicpro</span><i></i></a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="my_account_advanced.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-default&amp;sidebar-sticky=false&amp;top_style=full&amp;sidebar_style=full" class="glyphicons cogwheel">Settings<i></i></a></li>
                                <li><a href="my_account_advanced.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-default&amp;sidebar-sticky=false&amp;top_style=full&amp;sidebar_style=full" class="glyphicons camera">My Photos<i></i></a></li>
                                <li class="profile">
                                    <span>
                                        <span class="heading">Profile <a href="my_account_advanced.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-default&amp;sidebar-sticky=false&amp;top_style=full&amp;sidebar_style=full" class="pull-right">edit</a></span>
                                        <span class="img"></span>
                                        <span class="details">
                                            <a href="my_account_advanced.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-default&amp;sidebar-sticky=false&amp;top_style=full&amp;sidebar_style=full">Mosaic Pro</a>
                                            contact@mosaicpro.biz
                                        </span>
                                        <span class="clearfix"></span>
                                    </span>
                                </li>
                                <li>
                                    <span>
                                        <a class="btn btn-default btn-mini pull-right" href="login.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-default&amp;sidebar-sticky=false&amp;top_style=full&amp;sidebar_style=full">Sign Out</a>
                                    </span>
                                </li>
                            </ul>
                        </li>
                        <!-- // Profile / Logout menu END -->

                    </ul>
                    
                    <!-- // Top Menu Right END -->
                    <div class="clearfix"></div>
                </div>
                <!-- Top navbar END -->
                
            </div>
        </div>
    </div>
    
    <?php
    echo $this->Html->script(array(
        //'/dna/js/plugins/js-beautify/beautify',
        //'/dna/js/plugins/js-beautify/beautify-html',
        '/dna/js/plugins/modernizr',
        '/dna/js/bootstrap/bootstrap.min',
        
        '/dna/js/plugins/jquery-ui/jquery-ui-1.9.2.custom',
        '/dna/js/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min',
        
        '/dna/js/plugins/pixelmatrix-uniform/jquery.uniform.min',
        '/dna/js/plugins/jquery-slimScroll/jquery.slimscroll.min',
        '/dna/js/plugins/holder/holder',
        '/dna/js/common',
        '/dna/js/admin',
    ));
    ?>
</body>
</html>
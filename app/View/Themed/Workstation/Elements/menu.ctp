<div class="navbar-collapse collapse pull-right clearfix topmenu" id="menu-<?php echo $menu['Menu']['id']; ?>"> 
<?php
    echo $this->WHtml->nestedLinks($menu['threaded'], $options);
?>
</div><!--/.nav-collapse -->
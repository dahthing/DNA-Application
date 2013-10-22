<!--[if lt IE 7]><p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->

 <!-- Fixed navbar -->
 <div class="navbar main">
     <div class="container">

         <div class="navbar-header">
             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
             </button>
             <?php echo $this->Html->Tag('h1',$this->Html->link(
                     $this->Html->image('/img/logotipo.png',array(
                         'alt'=>Configure::read('Site.title'),
                         'width'=>'259',
                         'height'=>'22',
                         'class'=>'logotipo'
                     )),
                     '/',
                     array('class'=>'navbar-brand','escape'=>false)
                 )); ?>
         </div>

         <?php echo $this->WHtml->menu('main',array('dropdown'=>true,'menuClass' => 'nav navbar-nav',))?>
     </div>
 </div>
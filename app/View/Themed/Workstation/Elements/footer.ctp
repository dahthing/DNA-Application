<div class="footer">
    <div class="container">
        
        <div class="footer_info clearfix">
            
            <?php echo $this->Html->Tag('div',
                    $this->Html->link(
                $this->Html->image('/img/footer_logotipo.png',array(
                    'alt'=>Configure::read('Site.title'),
                    'width'=>'217',
                    'height'=>'21',
                )),
                '/',
                array('escape'=>false)
            ),array('class'=>'pull-left footer_logotipo')); ?>
            
            <?php echo $this->element('social');?>
        </div>
        
        <div class="footer_blocks row">
            <div class="col-md-3 address">
                <p>Travessa de Cartes, n.º 179 a 183 </p>
                <p>4300-105 Porto</p>
                <p>t. 22 502 54 62/3</p>
                <p>correio@workstation.pt</p>
            </div>
            <div class="col-md-3"><?php echo $this->WHtml->menu('footer',array('dropdown'=>false))?></div>
            <div class="col-md-3"><?php echo $this->WHtml->menu('footer',array('dropdown'=>false))?></div>
            <div class="col-md-3"><?php echo $this->WHtml->menu('footer',array('dropdown'=>false))?></div>
        </div>
        
    </div>
</div>
<div class="body_end">
    <div class="container">
        <div class="pull-right"><?=$this->Html->image('/img/logo_nomeatus.png',array(
                    'alt'=>Configure::read('Site.title')
                ))?></div>
    </div>
</div>
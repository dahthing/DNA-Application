<?php
$this->extend('/Common/admin_index');

$this->Html
        ->addCrumb('Admin', '/admin', array('class' => 'home'))
        ->addCrumb(__d('dna', 'Menus'), array('plugin' => 'menus', 'controller' => 'menus', 'action' => 'index'))
        ->addCrumb(__d('dna', $menu['Menu']['title']), array(
            'plugin' => 'menus', 'controller' => 'links', 'action' => 'index',
            '?' => array('menu_id' => $menu['Menu']['id'])));
?>

<?php $this->start('actions'); ?>
<?php
echo $this->Dna->adminAction(
        __d('dna', $this->Html->Tag('i','').'New %s', Inflector::singularize($this->name)), 
        array('action' => 'add', $menu['Menu']['id']), 
        array('button' => 'btn-primary btn-icon glyphicons circle_plus')
);
?>
<?php $this->end('actions'); ?>

<?php
if (isset($this->params['named'])) {
    foreach ($this->params['named'] as $nn => $nv) {
        $this->Paginator->options['url'][] = $nn . ':' . $nv;
    }
}

echo $this->Form->create('Link', array(
    'url' => array(
        'action' => 'process',
        $menu['Menu']['id'],
    ),
));
?>
<table class="table table-striped">
    <?php
    $tableHeaders = $this->Html->tableHeaders(array(
        '',
        __d('dna', 'Id'),
        __d('dna', 'Title'),
        __d('dna', 'Status'),
        __d('dna', 'Actions'),
    ));
    ?>
    <thead>
        <?php echo $tableHeaders; ?>
    </thead>
    <?php
    $rows = array();
    foreach ($linksTree as $linkId => $linkTitle):
        $actions = array();
        $actions[] = $this->Dna->adminRowAction('', array(
            'controller' => 'links', 'action' => 'moveup', $linkId
                ), array(
            'icon' => 'chevron-up',
            'tooltip' => __d('dna', 'Move up'),
        ));
        $actions[] = $this->Dna->adminRowAction('', array(
            'controller' => 'links', 'action' => 'movedown', $linkId,
                ), array(
            'icon' => 'chevron-down',
            'tooltip' => __d('dna', 'Move down'),
        ));
        $actions[] = $this->Dna->adminRowActions($linkId);
        $actions[] = $this->Dna->adminRowAction('', array(
            'controller' => 'links', 'action' => 'edit', $linkId,
                ), array(
            'icon' => 'pencil', 'tooltip' => __d('dna', 'Edit this item'),
        ));
        $actions[] = $this->Dna->adminRowAction('', '#Link' . $linkId . 'Id', array(
            'icon' => 'trash',
            'tooltip' => __d('dna', 'Delete this item'),
            'rowAction' => 'delete',
                ), __d('dna', 'Are you sure?')
        );
        $actions = $this->Html->div('item-actions', implode(' ', $actions));
        $rows[] = array(
            $this->Form->checkbox('Link.' . $linkId . '.id'),
            $linkId,
            $linkTitle,
            $this->element('admin/toggle', array(
                'id' => $linkId,
                'status' => $linksStatus[$linkId],
            )),
            $actions,
        );
    endforeach;

    echo $this->Html->tableCells($rows);
    ?>

</table>
<div class="row-fluid">
    <div id="bulk-action" class="control-group">
        <?php
        echo $this->Form->input('Link.action', array(
            'div' => 'input inline',
            'label' => false,
            'options' => array(
                'publish' => __d('dna', 'Publish'),
                'unpublish' => __d('dna', 'Unpublish'),
                'delete' => __d('dna', 'Delete'),
            ),
            'empty' => true,
        ));
        ?>
        <div class="controls">
            <?php echo $this->Form->end(__d('dna', 'Submit')); ?>
        </div>
    </div>
</div>
<?php
$this->extend('/Common/admin_index');

$this->Html
        ->addCrumb('Admin', '/admin')
        ->addCrumb(__d('dna', 'Menus'), '/' . $this->request->url);
?>
<div class="row-fluid">
    <div class="span12">
        <table class="table table-striped">
            <?php
            $tableHeaders = $this->Html->tableHeaders(array(
                $this->Paginator->sort('id', __d('dna', 'Id')),
                $this->Paginator->sort('title', __d('dna', 'Title')),
                $this->Paginator->sort('alias', __d('dna', 'Alias')),
                $this->Paginator->sort('link_count', __d('dna', 'Link Count')),
                __d('dna', 'Actions'),
            ));
            ?>
            <thead>
                <?php echo $tableHeaders; ?>
            </thead>

            <?php
            $rows = array();
            foreach ($menus as $menu):
                $actions = array();
                $actions[] = $this->Dna->adminRowAction(
                        '', array('controller' => 'links', 'action' => 'index', '?' => array('menu_id' => $menu['Menu']['id'])), array('class' => 'btn-action glyphicons zoom_in', 'tooltip' => __d('dna', 'View links'))
                );
                $actions[] = $this->Dna->adminRowActions($menu['Menu']['id']);
                $actions[] = $this->Dna->adminRowAction(
                        '', array('controller' => 'menus', 'action' => 'edit', $menu['Menu']['id']), array('class' => 'btn-action glyphicons pencil btn-success ', 'tooltip' => __d('dna', 'Edit this item'))
                );
                $actions[] = $this->Dna->adminRowAction(
                        '', array('controller' => 'menus', 'action' => 'delete', $menu['Menu']['id']), array('class' => 'btn-action glyphicons bin btn-danger', 'tooltip' => __d('dna', 'Remove this item')), __d('dna', 'Are you sure?')
                );
                $actions = $this->Html->div('item-actions', implode(' ', $actions));
                $rows[] = array(
                    $menu['Menu']['id'],
                    $this->Html->link($menu['Menu']['title'], array('controller' => 'links', '?' => array('menu_id' => $menu['Menu']['id']))),
                    $menu['Menu']['alias'],
                    $menu['Menu']['link_count'],
                    $this->Html->div('item-actions', $actions),
                );
            endforeach;

            echo $this->Html->tableCells($rows);
            ?>
        </table>
    </div>
</div>

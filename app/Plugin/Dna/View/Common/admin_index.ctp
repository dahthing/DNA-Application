<?php
if (empty($modelClass)) {
    $modelClass = Inflector::singularize($this->name);
}
if (!isset($className)) {
    $className = strtolower($this->name);
}

$showActions = isset($showActions) ? $showActions : true;
?>

<h3 class="pull-left">
    <?php if ($titleBlock = $this->fetch('title')): ?>
        <?php echo $titleBlock; ?>
    <?php else: ?>
        <?php
        echo!empty($title_for_layout) ? $title_for_layout : $this->name;
        ?>
    <?php endif; ?>
</h3>

<?php if ($showActions): ?>

<div class="pull-right actions">
    <ul class="nav-buttons list-unstyled" style="list-style: none; margin: 0">
        <?php if ($actionsBlock = $this->fetch('actions')): ?>
            <?php echo $actionsBlock; ?>
        <?php else: ?>
            <?php
            echo $this->Dna->adminAction(
                    __d('dna', 'New %s', __d('dna', Inflector::singularize($this->name))), array('action' => 'add'), array('button' => 'primary')
            );
            ?>
        <?php endif; ?>
    </ul>
</div>
<?php endif; ?>

<div class="row-fluid">
    <div class="span12">
        <?php if ($contentBlock = $this->fetch('content')): ?>
            <?php echo $this->element('admin/search'); ?>
            <?php echo $contentBlock; ?>
        <?php else: ?>
            <?php echo $this->element('admin/search'); ?>
            <table class="table table-striped">
                <?php
                $tableHeaders = array();
                foreach ($displayFields as $field => $arr) {
                    if ($arr['sort']) {
                        $tableHeaders[] = $this->Paginator->sort($field, __d('dna', $arr['label']));
                    } else {
                        $tableHeaders[] = __d('dna', $arr['label']);
                    }
                }
                $tableHeaders[] = __d('dna', 'Actions');
                $tableHeaders = $this->Html->tableHeaders($tableHeaders);

                $rows = array();
                if (!empty(${strtolower($this->name)})) {
                    foreach (${strtolower($this->name)} as $item):
                        $actions = array();

                        if (isset($this->request->query['chooser'])):
                            $title = isset($item[$modelClass]['title']) ? $item[$modelClass]['title'] : null;
                            $actions[] = $this->Dna->adminRowAction(__d('dna', 'Choose'), '#', array(
                                'class' => 'item-choose',
                                'data-chooser_type' => $modelClass,
                                'data-chooser_id' => $item[$modelClass]['id'],
                            ));
                        else:
                            $actions[] = $this->Dna->adminRowAction('', array('action' => 'edit', $item[$modelClass]['id']), array('icon' => 'pencil', 'tooltip' => __d('dna', 'Edit this item'))
                            );
                            $actions[] = $this->Dna->adminRowActions($item[$modelClass]['id']);
                            $actions[] = $this->Dna->adminRowAction('', array(
                                'action' => 'delete',
                                $item[$modelClass]['id'],
                                    ), array(
                                'icon' => 'trash',
                                'tooltip' => __d('dna', 'Remove this item')
                                    ), __d('dna', 'Are you sure?'));
                        endif;
                        $actions = $this->Html->div('item-actions', implode(' ', $actions));
                        $row = array();
                        foreach ($displayFields as $key => $val) {
                            extract($val);
                            if (!is_int($key)) {
                                $val = $key;
                            }
                            if (strpos($val, '.') === false) {
                                $val = $modelClass . '.' . $val;
                            }
                            list($model, $field) = pluginSplit($val);
                            $row[] = $this->Layout->displayField($item, $model, $field, compact('type', 'url', 'options'));
                        }
                        $row[] = $actions;
                        $rows[] = $row;
                    endforeach;
                }
                ?>
                <?php echo $this->Html->tableCells($rows); ?>
                <thead>
                    <?php echo $tableHeaders; ?>
                </thead>
            </table>
        <?php endif; ?>
    </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <?php if ($pagingBlock = $this->fetch('paging')): ?>
            <?php echo $pagingBlock; ?>
        <?php else: ?>
            <?php if (isset($this->Paginator) && isset($this->request['paging'])): ?>
                <div class="pagination">
                    <p>
                        <?php
                        echo $this->Paginator->counter(array(
                            'format' => __d('dna', 'Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                        ));
                        ?>
                    </p>
                    <ul>
                        <?php echo $this->Paginator->first('< ' . __d('dna', 'first')); ?>
                        <?php echo $this->Paginator->prev('< ' . __d('dna', 'prev')); ?>
                        <?php echo $this->Paginator->numbers(); ?>
                        <?php echo $this->Paginator->next(__d('dna', 'next') . ' >'); ?>
                        <?php echo $this->Paginator->last(__d('dna', 'last') . ' >'); ?>
                    </ul>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

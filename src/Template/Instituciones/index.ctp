<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Institucione[]|\Cake\Collection\CollectionInterface $instituciones
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Institucione'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="instituciones index large-9 medium-8 columns content">
    <h3><?= __('Instituciones') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id', __('Id')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('nombre', __('Nombre')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('sitio', __('Sitio')) ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($instituciones as $institucione): ?>
            <tr>
                <td><?= $this->Number->format($institucione->id) ?></td>
                <td><?= h($institucione->nombre) ?></td>
                <td><?= h($institucione->sitio) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $institucione->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $institucione->id], ['confirm' => __('Are you sure you want to delete # {0}?', $institucione->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>

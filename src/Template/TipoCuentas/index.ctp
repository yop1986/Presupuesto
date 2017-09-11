<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\TipoCuenta[]|\Cake\Collection\CollectionInterface $tipoCuentas
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Tipo Cuenta'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cuentas'), ['controller' => 'Cuentas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cuenta'), ['controller' => 'Cuentas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tipoCuentas index large-9 medium-8 columns content">
    <h3><?= __('Tipo Cuentas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id', __('Id')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('nombre', __('Nombre')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('activo', __('Activo/Pasivo')) ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tipoCuentas as $tipoCuenta): ?>
            <tr>
                <td><?= $this->Number->format($tipoCuenta->id) ?></td>
                <td><?= h($tipoCuenta->nombre) ?></td>
                <td><?= h($tipoCuenta->activo) ? __('Activo') : __('Pasivo') ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tipoCuenta->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tipoCuenta->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tipoCuenta->id)]) ?>
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

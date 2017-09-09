<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tipoCuenta->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tipoCuenta->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Tipo Cuentas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Cuentas'), ['controller' => 'Cuentas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cuenta'), ['controller' => 'Cuentas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tipoCuentas form large-9 medium-8 columns content">
    <?= $this->Form->create($tipoCuenta) ?>
    <fieldset>
        <legend><?= __('Edit Tipo Cuenta') ?></legend>
        <?php
            echo $this->Form->control('nombre');
            echo $this->Form->control('activo');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

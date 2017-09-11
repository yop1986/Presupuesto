<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Monedas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Cuentas'), ['controller' => 'Cuentas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cuenta'), ['controller' => 'Cuentas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="monedas form large-9 medium-8 columns content">
    <?= $this->Form->create($moneda) ?>
    <fieldset>
        <legend><?= __('Add Moneda') ?></legend>
        <?php
            echo $this->Form->control('codigo', ['label' => __('Código')]);
            echo $this->Form->control('descripcion', ['label' => __('Descripción')]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

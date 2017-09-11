<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Cuentas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Tipo Cuentas'), ['controller' => 'TipoCuentas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tipo Cuenta'), ['controller' => 'TipoCuentas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Instituciones'), ['controller' => 'Instituciones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Institucion'), ['controller' => 'Instituciones', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cuentas form large-9 medium-8 columns content">
    <?= $this->Form->create($cuenta) ?>
    <fieldset>
        <legend><?= __('Add Cuenta') ?></legend>
        <?php
            echo $this->Form->control('nombre', ['label' => __('Nombre')]);
            echo $this->Form->control('moneda_id', ['label' => __('Moneda')]);
            echo $this->Form->control('saldo', ['label' => __('Saldo')]);
            echo $this->Form->control('estado', ['label' => __('Activa')]);
            echo $this->Form->control('tipo_cuenta_id', ['label' => __('Tipo de Cuenta'), 'options' => $tipoCuentas]);
            echo $this->Form->control('institucion_id', ['label' => __('Instiutción'), 'options' => $instituciones]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

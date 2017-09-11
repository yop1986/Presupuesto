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
                ['action' => 'delete', $cuenta->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $cuenta->id)]
            )
        ?></li>
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
        <legend><?= __('Edit Cuenta') ?></legend>
        <?php
            echo $this->Form->control('nombre');
            echo $this->Form->control('estado');
            echo $this->Form->control('tipo_cuenta_id', ['options' => $tipoCuentas]);
            echo $this->Form->control('institucion_id', ['options' => $instituciones]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

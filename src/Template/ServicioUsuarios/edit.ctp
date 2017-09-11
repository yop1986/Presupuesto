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
                ['action' => 'delete', $servicioUsuario->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $servicioUsuario->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Servicio Usuarios'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Servicios'), ['controller' => 'Servicios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Servicio'), ['controller' => 'Servicios', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="servicioUsuarios form large-9 medium-8 columns content">
    <?= $this->Form->create($servicioUsuario) ?>
    <fieldset>
        <legend><?= __('Edit Servicio Usuario') ?></legend>
        <?php
            echo $this->Form->control('descripcion');
            echo $this->Form->control('servicio_id', ['options' => $servicios]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

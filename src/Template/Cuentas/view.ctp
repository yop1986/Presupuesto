<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Cuenta $cuenta
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cuenta'), ['action' => 'edit', $cuenta->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cuenta'), ['action' => 'delete', $cuenta->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cuenta->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cuentas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cuenta'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tipo Cuentas'), ['controller' => 'TipoCuentas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tipo Cuenta'), ['controller' => 'TipoCuentas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Instituciones'), ['controller' => 'Instituciones', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Institucion'), ['controller' => 'Instituciones', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cuentas view large-9 medium-8 columns content">
    <h3><?= h($cuenta->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($cuenta->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo Cuenta') ?></th>
            <td><?= $cuenta->has('tipo_cuenta') ? $this->Html->link($cuenta->tipo_cuenta->id, ['controller' => 'TipoCuentas', 'action' => 'view', $cuenta->tipo_cuenta->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Institucion') ?></th>
            <td><?= $cuenta->has('institucion') ? $this->Html->link($cuenta->institucion->id, ['controller' => 'Instituciones', 'action' => 'view', $cuenta->institucion->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Usuario') ?></th>
            <td><?= $cuenta->has('usuario') ? $this->Html->link($cuenta->usuario->nombre, ['controller' => 'Usuarios', 'action' => 'view', $cuenta->usuario->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($cuenta->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Saldo') ?></th>
            <td><?= $this->Number->format($cuenta->saldo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= $cuenta->estado ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

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
                ['action' => 'delete', $institucione->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $institucione->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Instituciones'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="instituciones form large-9 medium-8 columns content">
    <?= $this->Form->create($institucione) ?>
    <fieldset>
        <legend><?= __('Edit Institucione') ?></legend>
        <?php
            echo $this->Form->control('nombre');
            echo $this->Form->control('sitio');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

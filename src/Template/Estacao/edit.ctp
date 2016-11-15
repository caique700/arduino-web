<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $estacao->estacao_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $estacao->estacao_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Estacao'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="estacao form large-9 medium-8 columns content">
    <?= $this->Form->create($estacao) ?>
    <fieldset>
        <legend><?= __('Edit Estacao') ?></legend>
        <?php
            echo $this->Form->input('nome');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

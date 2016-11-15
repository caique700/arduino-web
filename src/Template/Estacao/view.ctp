<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Estacao'), ['action' => 'edit', $estacao->estacao_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Estacao'), ['action' => 'delete', $estacao->estacao_id], ['confirm' => __('Are you sure you want to delete # {0}?', $estacao->estacao_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Estacao'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Estacao'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="estacao view large-9 medium-8 columns content">
    <h3><?= h($estacao->estacao_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nome') ?></th>
            <td><?= h($estacao->nome) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estacao Id') ?></th>
            <td><?= $this->Number->format($estacao->estacao_id) ?></td>
        </tr>
    </table>
</div>

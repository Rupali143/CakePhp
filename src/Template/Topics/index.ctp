 <div class="row">
 <h1>Blog topics</h1>
<p><?= $this->Html->link('Add Topic', ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Created</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($topics as $topic): ?>
    <tr>
        <td><?= $topic->id ?></td>
        <td>
            <?= $this->Html->link($topic->title, ['action' => 'view', $topic->id]) ?>
        </td>
        <td>
            <?= $topic->created->format(DATE_RFC850) ?>
        </td>
        <td>
            <?= $this->Form->postLink(
                'Delete',
                ['action' => 'delete', $topic->id],
                ['confirm' => 'Are you sure?'])
            ?>
            <?= $this->Html->link('Edit', ['action' => 'edit', $topic->id]) ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
</div>
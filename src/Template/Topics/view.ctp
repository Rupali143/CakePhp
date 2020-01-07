<div class="container">
<?= $this->Session->flash('auth');?>
<h1><?= h($topic->title) ?></h1>
<p><?= h($topic->content) ?></p>
 
<p>Tags :<?= h($topic->tags) ?></p>
By <h3><?= h($topic->author) ?></h3>
<p><small>Created: <?php echo $topic->created->format(DATE_RFC850) ?></small></p>

</div>
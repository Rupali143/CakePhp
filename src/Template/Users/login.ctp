
<div class="users form large-4 medium-4 medium-offset-4">
<div class="container">
<h2>Login</h2>

<?= $this->Form->create(); ?>
    <fieldset>
        <legend><?= __('Please enter your username and password') ?></legend>
        <?= $this->Form->input('username'); ?>
        <?= $this->Form->input('password',array('type' => 'password')); ?>
    </fieldset>
<?= $this->Form->button('Login',array('class'=>'button')); ?>
<?= $this->Form->end(); ?>
</div>
</div>
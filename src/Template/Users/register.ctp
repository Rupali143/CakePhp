
<div class="users form large-4 medium-4 medium-offset-4">
<div class="container">
<h2>Register</h2>
<?= $this->Form->create($user,array('enctype'=>'multipart/form-data')); ?>
    <fieldset>
        <legend><?= __('Please enter your username and password') ?></legend>
        <?= $this->Form->input('fullname'); ?>
        <?= $this->Form->input('email'); ?>
        <?= $this->Form->input('username'); ?>
        <?= $this->Form->input('password',array('type' => 'password')); ?>
        <?= $this->Form->input('photo',['type' =>'file'])?>
    </fieldset>
<?= $this->Form->button('Register',array('class'=>'button btn-sm')); ?>
<?= $this->Form->end(); ?>
</div>
</div>

<!--  SIGN UP STEPS  -->
<!--  SIGN UP - 1 (REGISTER)  -->
<?php if(empty($s)): ?>
<div  id="register" class="container padded">
<div id="register">
        <div class="paginate active">Register</div>
        <div class="paginate">Personal Information</div>
        <div class="paginate">Complete Registration</div>
        <h1>User Registration</h1>
        <p>Welcome to user registration! You can sign up yourself and start improving your business. User registration is FREE and once you register yourself you can select apropiate business package for your company and start advertising.<br />
        <span style="color:#900">All field are required!</span></p>
    <?php
        echo $this->Form->create();
        echo $this->Form->input('name');
        echo $this->Form->input('surname');
        echo $this->Form->input('email');
        echo $this->Form->input('password');
        echo $this->Form->input('password_confirm', array('label'=>'Password Confirmation','type'=>'password'));
        echo $this->Form->input('terms', array('label'=>false, 'type'=>'checkbox'));
        ?> I accept <a href="#" class="link">Terms Of Use</a> <?
        echo $this->Form->end('Continue Registration');
    ?>
</div>
</div>

<?php elseif($s == 'personal-info'): ?>
<div  id="register" class="container padded">
<div id="register">
        <div class="paginate">Register</div>
        <div class="paginate active">Personal Information</div>
        <div class="paginate">Complete Registration</div>
        <h1>User Registration</h1>
        <p>Welcome to user registration! You can sign up yourself and start improving your business. User registration is FREE and once you register yourself you can select apropiate business package for your company and start advertising.<br />
        <span style="color:#900">All field are required!</span></p>
    <?php
        echo $this->Form->create();
        echo $this->Form->input('phone');
        echo $this->Form->input('address');
        echo $this->Form->input('city');
        echo $this->Form->input('ptt', array('label'=>'Postal Code'));
        echo $this->Form->input('state');
        echo $this->Form->input('country');
        echo $this->Form->end('Complete Registration');
    ?>
</div>
</div>

<?php elseif($s == 'complete'): ?>
<div  id="register" class="container padded">
<div id="register">
        <div class="paginate">Register</div>
        <div class="paginate">Personal Information</div>
        <div class="paginate active">Complete Registration</div>
        <h1>User Registration</h1>
        <p>Welcome to user registration! You can sign up yourself and start improving your business. User registration is FREE and once you register yourself you can select apropiate business package for your company and start advertising.<br />
        <span style="color:#900">All field are required!</span></p>
</div>
</div>
<? else: ?>
<div  id="register" class="container padded">
<div id="register">
    Unknown page!
</div>
</div>
<? endif; ?>
So as I said on first step it's all OK, it saves the user i
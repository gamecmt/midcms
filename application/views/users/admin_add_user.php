<h2>新增用户</h2>

<?php echo validation_errors('<p class="bg-danger">'); ?>

<?php $attributes = array('id'=>'register_form', 'class'=>'form_horizontal'); ?>

<?php echo form_open('user_admin/add_user', $attributes); ?>

<div class="form-group">
<?php echo form_label('用户账号'); ?>
<?php 
	$data = array(
		'class'=>'form-control',
		'name'=>'username',
		'placeholder'=>'输入账号'
	);
?>
<?php echo form_input($data); ?>
</div>

<div class="form-group">
<?php echo form_label('用户密码'); ?>
<?php
	$data = array(
		'class'=>'form-control',
		'name'=>'password',
		'placeholder'=>'输入密码'
	);
?>
<?php echo form_password($data); ?>
</div>

<div class="form-group">
<?php echo form_label('重复密码'); ?>
<?php
	$data = array(
		'class'=>'form-control',
		'name'=>'confirm_password',
		'placeholder'=>'重复密码'
	);
?>
<?php echo form_password($data); ?>
</div>

<div class="form-group">
<?php echo form_label('电子邮箱'); ?>
<?php
	$data = array(
		'class'=>'form-control',
		'name'=>'email',
		'placeholder'=>'输入电子邮箱'
	);
?>
<?php echo form_input($data); ?>
</div>

<div class="form-group">
<?php
	$data = array(
		'class'=>'btn btn-primary',
		'name'=>'submit',
		'value'=>'添加新用户'
	);
?>
<?php echo form_submit($data); ?>
</div>

<?php echo form_close(); ?>
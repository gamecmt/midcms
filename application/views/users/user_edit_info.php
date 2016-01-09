<h2>更改用户信息</h2>

<p class="bg-success">
	<?php if ($this->session->flashdata('user_updated')): ?>
	<?php echo $this->session->flashdata('user_updated'); ?>
	<?php endif; ?>
</p>

<?php echo validation_errors('<p class="bg-danger">'); ?>

<?php $attributes = array('id'=>'edit_user_view', 'class'=>'form_horizontal'); ?>

<?php echo form_open('users/edit_info/' . $this->session->userdata('id'), $attributes); ?>

<div class="form-group">
<?php echo form_label('用户账号'); ?>
<?php 
	$data = array(
		'class'=>'form-control',
		'name'=>'username',
		'value'=>$user_data->username
	);
?>
<?php echo form_input($data); ?>
</div>

<div class="form-group">
<?php echo form_label('电子邮箱'); ?>
<?php
	$data = array(
		'class'=>'form-control',
		'name'=>'email',
		'value'=>$user_data->email
	);
?>
<?php echo form_input($data); ?>
</div>

<div class="form-group">
<?php
	$data = array(
		'class'=>'btn btn-primary',
		'name'=>'submit',
		'value'=>'更改'
	);
?>
<?php echo form_submit($data); ?>
</div>

<?php echo form_close(); ?>
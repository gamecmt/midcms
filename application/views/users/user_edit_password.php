<h2>更改用户密码</h2>

<p class="bg-success">
	<?php if ($this->session->flashdata('user_password_updated')): ?>
	<?php echo $this->session->flashdata('user_password_updated'); ?>
	<?php endif; ?>
</p>

<p class="bg-danger">
	<?php if ($this->session->flashdata('user_pass_err')): ?>
	<?php echo $this->session->flashdata('user_pass_err'); ?>
	<?php endif; ?>
</p>

<?php echo validation_errors('<p class="bg-danger">'); ?>

<?php $attributes = array('id'=>'edit_user_password', 'class'=>'form_horizontal'); ?>

<?php echo form_open('users/edit_password/' . $this->session->userdata('id'), $attributes); ?>

<div class="form-group">
<?php echo form_label('原密码'); ?>
<?php
	$data = array(
		'class'=>'form-control',
		'name'=>'old_password',
	);
?>
<?php echo form_password($data); ?>
</div>

<div class="form-group">
<?php echo form_label('新密码'); ?>
<?php
	$data = array(
		'class'=>'form-control',
		'name'=>'password',
	);
?>
<?php echo form_password($data); ?>
</div>

<div class="form-group">
<?php echo form_label('输入新密码'); ?>
<?php
	$data = array(
		'class'=>'form-control',
		'name'=>'confirm_password',
	);
?>
<?php echo form_password($data); ?>
</div>

<div class="form-group">
<?php
	$data = array(
		'class'=>'btn btn-primary',
		'name'=>'submit',
		'value'=>'更改密码'
	);
?>
<?php echo form_submit($data); ?>
</div>

<?php echo form_close(); ?>
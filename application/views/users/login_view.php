<?php if ($this->session->userdata('logged_in')): ?>

<?php echo form_open('users/logout'); ?>

<h2>退出</h2>

<p>
<?php if ($this->session->userdata('username')): ?>
<p><?php echo "欢迎光临， " . $this->session->userdata('username') . "。<br>"; ?></p>
<p><a href="<?php echo base_url(); ?>users/edit_info/<?php echo $this->session->userdata('id'); ?>">修改账号信息</a></p>
<p><a href="<?php echo base_url(); ?>users/edit_password/<?php echo $this->session->userdata('id'); ?>">修改用户密码</a></p>
<?php endif; ?>
</p>

<?php
	$data = array(
		'name' => 'submit',
		'class' => 'btn btn-primary',
		'value' => '退出登录'
	);
	echo form_submit($data);
	echo form_close(); 
?>

<?php else: ?>

<h2>登录</h2>

<?php 
	if ($this->session->flashdata('errors')){
		echo $this->session->flashdata('errors');		
	}

	$attributes = array('id'=>'login_form', 'class'=>'form_horizontal');
	echo form_open('users/login', $attributes); 
?>

<div class="form-group">
<?php 
	echo form_label("账户");

	$data = array(
		'class'=>'form-control',
		'name'=>'username',
		'placeholder'=>"输入账户"
	);

	echo form_input($data); 
?>
</div>

<div class="form-group">
<?php 
	echo form_label('密码');

	$data = array(
		'class'=>'form-control',
		'name'=>'password',
		'placeholder'=>'输入密码'
	);

	echo form_password($data); ?>
</div>

<div class="form-group">
<?php
	$data = array(
		'class'=>'btn btn-primary',
		'name'=>'submit',
		'value'=>'登录'
	);
?>
<?php echo form_submit($data); ?>
</div>

<?php echo form_close(); ?>

<?php endif; ?>
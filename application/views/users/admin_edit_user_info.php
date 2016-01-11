<h2>编辑<?php echo $user_data->username; ?>用户信息</h2>

<?php echo validation_errors('<p class="bg-danger">'); ?>

<?php $attributes = array('id' => 'admin_edit_user_view', 'class' => 'form_horizontal'); ?>

<?php echo form_open('user_admin/edit_user_info/' . $user_data->id, $attributes); ?>

<div class="form-group">
    <?php echo form_label('用户账号'); ?>
    <?php
    $data = array(
        'class' => 'form-control',
        'name' => 'username',
        'value' => $user_data->username
    );
    ?>
    <?php echo form_input($data); ?>
</div>

<div class="form-group">
    <?php echo form_label('电子邮箱'); ?>
    <?php
    $data = array(
        'class' => 'form-control',
        'name' => 'email',
        'value' => $user_data->email
    );
    ?>
    <?php echo form_input($data); ?>
</div>

<div class="form-group">
    <?php
    $data = array(
        'class' => 'btn btn-primary',
        'name' => 'submit',
        'value' => '更改'
    );
    ?>
    <?php echo form_submit($data); ?>
</div>

<?php echo form_close(); ?>
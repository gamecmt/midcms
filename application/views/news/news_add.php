<h2>添加新闻</h2>

<?php echo validation_errors('<p class="bg-danger">'); ?>

<?php $attributes = array('id' => 'news_form', 'class' => 'form_horizontal'); ?>

<?php echo form_open('news/add', $attributes); ?>

<div class="form-group">
    <?php echo form_label('标题'); ?>
    <?php
    $data = array(
        'class' => 'form-control',
        'name' => 'title',
        'placeholder' => '输入标题'
    );
    ?>
    <?php echo form_input($data); ?>
</div>

<div class="form-group">
    <?php echo form_label('内容'); ?>
    <?php
    $data = array(
        'class' => 'form-control',
        'name' => 'content'
    );
    ?>
    <?php echo form_textarea($data); ?>
</div>

<div class="form-group">
    <?php echo form_label('作者'); ?>
    <?php
    $data = array(
        'class' => 'form-control',
        'name' => 'author'
    );
    ?>
    <?php echo form_input($data); ?>
</div>

<div class="form-group">
    <?php
    $data = array(
        'class' => 'btn btn-primary',
        'name' => 'submit',
        'value' => '添加新闻'
    );
    ?>
    <?php echo form_submit($data); ?>
</div>

<?php echo form_close(); ?>
<script type="text/javascript" src="<?php echo base_url();?>assets/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/ueditor/ueditor.all.js"></script>
<script type="text/javascript">
    var editor = new baidu.editor.ui.Editor();
    editor.render("content");
</script>

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

<label>内容</label>
<textarea  name="content" id="content" ></textarea>

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



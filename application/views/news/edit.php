<script type="text/javascript" src="<?php echo base_url(); ?>assets/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ueditor/ueditor.all.js"></script>


<h2>编辑新闻</h2>

<?php echo validation_errors('<p class="bg-danger">'); ?>

<?php $attributes = array('id' => 'news_form', 'class' => 'form_horizontal'); ?>

<?php echo form_open('news/edit_news', $attributes); ?>

<div class="form-group">
    <?php echo form_label('标题'); ?>
    <?php
    $data = array(
        'class' => 'form-control',
        'name' => 'title',
        'value' => $news_data->title
    );
    ?>
    <?php echo form_input($data); ?>
</div>

<label>内容</label>
<textarea name="content" id="content"></textarea>
<script type="text/javascript">
    var ueditor = new baidu.editor.ui.Editor();
    ueditor.render("content");
    ueditor.ready(function () {
        //设置编辑器的内容
        ueditor.setContent('<?php echo $news_data->content; ?>');
    });
</script>

<div class="form-group">
    <?php echo form_label('作者'); ?>
    <?php
    $data = array(
        'class' => 'form-control',
        'name' => 'author',
        'value' => $news_data->author
    );
    ?>
    <?php echo form_input($data); ?>
</div>

<div class="form-group">
    <?php
    $data = array(
        'class' => 'btn btn-primary',
        'name' => 'submit',
        'value' => '编辑'
    );
    ?>
    <?php echo form_submit($data); ?>
</div>

<?php echo form_close(); ?>



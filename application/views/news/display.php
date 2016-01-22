<div class="col-xs-9">
    <h1><?php echo $news_data->title; ?></h1>
    <p>发表日期<?php echo $news_data->date; ?></p>
    <h3>内容</h3>
    <p><?php echo $news_data->content; ?></p>
</div>

<div class="col-xs-3 pull-right">
    <ul class="list-group">
        <h3>快速操作</h3>
        <li class="list-group-item"><a href="<?php echo base_url(); ?>news/edit_news/<?php echo $news_data->id; ?>">编辑</a></li>
        <li class="list-group-item"><a href="<?php echo base_url(); ?>news/delete_news/<?php echo $news_data->id; ?>">删除</a></li>
    </ul>
</div>
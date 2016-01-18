<div class="col-xs-9">
    <h1><?php echo $news_data->title; ?></h1>
    <p>发表日期<?php echo $news_data->date; ?></p>
    <h3>内容</h3>
    <p><?php echo $news_data->content; ?></p>
</div>

<div class="col-xs-3 pull-right">
    <ul class="list-group">
        <h4>快速操作</h4>
        <li class="list-group-item"><a href="<?php echo base_url(); ?>news/edit/<?php echo $news_data->id; ?>">编辑</a></li>
        <li class="list-group-item"><a href="<?php echo base_url(); ?>news/delete/<?php echo $news_data->id; ?>">删除</a></li>
    </ul>
</div>
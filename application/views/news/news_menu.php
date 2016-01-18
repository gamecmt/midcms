<h1>新闻列表</h1>

<p><a href="<?php echo base_url(); ?>news/add">新增新闻</a></p>
<p class="bg-success">
    <?php if ($this->session->flashdata('admin_user_edited')): ?>
        <?php echo $this->session->flashdata('admin_user_edited'); ?>
    <?php endif; ?>
</p>

<table class="table table-hover">
    <thead>
    <tr>
        <th align="center">标题</th>
        <th align="center">日期</th>
        <th align="center">作者</th>
        <th align="center">发布者</th>
        <th align="center" colspan="2">管理</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($news as $news_item): ?>
        <tr>
            <td><a href="<?php echo base_url(); ?>news/display/<?php echo $news_item->id; ?>"><?php echo $news_item->title; ?></a></td>
            <td><?php echo $news_item->date; ?></td>
            <td><?php echo $news_item->author; ?></td>
            <td><?php echo $news_item->username; ?></td>
            <td><a href="<?php echo base_url(); ?>news/edit_news/<?php echo $news_item->id; ?>">编辑</a></td>
            <td><a href="<?php echo base_url(); ?>news/delete_news/<?php echo $news_item->id; ?>">删除</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
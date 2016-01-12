<h1>用户列表</h1>

<p><a href="<?php echo base_url(); ?>user_admin/add_user">新增用户</a></p>
<p class="bg-success">
    <?php if ($this->session->flashdata('admin_user_edited')): ?>
        <?php echo $this->session->flashdata('admin_user_edited'); ?>
    <?php endif; ?>
    <?php if ($this->session->flashdata('user_deleted')): ?>
        <?php echo $this->session->flashdata('user_deleted'); ?>
    <?php endif; ?>
    <?php if ($this->session->flashdata('user_init_pass')): ?>
        <?php echo $this->session->flashdata('user_init_pass'); ?>
    <?php endif; ?>
    <?php if ($this->session->flashdata('grant_admin')): ?>
        <?php echo $this->session->flashdata('grant_admin'); ?>
    <?php endif; ?>
    <?php if ($this->session->flashdata('revoke_admin')): ?>
        <?php echo $this->session->flashdata('revoke_admin'); ?>
    <?php endif; ?>
    <?php if ($this->session->flashdata('add_user')): ?>
        <?php echo $this->session->flashdata('add_user'); ?>
    <?php endif; ?>
</p>

<table class="table table-hover">
    <thead>
    <tr>
        <th align="center">用户账号</th>
        <th align="center">电子邮箱</th>
        <th align="center" colspan="4">管理</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user->username; ?></td>
            <td><?php echo $user->email; ?></td>
            <td><a href="<?php echo base_url(); ?>user_admin/edit_user_info/<?php echo $user->id; ?>">编辑</a></td>
            <td><a href="<?php echo base_url(); ?>user_admin/delete_user/<?php echo $user->id; ?>">删除</a></td>
            <td><a href="<?php echo base_url(); ?>user_admin/init_pass/<?php echo $user->id; ?>">初始密码</a></td>

            <?php if ($user->is_admin == 0): ?>
                <td><a href="<?php echo base_url(); ?>user_admin/grant_admin/<?php echo $user->id; ?>">授予管理权限</a></td>
            <?php else: ?>
                <td><a href="<?php echo base_url(); ?>user_admin/revoke_admin/<?php echo $user->id; ?>">取消管理权限</a></td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<h1>用户列表</h1>

<table class="table table-hover">
	<thead>
		<tr>
			<th align="center">用户账号</th>
			<th align="center">电子邮箱</th>
			<th align="center" colspan="4">管    理</th>
		</tr>
	</thead>
	<tbody>

		<?php foreach($users as $user): ?>
		<tr>
			<td><?php echo $user->username; ?></td>
			<td><?php echo $user->email; ?></td>
			<td><a href="<?php echo base_url(); ?>users/eidt_user_info/<?php echo $user->id; ?>">编辑</a></td>
			<td><a href="<?php echo base_url(); ?>users/delete_user/<?php echo $user->id; ?>">删除</a></td>
			<td><a href="<?php echo base_url(); ?>users/delete_user/<?php echo $user->id; ?>">初始密码</a></td>

			<?php if ($user->is_admin == 0): ?>
			<td><a href="<?php echo base_url(); ?>users/grant_admin/<?php echo $user->id; ?>">授予管理权限</a></td>
			<?php else:?>
			<td><a href="<?php echo base_url(); ?>users/revoke_admin/<?php echo $user->id; ?>">取消管理权限</a></td>
			<?php endif; ?>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php if ($this->session->userdata('logged_in')): ?>
    <?php echo form_open('users/logout'); ?>
    <h2>退出</h2>
    <p>
    <?php if ($this->session->userdata('username')): ?>
        <p>
            <?php echo "欢迎光临， " . $this->session->userdata('username'); ?>
            <?php
            if ($this->session->userdata('is_admin')) {
                echo "管理员。<br>";
                echo '<p><a href="' . base_url() . 'user_admin/edit_users">管理所有用户</a></p>';
                echo '<p><a href="' . base_url() . 'news/get_all_news">管理所有新闻</a></p>';
            } else {
                echo "会员。<br>";
            }
            ?>
        </p>
        <p>
            <a href="<?php echo base_url(); ?>news/get_user_news/<?php echo $this->session->userdata('id'); ?>">管理发表新闻</a>
        </p>
        <p>
            <a href="<?php echo base_url(); ?>user_edit/edit_info/<?php echo $this->session->userdata('id'); ?>">修改个人信息</a>
        </p>
        <p>
            <a href="<?php echo base_url(); ?>user_edit/edit_password/<?php echo $this->session->userdata('id'); ?>">修改个人密码</a>
        </p>
    <?php endif; ?>
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
    if ($this->session->flashdata('errors')) {
        echo $this->session->flashdata('errors');
    }
    $attributes = array('id' => 'login_form', 'class' => 'form_horizontal');
    echo form_open('users/login', $attributes);
    ?>

    <div class="form-group">
        <?php
        echo form_label("账户");
        $data = array(
            'class' => 'form-control',
            'name' => 'username',
            'placeholder' => "输入账户"
        );
        echo form_input($data);
        ?>
    </div>

    <div class="form-group">
        <?php
        echo form_label('密码');
        $data = array(
            'class' => 'form-control',
            'name' => 'password',
            'placeholder' => '输入密码'
        );
        echo form_password($data); ?>
    </div>

    <div class="form-group">
        <?php
        $data = array(
            'class' => 'btn btn-primary',
            'name' => 'submit',
            'value' => '登录'
        );
        ?>
        <?php echo form_submit($data); ?>
    </div>

    <?php echo form_close(); ?>

<?php endif; ?>
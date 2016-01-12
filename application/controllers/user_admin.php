<?php

class User_admin extends CI_Controller
{
    public function __construct()
    {
        //自动检测是否登录或者是否拥有管理员权限
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('no_access', '抱歉，您还没有登录。');
            redirect('home');
        }
        if (!$this->session->userdata('is_admin')) {
            $this->session->set_flashdata('no_admin', '抱歉，您不是管理员。');
            redirect('home');
        }
    }

    public function edit_users()
    {
        //显示所有用户信息，并将数据传输给view中的user_display
        $data['users'] = $this->user_model->get_users();
        $data['main_view'] = "users/users_display";
        $this->load->view('layouts/main', $data);
    }

    public function edit_user_info($user_id)
    {
        //编辑选中的用户信息
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]');
        if ($this->form_validation->run() == false) {
            $data['user_data'] = $this->user_model->get_user_info($user_id);
            $data['main_view'] = 'users/admin_edit_user_info';
            $this->load->view('layouts/main', $data);
        } else {
            $data = array(
                'id' => $user_id,
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email')
            );
            $username = $this->user_model->get_username($user_id);
            if ($this->user_model->user_edit($user_id, $data)) {
                $this->session->set_flashdata('admin_user_edited', $username . '用户信息已完成修改。');
                redirect('user_admin/edit_users/');
            }
        }
    }

    public function delete_user($user_id)
    {
        //删除用户
        $username = $this->user_model->get_username($user_id);
        $this->session->set_flashdata('user_deleted', $username . '用户已被删除。');
        $this->user_model->delete_user($user_id);
        redirect('user_admin/edit_users/');
    }

    public function init_pass($user_id)
    {
        //初始化密码
        $options = ['cost' => 12];
        $password = '888';
        $username = $this->user_model->get_username($user_id);
        $encripted_pass = password_hash($password, PASSWORD_BCRYPT, $options);
        $data = array(
            'id' => $user_id,
            'password' => $encripted_pass
        );

        if ($this->user_model->user_edit($user_id, $data)) {
            $this->session->set_flashdata('user_init_pass', $username . '用户密码已经初始化， 初始化密码为“888”。');
            redirect('user_admin/edit_users/');
        }

    }

    public function grant_admin($user_id)
    {
        //授予管理员权限
        $this->user_model->grant_admin_user($user_id);
        $username = $this->user_model->get_username($user_id);
        $this->session->set_flashdata('grant_admin', '已授予' . $username . '管理员权限。');
        redirect('user_admin/edit_users/');
    }

    public function revoke_admin($user_id)
    {
        //移除管理员权限
        $this->user_model->revoke_admin_user($user_id);
        $username = $this->user_model->get_username($user_id);
        $this->session->set_flashdata('revoke_admin', '已取消' . $username . '管理员权限。');
        redirect('user_admin/edit_users/');
    }

    public function add_user()
    {
        //检查各个参数是否合法,是则添加新用户,否则换回注册界面
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|min_length[3]|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]');
        if ($this->form_validation->run() == false) {
            $data['main_view'] = "users/admin_add_user";
            $this->load->view('layouts/main', $data);
        } else {
            $username = $this->input->post('username');
            if ($this->user_model->create_user()) {
                $this->session->set_flashdata('add_user', '新增' . $username . '用户成功！');
                redirect('user_admin/edit_users/');
            }
        }
    }
}

?>
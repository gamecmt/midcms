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
                'id' => $this->session->userdata('id'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email')
            );
            $user_data = $this->user_model->get_user_info($user_id);
            if ($this->user_model->user_edit($user_id, $data)) {
                $this->session->set_flashdata('admin_user_edited', $user_data->username . '用户信息已完成修改。');
                redirect('user_admin/edit_users/');
            }
        }
    }

    public function delete_user($user_id)
    {
        //删除用户
    }

    public function init_pass($user_id)
    {
        //初始化密码
    }

    public function grant_admin($user_id)
    {
        //授予管理员权限
    }

    public function revoke_admin($user_id)
    {
        //移除管理员权限
    }
}

?>
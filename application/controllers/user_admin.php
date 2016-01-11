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
}

?>
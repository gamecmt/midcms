<?php

class User_edit extends CI_Controller
{

    public function __construct()
    {
        //检测是否登录，没有则直接定位到home
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('no_access', '抱歉，您还没有登录。');
            redirect('home');
        }
    }

    public function edit_info($user_id)
    {
        //编辑用户信息
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]|valid_email');
        if ($this->form_validation->run() == false) {
            $data['user_data'] = $this->user_model->get_user_info($user_id);
            $data['main_view'] = 'users/user_edit_info';
            $this->load->view('layouts/main', $data);
        } else {
            $data = array(
                'id' => $this->session->userdata('id'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email')
            );
            if ($this->user_model->user_edit($user_id, $data)) {
                $this->session->set_flashdata('user_updated', '用户信息已修改。');
                redirect('user_edit/edit_info/' . $this->session->userdata('id'));
            }
        }
    }

    public function edit_password($user_id)
    {
        //编辑用户的密码,sql_password为数据库里加密的密码,$encripted_old_pass为旧密码,$encripted_pass为加密后的新密码
        $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|min_length[3]|matches[password]');
        if ($this->form_validation->run() == false) {
            $data['user_data'] = $this->user_model->get_user_info($user_id);
            $data['main_view'] = 'users/user_edit_password';
            $this->load->view('layouts/main', $data);
        } else {
            $sql_password = $this->user_model->get_user_password($user_id);
            $encripted_old_pass = $this->input->post('old_password');
            $options = ['cost' => 12];
            $encripted_pass = password_hash($this->input->post('password'), PASSWORD_BCRYPT, $options);
            if (password_verify($encripted_old_pass, $sql_password)) {
                $data = array(
                    'id' => $this->session->userdata('id'),
                    'password' => $encripted_pass
                );
                if ($this->user_model->user_edit($user_id, $data)) {
                    $this->session->set_flashdata('user_password_updated', '用户密码已修改。');
                    redirect('user_edit/edit_password/' . $this->session->userdata('id'));
                }
            } else {
                $this->session->set_flashdata('user_pass_err', '原密码错误。');
                redirect('user_edit/edit_password/' . $this->session->userdata('id'));
            }
        }
    }
}

?>
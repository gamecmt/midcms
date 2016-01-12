<?php

class Users extends CI_Controller
{

    public function register()
    {
        //检查各个参数是否合法,是则添加新用户,否则换回注册界面
        $this->form_validation->set_rules(
            'username', 'Username',
            'trim|required|min_length[3]|is_unique[users.username]',
            array(
                'required' => '您没有输入用户名。',
                'min_length[3]' => '用户名不能低于3个字符',
                'is_unique' => '该用户已经存在'
            )
        );
        $this->form_validation->set_rules(
            'password', 'Password',
            'trim|required|min_length[3]',
            array(
                'required' => '密码框没有输入。',
                'min_length[3]' => '密码不能低于3个字符'
            )
        );
        $this->form_validation->set_rules(
            'confirm_password', 'Confirm Password',
            'trim|required|min_length[3]|matches[password]',
            array(
                'required' => '重复密码框没有输入。',
                'min_length[3]' => '密码不能低于3个字符',
                'matches' => '两次密码输入不一致。'
            )
        );
        $this->form_validation->set_rules(
            'email', 'Email',
            'trim|required|min_length[3]|valid_email',
            array(
                'required' => '您没有输入电子邮箱',
                'min_length[3]' => '电子邮箱不能低于3个字符',
                'valid_email' => '电子邮箱格式不正确。'
            )
        );
        if ($this->form_validation->run() == false) {
            $data['main_view'] = "users/register_view";
            $this->load->view('layouts/main', $data);
        } else {
            if ($this->user_model->create_user()) {
                $this->session->set_flashdata('user_registered', '您已注册成功！');
                redirect('home/index');
            }
        }
    }

    public function login()
    {
        //判断是否登录,否则显示错误,是则将数据放入userdata中,同时将login_success放入flashdata中
        $this->form_validation->set_rules(
            'username', 'Username',
            'trim|required|min_length[3]',
            array(
                'required' => '您没有输入用户名。',
                'min_length[3]' => '用户名不能低于3个字符'
            )
        );
        $this->form_validation->set_rules(
            'password', 'Password',
            'trim|required|min_length[3]',
            array(
                'required' => '密码框没有输入。',
                'min_length[3]' => '密码不能低于3个字符'
            )
        );
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'errors' => validation_errors()
            );
            $this->session->set_flashdata($data);
            redirect('home/index');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user_id = $this->user_model->user_login($username, $password);
            $is_admin = $this->user_model->user_is_admin($username, $password);
            if ($user_id) {
                $user_data = array(
                    'id' => $user_id,
                    'username' => $username,
                    'logged_in' => true,
                    'is_admin' => $is_admin
                );
                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('login_success', '您已成功登录。');
                redirect('home/index');
            } else {
                $this->session->set_flashdata('login_failed', '用户账号或密码错误，登录失败！');
                redirect('home/index');
            }
        }

    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('home');
    }
}

?>
<?php

class Users extends CI_Controller {

	public function register() {

		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]');
		
		if ($this->form_validation->run() == false) {

			$data['main_view'] = "users/register_view";
			$this->load->view('layouts/main', $data);

		} else {

			if($this->user_model->create_user()){

				$this->session->set_flashdata('user_registered', '您已注册成功！');
				redirect('home/index');

			}

		}
		

	}

	public function login() {

		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
		
		if ($this->form_validation->run() == FALSE){

			$data = array(
				'errors'=>validation_errors()
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
					'id'=>$user_id,
					'username'=>$username,
					'logged_in'=>true,
					'is_admin'=>$is_admin
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

	public function logout(){

		$this->session->sess_destroy();
		redirect('home');

	}
	
}
?>
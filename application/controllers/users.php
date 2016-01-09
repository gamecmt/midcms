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
			redirect('home');

		}else{

			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$user_id = $this->user_model->user_login($username, $password);

			if ($user_id){

				$user_data = array(
					'id'=>$user_id,
					'username'=>$username,
					'logged_in'=>true
				);
				$this->session->set_userdata($user_data);
				$this->session->set_flashdata('login_success', '您已成功登录。');

				redirect('home/index');

			}else{

				$this->session->set_flashdata('login_failed', '用户账号或密码错误，登录失败！');
				redirect('home/index');

			}
		}

	}

	public function logout(){

		$this->session->sess_destroy();
		redirect('home');

	}

	public function edit_info($user_id) {

		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]');

		if($this->form_validation->run() == false) {

			$data['user_data'] = $this->user_model->get_user_info($user_id);
			$data['main_view'] = 'users/user_edit_info';
			$this->load->view('layouts/main', $data);

		} else {

			$options = ['cost'=>12];
			$encripted_pass = password_hash($this->input->post('password'), PASSWORD_BCRYPT, $options);
			$data = array(
				'id'=>$this->session->userdata('id'),
				'username'=>$this->input->post('username'),
				'email'=>$this->input->post('email')
			);

			if ($this->user_model->user_edit($user_id, $data)){

				$this->session->set_flashdata('user_updated', '用户信息已修改。');
				redirect('users/edit_info/' . $this->session->userdata('id'));

			}

		}
		
	}

	public function edit_password($user_id) {

		$this->form_validation->set_rules('old_password', 'Old password', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|min_length[3]');

		if($this->form_validation->run() == false) {

			$data['user_data'] = $this->user_model->get_user_info($user_id);
			$data['main_view'] = 'users/user_edit_password';
			$this->load->view('layouts/main', $data);

		} else {

			$sql_password = $this->user_model->get_user_password($user_id);
			$options = ['cost'=>12];
			$encripted_old_pass = password_hash($this->input->post('old_password'), PASSWORD_BCRYPT, $options);
			$encripted_pass = password_hash($this->input->post('password'), PASSWORD_BCRYPT, $options);
			$old_password = $this->input->post('old_password');
			$password = $this->input->post('password');
			$data = array(
				'sql_password'=>$sql_password,
				'encripted_old_pass'=>$encripted_old_pass,
				'encripted_pass'=>$encripted_pass,
				'password'=>$password,
				'old_password'=>$old_password
			);
			$data['main_view'] = 'users/err';
			$this->load->view('layouts/main', $data);
			// if ($sql_password == $encripted_old_pass) {
			// 	$data = array(
			// 		'id'=>$this->session->userdata('id'),
			// 		'password'=>$encripted_pass
			// 	);

			// 	if ($this->user_model->user_edit($user_id, $data)){

			// 		$this->session->set_flashdata('user_password_updated', '用户密码已修改。');
			// 		redirect('users/edit_password/' . $this->session->userdata('id'));

			// 	}
			// } else {

			// 	$this->session->set_flashdata('user_pass_err', '原密码错误。');
			// 	redirect('users/edit_password/' . $this->session->userdata('id'));

			// }

		}
		
	}
}

?>
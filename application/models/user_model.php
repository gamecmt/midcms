<?php

class User_model extends CI_Model
{

    public function create_user()
    {
        $options = ['cost' => 12];
        $encripted_pass = password_hash($this->input->post('password'), PASSWORD_BCRYPT, $options);
        $data = array(
            'username' => $this->input->post('username'),
            'password' => $encripted_pass,
            'email' => $this->input->post('email')
        );
        $insert_data = $this->db->insert('users', $data);
        return $insert_data;
    }

    public function user_login($username, $password)
    {
        $this->db->where('username', $username);
        $result = $this->db->get('users');
        $db_password = $result->row(2)->password;
        if (password_verify($password, $db_password)) {
            return $result->row(0)->id;
        } else {
            return false;
        }
    }

    public function user_is_admin($username, $password)
    {
        $this->db->where('username', $username);
        $result = $this->db->get('users');
        $db_password = $result->row(2)->password;

        if (password_verify($password, $db_password)) {
            return $result->row(5)->is_admin;
        } else {
            return false;
        }
    }

    public function user_edit($user_id, $data)
    {
        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
        return true;
    }

    public function get_user_info($user_id)
    {
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function get_username($user_id)
    {
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        return $query->row(1)->username;
    }

    public function get_users()
    {
        $query = $this->db->get('users');
        return $query->result();
    }

    public function get_user_password($user_id)
    {
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        return $query->row(2)->password;
    }

    public function delete_user($user_id)
    {
        $this->db->where('id', $user_id);
        $this->db->delete('users');
    }
}

?>
<?php

class News_Model extends CI_Model
{
    public function add_news()
    {
        //添加新闻
        $data = array(
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'author' => $this->input->post('author'),
            'user_id' => $this->session->userdata('id')
        );
        $query = $this->db->insert('news', $data);
        return $query;
    }

    public function get_all_news()
    {
        //显示任何用户的所有新闻
        //出现问题, user_id和news_id混淆了
        $this->db->join('users', 'news.user_id = users.id');
        $query = $this->db->get('news');
        return $query->result();
    }

    public function get_user_news($user_id)
    {
        //显示该用户的新闻
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('news');
        return $query->result();
    }

    public function delete_news($news_id){
        $this->db->where('id', $news_id);
        $this->db->delete('news');
    }

    public function get_title($news_id){
        $this->db->where('id',$news_id);
        $query = $this->db->get('news');
        return $query->row(1)->title;
    }
}
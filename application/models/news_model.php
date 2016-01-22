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
        $this->db->select('news.id, title, date, author, content, click, display, user_id, users.username, is_admin');
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

    public function delete_news($news_id)
    {
        //删除新闻
        $this->db->where('id', $news_id);
        $this->db->delete('news');
    }

    public function get_title($news_id)
    {
        //得到新闻标题
        $this->db->where('id', $news_id);
        $query = $this->db->get('news');
        return $query->row(1)->title;
    }

    public function get_news($news_id)
    {
        //得到当前id的新闻
        $this->db->where('id', $news_id);
        $query = $this->db->get('news');
        return $query->row();
    }

    public function update_news($news_id, $data)
    {
        $this->db->where('id', $news_id);
        $this->db->update('news', $data);
        return true;
    }
}
<?php

class News extends CI_Controller
{
    public function __construct()
    {
        //自动检测是否登录或者是否拥有管理员权限
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('no_access', '抱歉，您还没有登录。');
            redirect('home');
        }
        //调用ueditor编辑器
        $this->load->helper('url');
    }

    public function index()
    {
        $data['main_view'] = 'home_view';
        $this->load->view('layouts/main', $data);
    }

    public function add()
    {
        //添加新闻
        $this->form_validation->set_rules(
            'title', 'Title',
            'trim|required|min_length[3]|is_unique[news.title]',
            array(
                'required' => '您没有输入新闻标题。',
                'min_length' => '新闻标题不能低于3个字符。',
                'is_unique' => '该新闻标题已经存在。'
            )
        );
        $this->form_validation->set_rules(
            'content', 'Content',
            'trim|required|min_length[30]',
            array(
                'required' => '您没有输入新闻内容。',
                'min_length' => '新闻内容不能低于30个字符。'
            )
        );
        $this->form_validation->set_rules(
            'author', 'Author',
            'trim|required|min_length[2]',
            array(
                'required' => '您没有输入新闻作者。',
                'min_length' => '新闻作者不能低于2个字符。'
            )
        );
        if ($this->form_validation->run() == false) {
            $data['main_view'] = "news/news_add";
            $this->load->view('layouts/main', $data);
        } else {
            if ($this->news_model->add_news()) {
                $this->session->set_flashdata('news_add', '新闻已添加成功！');
                redirect('home/index');
            }
        }
    }

    public function get_all_news()
    {
        //显示所有新闻信息，并将数据传输给view中的news_display
        $data['news'] = $this->news_model->get_all_news();
        $data['main_view'] = "news/news_menu";
        $this->load->view('layouts/main', $data);
    }

    public function get_user_news()
    {
        //显示该用户发布的所有新闻信息，并将数据传输给view中的news_display
        $user_id = $this->session->userdata('id');
        $data['news'] = $this->news_model->get_user_news($user_id);
        $data['main_view'] = "news/user_news_menu";
        $this->load->view('layouts/main', $data);
    }

    public function delete_news($news_id)
    {
        //删除新闻(用户权限)
        $this->news_model->delete_news($news_id);
        $title = $this->news_model->get_title($news_id);
        $this->session->set_flashdata('news_deleted', $title . '新闻已被删除。');
        redirect('news/get_user_news/');
    }

    public function admin_delete_news($news_id)
    {
        //删除新闻(管理员权限)
        $this->news_model->delete_news($news_id);
        $title = $this->news_model->get_title($news_id);
        $this->session->set_flashdata('news_deleted', $title . '新闻已被删除。');
        redirect('news/get_all_news/');
    }

    public function display($news_id)
    {
        //显示当前新闻
        $data['news_data'] = $this->news_model->get_news($news_id);
        $data['main_view'] = "news/display";
        $this->load->view('layouts/main', $data);
    }

    public function edit_news($news_id)
    {
        //编辑当前新闻
        //还有问题
        $this->form_validation->set_rules(
            'title', 'Title',
            'trim|required|min_length[3]|is_unique[news.title]',
            array(
                'required' => '您没有输入新闻标题。',
                'min_length' => '新闻标题不能低于3个字符。',
                'is_unique' => '该新闻标题已经存在。'
            )
        );
        $this->form_validation->set_rules(
            'content', 'Content',
            'trim|required|min_length[30]',
            array(
                'required' => '您没有输入新闻内容。',
                'min_length' => '新闻内容不能低于30个字符。'
            )
        );
        $this->form_validation->set_rules(
            'author', 'Author',
            'trim|required|min_length[2]',
            array(
                'required' => '您没有输入新闻作者。',
                'min_length' => '新闻作者不能低于2个字符。'
            )
        );
        if ($this->form_validation->run() == false) {
            $data['news_data'] = $this->news_model->get_news($news_id);
            $data['main_view'] = "news/edit";
            $this->load->view('layouts/main', $data);
        } else {
            $data = array(
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content'),
                'author' => $this->input->post('author')
            );
            if ($this->news_model->update_news($news_id, $data)) {
                $this->session->set_flashdata('update_news', '新闻已修改成功！');
                redirect('news/get_user_news/');
            }
        }
    }
}

?>
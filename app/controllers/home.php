<?php 

    class Home extends Controller
    {
        function index($page = '')
        {
            $data['page_title'] = 'Home';

            $this->view("home", $data);
        }

    }
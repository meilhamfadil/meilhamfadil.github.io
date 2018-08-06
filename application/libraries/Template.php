<?php

class Template{

    private $CI = null;

    public function load($config){
        $this->CI = & get_instance();
        $this->CI->load->view("template/default", $config);
    }

    public function login($config){
        $this->CI = & get_instance();
        $this->CI->load->view("template/login", $config);
    }

    public function NotFound(){
        $this->CI = & get_instance();
        $this->CI->load->view("template/my404");
    }

}
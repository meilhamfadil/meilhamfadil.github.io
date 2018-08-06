<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Navigation{

    private $CI = null;
    private $model = null;
    private $induk = '<li class="sidebar-item |selected|"><a class="sidebar-link waves-effect waves-dark sidebar-link |active|" href="{link}" aria-expanded="false"><i class="mdi mdi-{ikon}"></i><span class="hide-menu"> {nama} </span></a></li>';
    private $anakcontainer = '<li class="sidebar-item |selected|"><a class="sidebar-link has-arrow waves-effect waves-dark |active|" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-{ikon}"></i><span class="hide-menu"> {nama} </span></a><ul aria-expanded="false" class="collapse  first-level |in|">{child}</ul></li>';
    private $anak = '<li class="sidebar-item |active|"><a href="{link}" class="sidebar-link |active|"><i class="mdi mdi-{ikon}"></i><span class="hide-menu"> {nama} </span></a></li>';
    private $regex = "/\{([\w]*)\}/";
    private $pages = array();
    private $role = 1;

    public function __construct($role = 1){
        $this->CI = & get_instance();
        $this->role = $role;
        $this->CI->load->model("menuModel", "MM");
        $this->model = $this->CI->MM;
        $this->CI->load->model("myModel", "M");
        $this->pages = $this->CI->M->getOne("vmenurole", "link", uri_string());
    }

    public function pageDetail(){
        return $this->pages;
    }

    public function show_menu($toggle, $sub){
        $menu = $this->model->getParent();
        $show = "";
        foreach($menu as $m){
            $child = $this->model->getChild($m->kode_menu);
            $temp = ($child) ? $this->show_child($child, $sub) : $this->induk;
            preg_match_all($this->regex, $this->induk, $match);
            foreach($match[1] as $b){
                $replace = ($b == "nama") ? ucfirst($m->$b) : $m->$b;
                $temp = str_replace("{" . $b . "}", $replace, $temp);
            }
            $selecteddiv = ($toggle == $m->toggle) ? "selected" : "";
            $selecteda = ($toggle == $m->toggle) ? "active" : "";
            $temp = str_replace("|selected|", $selecteddiv, $temp);
            $temp = str_replace("|active|", $selecteda, $temp);
            $show .= $temp;
        }
        return $show;
    }

    private function show_child($child, $sub){
        $show = "";
        $selectedin = "";
        foreach($child as $m){
            $temp = $this->anak;
            preg_match_all($this->regex, $this->anak, $match);
            foreach($match[1] as $b){
                $replace = ($b == "nama") ? ucfirst($m->$b) : $m->$b;
                $temp = str_replace("{" . $b . "}", $replace, $temp);
            }
            if($selectedin != "in"){
                $selectedin = ($sub == $m->toggle) ? "in" : "";
            }
            $selecteda = ($sub == $m->toggle) ? "active" : "";
            $temp = str_replace("|active|", $selecteda, $temp);
            $show .= $temp;
        }
        $return = str_replace("|in|", $selectedin, $this->anakcontainer);
        return str_replace("{child}", $show, $return);
    }
    
}

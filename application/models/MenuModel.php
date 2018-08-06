<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MenuModel extends CI_Model{

    public function getParent(){
        return $this->db->from("vmenurole")->where(array("induk" => 0, "aktif" => 1))->get()->result();
    }

    public function getChild($induk){
        return $this->db->from("vmenurole")->where(array("induk" => $induk, "aktif" => 1))->get()->result();
    }

}

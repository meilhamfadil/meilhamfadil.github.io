<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MyModel extends CI_Model{

    public function simpan($table, $data){
        $this->db->insert($table, $data);
        if($this->db->affected_rows() > 0){
            return array("Success", "Proses Simpan Sukses", $this->db->last_query());
        } else {
            return array("Failed", "Proses Simpan Gagal", $this->db->_error_message());
        }
    }

    public function update($table, $data, $where){
        $this->db->where($where)->update($table, $data);
        if($this->db->affected_rows() > 0){
            return array("Success", "Proses Update Sukses", $this->db->last_query());
        } else {
            return array("Failed", "Proses Update Gagal", $this->db->_error_message());
        }
    }

    public function delete($table, $where, $permanent = true, $set = null){
        if($permanent){
            $this->db->where($where)->delete($table);
        } else {
            $this->update($table, $set, $where);
        }
        
        if($this->db->affected_rows() > 0){
            return array("Success", "Proses Delete Sukses", $this->db->last_query());
        } else {
            return array("Failed", "Proses Delete Gagal", $this->db->_error_message());
        }
    }

    public function getListWhere($table, $where){
        $query = $this->db->from($table)->where($where)->get();
        return $query->result();
    }

    public function getOne($table, $index, $value){
        $query = $this->db->from($table)->where(array($index => $value))->get();
        return $query->row();
    }

    public function getOneWhere($table, $where){
        $query = $this->db->from($table)->where($where)->get();
        return $query->row();
    }

    public function field($table){
        return $this->db->list_fields($table);
    }

    public function getWilayah($table, $where){
        $query = $this->db->select("id as value, nama as display")->from($table)->where($where)->get();
        return $query->result();
    }

    public function check($table, $where){
        $query = $this->db->from($table)->where($where)->get();
        return $query->num_rows();
    }

    public function getId($table, $where, $index){
        $query = $this->db->from($table)->where($where)->get();
        $result = $query->row();
        if($query->num_rows() > 0){
            return $result->$index;
        } else {
            return 0;
        }
    }

    public function login($email, $password){
        $query = $this->db->from(VPENGGUNA)->where(array("email" => $email))->limit(1)->get();
        if($query->num_rows() > 0){
            $user = $query->row();
            if($user->password == md5($password)){
                // $this->update(VPENGGUNA, array("status_login" => 1, "last_login" => date("Y-m-d"), array("kode_pengguna" => $user->kode_pengguna)));
                $result = array("Success", base_url("home"), $user);
            } else {
                $result = array("Failed", "Password Salah");
            }
        } else {
            $result = array("Failed", "User Tidak Ditemukan");
        }
        return $result;
    }

    public function getData($table, $field, $where = null, $group = null, $order = null){
        $query = $this->db->select($field)->from($table);
        ($where != null) ? $query->where($where) : null;
        ($group != null) ? $query->group_by($group) : null;
        ($order != null) ? $query->order_by($order) : null;
        $query = $query->get();
        return $query->result();
    }

    public function runQuery($query){
        return $this->db->query($query)->result();
    }

}

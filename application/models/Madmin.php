<?php

/**
 * Description of Madmin
 *
 * @author AgungKayuuta
 */
class Madmin extends CI_Model{
    
    function check_login($id_admin, $pass){
        $this->db->where('id_admin', $id_admin);
        $this->db->where('pass', $pass);
        return $this->db->get('pc_admin');
    }        
}


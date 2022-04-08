<?php
Class users extends CI_Model
{
 function login($username, $password)
 {
    $condition = "username =" . "'" . $username . "' AND " . "password =" . "'" . MD5($password) . "'";
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();
  

    if($query -> num_rows() == 1)
    {
      return $query->result();
    }
    else
    {
      return false;
    }
  }
}
?>
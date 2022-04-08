<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class User_model extends CI_Model 
{

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() 
	{		
		parent::__construct();
		$this->load->database();		
	}
	
	/**
	 * create_user function.
	 * 
	 * @access public
	 * @param mixed $username
	 * @param mixed $email
	 * @param mixed $password
	 * @return bool true on success, false on failure
	 */
	public function create_user($username, $password, $usertype ,$create_date, $modify_date) 
	{
		$data = array(
			'username'    => $username,
			'password'    => MD5($password),
			'usertype'    => $usertype,
			'create_date' => $create_date,
			'modify_date' => $modify_date
			);		
		return $this->db->insert('users', $data);
		
	}
	public function getusers()
	  {
	  $query = $this->db->get('users');
	        if($query->num_rows() > 0){ 
	            $result = $query->result_array();
	            return $result;
	        }else{
	            return false;
	        }  
	  }
	
		
	/**
	 * get_user_id_from_username function.
	 * 
	 * @access public
	 * @param mixed $username
	 * @return int the user id
	 */
	public function get_user_id_from_username($username) 
	{		
		$this->db->select('id');
		$this->db->from('users');
		$this->db->where('username', $username);
		return $this->db->get()->row('id');		
	}
	
	/**
	 * get_user function.
	 * 
	 * @access public
	 * @param mixed $user_id
	 * @return object the user object
	 */
	public function getuser($id) 
	{
		$this->db->where("id",$id);
        $query = $this->db->get('users');
        if($query->num_rows() > 0)
        {
            $result = $query->result_array();
            return $result;
        }else{
            return false;
        }  				
	}
	
	/**
	 * hash_password function.
	 * 
	 * @access private
	 * @param mixed $password
	 * @return string|bool could be a string on success, or bool false on failure
	 */
	private function hash_password($password) 
	{		
		return password_hash($password, PASSWORD_BCRYPT);		
	}
	
	/**
	 * verify_password_hash function.
	 * 
	 * @access private
	 * @param mixed $password
	 * @param mixed $hash
	 * @return bool
	 */
	private function verify_password_hash($password, $hash) 
	{
		
		return password_verify($password, $hash);
		
	}
  public function update($data, $id)
	  {
	    $this->db->where('id', $id);
	    $this->db->update('users', $data);
	    return $this->db->affected_rows();
	  }
  public function delete_user($id)
	  {
	    $this->db->where('id', $id);
	    $this->db->delete('users');
	  }
  public function search($id,$from_date,$to_date)
    {
    	if (!empty($id) && !empty($from_date) && !empty($to_date)) 
      {
        $this->db->where('id',$id);
        $this->db->where('create_date >=', $from_date);
        $this->db->where('create_date <=', $to_date);        
      }
      else
      { 
         if (!empty($from_date) && !empty($to_date)) 
         {
             $this->db->where('create_date >=', $from_date);
             $this->db->where('create_date <=', $to_date); 
         }
         else
         {
            if (!empty($id) && !empty($from_date))
            {
              $this->db->where('id',$id);
              $this->db->where('create_date >=', $from_date);
            }
            else
            {
                  if (!empty($id) && !empty($to_date)) 
                  {
                    $this->db->where('id',$id);
                  $this->db->where('create_date =', $to_date);
                  }
                  else
                  {
                      if (!empty($from_date)) {
                       $this->db->where('create_date >=', $from_date);
                      }
                      else
                      {
                        if (!empty($id)) 
                          {
                            $this->db->where('id',$id);
                          }
                          else
                          {
                            if (!empty($to_date)) 
                              {
                              $this->db->where('create_date =', $to_date);
                              }
                              else
                              {
                                  return false;
                              }
                          }

                      }
                    }    
                }
          }  
      }
      
 		$this->db->select('*');
        $this->db->from('users');
         $this->db->limit($this->_pageNumber, $this->_offset);        
        $query = $this->db->get();
		if($query->num_rows()>0)
		{
		  return $result=$query->result_array();
		}
		 else{
		      return false;		 
		    }
    }
    private $_limit;
    private $_pageNumber;
    private $_offset;
 
  public function setLimit($limit) 
  {
        $this->_limit = $limit;
    }
 
    public function setPageNumber($pageNumber) 
    {
        $this->_pageNumber = $pageNumber;
    }
 
    public function setOffset($offset) {
        $this->_offset = $offset;
    }  
    public function getAllusersCount()
     {
        $this->db->from('users');
        return $this->db->count_all_results();
    }
  // Fetch data according to per_page limit.
  public function userList() 
  {               
        $this->db->select(array('u.id', 'u.username', 'u.usertype','u.create_date', 'u.modify_date'));
        $this->db->from('users as u');          
        $this->db->limit($this->_pageNumber, $this->_offset);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result;
        }
        return false;
    }
	
}

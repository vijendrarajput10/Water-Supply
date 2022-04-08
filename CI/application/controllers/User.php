<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class User extends CI_Controller {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
    	$this->load->helper('url');
	    $this->load->database();
	    $this->load->library("pagination");
	    $this->load->library('session');
		$this->load->model('user_model');
		
	}	
	public function index() 
	{
		$config['total_rows'] = $this->user_model->getAllusersCount();
        $data['total_count'] = $config['total_rows'];
        $config['suffix'] = '';
 
        if ($config['total_rows'] > 0) {
            $page_number = $this->uri->segment(3);
            $config["base_url"] = base_url() . "User/index/";
            if (empty($page_number))
                $page_number = 1;
            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->user_model->setPageNumber($this->pagination->per_page);
            $this->user_model->setOffset($offset);
            $this->pagination->cur_page = $offset;
            $this->pagination->initialize($config);
            $data['page'] = $page_number;
            $data['items_per_page'] = $this->pagination->per_page;
            $data['pdf'] = base_url() . "print_pdf/userpdf";
            $data['page_links'] = $this->pagination->create_links();
            $data['users'] = $this->user_model->userList();
        }    
		$data['search'] = $this->user_model->getusers();
    	$this->load->view('user_view' , $data);
	}
	
	/**
	 * register function.
	 * 
	 * @access public
	 * @return void
	 */
	public function register() 
	{
		 if($_POST)
        { 
		      $data = array('username' => $this->input->post('username'), 
		          'password' => $this->input->post('password'),
		          'usertype' => $this->input->post('usertype'),
		              );
						
			// load form helper and validation library
			$this->load->library('form_validation');
			
			// set validation rules
			$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('cnfpassword', 'confirm Password', 'trim|required|min_length[6]|matches[password]');
			
			if ($this->form_validation->run() === false) 
			{
				
				// validation not ok, send validation errors to the view
				$data['user'] = $data ;
				$this->load->view('registration_form', $data);
				
			
			} else 
			   {
			
					// set variables from the form
					$username = $this->input->post('username');
					$password = $this->input->post('password');
					$usertype = $this->input->post('usertype');					
					$create_date = date("Y-m-d");
					$modify_date= date("Y-m-d");
					
					if ($this->user_model->create_user($username, $password, $usertype, $create_date, $modify_date )) 
					{						
						redirect(base_url().'user', 'refresh');									
					} else {
						
						// user creation failed, this should never happen
						$data->error = 'There was a problem creating your new account. Please try again.';
						
						// send error to the view
						$this->load->view('user_view', $data);
					
				        }
			
		        }
		}
		else
	    {
	      $this->load->view('registration_form');
	    }
	}
	public function getuser($id)
  {
    $data['user'] = $this->user_model->getuser($id);
    $this->load->view('edituser' , $data);
  }
  public function deleteuser($id)
     {
       $this->user_model->delete_user($id);    
       redirect(base_url().'user', 'refresh');
      }
      public function updateUser($id)
  		{   
  		if($_POST)
        { 
		      $data = array('username' => $this->input->post('username'), 
		          'password' => $this->input->post('password'),
		          'usertype' => $this->input->post('usertype'),
		          'modify_date' => date("Y-m-d"),
		              );
						
			// load form helper and validation library
			$this->load->library('form_validation');
			
			// set validation rules
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('cnfpassword', 'confirm Password', 'trim|required|min_length[6]|matches[password]');
			
			if ($this->form_validation->run() === false) 
			{		
				// validation not ok, send validation errors to the view
				$this->load->view('registration_form', $data);					
			} else 
			   {			
					// set variables from the form
					$username = $this->input->post('username');
					$password = $this->input->post('password');
					$usertype = $this->input->post('usertype');
					
					if($this->user_model->update($data, $id) > 0)
					{						
						redirect(base_url().'user', 'refresh');									
					} else 
					   {															
						$data['users'] = $this->user_model->getusers();
						$this->load->view('user_view', $data);					
				       }			
		        }	
		}  
	}
	public function search()
     {         
         $id = $this->input->post('user_id');
         $from_date = $this->input->post('from_date');
         $to_date = $this->input->post('to_date');
        
         if (isset($id) and !empty($id) || isset($from_date) && !empty($from_date)|| isset($to_date) && !empty($to_date)) 
      {
      	if (!empty($from_date) && !empty($to_date)) 
      	{
      		 $id = $user_id;
        	 $from_date = $from_date;
         	 $to_date = $to_date;
      	}
      	else
      	{
	        if (!empty($from_date) && !empty($to_date)) 
	         {
	            $id = 0; 
	         }
	         else
	         {
	            if (!empty($id) && !empty($from_date))
	            {
	              $to_date = 0; 
	            }
	            else
	            {
	                  if (!empty($id) && !empty($to_date)) 
	                  {
	                    $from_date= 0; 
	                  }
	                  else
	                  {
	                      if (!empty($from_date)) {
	                       $id= 0; 
	                       $to_date= 0; 
	                      }
	                      else
	                      {
	                        if (!empty($id)) 
	                          {
	                            $to_date = 0; 
	                            $from_date= 0; 
	                          }
	                          else
	                          {
	                            if (!empty($to_date)) 
	                              {
	                               $from_date= 0; 
	                               $id = 0; 
	                              }
	                              else
	                              {
	                                  return ;
	                              }
	                          }

	                      }
	                    }    
	                }
	          }
	     }     
      }
      else
      { 
            $id = $this->uri->segment(3);
            $from_date = $this->uri->segment(4);
            $to_date = $this->uri->segment(5);
      }
         

         if(isset($id) and !empty($id) || isset($from_date) && !empty($from_date)|| isset($to_date) && !empty($to_date))
         {
         	$config['total_rows'] =count( $this->user_model->search($id,$from_date,$to_date));
        $data['total_count'] = $config['total_rows'];
        $config['suffix'] = '';
 
        if ($config['total_rows'] > 0) {
            $page_number = $this->uri->segment(6);
            $config["base_url"] = base_url() . "User/search/$id/$from_date/$to_date"; 
            if (empty($page_number))
                $page_number = 1;
            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->user_model->setPageNumber($this->pagination->per_page);
            $this->user_model->setOffset($offset);
            $this->pagination->cur_page = $offset;
            $this->pagination->initialize($config);
            $data['page'] = $page_number;
            $data['items_per_page'] = $this->pagination->per_page;            
            $data['page_links'] = $this->pagination->create_links();
            $data['pdf'] = base_url() . "print_pdf/searchuserpdf/$id/$from_date/$to_date/Search_User";
            $data['users'] = $this->user_model->search($id,$from_date,$to_date);
        }    
		$data['search'] = $this->user_model->getusers();
		$data['fromdate'] = $from_date;
		$data['todate'] = $to_date;
    	$this->load->view('user_view' , $data);         
         }
         else{
            $data['search'] = $this->user_model->getusers();
           $this->load->view('user_view',$data);
         }
      } 		
}

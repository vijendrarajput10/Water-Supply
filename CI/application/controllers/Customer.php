<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends CI_controller
{
  
  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->database();
    $this->load->library('form_validation');
    $this->load->model('customer_model');
    $this->load->library("pagination");
  }
  public function index()
  {
        $config['total_rows'] = $this->customer_model->getAllCustomersCount();
        $data['total_count'] = $config['total_rows'];
        $config['suffix'] = '';
 
        if ($config['total_rows'] > 0) {
            $page_number = $this->uri->segment(3);
            $config["base_url"] = base_url() . "Customer/index/";
            if (empty($page_number))
                $page_number = 1;
            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->customer_model->setPageNumber($this->pagination->per_page);
            $this->customer_model->setOffset($offset);
            $this->pagination->cur_page = $offset;
            $this->pagination->initialize($config);
            $data['page'] = $page_number;
            $data['items_per_page'] = $this->pagination->per_page;
            $data['page_links'] = $this->pagination->create_links();
            $data['pdf'] = base_url() . "print_pdf/customerpdf";
            $data['customers'] = $this->customer_model->customerList();
        }

    $data['search'] = $this->customer_model->getcustomers();
    $this->load->view('customer_view' , $data);
  }
  public function getcustomer($id)
  {
    $data['customer'] = $this->customer_model->getcustomer($id);
    $this->load->view('editcustomer' , $data);
  }
  public function addcustomerdata()
  {
   if($_POST)
    {
      $data = array('c_name' => $this->input->post('name'), 
              'address' => $this->input->post('address'),
              'contact_no' => $this->input->post('contactno'),
              'create_date' => date("Y-m-d"),
              );
              
              $this->form_validation->set_rules('name', 'Customer Name', 'trim|required|alpha_numeric|min_length[4]|is_unique[customers.c_name]', array('is_unique' => 'This username already exists. Please choose another one.'));
             $this->form_validation->set_rules('contactno', 'Phone Number', 'required|numeric|min_length[10]|max_length[10]');
             if ($this->form_validation->run() === false) 
      {
        $data['customer'] = $data ;
        // validation not ok, send validation errors to the view        
        $this->load->view('addcustomer', $data);     
      } else 
         {

            if($this->customer_model->insertcustomer($data))
            {
               redirect(base_url().'customer', 'refresh');
            }
            else
            {
             redirect(base_url().'customer', 'refresh');
            }
          }  
    }
    else
    {
          $this->load->view('addcustomer');
    }
  }
  public function updatedetails($id)
  {   
    if ($_POST) 
        {
            $data = array('c_name' => $this->input->post('name'), 
              'address' => $this->input->post('address'),
              'contact_no' => $this->input->post('contactno'),
              'modify_date' => date("Y-m-d")
              );              
              
          $this->form_validation->set_rules('contactno', 'Phone Number', 'required|numeric|min_length[10]|max_length[10]');
         if ($this->form_validation->run() === false) 
      {
          $data['customer'] = $this->customer_model->getcustomer($id);
          $this->load->view('editcustomer' , $data);      
      } else 
         {
           if($this->customer_model->update_details($data, $id) > 0)
            {             
               redirect(base_url().'customer', 'refresh');
            }
             else
              {
                  redirect(base_url().'customer', 'refresh');
              }
          }   
        }
        else
        {
            redirect(base_url());
        }
  }
    public function deletedetails($id)
     {
       $this->customer_model->delete_details($id);   
       redirect(base_url().'customer', 'refresh');
      }
      public function search()
     {
         $id = $this->input->post('customer_id');
         $from_date = $this->input->post('from_date');
         $to_date = $this->input->post('to_date');
        
         if (isset($id) && !empty($id) || isset($from_date) && !empty($from_date)|| isset($to_date) && !empty($to_date)) 
      {
        if (!empty($id) && !empty($from_date) && !empty($to_date)) 
        {
          $id = $id;
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
          }// 
      }
      else
      { 
            $id = $this->uri->segment(3);
            $from_date = $this->uri->segment(4);
            $to_date = $this->uri->segment(5);
      }
         
         
         if(isset($id) and !empty($id) || isset($from_date) && !empty($from_date)|| isset($to_date) && !empty($to_date))
         {
           $config['total_rows'] = count($this->customer_model->search($id,$from_date,$to_date));
        $data['total_count'] = $config['total_rows'];
        $config['suffix'] = '';
 
        if ($config['total_rows'] > 0) 
            $page_number = $this->uri->segment(6);
            $config["base_url"] = base_url() . "Customer/search/$id/$from_date/$to_date";                   
            if (empty($page_number))
                $page_number = 1;

            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->customer_model->setPageNumber($this->pagination->per_page);
            $this->customer_model->setOffset($offset);
            $this->pagination->cur_page = $offset;
            $this->pagination->initialize($config);
            $data['page'] = $page_number;
            $data['items_per_page'] = $this->pagination->per_page;
            $data['page_links'] = $this->pagination->create_links();
            $data['search'] = $this->customer_model->getcustomers();
            $data['fromdate'] = $from_date;
            $data['todate'] = $to_date;
            $data['pdf'] = base_url() . "print_pdf/searchcustomerpdf/$id/$from_date/$to_date/Search_Customer";
            $data['customers'] = $this->customer_model->search($id,$from_date,$to_date);                    
           $this->load->view('customer_view',$data);
         }
         else{
              $data['search'] = $this->customer_model->getcustomers();
              $this->load->view('customer_view' , $data);
         }
      }     
}
?>
<?php
error_reporting(0);

defined('BASEPATH') OR exit('No direct script access allowed');
class Deliveryboy extends CI_controller
{
  
  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->database();    
    $this->load->library("pagination");
    $this->load->library('form_validation');
    $this->load->model('deliveryboy_model');
  }
  public function index()
  {
    $config['total_rows'] = $this->deliveryboy_model->getAllDeliveryboysCount();
        $data['total_count'] = $config['total_rows'];
        $config['suffix'] = '';
 
        if ($config['total_rows'] > 0) {
            $page_number = $this->uri->segment(3);
            $config["base_url"] = base_url() . "Deliveryboy/index/";
            if (empty($page_number))
                $page_number = 1;
            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->deliveryboy_model->setPageNumber($this->pagination->per_page);
            $this->deliveryboy_model->setOffset($offset);
            $this->pagination->cur_page = $offset;
            $this->pagination->initialize($config);
            $data['page'] = $page_number;
            $data['items_per_page'] = $this->pagination->per_page;

            $data['page_links'] = $this->pagination->create_links();
            $data['pdf'] = base_url() . "print_pdf/deliveryboypdf";            
            $data['deliveryboys'] = $this->deliveryboy_model->deliveryboyList();
        }
    $data['search'] = $this->deliveryboy_model->getdeliveryboys();
    $this->load->view('deliveryboy_view' , $data);
  }
  public function getdeliveryboy($id)
  {
    $data['deliveryboy'] = $this->deliveryboy_model->getdeliveryboy($id);
    $this->load->view('editdeliveryboy' , $data);
  }
  public function adddeliveryboydata()
  {
    if($_POST)
    {
      $data = array('d_name' => $this->input->post('name'), 
              'address' => $this->input->post('address'),
              'phone_no' => $this->input->post('phoneno'),
              'date_of_birth' => $this->input->post('dateofbirth'),
              'working_time' => $this->input->post('workingtime'),
              'joining_date' => $this->input->post('joiningdate'),
              'reliving_date' => $this->input->post('relivingdate'),
              'salary' => $this->input->post('salary'),
              'create_date' => date("Y-m-d"));
              $this->form_validation->set_rules('name', 'Deliveryboy Name', 'trim|required|alpha_numeric|min_length[4]|is_unique[deliveryBoy.d_name]', array('is_unique' => 'This name already exists. Please choose another one.'));
              $this->form_validation->set_rules('phoneno', 'Phone Number', 'required|numeric|min_length[10]|max_length[10]');
              $this->form_validation->set_rules('salary', 'Salary', 'required|numeric');
              if ($this->form_validation->run() === false) 
                    {        
                  // validation not ok, send validation errors to the view
                   $data['deliveryboy'] = $data ;
                  $this->load->view('adddeliveryboy', $data);
            
          
                } else 
                {

                  if($this->deliveryboy_model->insertdeliveryboy($data))
                  {                   
                     redirect(base_url().'deliveryboy', 'refresh');
                  }
                  else
                  {                   
                   redirect(base_url().'deliveryboy', 'refresh');
                  }
              }
        }
        else
        {
            $this->load->view('adddeliveryboy');

        }
  }
  public function updatedetails($id)
  {   
    if ($_POST) 
    {
            $data = array('d_name' => $this->input->post('name'), 
              'address' => $this->input->post('address'),
              'phone_no' => $this->input->post('phoneno'),
              'date_of_birth' => $this->input->post('dateofbirth'),
              'working_time' => $this->input->post('workingtime'),
              'joining_date' => $this->input->post('joiningdate'),
              'reliving_date' => $this->input->post('relivingdate'),
              'salary' => $this->input->post('salary'),
              'modify_date' => date("Y-m-d"));
              $this->form_validation->set_rules('phoneno', 'Phone Number', 'required|numeric|min_length[10]|max_length[10]');
              $this->form_validation->set_rules('salary', 'Salary', 'required|numeric');
             if ($this->form_validation->run() === false) 
            {              
              $data['deliveryboy'] = $this->deliveryboy_model->getdeliveryboy($id);
              $this->load->view('editdeliveryboy' , $data);          
            } else 
              {
                if($this->deliveryboy_model->update_details($data, $id) > 0)
                {             
                 redirect(base_url().'deliveryboy', 'refresh');
                }
                 else
                 {
                   redirect(base_url().'deliveryboy', 'refresh');
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
    $this->deliveryboy_model->delete_details($id);    
    redirect(base_url().'deliveryboy', 'refresh');
  }
 
       public function search()
     {
         $id = $this->input->post('deliveryboy_id');
         $from_date = $this->input->post('from_date');
         $to_date = $this->input->post('to_date');
        
         if (isset($id) and !empty($id) || isset($from_date) && !empty($from_date)|| isset($to_date) && !empty($to_date)) 
      {
        if (!empty($id)&& !empty($from_date) && !empty($to_date))  
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
           $config['total_rows'] = count($this->deliveryboy_model->search($id,$from_date,$to_date));
           $data['total_count'] = $config['total_rows'];
           $config['suffix'] = '';
 
        if ($config['total_rows'] > 0) 
            $page_number = $this->uri->segment(6);
            $config["base_url"] = base_url() . "Deliveryboy/search/$id/$from_date/$to_date";        
            if (empty($page_number))
                $page_number = 1;
            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->deliveryboy_model->setPageNumber($this->pagination->per_page);
            $this->deliveryboy_model->setOffset($offset);
            $this->pagination->cur_page = $offset;
            $this->pagination->initialize($config);
            $data['page'] = $page_number;
            $data['items_per_page'] = $this->pagination->per_page;
            $data['page_links'] = $this->pagination->create_links();
            $data['search'] = $this->deliveryboy_model->getdeliveryboys();
            $data['fromdate'] = $from_date;
            $data['todate'] = $to_date;
            $data['pdf'] = base_url() . "print_pdf/searchdeliveryboypdf/$id/$from_date/$to_date/Search_DeliveryBoy";
            $data['deliveryboys'] = $this->deliveryboy_model->search($id,$from_date,$to_date);         
            $this->load->view('deliveryboy_view',$data);
         }
         else{
              $data['search'] = $this->deliveryboy_model->getdeliveryboys();
              $this->load->view('deliveryboy_view' , $data);
         }
      }     
      
 }
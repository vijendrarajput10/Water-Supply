<?php
error_reporting(0);

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Order class.
 * 
 * @extends CI_Controller
 */
class Order extends CI_Controller {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() 
	{		
		parent::__construct();
    	$this->load->helper('url');
	    $this->load->database();
	     $this->load->library("pagination");
		$this->load->model('order_model');
		$this->load->model('customer_model');
		$this->load->model('deliveryboy_model');		
		$this->load->library('form_validation');		
	}
	
	
	public function index() 
	{	  
	    	$config['total_rows'] = $this->order_model->getAllOrdersCount();	  
        $data['total_count'] = $config['total_rows'];
        $config['suffix'] = '';
        if ($config['total_rows'] > 0) {
            $page_number = $this->uri->segment(3);
            $config["base_url"] = base_url() . "Order/index/";
            if (empty($page_number))
                $page_number = 1;
            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->order_model->setPageNumber($this->pagination->per_page);
            $this->order_model->setOffset($offset);
            $this->pagination->cur_page = $offset;
            $this->pagination->initialize($config);
            $data['page'] = $page_number;
            $data['items_per_page'] = $this->pagination->per_page;
            $data['page_links'] = $this->pagination->create_links();
          $data['pdf'] = base_url() . "print_pdf/orderpdf";
        	$data['orders'] = $this->order_model->orderList();
          $data['customers'] = $this->order_model->getCustomer();
     		  $data['deliveryboys'] = $this->order_model->getDeliveryboy();      
        	$this->load->view('order_view' , $data); 
          }else
          {        
            $data['customers'] = $this->order_model->getCustomer();
            $data['deliveryboys'] = $this->order_model->getDeliveryboy();      
            $this->load->view('order_view' , $data); 
        }      
	}
	
	/**
	 * register function.
	 * 
	 * @access public
	 * @return void
	 */
	public function addorder() 
	{

		 if($_POST)
        { 
		      $data = array('customer_id' => $this->input->post('customer_id'), 
		          'deliveryboy_id' => $this->input->post('deliveryboy_id'),
		          'number_of_container' => $this->input->post('number_of_container'),
		          'amount' => $this->input->post('amount'),
		          'payment_status' => $this->input->post('payment_status'),
                  'create_date' => date("Y-m-d"),
		          );			
			// set validation rules			
			$this->form_validation->set_rules('number_of_container', 'Number of Container','required|numeric');
			$this->form_validation->set_rules('amount', 'Amount', 'required|numeric');			
			
			if ($this->form_validation->run() === false) 
			{			
				// validation not ok, send validation errors to the view								
				$data['customers'] = $this->order_model->getCustomer();
				$data['deliveryboys'] = $this->order_model->getDeliveryboy();
				$data['order'] = $data ;
		        $this->load->view('addorder', $data);			
			} else 
			   {										
					if ($this->order_model->create_order($data)) 
					{						
						redirect(base_url().'order', 'refresh');									
					} else {
						
						// order creation failed, this should never happen
						//$data->error = 'There was a problem creating your new account. Please try again.';						
						// send error to the view
						$this->load->view('order_view', $data);					
				        }			
		        }
		}
		else
	    {
	    	$data['customers'] = $this->order_model->getCustomer();
			  $data['deliveryboys'] = $this->order_model->getDeliveryboy();
	      $this->load->view('addorder', $data);
	    }
	}	
	public function getorder($id)
		  {
		    $data['order'] = $this->order_model->getorder($id);
		    $this->load->view('editorder' , $data);
		  }
	public function deletorder($id)
	     {
	       $this->order_model->delete_order($id);        
	       redirect(base_url().'order', 'refresh');
	      }
    public function updateOrder($id)
  		{   
  			$data = array('customer_id' => $this->input->post('customer_id'), 
		     'deliveryboy_id' => $this->input->post('deliveryboy_id'),
		     'number_of_container' => $this->input->post('number_of_container'),
		     'amount' => $this->input->post('amount'),
		     'payment_status' => $this->input->post('payment_status'),
		     'modify_date' => date("Y-m-d")
		      );

			$this->form_validation->set_rules('number_of_container', 'Number of Container','required|numeric');
			$this->form_validation->set_rules('amount', 'Amount', 'required|numeric');			
			
			if ($this->form_validation->run() === false) 
			{
				$data['order'] = $this->order_model->getorder($id);			
				$this->load->view('editorder', $data);			
			} else 
			   {			   					
					if($this->order_model->update($data, $id) > 0)
					{						
						redirect(base_url().'order', 'refresh');									
					} else {															
						$data['orders'] = $this->order_model->getorders();
						$this->load->view('order_view', $data);					
				        }		
		        }		 
	}
	public function deleteorder($id)
	     {
	       $this->order_model->delete_order($id);    
	       redirect(base_url().'order', 'refresh');
	     }	
	public function search()
    {	
    	
      	$customer_id = $this->input->post("customer_id");
  	    $deliveryboy_id = $this->input->post("deliveryboy_id");
        $from_date = $this->input->post("from_date");
        $to_date = $this->input->post("to_date");
       if(isset($customer_id) && !empty($customer_id) || isset($deliveryboy_id) && !empty($deliveryboy_id) || isset($to_date) && !empty($to_date)|| isset($from_date) && !empty($from_date) )
    	{
        if(!empty($customer_id) && !empty($deliveryboy_id) && !empty($from_date) && !empty($to_date) )
        {
          $customer_id = $customer_id;
        $deliveryboy_id = $deliveryboy_id;
        $from_date = $from_date;
        $to_date = $to_date;

        }	else
          {	
    		
              if(!empty($customer_id) && !empty($deliveryboy_id) && !empty($from_date))
            {
              $to_date = 0 ;
            }
            else
            {            
                      if(!empty($customer_id) && !empty($deliveryboy_id) )
                      {
                          $to_date = 0 ;
                          $from_date = 0 ;
                          }
                           else
                          {
                            if (!empty($customer_id) && !empty($from_date) && !empty($to_date)) 
                              {
                                $deliveryboy_id = 0 ;
                              }
                              else
                              {
                                if (!empty($deliveryboy_id) && !empty($from_date) && !empty($to_date)) 
                                {
                                    $customer_id = 0 ;
                                } 
                                else
                                {
                                      if (!empty($from_date) && !empty($to_date))
                                      {
                                         $customer_id = 0 ;
                                         $deliveryboy_id = 0 ; 
                                      }
                                      else
                                      {
                                              if (!empty($customer_id) && !empty($from_date)) 
                                              {
                                               $deliveryboy_id = 0 ;
                                               $to_date = 0 ;
                                              }
                                              else
                                              {
                                                if (!empty($deliveryboy_id) && !empty($from_date)) 
                                                {
                                                  $customer_id = 0 ;
                                                } 
                                                else
                                                { 
                                                      if (!empty($customer_id) && !empty($to_date)) 
                                                      {
                                                       $deliveryboy_id = 0 ;
                                                      }
                                                      else
                                                      {  
                                                        if (!empty($deliveryboy_id) && !empty($to_date)) 
                                                        {
                                                          $customer_id = 0 ;
                                                        }
                                                         else
                                                         {
                                                            if (!empty($from_date)) 
                                                            {
                                                              $customer_id = 0 ;
                                                              $deliveryboy_id = 0 ;
                                                              $to_date = 0 ;
                                                            }
                                                            else
                                                            {
                                                                  if(!empty($customer_id))
                                                                  {
                                                                    $deliveryboy_id = 0 ;
                                                                    $from_date = 0 ;
                                                                    $to_date = 0 ; 
                                                                  }
                                                                  else
                                                                  {
                                                                    if(!empty($deliveryboy_id))
                                                                    {
                                                                      $customer_id = 0 ;
                                                                      $from_date = 0 ;
                                                                      $to_date = 0 ;         
                                                                    }                                                          
                                                                    else
                                                                    {
                                                                      if (!empty($to_date)) 
                                                                      {
                                                                        $customer_id = 0 ;
                                                                        $deliveryboy_id = 0 ;
                                                                        $from_date = 0 ;
                                                                      }
                                                                      else
                                                                      {
                                                                        return ;
                                                                      }
                                                                    }
                                                                  } 
                                                            } //end of else for from date  

                                                          }//end of else for deliveryboy and to date    

                                                       }//end of cutomer and to date   

                                                      } //end of else for delivery boy and from date
                                                                                                              
                                                  } //end of else for customer and from date

                                          } //end of else for from date and to date 

                                   } //end of else for deliveryboy and from date and to date   

                              } //end of else for customer and from date and to date

                      } //end of else for customer and deliveryboy

            } //end of else for customer deliveryboy and from date
          }

    	}
    	else
    	{   		
		   	$customer_id = $this->uri->segment(3);
		   	$deliveryboy_id = $this->uri->segment(4);
		   	$from_date = $this->uri->segment(5);
		   	$to_date = $this->uri->segment(6);
		   	//$page_number = $this->uri->segment(7);   
   	   }
	   
	   if(isset($customer_id) && !empty($customer_id) || isset($deliveryboy_id) && !empty($deliveryboy_id) || isset($to_date) && !empty($to_date)|| isset($from_date) && !empty($from_date) )
	   {        
	    	$config['total_rows'] = count($this->order_model->search($customer_id,$deliveryboy_id,$from_date,$to_date));
	    	$data['total_count'] = $config['total_rows'];
        $config['suffix'] = '';
        if ($config['total_rows'] > 0)             
       		$page_number = $this->uri->segment(7);       
	    	  $config["base_url"] = base_url() . "Order/search/$customer_id/$deliveryboy_id/$from_date/$to_date";	    	
            if (empty($page_number))
                $page_number = 1;

            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->order_model->setPageNumber($this->pagination->per_page);
            $this->order_model->setOffset($offset);
            $this->pagination->cur_page = $offset;
            $this->pagination->initialize($config);
            $data['page'] = $page_number;
            $data['items_per_page'] = $this->pagination->per_page;
            $data['page_links'] = $this->pagination->create_links();            
            $data['fromdate'] = $from_date;
            $data['todate'] = $to_date;
            $data['pdf'] = base_url() . "print_pdf/searchorderpdf/$customer_id/$deliveryboy_id/$from_date/$to_date/Search_Order";
           	$data['orders'] = $this->order_model->search($customer_id,$deliveryboy_id,$from_date,$to_date);
			      $data['customers'] = $this->order_model->getCustomer();
      			$data['deliveryboys'] = $this->order_model->getDeliveryboy();                  
      			$this->load->view('order_view',$data);
        }else{        
            $data['customers'] = $this->order_model->getCustomer();
     		    $data['deliveryboys'] = $this->order_model->getDeliveryboy();      
        	  $this->load->view('order_view' , $data); 
        }
     
     }	        
}
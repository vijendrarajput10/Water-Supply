<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Order_model class.
 * 
 * @extends CI_Model
 */
class Order_model extends CI_Model 
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

  public function create_order($data) 
  {
        
    return $this->db->insert('orders', $data);
    
  }
  public function getorders()
  {
      $this->db->select("orders.id,orders.customer_id,orders.deliveryboy_id,deliveryBoy.d_name,customers.c_name,orders.number_of_container,orders.amount,orders.payment_status,orders.create_date,orders.modify_date");
      $this->db->from('orders');
      $this->db->join('deliveryBoy', 'deliveryBoy.id = orders.deliveryboy_id');  
      $this->db->join('customers', 'customers.id = orders.customer_id');
      $query = $this->db->get();
      $result = $query->result_array();
      return $result;
  }
  /**
   * get_order function.
   * 
   * @access public
   * @param mixed $order_id
   * @return object the order object
   */
  public function getorder($id) 
  {
        $this->db->where('orders.id', $id);
        $this->db->select("orders.id,orders.customer_id,orders.deliveryboy_id,deliveryBoy.d_name,customers.c_name,orders.number_of_container,orders.amount,orders.payment_status,");
        $this->db->from('orders');
        $this->db->join('deliveryBoy', 'deliveryBoy.id = orders.deliveryboy_id');  
        $this->db->join('customers', 'customers.id = orders.customer_id');
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $result = $query->result_array();
            return $result;
        }else{
            return false;
        }         
  }  
  
  public function update($data, $id)
  {
    $this->db->where('id', $id);
    $this->db->update('orders', $data);
    return $this->db->affected_rows();
  }
  public function delete_order($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('orders');
  }

  public function getCustomer()
  {
    $this->db->select("id,c_name");
    $this->db->from('customers');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }
  public function getDeliveryboy()
  {
    $this->db->select("id,d_name");
    $this->db->from('deliveryBoy');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  } 

  public function search($customer_id , $deliveryboy_id , $from_date , $to_date)
    {     

      if(!empty($customer_id) && !empty($deliveryboy_id) && !empty($from_date) && !empty($to_date) )
        {
          $this->db->where('customers.id', $customer_id);
          $this->db->where('deliveryBoy.id', $deliveryboy_id);
          $this->db->where('orders.create_date >=', $from_date);
          $this->db->where('orders.create_date <=', $to_date);
        }
        else
        {
            if(!empty($customer_id) && !empty($deliveryboy_id) && !empty($from_date))
          {
            $this->db->where('customers.id', $customer_id);
            $this->db->where('deliveryBoy.id', $deliveryboy_id);
            $this->db->where('orders.create_date >=', $from_date);
          }
          else
          {            
                    if(!empty($customer_id) && !empty($deliveryboy_id) )
                    {
                        $this->db->where('customers.id', $customer_id);      
                        $this->db->where('deliveryBoy.id', $deliveryboy_id);  
                        }
                         else
                        {
                          if (!empty($customer_id) && !empty($from_date) && !empty($to_date)) 
                            {
                              $this->db->where('customers.id', $customer_id);
                              $this->db->where('orders.create_date >=', $from_date);
                              $this->db->where('orders.create_date <=', $to_date);
                            }
                            else
                            {
                              if (!empty($deliveryboy_id) && !empty($from_date) && !empty($to_date)) 
                              {
                                  $this->db->where('deliveryBoy.id', $deliveryboy_id);
                                  $this->db->where('orders.create_date >=', $from_date);
                                  $this->db->where('orders.create_date <=', $to_date);
                              } 
                              else
                              {
                                    if (!empty($from_date) && !empty($to_date))
                                    {
                                        $this->db->where('orders.create_date BETWEEN "'. $from_date. '" and "'. $to_date.'"');
                                    }
                                    else
                                    {
                                            if (!empty($customer_id) && !empty($from_date)) 
                                            {
                                            $this->db->where('customers.id', $customer_id);
                                            $this->db->where('orders.create_date >=', $from_date);
                                            }
                                            else
                                            {
                                              if (!empty($deliveryboy_id) && !empty($from_date)) 
                                              {
                                                $this->db->where('deliveryBoy.id', $deliveryboy_id);
                                                $this->db->where('orders.create_date >=', $from_date);
                                              } 
                                              else
                                              { 
                                                    if (!empty($customer_id) && !empty($to_date)) 
                                                    {
                                                     $this->db->where('customers.id', $customer_id);
                                                    $this->db->where('orders.create_date =', $to_date);
                                                    }
                                                    else
                                                    {  
                                                      if (!empty($deliveryboy_id) && !empty($to_date)) 
                                                      {
                                                        $this->db->where('deliveryBoy.id', $deliveryboy_id);
                                                        $this->db->where('orders.create_date =', $to_date);
                                                      }
                                                       else
                                                       {
                                                          if (!empty($from_date)) 
                                                          {
                                                            $this->db->where('orders.create_date >=', $from_date);
                                                          }
                                                          else
                                                          {
                                                                if(!empty($customer_id))
                                                                {
                                                                  $this->db->where('customers.id', $customer_id);          
                                                                }
                                                                else
                                                                {
                                                                  if(!empty($deliveryboy_id))
                                                                  {
                                                                    $this->db->where('deliveryboy.id', $deliveryboy_id);          
                                                                  }                                                          
                                                                  else
                                                                  {
                                                                    if (!empty($to_date)) 
                                                                    {
                                                                      $this->db->where('orders.create_date =', $to_date);
                                                                    }
                                                                    else
                                                                    {
                                                                      return false;
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

        } //end of else for all 4 combination

        $this->db->select("orders.id,orders.customer_id,orders.deliveryboy_id,deliveryBoy.d_name,customers.c_name,orders.number_of_container,orders.amount,orders.payment_status,orders.create_date,orders.modify_date");
        $this->db->from('orders');
        $this->db->join('deliveryBoy', 'deliveryBoy.id = orders.deliveryboy_id');  
        $this->db->join('customers', 'customers.id = orders.customer_id');
        $this->db->limit($this->_pageNumber, $this->_offset);
        $query = $this->db->get();
        if($query->num_rows()>0)
        {
         $result=$query->result_array();
         return $result;
        }
        else{
              return false; 
            }
    }
    public function setLimit($limit) 
    {
        $this->_limit = $limit;
    }
 
    public function setPageNumber($pageNumber) 
    {
        $this->_pageNumber = $pageNumber;
    }
 
    public function setOffset($offset) 
    {
        $this->_offset = $offset;
    }
  // Count all record of table "employee" in database.
    public function getAllOrdersCount() 
    {
          $this->db->select("orders.id,deliveryBoy.d_name,customers.c_name,orders.number_of_container,orders.amount,orders.payment_status,orders.create_date,orders.modify_date");        
          $this->db->from('orders');
          $this->db->join('deliveryBoy', 'deliveryBoy.id = orders.deliveryboy_id');  
          $this->db->join('customers', 'customers.id = orders.customer_id');          
          return $this->db->count_all_results();
      }
    // Fetch data according to per_page limit.
    public function orderList() 
    {
          $this->db->select("orders.id,deliveryBoy.d_name,customers.c_name,orders.number_of_container,orders.amount,orders.payment_status,orders.create_date,orders.modify_date");        
          $this->db->from('orders');
          $this->db->join('deliveryBoy', 'deliveryBoy.id = orders.deliveryboy_id');  
          $this->db->join('customers', 'customers.id = orders.customer_id');          
          $this->db->limit($this->_pageNumber, $this->_offset); //for getting search result on pagination 
          $query = $this->db->get();
          if ($query->num_rows() > 0) 
          {
              $result = $query->result_array();
              return $result;
          }
          return false;
      } 

}

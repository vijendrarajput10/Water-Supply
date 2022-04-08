<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer_model extends CI_Model
{
  public function getcustomers()
  {
  $query = $this->db->get('customers');
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }else{
            return false;
        }  
  }
  public function getcustomer($id)
  {
   $this->db->where("id",$id);
   $query = $this->db->get('customers');
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }else{
            return false;
        }  
  }
  public function insertcustomer($data)
  {
    return $this->db->insert('customers', $data);
  }
  public function update_details($data, $id)
  {
    $this->db->where('id', $id);
    $this->db->update('customers', $data);
    return $this->db->affected_rows();
  }
  public function delete_details($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('customers');
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
        $this->db->from('customers');
        $this->db->limit($this->_pageNumber, $this->_offset);
        $query = $this->db->get();
        if($query->num_rows()>0)
        {
        return $result=$query->result_array();
        }
        else
        {
           return false;     
           }
    } 
    public function record_count() 
    {
        return $this->db->count_all("customers");
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
 
    public function setOffset($offset)
    {
        $this->_offset = $offset;
    }
  
  public function getAllCustomersCount() 
  {
        $this->db->from('customers');
        return $this->db->count_all_results();
    }
  // Fetch data according to per_page limit.
  public function customerList() 
  {               
        $this->db->select(array('c.id', 'c.c_name', 'c.address', 'c.contact_no', 'c.create_date', 'c.modify_date'));
        $this->db->from('customers as c');          
        $this->db->limit($this->_pageNumber, $this->_offset);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result;
        }
        return false;
    }
}
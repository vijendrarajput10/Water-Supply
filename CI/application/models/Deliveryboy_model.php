<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Deliveryboy_model extends CI_Model
{
  public function getdeliveryboys()
  {
    $query = $this->db->get('deliveryBoy');
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }else{
            return false;
        }  
  }
  public function getdeliveryboy($id)
  {
   $this->db->where("id",$id);
   $query = $this->db->get('deliveryBoy');
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }else{
            return false;
        }  
  }
  public function insertdeliveryboy($data)
  {
    return $this->db->insert('deliveryBoy', $data);
  }
  public function update_details($data, $id)
  {
    $this->db->where('id', $id);
    $this->db->update('deliveryBoy', $data);
    return $this->db->affected_rows();
  }
  public function delete_details($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('deliveryBoy');
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
        $this->db->from('deliveryBoy');
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
    public function getAllDeliveryboysCount()
     {
        $this->db->from('deliveryBoy');
        return $this->db->count_all_results();
    }
  // Fetch data according to per_page limit.
  public function deliveryboyList() 
  {               
        $this->db->select(array('d.id', 'd.d_name', 'd.address', 'd.date_of_birth','d.phone_no','d.joining_date','d.reliving_date','d.working_time','d.salary', 'd.create_date', 'd.modify_date'));
        $this->db->from('deliveryBoy as d');          
        $this->db->limit($this->_pageNumber, $this->_offset);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result;
        }
        return false;
    }
}
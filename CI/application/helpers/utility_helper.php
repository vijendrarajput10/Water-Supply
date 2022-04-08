<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('modeOfpayment'))
{
    function modeOfpayment($id='')
    {
        $payment_option = array(
                '1' => 'Online',
                '2' => 'COD'
        );        
        if(array_key_exists($id, $payment_option)){
           return $payment_option[$id];  
          }
          else{
            return "failed";  
          }
    }
}
if (!function_exists('paymentStatus'))
{
    function paymentStatus($id='')
    {
        $status_option = array(
                '1' => 'Complete',
                '2' => 'Declined',
                '3' => 'Error',
                '4' => 'Held for review'
        );
        if(array_key_exists($id, $status_option)){
           return $status_option[$id]; 
          }
          else{
            return "failed";  
          }
    }
}
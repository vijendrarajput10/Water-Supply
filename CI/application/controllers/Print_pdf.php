<?php

/* @property mpdf_model $mpdf_model */
class Print_pdf extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('order_model');
        $this->load->model('customer_model');
        $this->load->model('deliveryboy_model');


    }


    function index()
    {
        ini_set('memory_limit', '256M');
        // load library
        $this->load->library('pdf');        
    }
    public function orderpdf()
    {   
        ini_set('memory_limit', '256M');
        // load library
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        // retrieve data from model
        $data['orders'] = $this->order_model->getorders();
        //$data['title'] = "items";
        // boost the memory limit if it's low ;)
        $html = $this->load->view('content/opdf', $data, true);
        // render the view into HTML
        $pdf->WriteHTML($html);
        // write the HTML into the PDF
        $output = 'ORDER ' . date('Y_m_d') . '.pdf';
        $pdf->Output("$output", 'I');

    }
    public function customerpdf()
    {   
        ini_set('memory_limit', '256M');
        // load library
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        // retrieve data from model
        $data['customers'] = $this->customer_model->getcustomers();
        //$data['title'] = "items";
        // boost the memory limit if it's low ;)
        $html = $this->load->view('content/cpdf', $data, true);
        // render the view into HTML
        $pdf->WriteHTML($html);
        // write the HTML into the PDF
        $output = 'CUSTOMER ' . date('Y_m_d') . '.pdf';
        $pdf->Output("$output", 'I');

    }
    public function deliveryboypdf()
    {   
        ini_set('memory_limit', '256M');
        // load library
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        // retrieve data from model
        $data['deliveryboys'] = $this->deliveryboy_model->getdeliveryboys();
        //$data['title'] = "items";
        // boost the memory limit if it's low ;)
        $html = $this->load->view('content/dpdf', $data, true);
        // render the view into HTML
        $pdf->WriteHTML($html);
        // write the HTML into the PDF
        $output = 'DELIVERYBOY ' . date('Y_m_d') . '.pdf';
        $pdf->Output("$output", 'I');

    }
    public function userpdf()
    {   
        ini_set('memory_limit', '256M');
        // load library
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        // retrieve data from model
        $data['users'] = $this->user_model->getusers();
        //$data['title'] = "items";
        // boost the memory limit if it's low ;)
        $html = $this->load->view('content/updf', $data, true);
        // render the view into HTML
        $pdf->WriteHTML($html);
        // write the HTML into the PDF
        $output = 'USER ' . date('Y_m_d') . '.pdf';
        $pdf->Output("$output", 'I');

    }

     public function searchcustomerpdf()
    {   
        $id = $this->uri->segment(3);
        $from_date = $this->uri->segment(4);
        $to_date = $this->uri->segment(5);       
        ini_set('memory_limit', '256M');
        // load library
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        // retrieve data from model
        $data['customers'] = $this->customer_model->search($id,$from_date,$to_date); 
        //$data['title'] = "items";
        // boost the memory limit if it's low ;)
        $html = $this->load->view('content/cpdf', $data, true);
        // render the view into HTML
        $pdf->WriteHTML($html);
        // write the HTML into the PDF
        $output = 'SEARCH CUSTOMER ' . date('Y_m_d') . '.pdf';
        $pdf->Output("$output", 'I');

    }
     public function searchdeliveryboypdf()
    {   
        $id = $this->uri->segment(3);
        $from_date = $this->uri->segment(4);
        $to_date = $this->uri->segment(5);  
         ini_set('memory_limit', '256M');
        // load library
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        // retrieve data from model
        $data['deliveryboys'] = $this->deliveryboy_model->search($id,$from_date,$to_date); 
        //$data['title'] = "items";
        // boost the memory limit if it's low ;)
        $html = $this->load->view('content/dpdf', $data, true);
        // render the view into HTML
        $pdf->WriteHTML($html);
        // write the HTML into the PDF
        $output = 'SEARCH DELIVERYBOY ' . date('Y_m_d') . '.pdf';
        $pdf->Output("$output", 'I');            
        
       

    }
     public function searchorderpdf()
    {   
        $customer_id = $this->uri->segment(3);
        $deliveryboy_id = $this->uri->segment(4);
        $from_date = $this->uri->segment(5);
        $to_date = $this->uri->segment(6);
        ini_set('memory_limit', '256M');
        // load library
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        // retrieve data from model
        $data['orders'] = $this->order_model->search($customer_id,$deliveryboy_id,$from_date,$to_date);        // render the view into HTML        //$data['title'] = "items";
        // boost the memory limit if it's low ;)
        $html = $this->load->view('content/opdf', $data, true);
        // render the view into HTML
        $pdf->WriteHTML($html);
        // write the HTML into the PDF
        $output = 'SEARCH ORDER ' . date('Y_m_d') . '.pdf';
        $pdf->Output("$output", 'I');
        
        
       

    }
    public function searchuserpdf()
    {   
        $id = $this->uri->segment(3);
        $from_date = $this->uri->segment(4);
        $to_date = $this->uri->segment(5);
        ini_set('memory_limit', '256M');
        // load library
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        // retrieve data from model
        $data['users'] = $this->user_model->search($id,$from_date,$to_date);
        //$data['title'] = "items";
        // boost the memory limit if it's low ;)
        $html = $this->load->view('content/updf', $data, true);
        // render the view into HTML
        $pdf->WriteHTML($html);
        // write the HTML into the PDF
        $output = 'SEARCH USER ' . date('Y_m_d') . '.pdf';
        $pdf->Output("$output", 'I');

    }
}
/* End of file dashboard.php */
/* Location: ./system/application/modules/matchbox/controllers/dashboard.php */
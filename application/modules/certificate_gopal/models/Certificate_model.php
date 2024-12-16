<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Certificate_model extends CI_Model {


    public function get_student()
    {
        $this->db->select('*');
        $this->db->from('s_certificate');
        // $this->db->where('Status','1');
        $this->db->order_by('SC_ID');
        $query=$this->db->get();
        return $query->result_array();
    }
    
    public function save_student()
    {
        $data=array(
            'Name'=>$this->input->post('name'),
            'Organization'=>$this->input->post('org'),
            'Phone'=>$this->input->post('phone'),
            'Title'=>$this->input->post('title'),
            'Document_Number'=>$this->input->post('doc'),
            'Email'=>$this->input->post('email'),
            'Citizenship'=>$this->input->post('citizen'),
            // 'display_order'=>$this->input->post(''),
            'Status'=>'1'
        );
        $this->db->insert('s_certificate',$data);
        return true;
    }
    public  function getstudentbyId()
    {
        $this->db->select('*');
        $this->db->from('s_certificate');
        $this->db->where('SC_ID',$this->input->post('id'));
        $query=$this->db->get();
        return $query->row();

    }
    public function update_student($id)
    {
        $data=array(
            'Name'=>$this->input->post('name'),
            'Organization'=>$this->input->post('org'),
            'Phone'=>$this->input->post('phone'),
            'Title'=>$this->input->post('title'),
            'Document_Number'=>$this->input->post('doc'),
            'Email'=>$this->input->post('email'),
            'Citizenship'=>$this->input->post('citizen'),
            'Status'=>$this->input->post('status')
        );
        $this->db->where('SC_ID',$id);
        $this->db->update('s_certificate',$data);
        return true;
    }
    public  function delete_student()
    {
        $this->db->where('SC_ID',$this->input->post('id'));
        $this->db->delete('s_certificate');
        return true;
       

    }


    //  COURSE  //
    public function get_course()
    {
        $this->db->select('*');
        $this->db->from('ccourse');
        $this->db->order_by('C_ID');
        $query=$this->db->get();
        return $query->result_array();
    }
    public  function getcoursebyId()
    {
        $this->db->select('*');
        $this->db->from('ccourse');
        $this->db->where('C_ID',$this->input->post('id'));
        $query=$this->db->get();
        return $query->row();

    }
    
    public function save_course()
    {
        $data=array(
            'Name'=>$this->input->post('cname'),
            'Teacher'=>$this->input->post('tname'),
            'Start'=>$this->input->post('start'),
            'End'=>$this->input->post('end'),
            'Duration'=>$this->input->post('time'),
        );
        $this->db->insert('ccourse',$data);
        return true;
    }
    public function update_course($id)
    {
        $data=array(
            'Name'=>$this->input->post('cname'),
            'Teacher'=>$this->input->post('tname'),
            'Start'=>$this->input->post('start'),
            'End'=>$this->input->post('end'),
            'Duration'=>$this->input->post('time'),
        );
        $this->db->where('C_ID',$id);
        $this->db->update('ccourse',$data);
        return true;
    }
    public  function delete_course()
    {
        $this->db->where('C_ID',$this->input->post('id'));
        $this->db->delete('ccourse');
        return true;
    }



    //  TRAINEEE CERTIFICATE  //
    public function get_certificate()
    {
        $this->db->select('*');
        $this->db->from('certificate');
        $this->db->order_by('CE_ID');
        $query=$this->db->get();
        return $query->result_array();
    }
    public  function getcertificatebyId()
    {
        $this->db->select('*');
        $this->db->from('certificate');
        $this->db->where('CE_ID',$this->input->post('id'));
        $query=$this->db->get();
        return $query->row();

    }
    
    public function save_certificate()
    {
        $data=array(
            'Certificate_Name'=>$this->input->post('cname'),
            'Date_of_issue'=>$this->input->post('issue'),
            'Certificate_Text'=>$this->input->post('text'),
            'Background'=>$this->input->post('background'),
            'Footer1'=>$this->input->post('footer1'),
            'Footer2'=>$this->input->post('footer2'),
            'Footer3'=>$this->input->post('footer3'),
            'Footer4'=>$this->input->post('footer4')
        );
        $this->db->insert('certificate',$data);
        return true;
    }
    public function update_certificate($id)
    {
        $data=array(
            'Certificate_Name'=>$this->input->post('cname'),
            'Date_of_issue'=>$this->input->post('issue'),
            'Certificate_Text'=>$this->input->post('text'),
            'Background'=>$this->input->post('background'),
            'Footer1'=>$this->input->post('footer1'),
            'Footer2'=>$this->input->post('footer2'),
            'Footer3'=>$this->input->post('footer3'),
            'Footer4'=>$this->input->post('footer4')
        );
        $this->db->where('CE_ID',$id);
        $this->db->update('certificate',$data);
        return true;
    }
    public  function delete_certificate()
    {
        $this->db->where('CE_ID',$this->input->post('id'));
        $this->db->delete('certificate');
        return true;
    }
    // public function save_img($id,$image)
    // {  
    //     $data=array(
    //         'image'=>$image,
    //     );
    // }

}
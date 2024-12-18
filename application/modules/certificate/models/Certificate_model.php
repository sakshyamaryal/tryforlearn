<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Certificate_model extends CI_Model {


    public function get_student()
    {
        $this->db->select('sc.*,c.name as certificatename');
        $this->db->from('s_certificate sc');
        $this->db->join('certificate c','sc.certificateid=c.certificateid');
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
          'certificateid'=>$this->input->post('cid'),

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
         'certificateid'=>$this->input->post('cid'),

            'Status'=>$this->input->post('status')
        );
        $this->db->where('SC_ID',$id);
        $this->db->update('s_certificate',$data);
        return true;
    }
    public  function delete_student()
    {
        $this->db->where_in('SC_ID',$this->input->post('id'));
        $this->db->delete('s_certificate');
        return true;
       

    }
    
    public function get_course()
    {
        $this->db->select('*');
        $this->db->from('ccourse');
        $this->db->order_by('C_ID');
        $query=$this->db->get();
        return $query->result_array();
    }
}
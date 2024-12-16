<?php

class Exam_model extends CI_Model
{



	public function get_Exam ($type)
	{
		$where = " 1 = 1 ";
		$order = '';
		$take = '10';
		$skip = '0';
		if($type=='sub')
		{
			$twhere=' and se.topic_id = 0 and';
		}else
		{
			$twhere= 'and se.subject_id = 0 and ';
		}
		if (isset($_GET["take"])) {
			$take = $_GET["take"];
		}
		if (isset($_GET["skip"])) {
			$skip = $_GET["skip"];
		}
		if (!isset($_REQUEST['sort'][0]['field'])) {
			$field = "student_exam_id";
		} else {
			$field = $_REQUEST['sort'][0]['field'];
		}
		if (!isset($_REQUEST['sort'][0]['dir'])) {
			$order = "desc";
		} else {
			$order = $_REQUEST['sort'][0]['dir'];
		}


		if (isset($_REQUEST['filter'])) $where = $this->parseFilters($_REQUEST['filter']);
		$query = $this->db->query("select se.*,exam.exam_name,exam.full_marks,exam.pass_marks,exam.exam_id,qn.qn_full_marks,qn.qn_pass_marks,t.topic_name,qn.qname,qn.is_subj_obj,st.fullname,st.address,st.email,st.phone from student_exam se left join topic t on t.topic_id=se.topic_id left join upload_qn qn on se.question_id=qn.upload_id left join users st on st.user_id=se.student_id left join exam on qn.exam_type=exam.exam_id where reportid=0 $twhere  $where order by $field $order limit $skip, $take");
		return $query->result();
	}

	function parseFilters ($filters, $count = 0)
	{
		$where = "";
		$intcount = 0;
		$noend = false;
		$nobegin = false;
		// Do we actually have filters or noi ?
		if (isset($filters['filters'])) {
			$itemcount = count($filters['filters']);
			if ($itemcount == 0) {
				$noend = true;
				$nobegin = true;
			} elseif ($itemcount == 1) {
				$noend = true;
				$nobegin = true;
			} elseif ($itemcount > 1) {
				$noend = false;
				$nobegin = false;
			}
			foreach ($filters['filters'] as $key => $filter) {
				if (isset($filter['field'])) {
					switch ($filter['operator']) {
						case 'startswith':
							$compare = " LIKE ";
							$field = $filter['field'];
							$value = "'" . $filter['value'] . "%' ";
							break;
						case 'contains':
							$compare = " LIKE ";
							$field = $filter['field'];
							$value = " '%" . $filter['value'] . "%' ";
							break;
						case 'doesnotcontain':
							$compare = " NOT LIKE ";
							$field = $filter['field'];
							$value = " '%" . $filter['value'] . "%' ";
							break;
						case 'endswith':
							$compare = " LIKE ";
							$field = $filter['field'];
							$value = "'%" . $filter['value'] . "' ";
							break;
						case 'eq':
							$compare = " = ";
							$field = $filter['field'];
							$value = "'" . $filter['value'] . "'";
							break;
						case 'gt':
							$compare = " > ";
							$field = $filter['field'];
							$value = $filter['value'];
							break;
						case 'lt':
							$compare = " < ";
							$field = $filter['field'];
							$value = $filter['value'];
							break;
						case 'gte':
							$compare = " >= ";
							$field = $filter['field'];
							$value = $filter['value'];
							break;
						case 'lte':
							$compare = " <= ";
							$field = $filter['field'];
							$value = $filter['value'];
							break;
						case 'neq':
							$compare = " <> ";
							$field = $filter['field'];
							$value = "'" . $filter['value'] . "'";
							break;
					}
					if ($count == 0 && $intcount == 0) {
						$before = "";
						$end = " " . $filters['logic'] . " ";
					} elseif ($count > 0 && $intcount == 0) {
						$before = "";
						$end = " " . $filters['logic'] . " ";
					} else {
						$before = " " . $filters['logic'] . " ";
						$end = "";
					}
					$where .= ($nobegin ? "" : $before) . $field . $compare . $value . ($noend ? "" : $end);
					$count++;
					$intcount++;
				} else {
					$where .= " ( " . parseFilters($filter, $count) . " )";
				}
				$where = str_replace(" or  or ", " or ", $where);
				$where = str_replace(" and  and ", " and ", $where);
			}
		} else {
			$where = " 1 = 1 ";
		}

		return $where;
	}

	public function count_all_Exam ($type)
	{
		$this->db->select(" * ");
		$this->db->from('student_exam');

		$this->db->where('reportid',0);
		if($type=='sub')
		{
			$this->db->where('topic_id',0);
		}else
		{
			$this->db->where('subject_id',0);
		}
		$query = $this->db->get();
		return $query->num_rows();
	}


	
	public function updateService ($data, $serviceId)
	{
		$this->db->where('student_exam_id', $serviceId);
		if ($this->db->update('student_exam', $data)) {
			return true;
		} else {
			return false;
		}
	}

	public function makereport($data)
	{
		if ($this->db->insert('report', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}
	public function update_exam_report ($data,$id)
	{
		$update=array('reportid'=>$id);
		foreach($data as $val)
		{
			$this->db->where('student_exam_id', $val->student_exam_id);
		$this->db->update('student_exam', $update);
		

		}
		return true;
		
	}
	public function findans($id)
	{
		$this->db->select("submitted_answer ");
		$this->db->from('student_exam');
		$this->db->where('student_exam_id',$id);
		$query = $this->db->get();
		 if($query->num_rows()>0)
		 {
			 $data= $query->row();
			 return $data->submitted_answer;
		 }else{
			 return false;
		 }
	}

}
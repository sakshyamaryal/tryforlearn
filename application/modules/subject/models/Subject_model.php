<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Subject_model extends CI_Model
{
	public function getclass($level)
	{
		$sql="select classid,name from class where levelid=?";
		$res=$this->db->query($sql,array($level))->result_array();
		return $res;

	}

	public function get_subject ()
	{
		$where = " 1 = 1 ";
		$order = '';
		$take = '10';
		$skip = '0';
		if (isset($_GET["take"])) {
			$take = $_GET["take"];
		}
		if (isset($_GET["skip"])) {
			$skip = $_GET["skip"];
		}
		if (!isset($_REQUEST['sort'][0]['field'])) {
			$field = "subject_id";
		} else {
			$field = $_REQUEST['sort'][0]['field'];
		}
		if (!isset($_REQUEST['sort'][0]['dir'])) {
			$order = "desc";
		} else {
			$order = $_REQUEST['sort'][0]['dir'];
		}


		if (isset($_REQUEST['filter'])) $where = $this->parseFilters($_REQUEST['filter']);
		$query = $this->db->query("select s.*,c.name,1monthsprice as onemonth,3monthsprice as threemonth,6monthsprice as sixmonth,1yearprice as oneyear from subject s join class c on c.classid=s.classid  where s.is_active=1 and c.is_active=1 and s.levelid=? and  $where order by $field $order limit $skip, $take",array($this->session->userdata('levelid')));
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


	public function count_all_subject ()
	{
		$this->db->select(" * ");
		$this->db->where('is_active',1);
		$this->db->where('levelid',$this->session->userdata('levelid'));
		$this->db->from('subject');
		$query = $this->db->get();
		return $query->num_rows();
	}



	public function save ($id)
	{
		$data = array(
			'levelid'=>$this->session->userdata('levelid'),
			'classid' => $this->input->post('classid'),
			'subject_name' => $this->input->post('subject_name'),
			
			'isfree' => (@$this->input->post('isfree')!='')?@$this->input->post('isfree'):1,
			'1monthsprice' => $this->input->post('1monthsprice'),
			'3monthsprice' => $this->input->post('3monthsprice'),
			'6monthsprice' => $this->input->post('6monthsprice'),
			'1yearprice' => $this->input->post('1yearprice'),
			'toshow'=>$this->input->post('issubscription'),
			'penalty'=>$this->input->post('penalty'),

			'is_active' => '1'
		);
		if ($id == null) {
			if ($this->db->insert('subject', $data)) {
				return true;
			} else {
				return false;
			}

		} else {
			$this->db->where('subject_id', $id);
			if ($this->db->update('subject', $data)) {
				return true;
			} else {
				return false;
			}

		}


	}

	public
	function delete_subject ()
	{
		
		$data = array(
			'is_active' => '0'
		);
		$this->db->where('subject_id', $this->input->post('id'));
		if ($this->db->update('subject', $data)) {
			return true;
		} else {
			return false;
		}

	}
}
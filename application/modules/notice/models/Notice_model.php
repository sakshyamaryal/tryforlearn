<?php

class Notice_model extends CI_Model
{
	public function saveNotice ($data_arr)
	{
		$this->db->insert('notice', $data_arr);
		$id=$this->db->insert_id();
		$this->db->select('user_id');
		$this->db->from('users');
		$this->db->where('user_type',3);
		$this->db->where('is_active',1);
		$user=$this->db->get()->result_array();
		
		foreach($user as $usr)

		{
			$data=array
			(
				'keyid'=>$id,
				'keytype'=>'notice',
				'userid'=>$usr['user_id'],
				'title'=>$data_arr['title'],
				'posted_date'=>$data_arr['created_date'],
				'logstamp'=>date('Y-m-d h:i:s'),
				'is_seen'=>0
			);
			$this->db->insert('trigger_notify',$data);
		}
		return $id;
	}


	public function get_notice ()
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
			$field = "notice_id";
		} else {
			$field = $_REQUEST['sort'][0]['field'];
		}
		if (!isset($_REQUEST['sort'][0]['dir'])) {
			$order = "desc";
		} else {
			$order = $_REQUEST['sort'][0]['dir'];
		}


		if (isset($_REQUEST['filter'])) $where = $this->parseFilters($_REQUEST['filter']);
		$query = $this->db->query("select * from notice where is_active=1 and  $where order by $field $order limit $skip, $take");
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

	public function count_all_notice ()
	{
		$this->db->select(" * ");
		$this->db->where('is_active',1);
		$this->db->from('notice');
		$query = $this->db->get();
		return $query->num_rows();
	}


	
	public function updateNotice ($data, $noticeId)
	{
		$this->db->where('notice_id', $noticeId);
		if ($this->db->update('notice', $data)) {
			$this->db->select('user_id');
			$this->db->from('users');
			$this->db->where('user_type',3);
			$this->db->where('is_active',1);
			$user=$this->db->get()->result_array();
			
			foreach($user as $usr)
	
			{
				$notice=array
				(
					'keyid'=>$noticeId,
					'keytype'=>'notice',
					'userid'=>$usr['user_id'],
					'title'=>$data['title'],
					'posted_date'=>date('Y-m-d'),
					'logstamp'=>date('Y-m-d h:i:s'),
					'is_seen'=>0
				);
				$this->db->insert('trigger_notify',$notice);
			}
			return true;
		} else {
			return false;
		}
	}
}
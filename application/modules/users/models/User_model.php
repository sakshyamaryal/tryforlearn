<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{

	public function get_user ()
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
			$field = "user_id";
		} else {
			$field = $_REQUEST['sort'][0]['field'];
		}
		if (!isset($_REQUEST['sort'][0]['dir'])) {
			$order = "desc";
		} else {
			$order = $_REQUEST['sort'][0]['dir'];
		}


		if (isset($_REQUEST['filter'])) $where = $this->parseFilters($_REQUEST['filter']);
		$query = $this->db->query("select users.*, user_type.* from users left join user_type on user_type.typeid=users.user_type where user_type!=1 and user_type!=3 and $where order by $field $order limit $skip, $take");
		return $query->result();
	}

	public function get_student ()
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
			$field = "user_id";
		} else {
			$field = $_REQUEST['sort'][0]['field'];
		}
		if (!isset($_REQUEST['sort'][0]['dir'])) {
			$order = "desc";
		} else {
			$order = $_REQUEST['sort'][0]['dir'];
		}


		if (isset($_REQUEST['filter'])) $where = $this->parseFilters($_REQUEST['filter']);
		$query = $this->db->query("select users.*, user_type.*,user_information.*,case when is_approved=1 then 
		'Approved' else 'Unapproved' end as is_approved from users
		join user_information on users.user_id=user_information.userid
		  join user_type on user_type.typeid=users.user_type
		  where users.is_active=1 and user_type=3 AND $where order by $field $order limit $skip, $take");
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

	public function count_all_user ()
	{
		$this->db->select(" * ");
		 $this->db->where('is_active',1);
		 $this->db->where('user_type!=',1);
		 $this->db->where('user_type!=',3);
		$this->db->from('users');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_students ()
	{
		$this->db->select(" * ");
		$this->db->from('users');
		$this->db->where('is_active',1);

		$this->db->where('user_type',3);
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function getUserType ()
	{
		$this->db->select('*');
		$this->db->from('user_type');
		$this->db->where('typeid !=',1);
		$this->db->order_by('user_type_name');
		$query = $this->db->get();
		return $query->result();

	}


	public function save ($id)
	{

		if ($id == null) {
			$data = array(
				'fullname' => $this->input->post('fullName'),
				'address' => $this->input->post('address'),
				'phone' => $this->input->post('phone'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'user_type' => $this->input->post('userType'),
				'password' => md5($this->input->post('password')),
				'is_active' => 1
			);
		// 		if($this->input->post('status')=='1')
		// {
		//     $data['is_approved']=1;
		// }else{$data['is_approved']=0;
		// }
		$data['is_approved']=1;
			if ($this->db->insert('users', $data)) {
				return true;
			} else {
				return false;
			}

		} else {
			$data = array(
				'fullname' => $this->input->post('fullName'),
				'address' => $this->input->post('address'),
				'phone' => $this->input->post('phone'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'user_type' => $this->input->post('userType'),
				'is_active' => '1'
			);
		// 		if($this->input->post('status')=='1')
		// {
		//     $data['is_approved']=1;
		// }else{$data['is_approved']=0;}
			$data['is_approved']=1;
			$this->db->where('user_id', $id);
			if ($this->db->update('users', $data)) {
				return true;
			} else {
				return false;
			}

		}


	}

	public
	function delete_user ()
	{
// 		$data = array(
// 			'is_active' => '0'
// 		);
// 		$this->db->where('user_id', $this->input->post('id'));
// 		if ($this->db->update('users', $data)) {
// 			return true;
// 		} else {
// 			return false;
// 		}
	
		$this->db->where_in('user_id', $this->input->post('id'));
		if ($this->db->delete('users')) {
			return true;
		} else {
			return false;
		}
	}


	public function updateUser ($data, $userId)
	{
		$this->db->where_in('user_id', $userId);
		if ($this->db->update('users', $data)) {
			return true;
		} else {
			return false;
		}
	}

	public function getsubscribed($where)
	{
		
		$sql="select l.name as levelname,c.name as classname,subject_name,feepackage,paid_amount,paid_date,remarks,fullname,phone,email,discountamount,vouchercode
		from student_fee sf 
		join users u on u.user_id=sf.student_id
		join level l on l.level_id=sf.levelid
		join class c on c.classid=sf.classid
		join subject s on s.subject_id=sf.subjectid
		where sf.is_paid=1 ".$where." order by paid_date desc";
		$res=$this->db->query($sql)->result();
		return $res;
	}

	public function verifyDisable ($data, $userId)
	{
		$this->db->where_in('user_id', $userId);
		if ($this->db->update('users', $data)) {
			return true;
		} else {
			return false;
		}
	}
}
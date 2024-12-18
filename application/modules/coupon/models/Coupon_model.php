<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Coupon_model extends CI_Model
{

	public function get_coupon()
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
			$field = "vouchercodeid";
		} else {
			$field = $_REQUEST['sort'][0]['field'];
		}
		if (!isset($_REQUEST['sort'][0]['dir'])) {
			$order = "desc";
		} else {
			$order = $_REQUEST['sort'][0]['dir'];
		}


		if (isset($_REQUEST['filter']))
			$where = $this->parseFilters($_REQUEST['filter']);
		$query = $this->db->query("select s.subject_name,c.name,vc.* from vouchercode vc left join subject s on vc.subjectid=s.subject_id join class c on c.classid=vc.classid  where isactive=1 and  $where order by $field $order limit $skip, $take");
		return $query->result();
	}

	function parseFilters($filters, $count = 0)
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


	public function count_all_coupon()
	{
		$this->db->select(" * ");
		$this->db->where('isactive', 1);
		$this->db->from('vouchercode');
		$query = $this->db->get();
		return $query->num_rows();
	}



	public function save($id)
	{
		$subjects = $this->input->post('subjectid[]');
		$packages = $this->input->post('package[]');
		$this->db->trans_begin();
		if ($id == null) {
			foreach ($subjects as $sub) {
				foreach ($packages as $pack) {
					$data = array(
						'levelid' => $this->input->post('levelid'),
						'classid' => $this->input->post('classid'),
						'subjectid' => $sub,
						'vouchercode' => $this->input->post('vouchercode'),
						'discountamount' => $this->input->post('discountamount'),
						'packagetype' => $pack,
						'maxlimit' => $this->input->post('limit'),
						'discounttype' => $this->input->post('discounttype'),
						'validtill' => $this->input->post('validity'),
						'isactive' => '1',
						'for_gender' => $this->input->post('forGender'),
						'for_disabled' => $this->input->post('forDisabled'),
					);
					$this->db->insert('vouchercode', $data);
				}
			}
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				throw new Exception("Error Occurred");
			} else {
				$this->db->trans_commit();
				return true;
			}  

		} else {
			$data = array(
				'levelid' => $this->input->post('levelid'),
				'classid' => $this->input->post('classid'),
				'subjectid' => $subjects[0],
				'vouchercode' => $this->input->post('vouchercode'),
				'discountamount' => $this->input->post('discountamount'),
				'packagetype' => $packages[0],
				'maxlimit' => $this->input->post('limit'),
				'discounttype' => $this->input->post('discounttype'),
				'validtill' => $this->input->post('validity'),
				'isactive' => '1',
				'for_gender' => $this->input->post('forGender'),
				'for_disabled' => $this->input->post('forDisabled'),
			);
			$this->db->where('vouchercodeid', $id);
			$update = $this->db->update('vouchercode', $data);
			if ($update) {
				$this->db->trans_commit();
				return true;
			} else {
				return false;
			}

		}


	}

	public
		function delete_coupon(
	) {

		$data = array(
			'isactive' => '0'
		);
		
		$this->db->where_in('vouchercodeid', $this->input->post('id'));
		if ($this->db->update('vouchercode', $data)) {
			return true;
		} else {
			return false;
		}

	}
}
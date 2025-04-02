<?php

class Blogs_model extends CI_Model
{
    public function saveBlog($data)
    {
        $this->db->insert('blogs', $data);
        return $this->db->insert_id();
    }

    public function getAllBlogs($limit = 10, $offset = 0, $sortField = 'blog_id', $sortOrder = 'DESC')
    {
        $this->db->select('*');
        $this->db->from('blogs');
        $this->db->where('is_active', 1);
        $this->db->order_by($sortField, $sortOrder);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    public function countAllBlogs()
    {
        $this->db->where('is_active', 1);
        $this->db->from('blogs');
        return $this->db->count_all_results();
    }

    public function getBlogById($blogId)
    {
        $this->db->select('*');
        $this->db->from('blogs');
        $this->db->where('blog_id', $blogId);
        $query = $this->db->get();
        return $query->row();
    }

    public function updateBlog($blogId, $data)
    {
        $this->db->where('blog_id', $blogId);
        return $this->db->update('blogs', $data);
    }

    public function updateImage($blogId, $fileName)
    {
        $data = [
            'image' => $fileName
        ];
        $this->db->where('blog_id', $blogId);
        return $this->db->update('blogs', $data);
    }

    public function deleteBlog($blogId)
    {
        $this->db->where('blog_id', $blogId);
        return $this->db->update('blogs', ['is_active' => 0]);
    }

    public function parseFilters($filters)
    {
        $where = "1=1";
        if (isset($filters['filters'])) {
            foreach ($filters['filters'] as $filter) {
                if (isset($filter['field'])) {
                    $field = $filter['field'];
                    $value = $this->db->escape_like_str($filter['value']);
                    switch ($filter['operator']) {
                        case 'startswith':
                            $where .= " AND $field LIKE '$value%'";
                            break;
                        case 'contains':
                            $where .= " AND $field LIKE '%$value%'";
                            break;
                        case 'doesnotcontain':
                            $where .= " AND $field NOT LIKE '%$value%'";
                            break;
                        case 'endswith':
                            $where .= " AND $field LIKE '%$value'";
                            break;
                        case 'eq':
                            $where .= " AND $field = '$value'";
                            break;
                        case 'neq':
                            $where .= " AND $field <> '$value'";
                            break;
                        case 'gt':
                            $where .= " AND $field > '$value'";
                            break;
                        case 'lt':
                            $where .= " AND $field < '$value'";
                            break;
                        case 'gte':
                            $where .= " AND $field >= '$value'";
                            break;
                        case 'lte':
                            $where .= " AND $field <= '$value'";
                            break;
                    }
                }
            }
        }
        return $where;
    }
}
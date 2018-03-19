<?php

/**
 * User: Sven Vanderwegen
 * Date: 13/11/2017
 * Time: 13:54
 */

class CPM_Products extends CI_Model{

    public $product_name;

    const TABLE_NAME = "CPM_PRODUCTS";

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function create_entry($product_name)
    {
        $this->product_name = $product_name;
        $this->db->insert(self::TABLE_NAME, $this);
        return $this->read_entry($this->db->insert_id());
    }

    public function update_entry($id, $product_name)
    {
        $this->product_name = $product_name;
        $this->db->set($this);
        $this->db->where("ID", $id);
        $this->db->update(self::TABLE_NAME);
        return $this->read_entry($id);
    }

    public function read_entry($id)
    {
        $this->db->select("ID, PRODUCT_NAME, SECRET_CATEGORY");
        $this->db->from(self::TABLE_NAME);

        $this->db->where("ID", $id);

        return $this->db->get()->row();
    }

    public function read_all()
    {
        $this->db->select("ID, PRODUCT_NAME, SECRET_CATEGORY");
        $this->db->from(self::TABLE_NAME);

        return $this->db->get()->result();
    }

    public function delete_entry($id)
    {
        $this->db->where("ID", $id);
        $this->db->delete(self::TABLE_NAME);
        return $this->db->affected_rows();
    }

}
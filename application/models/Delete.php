<?php
 class Delete extends CI_Model { public function __construct() { parent::__construct(); } public function del_img($imgid){ $sql1 = "DELETE FROM `img_images` WHERE imgid = '$imgid'"; $sql2 = "DELETE FROM `img_imginfo` WHERE imgid = '$imgid'"; $this->db->query($sql1); $this->db->query($sql2); } } ?>
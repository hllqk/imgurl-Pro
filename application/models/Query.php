<?php
 class Query extends CI_Model { public function __construct() { parent::__construct(); } public function domain($storage){ $sql = "SELECT domains FROM img_storage WHERE `engine` = '$storage'"; $query = $this->db->query($sql); if($query){ $row = $query->row(); $domain = $row->domains; return $domain; } else{ return FALSE; } } public function repeat($imgid){ $sql = "SELECT * FROM img_images WHERE `imgid` = '$imgid'"; $query = $this->db->query($sql); if($query){ $row = $query->row(); return $row; } else{ return false; } } public function onepic($imgid){ $sql = "SELECT * FROM img_images WHERE `imgid` = '$imgid'"; $query = $this->db->query($sql); if($query){ $row = $query->row(); return $row; } else{ return false; } } public function img($id){ $id = strip_tags($id); $id = (int)$id; $sql = "SELECT * FROM img_images WHERE `id` = '$id'"; $query = $this->db->query($sql); if($query){ $row = $query->row(); return $row; } else{ return false; } } public function imginfo($imgid){ $sql = "SELECT * FROM img_imginfo WHERE `imgid` = '$imgid'"; $query = $this->db->query($sql); if($query){ $row = $query->row(); return $row; } else{ return false; } } public function userinfo(){ $sql = "SELECT * FROM `img_options` WHERE `name` = 'userinfo' LIMIT 1"; $query = $this->db->query($sql); if($query){ $row = $query->row(); return $row; } else{ return false; } } public function tinypng(){ $sql = "SELECT * FROM `img_options` WHERE `name` = 'tinypng' LIMIT 1"; @$query = $this->db->query($sql); if($query){ $row = $query->row(); return $row; } else{ return FALSE; } } public function site_setting($type = ''){ $sql = "SELECT * FROM img_options WHERE name = 'site_setting' LIMIT 1"; $query = $this->db->query($sql); if($type == '') { if($query){ $row = $query->row(); return $row; } else{ return FALSE; } } else{ if($query){ $row = $query->row(); $row = json_decode($row->values); return $row; } else{ return FALSE; } } } public function siteinfo(){ $sql = "SELECT * FROM img_options WHERE name = 'site_setting' LIMIT 1"; $query = $this->db->query($sql); if($query){ $row = $query->row(); var_dump($row); return $row; } else{ return FALSE; } } public function option($name){ $sql = "SELECT * FROM img_options WHERE name = '$name' LIMIT 1"; $query = $this->db->query($sql); if($query){ $row = $query->row(); return $row; } else{ return FALSE; } } public function uplimit($ip){ $date = date('Y-m-d',time()); $date = $date.'%'; $sql = "select count(*) num from img_images where `ip` = '$ip' AND `user` = 'visitor' AND `date` LIKE '$date'"; $query = $this->db->query($sql); $num = (int)$query->row()->num; $sql = "SELECT * FROM img_options WHERE name = 'uplimit' LIMIT 1"; $query = $this->db->query($sql); $limit = $query->row(); $limit = $limit->values; $limit = json_decode($limit); $limit = $limit->limit; if($num >= $limit){ return FALSE; } else{ return TRUE; } } public function get_uplimit($name = null){ try{ $row = $this->option('uplimit'); $data = json_decode($row->values); if($name == 'max_size'){ return $data->max_size; } else if($name == 'limit'){ return $data->limit; } else{ exit('参数错误！'); } } catch(EXCeption $e){ exit($e->getMessage()); } } public function found($num){ $sql = "SELECT a.id,a.imgid,a.path,a.date,b.mime,b.width,b.height,b.views,b.ext,b.client_name FROM img_images AS a INNER JOIN img_imginfo AS b ON a.imgid = b.imgid AND a.user = 'visitor' AND a.level != 'adult' ORDER BY a.id DESC LIMIT $num"; $query = $this->db->query($sql); $query = $query->result_array(); return $query; } public function storage($name){ $sql = "SELECT * FROM `img_storage` WHERE `engine` = '$name' LIMIT 1"; $query = $this->db->query($sql); if($query){ $row = $query->row(); if($row->switch == 'ON'){ $row->switch = 'checked'; } else if($row->switch == 'OFF'){ $row->switch = ''; } if((int)$row->permission === 1){ $row->permissions->key1 = 'checked'; $row->permissions->key2 = ''; } else if((int)$row->permission === 0){ $row->permissions->key1 = ''; $row->permissions->key2 = 'checked'; } return $row; } else{ return FALSE; } } public function count_num($type){ switch ($type) { case 'admin': $sql = "SELECT count(*) AS num FROM `img_images` WHERE `user` = 'admin'"; break; case 'visitor': $sql = "SELECT count(*) AS num FROM `img_images` WHERE `user` = 'visitor'"; break; case 'dubious': $sql = "SELECT count(*) AS num FROM `img_images` WHERE `level` = 'adult'"; break; case 'day': $date = date('Y-m-d',time()); $sql = "SELECT count(*) AS num FROM `img_images` WHERE date LIKE '{$date}%'"; break; case 'month': $date = date('Y-m',time()); $sql = "SELECT count(*) AS num FROM `img_images` WHERE date LIKE '{$date}%'"; break; case 'gif': $sql = "SELECT count(*) AS num FROM (SELECT a.id,b.ext FROM img_images a INNER JOIN img_imginfo b ON a.imgid = b.imgid AND a.user = 'visitor' AND b.ext = '.gif') AS gif"; break; case 'large': $sql = "SELECT count(*) AS num FROM
                    (
                        SELECT a.id,a.imgid,a.path,a.thumb_path,a.date,a.compression,a.level,b.mime,b.width,b.height,b.views,b.ext,b.client_name 
                        FROM img_images 
                        AS a INNER JOIN img_imginfo AS b 
                        ON a.imgid = b.imgid 
                        AND a.user = 'visitor' 
                        AND a.level = 'everyone' 
                        AND b.width >= 1920 
                        AND b.height >= 1080 
                        ORDER BY a.id DESC
                    ) AS large"; break; case 'localhost': case 'backblaze': case 'cos': case 'qiniu': case 'ftp': $sql = "SELECT count(*) AS num FROM `img_images` WHERE `storage` = '{$type}'"; break; default: break; } $query = $this->db->query($sql); $row = $query->row(); return $row; } public function picinfo($imgid){ $sql = "SELECT a.*,b.* FROM img_images AS a INNER JOIN img_imginfo AS b ON a.imgid = b.imgid AND b.imgid = '$imgid' LIMIT 1"; $query = $this->db->query($sql); $query = $query->row(); return $query; } public function img_id($id){ $id = (int)$id; $sql = "SELECT a.*,b.* FROM img_images AS a INNER JOIN img_imginfo AS b ON a.id = $id AND a.imgid = b.imgid"; $imginfo = $this->db->query($sql)->row(); return $imginfo; } public function found_img($type,$page){ $page = (intval($page) <= 0) ? 1 : $page; $limit = 16; $page = $page / 16; $offset = $page * $limit; $sql_header = "SELECT a.id,a.imgid,a.path,a.thumb_path,a.storage,a.date,
            b.mime,b.width,b.height,b.views,b.ext,b.client_name,b.size 
            FROM img_images AS a 
            INNER JOIN img_imginfo AS b 
            ON a.imgid = b.imgid 
            AND a.user = 'visitor' 
            AND (a.level = 'everyone' OR a.level = 'unknown') "; switch($type){ case 'all': $num = $this->count_num('visitor')->num; $sql = $sql_header."ORDER BY a.id DESC LIMIT $limit OFFSET $offset"; break; case 'gif': $num = $this->count_num('gif')->num; $sql = $sql_header."AND b.ext = '.gif' ORDER BY a.id DESC LIMIT $limit OFFSET $offset"; break; case 'views': $num = $this->count_num('visitor')->num; $sql = $sql_header."ORDER BY b.views DESC LIMIT $limit OFFSET $offset"; break; case 'large': $num = $this->count_num('large')->num; $sql = $sql_header."AND b.width >= 1920 AND b.height >= 1080 ORDER BY a.id DESC LIMIT $limit OFFSET $offset"; break; default: $num = $this->count_num('visitor')->num; $sql = $sql_header."ORDER BY a.id DESC LIMIT $limit OFFSET $offset"; break; } $datas = $this->db->query($sql)->result_array(); return $datas; } public function to23(){ $sqls = array( 'alter table "img_images" ADD "token"  TEXT(16) DEFAULT NULL;', 'CREATE UNIQUE INDEX "token" ON "img_images" ("token" ASC)', 'CREATE UNIQUE INDEX "imginfo_imgid" ON "img_imginfo" ("imgid" ASC)' ); foreach ($sqls as $value) { $datas = $this->db->query($value); } if($datas){ return TRUE; } else{ return FALSE; } } public function get_domain() { $sql = 'SELECT `values` FROM img_options WHERE `name` = "site_url"'; $data = $this->db->query($sql)->row(); if($data){ return $data->values; } else{ return FALSE; } } public function get_token($value){ $sql = "SELECT a.*,b.mime,b.width,b.height,b.views,b.ext,b.client_name FROM img_images AS a INNER JOIN img_imginfo AS b ON a.token = '{$value}' AND a.imgid = b.imgid"; $imginfo = $this->db->query($sql)->row(); return $imginfo; } public function check_storage_status($storage){ $sql = "SELECT `engine`,switch FROM `img_storage` WHERE `engine` = '{$storage}'"; $data = $this->db->query($sql)->row(); if($data->switch == 'ON'){ return TRUE; } else{ return FALSE; } } public function check_storage_permission($storage){ $sql = "SELECT `engine`,permission FROM `img_storage` WHERE `engine` = '{$storage}'"; $data = $this->db->query($sql)->row(); if($data->permission == 1){ return TRUE; } else{ return FALSE; } } public function options($name){ $sql = "SELECT * FROM `img_options` WHERE `name` = '{$name}'"; try{ $data = $this->db->query($sql)->row(); return $data; } catch(Exception $e){ exit($e->getMessage()); } } public function list_storage($type = TRUE){ $type = ($type == TRUE) ? TRUE : FALSE; if( ($type === TRUE) && (isset($_COOKIE['token'])) ){ $sql = "SELECT engine,weight,name FROM `img_storage` WHERE `switch` = 'ON' ORDER BY `weight` DESC"; } else if( ($type === TRUE) && (!isset($_COOKIE['token'])) ){ $sql = "SELECT engine,weight,name FROM `img_storage` WHERE `switch` = 'ON' AND `permission` = 1 ORDER BY `weight` DESC"; } else{ $sql = "SELECT engine,weight,name FROM `img_storage` WHERE ORDER BY `weight` DESC"; } try{ $query = $this->db->query($sql); $result = $query->result(); return $result; } catch(EXCeption $e){ exit($e->getMessage()); } } public function imgid_get_domain($imgid){ $sql = "SELECT domains FROM img_storage WHERE `engine` = (SELECT storage FROM `img_images` WHERE `imgid` = '{$imgid}')"; try{ $query = $this->db->query($sql); $result = $query->row(); return $result; } catch(EXCeption $e){ exit($e->getMessage()); } } public function count_upload($date,$user = ''){ header("Access-Control-Allow-Origin: *"); $count = count($date); $num = array(); for ($i=0; $i < $count; $i++) { switch ($user) { case 'visitor': case 'admin': $sql = "SELECT COUNT(*) AS num FROM img_images WHERE `user` = '{$user}' AND `date` LIKE '{$date[$i]}%'"; break; default: $sql = "SELECT COUNT(*) AS num FROM img_images WHERE `date` LIKE '{$date[$i]}%'"; break; } $query = $this->db->query($sql); $result = $query->row(); $num[$i] = (int)$result->num; } return $num; } public function get_imgid($num = 1000){ $sql = "SELECT imgid FROM `img_images` ORDER BY id DESC LIMIT {$num}"; $result = $this->db->query($sql)->result(); if($result){ return $result; } else{ return NULL; } } public function get_first_storage(){ $sql = "SELECT * FROM `img_storage` WHERE switch = 'ON' ORDER BY weight DESC LIMIT 1"; $result = $this->db->query($sql)->row(); if($result){ return $result; } else{ return NULL; } } public function read_token(){ $sql = "SELECT * FROM `img_options` WHERE `name` = 'token' LIMIT 1"; $result = $this->db->query($sql)->row(); if($result){ return $result; } else{ return NULL; } } } ?>
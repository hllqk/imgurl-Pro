<?php
 defined('BASEPATH') OR exit('No direct script access allowed'); class Deal extends CI_Controller{ public function __construct(){ parent::__construct(); set_time_limit(300); $this->load->database(); } public function compress($id){ $this->load->library('basic'); $this->basic->is_login(TRUE); $id = (int)$id; $sql = "SELECT a.`id`,a.`path`,a.`compression`,b.`mime` FROM img_images AS a INNER JOIN img_imginfo AS b ON a.imgid = b.imgid AND a.id = $id"; $query = $this->db->query($sql); $row = $query->row_array(); $path = FCPATH.$row['path']; if($row['compression'] == 1){ $this->err_msg('此图片已经压缩！'); } if(($row['mime'] != 'image/jpeg') && ($row['mime'] != 'image/png')){ $this->err_msg('此图片类型不支持压缩！'); } $sql = "SELECT * FROM img_options WHERE name = 'tinypng' LIMIT 1"; $row = $this->db->query($sql)->row_array(); if($row['switch'] == 'OFF'){ $this->err_msg('您没有启用压缩功能！'); } $keys = $row['values']; $keys = json_decode($keys, true); $i = 'api'.rand(1, count($keys)); $key = $keys[$i]; $url = "https://api.tinify.com/shrink"; $data = file_get_contents($path); $ch = curl_init(); $user = "api"; curl_setopt($ch, CURLOPT_URL, $url); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); curl_setopt($ch, CURLOPT_USERPWD, "{$user}:{$key}"); curl_setopt($ch, CURLOPT_POST, 1); curl_setopt($ch, CURLOPT_POSTFIELDS, $data); curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); $output = curl_exec($ch); curl_close($ch); $output = json_decode($output); $outurl = $output->output->url; if(!filter_var($outurl, FILTER_VALIDATE_URL)){ $this->err_msg('请求接口失败！'); } $curl = curl_init($outurl); curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36"); curl_setopt($curl, CURLOPT_FAILONERROR, true); curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); $data = curl_exec($curl); curl_close($curl); file_put_contents($path,$data); $sql = "UPDATE img_images SET compression = 1 WHERE `id` = $id"; if($this->db->query($sql)){ $this->suc_msg('压缩完成！'); } } public function identify($id){ header("Access-Control-Allow-Origin: *"); $id = (int)$id; $this->load->model('query','',TRUE); $re = $this->query->img($id); $storage = $re->storage; $sql = "SELECT a.id,a.path,a.level,b.domains FROM img_images AS a INNER JOIN img_storage AS b ON b.engine = '{$storage}' AND a.id = $id"; $query = $this->db->query($sql); $row = $query->row_array(); $imgurl = $row['domains'].$row['path']; if(($row['level'] != 'unknown') && ($row['level'] != NULL)){ $this->err_msg('此图片已经识别过！'); } $sql = "SELECT * FROM img_options WHERE name = 'moderate' LIMIT 1"; $row = $this->db->query($sql)->row_array(); if($row['switch'] == 'OFF'){ $this->err_msg('未启用图片鉴黄识别！'); } $apiurl = "https://www.moderatecontent.com/api/v2?key=".$row['values']."&url=".$imgurl; $curl = curl_init($apiurl); curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36"); curl_setopt($curl, CURLOPT_FAILONERROR, true); curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); $html = curl_exec($curl); curl_close($curl); $html = json_decode($html); @$level = $html->rating_label; @$error_code = (int)$html->error_code; $sql = "UPDATE img_images SET level = '$level' WHERE `id` = $id"; if($error_code === 0){ $this->db->query($sql); if($level == 'adult'){ $arr = array( "code" => 400, "msg" => '您的IP已记录，请不要上传违规图片！' ); $arr = json_encode($arr); if( isset($_COOKIE['dubious']) ){ $num = intval($_COOKIE['dubious']); $num++; setcookie("dubious", $num, time()+3 * 24 * 60 * 60,"/"); } else{ setcookie("dubious", 1, time()+3 * 24 * 60 * 60,"/"); } echo $arr; } else{ $this->suc_msg('识别完成！'); } } else{ $this->err_msg('识别失败！'); } } public function identify_more(){ $sql = "SELECT * FROM img_images WHERE (`level` = 'unknown') OR (`level` = NULL) ORDER BY `id` DESC LIMIT 5"; $query = $this->db->query($sql); $result = $query->result(); foreach($result as $row){ $this->identify($row->id); } } protected function err_msg($msg){ $arr = array( "code" => 0, "msg" => $msg ); $arr = json_encode($arr); echo $arr; exit; } protected function suc_msg($msg){ $arr = array( "code" => 200, "msg" => $msg ); $arr = json_encode($arr); echo $arr; } public function resetpass(){ $password1 = $this->input->post('password1', TRUE); $password2 = $this->input->post('password2', TRUE); $pass_txt = FCPATH."data/password.txt"; if(!file_exists($pass_txt)){ $this->err_msg("没有权限，请参考帮助文档操作！"); } else{ $pattern = '/^[a-zA-Z0-9!@#$%^&*.]+$/'; if($password1 != $password2){ $this->err_msg("两次密码不一致！"); } else if(!preg_match($pattern,$password2)){ $this->err_msg("密码格式有误！"); exit; } else{ $password = md5($password2.'imgurl'); $this->load->model('query','',TRUE); $this->load->model('update','',TRUE); $userinfo = $this->query->userinfo()->values; $userinfo = json_decode($userinfo); $userinfo->password = $password; $values = json_encode($userinfo); if($this->update->password($values)){ unlink($pass_txt); $this->suc_msg("密码已重置，请重新登录。"); } else{ $this->err_msg("更新失败，未知错误！"); } } } } } ?>
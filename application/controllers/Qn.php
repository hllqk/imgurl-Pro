<?php
 ini_set("max_execution_time", "300"); header("Access-Control-Allow-Origin: *"); defined('BASEPATH') OR exit('No direct script access allowed'); class Qn extends CI_Controller{ protected $temp; protected $qiniu_domain; public function __construct(){ parent::__construct(); $this->load->helper('basic'); ip_block(); $this->load->library('qiniu'); $this->temp = FCPATH.'data/temp/'; $this->load->library('up_deal'); $this->load->model('query','',TRUE); $this->qiniu_domain = $this->query->domain('qiniu'); $this->load->library('basic'); $this->basic->cookie_ban(); } public function upload(){ $config = $this->up_deal->config($this->temp); $this->load->library('upload', $config); $this->up_deal->check_storage_status('qiniu'); $starts = $this->up_deal->up_start(); if ( ! $this->upload->do_upload('file')) { $msg = $this->upload->display_errors(); $msg = strip_tags($msg); $this->up_deal->error_msg($msg); } else { $data = $this->upload->data(); $full_path = $data['full_path']; $mime = $data['file_type']; $imgid = md5_file($full_path); $imgid = substr($imgid,8,16); $new_path = $this->temp.$imgid.$data['file_ext']; $qiniu_path = $starts['up_path'].$imgid.$data['file_ext']; $full_thumb_path = $this->temp.'/'.$imgid.'_thumb'.$data['file_ext']; $qiniu_thumb_path = $starts['up_path'].$imgid.'_thumb'.$data['file_ext']; rename($full_path,$new_path); $full_path = $new_path; $this->load->library('image'); if(!$this->image->thumbnail($full_path,290,175)){ $qiniu_thumb_path = $qiniu_path; } if( $data['file_type'] === 'image/x-ms-bmp' ){ $tmpinfo = getimagesize($full_path); $data['image_width'] = $tmpinfo[0]; $data['image_height'] = $tmpinfo[1]; } if($data['file_type'] === 'image/webp'){ $data['image_width'] = 0; $data['image_height'] = 0; } $this->load->model('insert','',TRUE); $info = $this->up_deal->check_repeat($imgid,$data); if($info){ $this->up_deal->clean_temp($new_path,$full_thumb_path); $info = json_encode($info); exit($info); } $re_one = $this->qiniu->upload($full_path,$qiniu_path); if( stristr($re_one,'hash') ){ $re_one = TRUE; } else if( stristr($re_one,'error') ){ $re_one = FALSE; } if($qiniu_path != $qiniu_thumb_path){ $re_two = $this->qiniu->upload($full_thumb_path,$qiniu_thumb_path); if( stristr($re_two,'hash') ){ $re_two = TRUE; } else if( stristr($re_two,'error') ){ $re_two = FALSE; } } else{ $re_two = TRUE; } if( ! $re_one OR ! $re_two){ $this->up_deal->clean_temp($new_path,$full_thumb_path); $this->up_deal->error_msg('请求接口失败！'); } $others = array( "size" => $data['file_size'] ); $others = json_encode($others); $token = $this->up_deal->token($starts); $delete = $this->basic->domain().'/delete/'.$token; $datas = array( "imgid" => $imgid, "path" => $qiniu_path, "thumb_path"=> $qiniu_thumb_path, "storage" => "qiniu", "ip" => get_ip(), "ua" => get_ua(), "date" => $starts['date'], "user" => $starts['user'], "level" => 'unknown', "token" => $token ); $imginfo = array( "imgid" => $imgid, "mime" => $mime, "width" => $data['image_width'], "height" => $data['image_height'], "ext" => $data['file_ext'], "client_name" => $data['client_name'], "size" => $data['file_size'] ); $id = $this->insert->images($datas); $imginfo = $this->insert->imginfo($imginfo); $this->up_deal->clean_temp($new_path,$full_thumb_path); if($id && $imginfo) { $info = array( "code" => 200, "id" => $id, "imgid" => $imgid, "relative_path" => $qiniu_path, "url" => $this->qiniu_domain.$qiniu_path, "thumbnail_url" => $this->qiniu_domain.$qiniu_thumb_path, "width" => $data['image_width'], "height" => $data['image_height'], "delete" => $delete ); $info = json_encode($info); exit($info); } } } public function delete(){ $re = $this->qiniu->delete('banner-pc-ok_600.jpg'); var_dump($re); exit; } }
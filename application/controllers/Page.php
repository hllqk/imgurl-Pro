<?php
 defined('BASEPATH') OR exit('No direct script access allowed'); class Page extends CI_Controller{ public function _remap($name){ $name = strip_tags($name); $pagefile = FCPATH.'data/pages/'.$name.'.md'; $pagefile = str_replace('\\','/',$pagefile); if(!is_file($pagefile)){ show_404(); } $content = file_get_contents($pagefile); $this->load->library("parsedown"); $content = $this->parsedown->text($content); $pattern = '/<h1>(.*)<\/h1>/'; preg_match($pattern,$content,$arr); $description = mb_substr($content, 0, 180,'utf-8'); $description = str_replace('#','',$description); $description = strip_tags($description); $description = trim($description); $this->load->model('query','',TRUE); $data = $this->query->site_setting('1'); $data->content = $content; $data->title = $arr[1]; $data->description = $description; $this->load->model('query','',TRUE); $data->footer = $this->query->options('footer')->values; $this->load->view('/user/header',$data); $this->load->view('/user/page',$data); $this->load->view('/user/footer'); } } ?>
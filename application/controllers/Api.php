<?php
 defined('BASEPATH') OR exit('No direct script access allowed'); class Api extends CI_Controller{ public function found($type = 'all'){ header("Access-Control-Allow-Origin: *"); header('Content-Type:application/json; charset=utf-8'); $this->load->model('query','',TRUE); $datas = $this->query->found_img($type,1); $json = json_encode($datas); echo $json; } public function number($type = 'week'){ @$user = $this->input->get('user',TRUE); $user = isset($user) ? $user : 'all'; switch ($type) { case 'week': $date[0] = date('Y-m-d',strtotime('-6 day')); $date[1] = date('Y-m-d',strtotime('-5 day')); $date[2] = date('Y-m-d',strtotime('-4 day')); $date[3] = date('Y-m-d',strtotime('-3 day')); $date[4] = date('Y-m-d',strtotime('-2 day')); $date[5] = date('Y-m-d',strtotime('-1 day')); $date[6] = date('Y-m-d',time()); break; case 'year': $date[0] = date('Y-m',strtotime('first day of -11 month')); $date[1] = date('Y-m',strtotime('first day of -10 month')); $date[2] = date('Y-m',strtotime('first day of -9 month')); $date[3] = date('Y-m',strtotime('first day of -8 month')); $date[4] = date('Y-m',strtotime('first day of -7 month')); $date[5] = date('Y-m',strtotime('first day of -6 month')); $date[6] = date('Y-m',strtotime('first day of -5 month')); $date[7] = date('Y-m',strtotime('first day of -4 month')); $date[8] = date('Y-m',strtotime('first day of -3 month')); $date[9] = date('Y-m',strtotime('first day of -2 month')); $date[10] = date('Y-m',strtotime('first day of -1 month')); $date[11] = date('Y-m',time()); break; default: break; } $this->load->model('query','',TRUE); $num = $this->query->count_upload($date,$user); $datas = [ "code" => 200, "date" => $date, "num" => $num ]; exit(json_encode($datas)); } } ?>
<?php
 defined('BASEPATH') OR exit('No direct script access allowed'); class User extends CI_Controller{ public function __construct(){ parent::__construct(); $this->load->helper('basic'); } public function login(){ $this->load->library('basic'); if($this->basic->is_login(FALSE)){ header("location:/admin/"); } $this->load->model('query','',TRUE); $siteinfo = $this->query->site_setting('1'); $siteinfo->title = '管理员登录 - '.$siteinfo->title; $siteinfo->footer = $this->query->options('footer')->values;; $this->load->view('user/header',$siteinfo); $this->load->view('user/login'); $this->load->view('user/footer'); } public function verify(){ $user = $this->input->post('user',TRUE); $pass = $this->input->post('password',TRUE); $pass = md5($pass.'imgurl'); $this->load->model("query",'',TRUE); $info = $this->query->userinfo()->values; $info = json_decode($info); $username = $info->username; $password = $info->password; if(($user == $username) && ($pass == $password)){ $token = token($username,$password); setcookie("user", $username, time()+ 7 * 24 * 60 * 60,"/"); setcookie("token", $token, time()+ 7 * 24 * 60 * 60,"/"); $data = array( "code" => 200, "msg" => '登录成功！' ); $data = json_encode($data); echo $data; exit; } else{ $this->err_msg('用户名或密码不正确'); $this->clean_cookies(); exit; } } public function logout(){ echo '您已退出，将在3s后返回首页！'; $this->clean_cookies(); header("Refresh:3;url=/"); exit; } protected function clean_cookies(){ setcookie("user", '', time()-3600,"/"); setcookie("token", '', time()-3600,"/"); } protected function err_msg($msg){ $data = array( "code" => 0, "msg" => $msg ); $data = json_encode($data); echo $data; } public function resetpass(){ $this->load->model('query','',TRUE); $siteinfo = $this->query->site_setting('1'); $siteinfo->title = '重置密码 - '.$siteinfo->title; $userinfo = $this->query->userinfo()->values; $userinfo = json_decode($userinfo); $siteinfo->username = $userinfo->username; $pass_txt = FCPATH."data/password.txt"; if(!file_exists($pass_txt)){ echo "没有权限，请参考帮助文档重置密码！"; } else{ $this->load->view('user/header.php',$siteinfo); $this->load->view('user/resetpass.php'); $this->load->view('user/footer.php'); } } } ?>
<?php
 defined('BASEPATH') OR exit('No direct script access allowed'); class Image{ protected $CI; public function __construct(){ $this->CI = & get_instance(); } public function thumbnail($source,$width,$height){ $source = str_replace("\\","/",$source); $imgarr = explode("/",$source); $imginfo = getimagesize($source); $img_w = $imginfo[0]; $img_h = $imginfo[1]; $mime = $imginfo['mime']; $filename = end($imgarr); $imgname = explode(".",$filename); $thumbnail_name = $imgname[0].'_thumb'.'.'.$imgname[1]; $dirname = dirname($source); $thumbnail_full = $dirname.'/'.$thumbnail_name; if(($img_w > $width) || ($img_h > $height)){ if(($mime === 'image/webp') OR ($mime === 'image/svg+xml') OR ($mime === 'image/x-ms-bmp')){ return FALSE; } elseif($this->check()){ $image = new Imagick($source); $image->cropThumbnailImage( $width, $height ); $image->writeImage( $thumbnail_full ); $image->clear(); return TRUE; } else{ $config['image_library'] = 'gd2'; $config['source_image'] = $source; $config['create_thumb'] = TRUE; $config['maintain_ratio'] = TRUE; $config['width'] = $width; $config['height'] = $height; $this->CI->load->library('image_lib', $config); $this->CI->image_lib->resize(); return TRUE; } } else{ return FALSE; } } protected function check(){ $ext = get_loaded_extensions(); if(array_search('imagick',$ext)){ return TRUE; } else{ return FALSE; } } public function compress($source){ } } ?>
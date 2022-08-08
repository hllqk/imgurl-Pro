<?php
/**
 * 全局配置文件
*/

/*-------------------------------------ImgURL授权密钥，请前往:购买，买你妈，傻逼-------------------------------------*/
$config['key']	=	'550572946f10c731ff80df16c2ff9f15';

/*-------------------------------------SMTP信息，暂时用不着，保留用-------------------------------------*/
//邮件发送协议，默认不用修改
$config['smtp']['protocol']	=	'smtp';
//SMTP 服务器地址
$config['smtp']['smtp_host']	=	'';
//SMTP 用户名
$config['smtp']['smtp_user']	=	'';
//SMTP 密码
$config['smtp']['smtp_pass']	=	'';
//SMTP 端口
$config['smtp']['smtp_port']	=	'';
//SMTP 加密方式,tls或ssl
$config['smtp']['smtp_crypto']	=	'ssl';
//不用管
$config['smtp']['crlf']	=	'\r\n';
//不用管
$config['smtp']['newline']	=	'\r\n';
//不用管
$config['smtp']['mailtype']	=	'html';


/*-------------------------------------B2存储设置-------------------------------------*/
//请先阅读帮助文档：https://dwz.ovh/5
//保留参数，不用理会
$config['b2']['status']	=	'ON';
//B2 keyID
$config['b2']['b2_app_key_id']	=	'';
//B2主程序密钥
$config['b2']['b2_app_key']	=	'';
//B2 bucket ID
$config['b2']['b2_bucket_id']	=	'';
//B2绑定域名，不需要设置
$config['b2']['b2_domain']	=	'';
/*-------------------------------------B2存储设置END-------------------------------------*/


/*-------------------------------------FTP设置-------------------------------------*/
//请先阅读帮助文档：https://dwz.ovh/6
//FTP主机名（连接地址）
$config['ftp']['hostname']	=	'';
//FTP用户名
$config['ftp']['username']	=	'';
//FTP密码
$config['ftp']['password']	=	'';
//FTP端口，一般保持默认不用修改
$config['ftp']['port']	=	21;
//FTP传输模式，TRUE:被动模式，FALSE:主动模式
$config['ftp']['passive']	=	TRUE;
//DEBUG模式
$config['ftp']['debug']    = FALSE;
/*-------------------------------------FTP设置END-------------------------------------*/


/*-------------------------------------腾讯COS设置-------------------------------------*/
//请先阅读帮助文档：https://dwz.ovh/7
$config['cos']['app_id']	=	'';
$config['cos']['access_key_id']	=	'';
$config['cos']['access_key_secret']	=	'';
$config['cos']['bucket']	=	'';
//腾讯COS可用地域，示例地址：cos.ap-guangzhou.myqcloud.com，更多参见：https://cloud.tencent.com/document/product/436/6224
$config['cos']['host']	=	'';
//COS所绑定的域名，不需要设置
$config['cos']['domain']	=	'https://backup-1251029189.cos.ap-guangzhou.myqcloud.com/';
/*-------------------------------------腾讯COS设置END-------------------------------------*/

/*-------------------------------------七牛云设置-------------------------------------*/
//请先阅读帮助文档：https://dwz.ovh/a
$config['qiniu']['AccessKey']	=	'';
$config['qiniu']['SecretKey']	=	'';
$config['qiniu']['bucket']	=	'';
//上传地址,参见：https://developer.qiniu.com/kodo/manual/1671/region-endpoint
$config['qiniu']['up_host']	=	'';
/*-------------------------------------七牛云设置END-------------------------------------*/
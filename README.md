# ImgURL Pro专业图床和相册程序-支持图片压缩,鉴黄和FTP,腾讯云COS等第三方存储
imgurl Pro免授权版  
ImgURL是一款开源图床程序，首个版本诞生于2017年12月，经过重构 + 多个版本更新，目前已经稳定，现在正式发布ImgURL Pro专业版图床程序，满足更多用户需要。同时ImgURL社区版（开源版）将继续维护，但是功能有别于专业版，根据自己的需要选择即可。  
## 声明:此源码确实是少了文件，精简版，删除修改了一些不必要的lj  
帮助文档:https://doc.xiaoz.me/books/imgurl-pro  

著作权归作者所有。
商业转载请联系作者获得授权,非商业转载请注明出处。
原文: http://www.shui.tk/2022/08/04/imgurl+Pro.html
专业版功能 以解锁  
支持拽拖上传、多图上传、Ctrl + V粘贴上传、URL上传  
支持图片裁剪，自动生成缩略图  
限制访客上传数量/限制上传大小  
图片压缩  
图片鉴黄  
API支持  
无广告  
自定义底部版权  
IP黑名单  
多个外部存储（本地、Backblaze B2、腾讯COS、FTP、S3协议存储） 
永久更新 + 有限的技术支持  
变化  
这次需要特别说明的支持多个外部存储，目前已经支持本地、Backblaze B2、腾讯COS、FTP等存储方式，后期将增加更多，这些存储功能可以在后台按需启用。  
Pro版本继承了社区版所有功能，去除了顶部无关紧要的菜单，去除了广告，同时底部的版权也可以通过后台自定义
后台选项做减法，功能做加法，Pro版本将多项设置合为一个页面，登录后台即可看到所有的选项，设置选项一目了然。  

考虑到后期扩展和数据量的问题，Pro版已经支持MySQL数据库，相比社区版SQLite数据库，性能有明显的提升。  

功能对比  
功能	专业版	社区版  
外部存储	本地、B2、腾讯COS、FTP、七牛云、S3	仅本地  
广告	无	有  
自定义版权	支持	不支持  
数据库	MySQL	SQLite3  
上传方式	选择、多图、拽拖、粘贴、URL上传	选择、多图、拽拖、粘贴、URL上传  
多用户支持	是	否  
API支持	是	是  
更新周期	长期	不定期  
技术支持	6个月	无 
一些个人建议  
如果仅是个人或内部使用一般社区版即可满足需要，若您需要多个外部存储，同时需要开放给其它用户使用，建议选择专业版。专业版使用MySQL数据库，性能更好，功能也更加丰富和完善，总之根据需要选择自己合适的方案即可。

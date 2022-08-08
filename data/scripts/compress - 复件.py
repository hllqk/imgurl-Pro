#!/usr/bin/python
# -*- coding: utf-8 -*-
#####	name: 图片批量压缩		#####
#####	author: xiaoz.me		#####
##### 	update: 2018-03-13		#####

import sqlite3
import os


#图片根目录
global imgpath
#设置图片绝对路径
imgpath = '/data/wwwroot/test.imgurl.org'
conn = sqlite3.connect(imgpath + "/data/imgurl.db3")


c = conn.cursor()
#查询10张没有压缩的图片
imgs = c.execute("SELECT imgid FROM img_images WHERE ip = '112.10.160.129'")


#遍历输出
for row in imgs:
	sql = "DELETE FROM img_images WHERE imgid = " + row;
	sql2 = "DELETE FROM img_imginfo WHERE imgid = " + row;
	conn.execute(sql)
	conn.execute(sql1)
#关闭数据库连接	
conn.close()

<script src = 'https://libs.xiaoz.top/echarts/echarts.min.js'></script>
<div class="layui-container" style = "margin-top:2em;">
	<div class="layui-col-lg12">
		<div class="setting-msg">您正在使用ImgURL Pro，使用之前请先阅读 <a href="https://dwz.ovh/2" target = "_blank" rel = "nofollow">帮助文档</a>，如需技术支持，请联系<em>support@imgurl.org</em></div>
	</div>
	<div class="layui-row layui-col-space20">
		<div class="layui-col-lg3">
			<div class = "analyze">
				<h3><i class="fa fa-upload"></i> 累计上传</h3>
				<p><?php echo $num; ?>张</p>
			</div>
		</div>
		<div class="layui-col-lg3">
			<div class = "analyze">
				<h3><i class="fa fa-upload"></i> 本地上传</h3>
				<p><?php echo $localhost; ?>张</p>
			</div>
		</div>
		<div class="layui-col-lg3">
			<div class = "analyze">
				<h3><i class="fa fa-user-plus"></i> 管理员累积上传</h3>
				<p><?php echo $admin; ?>张</p>
			</div>
		</div>
		<div class="layui-col-lg3">
			<div class = "analyze">
				<h3><i class="fa fa-user-o"></i> 游客累积上传</h3>
				<p><?php echo $visitor; ?>张</p>
			</div>
		</div>
		<div class="layui-col-lg3">
			<div class = "analyze">
				<h3><i class="fa fa-question"></i> 可疑图片</h3>
				<p><?php echo $dubious; ?>张</p>
			</div>
		</div>
		<div class="layui-col-lg3">
			<div class = "analyze">
				<h3><i class="fa fa-calendar-check-o"></i> 本月上传</h3>
				<p><?php echo $month; ?>张</p>
			</div>
		</div>
		<div class="layui-col-lg3">
			<div class = "analyze">
				<h3><i class="fa fa-calendar-plus-o"></i> 今日上传</h3>
				<p><?php echo $day; ?>张</p>
			</div>
		</div>
		<div class="layui-col-lg3">
			<div class = "analyze">
				<h3><i class="fa fa-comments"></i> 社区支持</h3>
				<p><a href="https://dwz.ovh/imgurl2" target = "_blank" title = "ImgURL社区支持">https://ttt.sh/</a></p>
			</div>
		</div>
		<!--<div class="layui-col-lg3">
			<div class = "analyze">
				<h3><i class="fa fa-github"></i> 源码下载</h3>
				<p><a href="https://github.com/helloxz/imgurl" target = "_blank">https://github.com/</a></p>
			</div>
		</div>-->
		<div class="layui-col-lg3">
			<div class = "analyze">
				<h3><i class="fa fa-paypal"></i> 打赏你妈</h3>
				<p><a href="shui.tk" target = "_blank">打赏个屁</p>
			</div>
		</div>
		<!--<div class="layui-col-lg3">
			<div class = "analyze">
				<h3><i class="fa fa-qq"></i> 技术支持</h3>
				<p>QQ:<a href = "http://wpa.qq.com/msgrd?v=3&uin=&site=qq&menu=yes" rel = "nofollow" target = "_blank" title = "联系你妈作者，傻逼">联系你妈作者</a></p>
			</div>
		</div>-->
		<div class="layui-col-lg3">
			<div class = "analyze">
				<h3><i class="fa fa-qq"></i> QQ交流你妈</h3>
				<p><a href = "//shang.qq.com/wpa/qunwpa?idkey=1994c352ea864ed09a00fd3cfb0f80c946850a70e98551736be69f4253f09136" rel = "nofollow" target = "_blank" title = "加入ImgURL交流群，和大家一起讨论。">交流你妈</a></p>
			</div>
		</div>
	</div>

	<div class="layui-row">
		<!-- 表格数据 -->
		<div class="layui-col-lg12" style = "border:1px solid #eeeeee;margin-top:1em;">
			<div id="count_upload" style="width: 100%;height:360px;"></div>
		</div>
		<!-- 表格数据END -->
		<!-- 静态表格显示系统信息 -->
		<div class="layui-col-lg6">
			<table class="layui-table">
			<colgroup>
				<col width="130">
				<col>
				<col>
			</colgroup>
			<thead>
				<tr>
				<th>名称</th>
				<th>信息</th>
				</tr> 
			</thead>
			<tbody>
				<tr>
					<td>操作系统</td>
					<td><?php echo $os; ?></td>
				</tr>
				<tr>
					<td>WEB环境</td>
					<td><?php echo $web; ?></td>
				</tr>
				<tr>
					<td>PHP版本</td>
					<td><?php echo $php_version; ?></td>
				</tr>
				<tr>
					<td>最大上传限制</td>
					<td><?php echo $max_size; ?></td>
				</tr>
				<tr>
					<td>内存占用</td>
					<td><?php echo $this->benchmark->memory_usage();?></td>
				</tr>
				<tr>
					<td>ImgURL版本号</td>
					<td><?php echo $imgurl_version; ?></td>
				</tr>
				<tr>
					<td>FTP组件</td>
					<td><?php echo $ftp; ?></td>
				</tr>
			</tbody>
			</table>
		</div>
		<!-- 静态表格 -->
	</div>
	
</div>
<script>
	//同步获取接口数据
	$.ajax({url:"/api/number?user=visitor",async:false,success:function(data){
		var info = JSON.parse(data);
		date = info.date;
		visitor = info.num;
	}})
	$.ajax({url:"/api/number?user=admin",async:false,success:function(data){
		var info = JSON.parse(data);
		admin = info.num;
	}})
	all = $.ajax({url:"/api/number",async:false,success:function(data){
		var info = JSON.parse(data);
		all_num = info.num;
	}})
	myChart = echarts.init(document.getElementById('count_upload'),'light');
	option = {
		title: {
			text: '上传数量统计'
		},
		tooltip: {
			trigger: 'axis'
		},
		legend: {
			data:['上传总数','游客上传','管理员上传']
		},
		// grid: {
		// 	left: '3%',
		// 	right: '4%',
		// 	bottom: '3%',
		// 	containLabel: true
		// },
		toolbox: {
			feature: {
				saveAsImage: {}
			}
		},
		xAxis: {
			type: 'category',
			boundaryGap: false,
			data: date
		},
		yAxis: {
			type: 'value'
		},
		series: [
			{
				name:'上传总数',
				type:'line',
				//stack: '总量',
				data:all_num
			},
			{
				name:'游客上传',
				type:'line',
				//stack: '总量',
				data:visitor
			},
			{
				name:'管理员上传',
				type:'line',
				//stack: '总量',
				data:admin
			}
		]
	};
	myChart.setOption(option);
</script>

  
 
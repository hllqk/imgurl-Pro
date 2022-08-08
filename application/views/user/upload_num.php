<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ImgURL上传数量统计</title>
    <!-- 引入 echarts.js -->
    <script src = 'https://libs.xiaoz.top/jquery/2.2.4/jquery.min.js'></script>
    <script src = 'https://libs.xiaoz.top/echarts/echarts.min.js'></script>
</head>
<body>
    <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
    <div id="week" style="width: 800px;height:400px;"></div>
    <div id="year" style="width: 980px;height:400px;"></div>
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        myChart = echarts.init(document.getElementById('week'),'light');

        // 指定图表的配置项和数据
        $.ajax({url:"/api/number",async:false,success:function(data){
			var info = JSON.parse(data);
	        var option = {
	            title: {
	                text: '最近7天'
	            },
	            tooltip: {},
	            legend: {
	                data:['上传数量']
	            },
	            xAxis: {
	                data: info.date
	            },
	            yAxis: {},
	            series: [{
	                name: '上传数量',
	                type: 'bar',
	                data: info.num
	            }]
	        };
	        // 使用刚指定的配置项和数据显示图表。
        	myChart.setOption(option);
	    }});

		myChart = echarts.init(document.getElementById('year'),'light');
        // 指定图表的配置项和数据
        $.ajax({url:"/api/number/year",async:false,success:function(data){
			var info = JSON.parse(data);
	        var option = {
	            title: {
	                text: '最近1年'
	            },
	            tooltip: {},
	            legend: {
	                data:['上传数量']
	            },
	            xAxis: {
	                data: info.date
	            },
	            yAxis: {},
	            series: [{
	                name: '上传数量',
	                type: 'bar',
	                data: info.num
	            }]
	        };
	        // 使用刚指定的配置项和数据显示图表。
        	myChart.setOption(option);
	    }});
    </script>
</body>
</html>
<div class="layui-container setting">
	<div class="layui-row">
		<div class="layui-col-lg12">
			<div class="setting-msg">
				<p><em>1. 在下方可设置IP黑名单，一行一个</em></p>
				<p><em>2. 支持单个IP： <code>192.168.50.1</code> 或IP段： <code>192.168.50.</code></em></p>
			</div>
		</div>
		<div class="layui-col-lg12">
			<div id="site">
			<form class="layui-form" method = "post">
				<div style = "font-weight:bold;margin-bottom:1em;">请输入IP，一行一个，换行分隔。</div>
				<textarea name="ips" required placeholder="请在下方输入IP，一行一个，换行分隔。" class="layui-textarea" rows="26"><?php echo $ips; ?></textarea>
				<div>
					<button  style = "margin-top:1em;" class="layui-btn" lay-submit lay-filter="saveIP">保存</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="layui-container setting">
	<div class="layui-row">
		<div class="layui-col-lg12">
			<div class="setting-msg">
				<p>1. 上传数量如果为0则不允许游客上传</em></p>
				<p>2. 上传大小最大允许为10(Mb)</em></p>
			</div>
		</div>
		<div class="layui-col-lg4">
			<div id="site">
			<form class="layui-form" method = "post">
				<div class="layui-form-item">
					<label class="layui-form-label">游客上传</label>
					<div class="layui-input-block">
						<input type="checkbox" lay-filter="upswitch" name="switch" lay-skin="switch" <?php echo $switch;?>>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">上传数量</label>
					<div class="layui-input-block">
					<input type="text" id = "limit" name="limit" required  lay-verify="required|number" placeholder="指的是游客每日上传数量" autocomplete="off" class="layui-input" value = "<?php echo $limit; ?>">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">上传大小</label>
					<div class="layui-input-block">
					<input type="text" name="max_size" required  lay-verify="required|number" placeholder="后端上传大小，单位为Mb" autocomplete="off" class="layui-input" value = "<?php echo $max_size; ?>">
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-input-block">
					<button class="layui-btn" lay-submit lay-filter="formuplimit">保存</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
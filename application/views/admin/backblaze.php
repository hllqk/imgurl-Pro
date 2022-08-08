<div class="layui-container site">
	<div class="layui-row">
        <div class="layui-col-lg12">
            <div class="setting-msg">
				请在下方填写Backblaze B2域名，注意末尾有一个斜杠(/)，若不清楚，请参考帮助文档。
			</div>
        </div>
		<div class="layui-col-lg6">
			<div id="site">
			<form class="layui-form" action="/set/storage/backblaze" method = "post">
				<div class="layui-form-item">
					<label class="layui-form-label">绑定域名</label>
					<div class="layui-input-block">
					<input type="text" name="domain" value = "<?php echo $domains; ?>" required  lay-verify="required|url" placeholder="请输入绑定域名" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">允许上传</label>
					<div class="layui-input-block">
						<input type="checkbox" lay-filter="upswitch" name="switch" lay-skin="switch" <?php echo $b2['switch']; ?>><div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em></em><i></i></div>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-input-block">
					<button class="layui-btn" lay-submit lay-filter="formlocalhost">保存</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
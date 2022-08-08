<div class="layui-container setting">
	<div class="layui-row">
		<div class="layui-col-lg12">
			<div class="setting-msg">
				<p><em>1. token主要是提供给开发者使用</em></p>
				<p><em>2. 如果上传接口传递了token，视为管理员上传，不限制上传数量。</em></p>
				<p><em>3. 如果API接口没有传递token，视为游客上传，上传数量将受到限制。</em></p>
                <p><em>4. API使用说明请参考：<a href="https://dwz.ovh/b" rel = "nofollow" target="_blank">https://dwz.ovh/b</a></em></p>
			</div>
		</div>
		<div class="layui-col-lg4">
			<div id="site">
			<form class="layui-form" method = "post">
				<div class="layui-form-item">
					<label class="layui-form-label">当前token</label>
					<div class="layui-input-block">
					<input type="text" name="token" id = "token" required  readonly placeholder="如果为空，请点击下方更换按钮生成" autocomplete="off" class="layui-input" value = "<?php echo $token->values; ?>">
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">状态</label>
					<div class="layui-input-block">
						<input type="checkbox" lay-filter="token_status" name="switch" lay-text="开启|关闭" id = "token_status" lay-skin="switch" <?php echo $token->switch;?>>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-input-block">
						<button class="layui-btn" lay-submit lay-filter="chgToken">更换token</button>
						<button class="layui-btn" lay-submit lay-filter="saveToken">保存状态</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
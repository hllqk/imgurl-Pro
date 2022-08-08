<div class="layui-container site">
	<div class="layui-row">
		<div class="layui-col-lg12">
			<div class="setting-msg">
				<p>1. 图片压缩使用 <a href="https://tinypng.com/" rel = "nofollow" target = "_blank">TinyPNG</a> 提供的接口，需要同时设置2个API KEY，详细说明请查看<a href="https://dwz.ovh/4" target = "_blank" rel = "nofollow">帮助文档</a></p>
				<p>2. 图片鉴黄使用Moderate Content提供的接口，详细说明请参考<a href="https://dwz.ovh/4" rel = "nofollow" target = "_blank">帮助文档</a></p>
			</div>
		</div>
		<div class="layui-col-lg12">
			<!--新建一个选显卡-->
			<div class="layui-tab layui-tab-brief">
			  <ul class="layui-tab-title">
			    <li class="layui-this">图片压缩</li>
			    <li>图片鉴黄</li>
			    <li>图片水印</li>
			  </ul>
			  <div class="layui-tab-content">
				  <!--图片压缩-->
			    <div class="layui-tab-item layui-show">
				    <div id="site" class = "site layui-col-lg6">
					<form class="layui-form" method = "post">
						<div class="layui-form-item">
							<label class="layui-form-label">API key 1</label>
							<div class="layui-input-block">
							<input type="text" name="api1" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input" value = "<?php echo @$tinypng['values']->api1; ?>">
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">API key 2</label>
							<div class="layui-input-block">
							<input type="text" name="api2" lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input" value = "<?php echo @$tinypng['values']->api2; ?>">
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">启用压缩</label>
							<div class="layui-input-block">
							<input type="checkbox" name="switch" lay-skin="switch" lay-text="ON|OFF" <?php echo $tinypng['switch']; ?>>
							</div>
						</div>
						<div class="layui-form-item">
							<div class="layui-input-block">
							<button class="layui-btn" lay-submit lay-filter="form_tinypng">保存</button>
							</div>
						</div>
						</form>
					</div>
			    </div>
			    <!--图片压缩END-->
			    <!--图片鉴黄-->
			    <div class="layui-tab-item">
				    <div class="layui-col-lg6">
						<div id="site" class = "site">
						<form class="layui-form" method = "post">
							<div class="layui-form-item">
								<label class="layui-form-label">API key</label>
								<div class="layui-input-block">
								<input type="text" name="api" value = "<?php echo $moderate['values'] ?>" required  lay-verify="required" placeholder="请输入Moderate Content API KEY" class="layui-input">
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">启用鉴黄</label>
								<div class="layui-input-block">
								<input type="checkbox" name="switch" lay-filter="jhswitch" lay-skin="switch" lay-text="ON|OFF" <?php echo $moderate['switch']; ?>>
								</div>
							</div>
							
							<div class="layui-form-item">
								<div class="layui-input-block">
								<button class="layui-btn" lay-submit lay-filter="form_moderate">保存</button>
								</div>
							</div>
							</form>
						</div>
					</div>
			    </div>
			    <!--图片鉴黄END-->
			    <!--图片水印-->
				<div class="layui-tab-item">
				    <div class="layui-col-lg6">
						<div id="site" class = "site">
						开发中...
						</div>
					</div>
			    </div>
			    <!--图片水印end-->
			  </div>
			</div>
			<!--选显卡end-->
			
		</div>
	</div>
</div>
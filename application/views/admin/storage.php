<div class="layui-container site">
	<div class="layui-row">
        <div class="layui-col-lg12">
            <div class="setting-msg">
				<p>1. 请在下方填写对应存储的绑定域名，需要带有http(s)，比如<em>https://test.imgurl.org</em></p>
				<p>2. 本地存储、FTP存储末尾没有斜线（/），其余存储绑定域名末尾必须带有斜线（/）</p>
				<p>3. 权重范围为0-99，权重越大，选项越靠前</p>
				<p>4. 打开允许上传，前台页面才会显示对应选项</p>
				<p>5. 使用外部存储之前，需要先参考<a href="https://dwz.ovh/3" rel = "nofollow" target = "_blank">帮助文档</a>进行设置。</p>
			</div>
        </div>
        <div class="layui-col-lg12">
	        <!--创建一个选项卡-->
			<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
			  <ul class="layui-tab-title">
			    <li class="layui-this">本地</li>
			    <li>Backblaze B2</li>
			    <li>FTP</li>
			    <li>腾讯COS</li>
			    <li>七牛云</li>
			  </ul>
			  <div class="layui-tab-content">
				  <!--本地存储-->
			  	<div class="layui-tab-item layui-show">
				  	<div id="site" class="layui-col-lg6 storage">
					<form class="layui-form" action="/set/storage/localhost" method = "post">
						<div class="layui-form-item">
							<label class="layui-form-label">绑定域名</label>
							<div class="layui-input-block">
							<input type="text" name="domain" value = "<?php echo $localhost['domains']; ?>" required  lay-verify="required|url" placeholder="请输入绑定域名" class="layui-input">
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">权重</label>
							<div class="layui-input-block">
							<input type="text" name="weight" required lay-verify="required" value = "<?php echo $localhost['weight']; ?>"  placeholder="0-99，权重越大，选项越靠前。" class="layui-input">
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">游客上传</label>
							<div class="layui-input-block">
							<input type="radio" name="permission" value="1" <?php echo $localhost['permissions']->key1; ?> title="是">
							<input type="radio" name="permission" value="0" <?php echo $localhost['permissions']->key2; ?> title="否">
							</div>
						</div>
						<div class="layui-form-item">
							<div class="layui-input-block">
							<button class="layui-btn layui-btn-sm" lay-submit lay-filter="formlocalhost">保存</button>
							</div>
						</div>
					</form>
					</div>
			  	</div>
			  	<!--本地存储END-->
			  	<!--B2存储-->
			    <div class="layui-tab-item">
				    <div class="layui-col-lg6">
						<div id="site" class = "storage">
						<form class="layui-form" action="/set/storage/backblaze" method = "post">
							<div class="layui-form-item">
								<label class="layui-form-label">绑定域名</label>
								<div class="layui-input-block">
								<input type="text" name="domain" value = "<?php echo $b2['domains']; ?>" required  lay-verify="required|url" placeholder="请输入绑定域名" class="layui-input">
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">权重</label>
								<div class="layui-input-block">
								<input type="text" name="weight" value = "<?php echo $b2['weight']; ?>" required  lay-verify="required" placeholder="0-99，权重越大，选项越靠前。" class="layui-input">
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">游客上传</label>
								<div class="layui-input-block">
								<input type="radio" name="permission" value="1" <?php echo $b2['permissions']->key1; ?> title="是">
								<input type="radio" name="permission" value="0" <?php echo $b2['permissions']->key2; ?> title="否">
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">开关</label>
								<div class="layui-input-block">
									<input type="checkbox" lay-filter="upswitch" name="switch" lay-skin="switch" <?php echo $b2['switch']; ?>><div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em></em><i></i></div>
								</div>
							</div>
							<div class="layui-form-item">
								<div class="layui-input-block">
								<button class="layui-btn layui-btn-sm" lay-submit lay-filter="formb2">保存</button>
								</div>
							</div>
							</form>
						</div>
					</div>
			    </div>
			    <!--B2存储END-->
			    <div class="layui-tab-item">
				    <!--FTP存储-->
				    <div class="layui-col-lg6">
						<div id="site" class = "storage">
						<form class="layui-form" method = "post">
							<div class="layui-form-item">
								<label class="layui-form-label">绑定域名</label>
								<div class="layui-input-block">
								<input type="text" name="domain" value = "<?php echo $ftp['domains']; ?>" required  lay-verify="required|url" placeholder="请输入绑定域名" class="layui-input">
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">权重</label>
								<div class="layui-input-block">
								<input type="text" name="weight" required lay-verify="required" value = "<?php echo $ftp['weight']; ?>" required  lay-verify="required" placeholder="0-99，权重越大，选项越靠前。" class="layui-input">
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">游客上传</label>
								<div class="layui-input-block">
								<input type="radio" name="permission" value="1" <?php echo $ftp['permissions']->key1; ?> title="是">
								<input type="radio" name="permission" value="0" <?php echo $ftp['permissions']->key2; ?> title="否">
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">开关</label>
								<div class="layui-input-block">
									<input type="checkbox" lay-filter="upswitch" name="switch" lay-skin="switch" <?php echo $ftp['switch']; ?>><div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em></em><i></i></div>
								</div>
							</div>
							<div class="layui-form-item">
								<div class="layui-input-block">
								<button class="layui-btn layui-btn-sm" lay-submit lay-filter="form_ftp">保存</button>
								</div>
							</div>
							</form>
						</div>
					</div>
			    <!--B2存储END-->
			    </div>
			    <div class="layui-tab-item">
				    <!--COS存储-->
				    <div class="layui-col-lg6">
						<div id="site" class = "storage">
						<form class="layui-form" method = "post">
							<div class="layui-form-item">
								<label class="layui-form-label">绑定域名</label>
								<div class="layui-input-block">
								<input type="text" name="domain" value = "<?php echo $cos['domains']; ?>" required  lay-verify="required|url" placeholder="请输入绑定域名" class="layui-input">
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">权重</label>
								<div class="layui-input-block">
								<input type="text" name="weight" value = "<?php echo $cos['weight']; ?>" required  lay-verify="required" placeholder="0-99，权重越大，选项越靠前。" class="layui-input">
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">游客上传</label>
								<div class="layui-input-block">
								<input type="radio" name="permission" value="1" <?php echo $cos['permissions']->key1; ?> title="是">
								<input type="radio" name="permission" value="0" <?php echo $cos['permissions']->key2; ?> title="否">
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">开关</label>
								<div class="layui-input-block">
									<input type="checkbox" lay-filter="upswitch" name="switch" lay-skin="switch" <?php echo $cos['switch']; ?>><div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em></em><i></i></div>
								</div>
							</div>
							<div class="layui-form-item">
								<div class="layui-input-block">
								<button class="layui-btn layui-btn-sm" lay-submit lay-filter="form_cos">保存</button>
								</div>
							</div>
							</form>
						</div>
					</div>
				    <!--COS存储END-->
			    </div>
			    <div class="layui-tab-item">
					<!--七牛存储-->
				    <div class="layui-col-lg6">
						<div id="site" class = "storage">
						<form class="layui-form" method = "post">
							<div class="layui-form-item">
								<label class="layui-form-label">绑定域名</label>
								<div class="layui-input-block">
								<input type="text" name="domain" value = "<?php echo $qiniu['domains']; ?>" required  lay-verify="required|url" placeholder="请输入绑定域名" class="layui-input">
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">权重</label>
								<div class="layui-input-block">
								<input type="text" name="weight" value = "<?php echo $qiniu['weight']; ?>" required  lay-verify="required" placeholder="0-99，权重越大，选项越靠前。" class="layui-input">
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">游客上传</label>
								<div class="layui-input-block">
								<input type="radio" name="permission" value="1" <?php echo $qiniu['permissions']->key1; ?> title="是">
								<input type="radio" name="permission" value="0" <?php echo $qiniu['permissions']->key2; ?> title="否">
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">开关</label>
								<div class="layui-input-block">
									<input type="checkbox" lay-filter="upswitch" name="switch" lay-skin="switch" <?php echo $qiniu['switch']; ?>><div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em></em><i></i></div>
								</div>
							</div>
							<div class="layui-form-item">
								<div class="layui-input-block">
								<button class="layui-btn layui-btn-sm" lay-submit lay-filter="form_qiniu">保存</button>
								</div>
							</div>
							</form>
						</div>
					</div>
				    <!--七牛存储END-->
				</div>
			  </div>
			</div>     
	        <!--选项卡END-->
        </div>
		<div class="layui-col-lg6">
			
		</div>
	</div>
</div>
<div class="layui-container site">
	<div class="layui-row">
		<div class="layui-col-lg12">
			<!--提示-->
			<div class="setting-msg">
				站点公告和页脚信息支持HTML代码
			</div>
			<!-- 创建一个选项卡 -->
			<div class="layui-tab layui-tab-brief">
			<ul class="layui-tab-title">
				<li class="layui-this">站点信息</li>
				<li>首页公告</li>
				<li>页脚信息</li>
				<li>页面提示</li>
			</ul>
			<div class="layui-tab-content">
				<div class="layui-tab-item layui-show">
					<!-- 站点信息设置 -->
					<div id="site" class = "site">
					<form class="layui-form" action = "/set/site" method = "post">
						<div class="layui-form-item">
							<label class="layui-form-label">Logo地址</label>
							<div class="layui-input-block">
							<input type="text" name="logo" required  lay-verify="required" placeholder="可输入绝对路径或URL地址" autocomplete="off" class="layui-input" value = "<?php echo $site->logo; ?>">
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">网站标题</label>
							<div class="layui-input-block">
							<input type="text" name="title" required  lay-verify="required" placeholder="请输入网站标题标题" autocomplete="off" class="layui-input" value = "<?php echo $site->title; ?>">
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">网站关键词</label>
							<div class="layui-input-block">
							<input type="text" name="keywords"  placeholder="多个关键词用英文状态下的逗号(,)分隔" autocomplete="off" class="layui-input" value = "<?php echo $site->keywords; ?>">
							</div>
						</div>
						<div class="layui-form-item layui-form-text">
							<label class="layui-form-label">站点描述</label>
							<div class="layui-input-block">
<textarea name="description" placeholder="请输入网站描述" class="layui-textarea"><?php echo $description; ?></textarea>
							</div>
						</div>
						
						<div class="layui-form-item layui-form-text">
							<label class="layui-form-label">统计代码</label>
							<div class="layui-input-block">
								<textarea name="analytics" placeholder="请输入统计代码，目前仅测试过百度统计，其它统计代码可能会出错。" class="layui-textarea"><?php echo $site->analytics; ?></textarea>
							</div>
						</div>
						<!-- <div class="layui-form-item layui-form-text">
							<label class="layui-form-label">Disqus</label>
							<div class="layui-input-block">
								<textarea name="comments" placeholder="请输入统Disqus评论代码" class="layui-textarea"></textarea>
							</div>
						</div> -->
						<div class="layui-form-item">
							<div class="layui-input-block">
							<button class="layui-btn" lay-submit lay-filter="formsite">保存</button>
							</div>
						</div>
						</form>
					</div>
					<!-- 站点信息设置END -->
				</div>
				<div class="layui-tab-item">
					<!-- 站点公告 -->
					<div class="site">
						<form class="layui-form" action = "/set/site" method = "post">
							<div class="layui-form-item layui-form-text">
								<label class="layui-form-label">站点公告</label>
								<div class="layui-input-block">
									<textarea lay-verify="required" name="values" placeholder="首页顶部站点公告，可输入HTML内容" class="layui-textarea"><?php echo $notice->values; ?></textarea>
								</div>
							</div>
							<div class="layui-form-item">
								<div class="layui-input-block">
								<button class="layui-btn" lay-submit lay-filter="form_notice">保存</button>
								</div>
							</div>
						</form>
					</div>
					<!-- 站点公告END -->
				</div>
				<div class="layui-tab-item">
					<!-- 底部版权 -->
					<div class="site">
						<form class="layui-form" action = "/set/site" method = "post">
							<div class="layui-form-item layui-form-text">
								<label class="layui-form-label">页脚信息</label>
								<div class="layui-input-block">
									<textarea lay-verify="required" name="values" placeholder="页面底部信息，通常填写备案号、版权等信息" class="layui-textarea"><?php echo $footer->values; ?></textarea>
								</div>
							</div>
							<div class="layui-form-item">
								<div class="layui-input-block">
								<button class="layui-btn" lay-submit lay-filter="form_footer">保存</button>
								</div>
							</div>
						</form>
					</div>
					<!-- 底部版权END -->
				</div>
				<!-- 页面提示 -->
				<div class="layui-tab-item">
					<div class="site">
						<form class="layui-form" method = "post">
							<div class="layui-form-item layui-form-text">
								<label class="layui-form-label">页面提示</label>
								<div class="layui-input-block">
									<textarea lay-verify="required" name="values" placeholder="图片页面的提示信息" class="layui-textarea"><?php echo $page_notice->values; ?></textarea>
								</div>
							</div>
							<div class="layui-form-item">
								<div class="layui-input-block">
								<button class="layui-btn" lay-submit lay-filter="form_page_notice">保存</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- 页面提示 -->
			</div>
			</div>
			<!-- 选项卡END -->
		</div>
	</div>
</div>

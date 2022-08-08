<div class="layui-container" style = "">
    <div class="layui-row">
        <!-- 首页主要区域 -->
        <div class="layui-col-lg12">
            <div id="main">
                <div class="alert alert-warning" role="alert">
                    <span class="alert-inner--icon"><i class="layui-icon"></i></span>
                    <span class="alert-inner--text"><strong>注意：</strong><?php echo $notice; ?></span>
                </div>
                <!-- 选择按钮 -->
                <!-- 上传地址 -->
                <div id = "storage">
                    <form class="layui-form" action="">
                    <div class="layui-form-item">
                        <?php if(count($storage) == 0){ ?>
                            <span style = "color:#FF5722;font-weight: bold;">游客上传已关闭！</span>
                        <?php }else{ ?>
                        <label class="layui-form-label">存储方式</label>
                        <div class="layui-input-block">
                            <!-- 遍历存储引擎 -->
                            <?php
                            $i = 1;
                            // var_dump($storage);
                            // exit;
                            foreach($storage AS $value){
                                if($i == 1){
                                    $checked = 'checked';
                                }
                                else{
                                    $checked = null;
                                }
                                $i++;
                                ?>
                                <input type="radio" name="storage" value="<?php echo $value->engine; ?>" title = "<?php echo $value->name ?>" <?php echo $checked;?> >
                            <?php }} ?>
                        </div>
                    </div>
                    </form>
                </div> 
                <!-- 选择按钮END -->
                <!-- 上传区域 -->
                <div class="layui-form-item">
                <div class="layui-upload-drag" id="multiple">
                    <i class="layui-icon layui-icon-upload"></i>
                    <p>点击这里可选择多张图片，支持拖拽。</p>
                </div>
                </div>
                <!-- 上传区域END -->
            </div>
        </div>
        <div class="layui-col-lg12">
            <!-- 上传进度条 -->
            <div class = "progress" style = "margin-bottom:0.5em;">
                <div class="layui-progress layui-progress-big" lay-filter="uploadProgress" lay-showPercent="true">
                    <div class="layui-progress-bar" lay-percent="0%"></div>
                </div>
            </div>
            <!-- 上传进度条END -->
        </div>
        <!-- 多图上传结果 -->
        <div class="layui-col-lg12" id = "multiple-re">
            <div class="layui-tab layui-tab-brief">
                <ul class="layui-tab-title">
                    <li class="layui-this">URL</li>
                    <li>HTML</li>
                    <li>Markdown</li>
                    <li>BBCode</li>
                    <li>Delete Link</li>
                </ul>
                <div class="layui-tab-content">
                    <!-- 第一个选显卡结果 -->
                    <div class="layui-tab-item layui-show" id = "re-url">
                        <pre></pre>
                    </div>
                    <!-- 返回HTML结果 -->
                    <div class="layui-tab-item" id = "re-html">
                        <pre></pre>
                    </div>
                    <!-- 返回Markdown结果 -->
                    <div class="layui-tab-item" id = "re-md">
                        <pre></pre>
                    </div>
                    <!-- 返回BBCode结果 -->
                    <div class="layui-tab-item" id = "re-bbc">
                        <pre></pre>
                    </div>
                    <!-- 返回删除链接 -->
                    <div class="layui-tab-item" id = "re-dlink">
                        <pre></pre>
                    </div>
                </div>
            </div>
            <!-- 导出txt按钮 -->
            <!-- <a href="" class="layui-btn layui-btn-sm"><i class="layui-icon layui-icon-download-circle"></i> 导出txt</a> -->
            <!-- 导出txt按钮end -->
        </div>
        <!-- 多图上传结果END -->
        <!-- 首页主要区域END -->
    </div>
</div>
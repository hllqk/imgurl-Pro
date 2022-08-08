<div class="layui-container" style = "margin-top:1em;margin-bottom:6em;">
    <div class="layui-row layui-col-space10" >
        <div class="layui-col-lg12">
            <?php if( stristr($uri,'dubious') && (!isset($model)) ){ ?>
                <div class="setting-msg">您当前处于安全模式，<a href="/manage/images/dubious/0?model=1">点此切换</a>为标准模式。</div>
            <?php }elseif ( stristr($uri,'dubious') && isset($model) ){ ?>
                <div class="setting-msg">您当前处于标准模式，<a href="/manage/images/dubious/0">点此切换</a>为安全模式。</div>
            <?php }else{ ?>
            <!-- 增加一个按钮组 -->
            按存储类型：
            <div class="layui-btn-group">
                <a href="/manage/images/all/0" class="layui-btn layui-btn-sm">默认</a>
                
                <?php foreach ($engine as $value) {
                    //逻辑判断
                    
                ?>
                <a href="/manage/images/<?php echo $value->engine; ?>/0" class="layui-btn layui-btn-sm"><?php echo $value->name; ?></a>
            <?php } ?>
            </div>
            <!-- 按钮组END -->
            <!-- 条件筛选 -->
            <!-- 先来一个选项卡 -->
            <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
                <ul class="layui-tab-title">
                    <li class="layui-this">常规筛选</li>
                    <li>时间筛选</li>
                </ul>
                <div class="layui-tab-content">
                    <!-- 常规筛选内容 -->
                    <div class="layui-tab-item layui-show">
                        <table class="layui-table layui-form" lay-even="" lay-skin="nob">
                            <tbody>
                            </tbody><thead>
                            <tr>
                                <th width="85%">
                                    <input id="value" type="text" required="" lay-verify="required" placeholder="可输入 ID/IP/imgid 进行查询" autocomplete="off" class="layui-input" data-cip-id="url" data-kpxc-id="ip">
                                </th>
                                <th width="15%">
                                    <select id="type" lay-verify="required">
                                        <option value="">请选择条件</option>
                                        <option value="id">ID</option>
                                        <option value="imgid">ImgID</option>
                                        <option value="ip">IP</option>
                                        <option value="name">图片名称</option>
                                    </select>
                                </th>
                                <th width="10%"><button type="submit" class="layui-btn layui-btn" onclick="findimg()"><i class="layui-icon"></i> 查 询</button></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- 常规筛选内容END -->
                    <!-- 时间筛选 -->
                    <div class="layui-tab-item">
                        <table class="layui-table layui-form" lay-even="" lay-skin="nob">
                                <tbody>
                                </tbody><thead>
                                <tr>
                                    <th width="30%">
                                        <input id = "start-time" type="text" class="layui-input" id="start-time">
                                    </th>
                                    <th width = "5%"> ------ </th>
                                    <th width="30%">
                                        <input id = "end-time" type="text" class="layui-input" id="end-time">
                                    </th>
                                    <th width="15%">
                                        <select id="user" lay-verify="required">
                                            <option value="all">默认</option>
                                            <option value="admin">管理员</option>
                                            <option value="visitor">游客</option>
                                        </select>
                                    </th>
                                    <th width="10%"><button type="submit" class="layui-btn layui-btn" onclick="find_date_img()"><i class="layui-icon"></i> 查 询</button></th>
                                </tr>
                                </thead>
                        </table>
                    </div>
                    <!-- 时间筛选END -->
                </div>
            </div>
            <?php } ?>
            <!-- 条件筛选END -->
        </div>
    </div>
    <div class="layui-row layui-col-space10 showimgs" id = "showimgs">
        <?php 
                foreach ($imgs as $img)
                {
                    $storage = $img['storage'];
                    //一些简单的逻辑处理 
                    switch($storage){
                        case 'localhost':
                            //获取缩略图地址
                            $thumbpath = thumbnail($img);
                            $thumburl = $domain.$thumbpath;
                            //源图像地址
                            $img_url = $domain.$img['path'];
                            break;
                        case 'backblaze':
                            //缩略图地址
                            $thumburl = $b2_domain.$img['thumb_path'];
                            //源图像地址
                            $img_url = $b2_domain.$img['path'];
                            break;
                        case 'cos':
                            //缩略图地址
                            $thumburl = $cos_domain.$img['thumb_path'];
                            //源图像地址
                            $img_url = $cos_domain.$img['path'];
                            break;
                        case 'ftp':
                            //缩略图地址
                            $thumburl = $ftp_domain.$img['thumb_path'];
                            //源图像地址
                            $img_url = $ftp_domain.$img['path'];
                            break;
                        case 'qiniu':
                            //缩略图地址
                            $thumburl = $qiniu_domain.$img['thumb_path'];
                            //源图像地址
                            $img_url = $qiniu_domain.$img['path'];
                            break;
                        default:
                            break;
                    }
                    
                    //判断是否压缩设置不同样式的CSS
                    if($img['compression'] == 1){
                        $css = 'layui-btn-normal';
                    }
                    else{
                        $css = 'layui-btn-primary';
                    }
                    //如果是可疑图片
                    if( ($img['level'] == 'adult') && (!isset($model))){
                        $thumburl = '/static/images/dubious_290.png';
                    }
            ?>
            <div class="layui-col-lg3" id = "img<?php echo $img['id']; ?>">
                <div class = "operate">
                    <!-- 选择按钮 -->
                    <div class = "choose"><input type="checkbox" name="chk" value = "<?php echo $img['id']; ?>"></div>
                    <!-- 压缩图标 -->
                    <div>
                        <button class="layui-btn  layui-btn-xs <?php echo $css; ?>" title = "压缩图片" onclick = "compress(<?php echo $img['id']; ?>,'<?php echo $storage; ?>')">
                        <i class="fa fa-compress"></i>
                        </button>  
                    </div>
                    <!-- 链接图标 -->
                    <div>
                        <button class="layui-btn  layui-btn-xs layui-btn-normal" title = "获取图片链接" onclick = "showlink('<?php echo $img_url; ?>','<?php echo $thumburl; ?>')">
                        <i class="fa fa-link"></i>
                        </button>  
                    </div>
                    <!-- 信息图标 -->
                    <div>
                        <button class="layui-btn  layui-btn-xs layui-btn-normal" title = "查看图片信息" onclick = "imginfo('<?php echo $img['imgid']; ?>','<?php echo $img['client_name']; ?>')">
                            <i class="fa fa-info-circle"></i>
                        </button>  
                    </div>
                    <!-- 直达链接 -->
                    <div>
                        <a href="/img/<?php echo $img['imgid']; ?>" target = "_blank" class="layui-btn layui-btn-xs layui-btn-normal"><i class="fa fa-globe"></i></a>
                    </div>
                    <!-- 删除按钮 -->
                    <div>
                        <button class="layui-btn  layui-btn-xs layui-btn-danger" title = "删除这张图片" onclick = "del_id(<?php echo $img['id']; ?>)">
                            <i class="fa fa-trash-o"></i>
                        </button>  
                    </div>
                    <!-- 取消可疑状态 -->
                    <?php if($img['level'] == 'adult'){ ?>
                    <div>
                        <button class="layui-btn  layui-btn-xs" title = "取消可疑状态" onclick = "cancel(<?php echo $img['id']; ?>)">
                            <i class="fa fa-check"></i>
                        </button>  
                    </div>
                    
                    <?php } ?>
                    <?php if( stristr($uri,'dubious') ) { ?>
                        <!-- 统计这个IP上传可疑图片数量 -->
                        <div>
                            <a href="/manage/images/ip/?value=<?php echo $img['ip']; ?>" target = "_blank" class="layui-btn layui-btn-xs layui-btn-normal">
                                <i class="fa fa-photo "></i>
                            </a>
                        </div>
                    <?php } ?>
                </div>
                <div class = "img_thumb">
                    <img alt="<?php echo $img['client_name']; ?>" class="lazyload" layer-src= "<?php echo $img_url; ?>" data-src = "<?php echo $thumburl; ?>">
                </div>
            </div>
            <?php
            } 
        ?>
	</div>
	<!-- 分页按钮 -->
	<div class="layui-row" style = "margin-top:2em;">
		<div class="layui-col-lg6" id = "paging">
            <?php echo $page; ?>
        </div>
        <div class="layui-col-lg3">
	        <span>操作：</span>
	        <div class="layui-btn-group">
			  <button type="button" class="layui-btn layui-btn-xs" onclick = "check_all()">全选</button>
			  <button type="button" class="layui-btn layui-btn-xs" onclick = "cancel_all()">取消全选</button>
			  <!--<button type="button" class="layui-btn layui-btn-xs" onclick = "invert_selection()">反选</button>-->
			</div>
	    </div>
        <div class="layui-col-lg3">
            <!-- <button class="layui-btn layui-btn-xs" id = "checkAll">全选</button>--> <label>选中项：</label>
            <div class="layui-btn-group">
            <button class="layui-btn layui-btn-xs layui-btn-danger" onclick = "del_more()">删除</button>
            <button class="layui-btn layui-btn-xs layui-btn-warm" onclick = "cancel_dubious()">取消可疑</button>
            </div>
        </div>
	</div>
	<!-- 分页按钮 -->
</div>

<!-- 浮动按钮 -->
<div class="float-button">
    <div><button  title = "删除选中" class="layui-btn layui-btn-danger layui-btn-sm" onclick = "del_more()"><i class="fa fa-trash-o"></i></button></div>
    <div><button title = "批量取消可疑" class="layui-btn layui-btn-sm" onclick = "cancel_dubious()"><i class="fa fa-check"></i></button></div>
</div>
<!-- 浮动按钮END -->
<!-- 图片懒加载 -->
<script>
    lazyload();
</script>
<!-- 图片懒加载END -->

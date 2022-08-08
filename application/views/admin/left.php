<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
	  	<li class="layui-nav-item layui-nav-itemed">
			<a href="javascript:;"><i class="layui-icon layui-icon-picture-fine"></i> 图片管理</a>
			<dl class="layui-nav-child">
        <dd><a href="/manage/images/all/0">所有图片</a></dd>
        <!-- <dd><a href="/manage/images/localhost/0">localhost</a></dd>
        <dd><a href="/manage/images/backblaze/0">Backblaze B2</a></dd> -->
			  <dd><a href="/manage/images/admin/0">管理员上传</a></dd>
			  <dd><a href="/manage/images/visitor/0">游客上传</a></dd>
			  <dd><a href="/manage/images/dubious/0">可疑图片</a></dd>
        <!-- <dd><a href="/manage/batch_delete">批量删除</a></dd> -->
      </dl>
        </li>
        <li class="layui-nav-item layui-nav-itemed">
          <a class="" href="javascript:;"><i class="layui-icon layui-icon-set"></i> 系统设置</a>
          <dl class="layui-nav-child">
            <dd><a href="/setting/site">站点设置</a></dd>
            <dd><a href="/storage/setting">存储方案</a></dd>
            <dd><a href="/setting/uplimit">上传限制</a></dd>
            <dd><a href="/setting/picture">图片处理</a></dd>
            <dd><a href="/setting/token">Token管理</a></dd>
            <dd><a href="/setting/ipblock">IP黑名单</a></dd>
            <!-- <dd><a href="/setting/compress">图片压缩</a></dd>
            <dd><a href="/setting/identify">图片鉴黄</a></dd> -->
          </dl>
        </li>
      </ul>
    </div>
  </div>
  <div class="layui-body">
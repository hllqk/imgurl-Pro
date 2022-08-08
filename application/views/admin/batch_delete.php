<div class="layui-container site">
	<div class="layui-row">
        <div class="layui-col-lg12">
	        <form action="" class="layui-form">
		        <table class = "layui-table" lay-skin="nob">
			        <colgroup>
					    <col width="50%">
					    <col width="25%">
                        <col width="15%">
					    <col>
					</colgroup>
			        <tr>
				        <td>
					        <input type="text" class="layui-input" id="date" placeholder = "请选择时间段" lay-verify="required">
					    </td>
					    <td>
						    <select name="engine" lay-verify="required">
						        <option value="">选择存储引擎</option>
<!--						        <option value="all">全部</option>-->
						        <option value="localhost">本地</option>
						        <option value="b2">Backblaze B2</option>
						        <option value="cos">腾讯COS</option>
						        <option value="ftp">FTP</option>
                                <option value="ftp">七牛</option>
						    </select>
					    </td>
                        <td>
                            <select name="user" lay-verify="required">
                                <option value="visitor">游客上传</option>
                                <option value="admin">管理员上传</option>
                                <option value="all">全部</option>
                            </select>
                        </td>
					    <td>
						    <button class="layui-btn layui-btn-danger" lay-submit lay-filter="batch_delete">全部删除</button>
					    </td>
			        </tr>
		        </table>
	        </form>
        </div>
	</div>
</div>
@extends('admin.layouts.header')

@section('content')
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 资讯管理 <span class="c-gray en">&gt;</span> 职位管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <div class="cl pd-5 bg-1 bk-gray"> <span class="l">
                <a class="btn btn-primary radius" href="javascript:;" onclick="admin_role_add('添加职位','office_add/{{$admin->id}}','800','300')"><i class="Hui-iconfont">&#xe600;</i> 添加职位</a> </span> <span class="r">共有数据：<strong>{!! $posts_list->total() !!} </strong> 条</span> </div>
        <table class="table table-border table-bordered table-hover table-bg">
            <thead>
            <tr>
                <th scope="col" colspan="9">职位管理</th>
            </tr>
            <tr class="text-c">
                <th width="40">ID</th>
                <th width="200">职位名称</th>
                <th width="200">职位描述</th>
                <th width="200">招聘人数</th>
                <th width="200">职位状态</th>
                <th width="200">招聘等级</th>
                <th width="200">更新时间</th>
                <th width="200">创建时间</th>
                <th width="200">创建人</th>
                <th width="70">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts_list as $k=>$v)
                <tr class="text-c">
                    <td>{{$v->id}}</td>
                    <td>{{$v->posts_name}}</td>
                    <td>{{$v->description}}</td>
                    <td>{{$v->number}}</td>
                    <td>{{$v->status}}</td>
                    <td>{{$v->grade}}</td>
                    <td>{{$v->created_at}}</td>
                    <td>{{$v->updated_at}}</td>
                    <td>{{$v->creat_name}}</td>
                    <td class="f-14">

                        <a title="编辑" href="javascript:;" onclick="admin_role_edit('角色编辑','office_edit/{{$v->id}}','1')" style="text-decoration:none">职位编辑</a>
{{--                        <a title="编辑" href="javascript:;" onclick="admin_role_edit('角色编辑','identity_edite/{{$v->id}}','1')" style="text-decoration:none">角色编辑</a>--}}

{{--                        @if ($v->status == 1)--}}
{{--                            <a style="text-decoration:none" onClick="admin_stop(this,{{ $v->id }})" href="javascript:;" title="停用">停用</a>--}}
{{--                        @else--}}
{{--                            <a style="text-decoration:none" onClick="admin_start(this,{{ $v->id }})" href="javascript:;" title="启用">启用</a>--}}
{{--                        @endif--}}

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        /*管理员-角色-添加*/
        function admin_role_add(title,url,w,h){
       
            layer_show(title,url,w,h);
        }
        /*管理员-角色-编辑*/
        function admin_role_edit(title,url,id,w,h){
            console.log(111)
            layer_show(title,url,w,h);
        }
        /*管理员-角色-删除*/
        function admin_role_del(obj,id){
            layer.confirm('角色删除须谨慎，确认要删除吗？',function(index){
                $.ajax({
                    type: 'POST',
                    url: '',
                    dataType: 'json',
                    success: function(data){
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!',{icon:1,time:1000});
                    },
                    error:function(data) {
                        console.log(data.msg);
                    },
                });
            });
        }
        /*角色-停用*/
        function admin_stop(obj,id){
            layer.confirm('确认要停用吗？',function(index){
                //此处请求后台程序，下方是成功后的前台处理……
                $.ajax({
                    type: 'POST',
                    url: 'identity_status/'+id,
                    dataType: 'json',
                    data:{status:'stop'},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        // $(obj).parents("tr").remove();
                        console.log(data)
                        if (data.msg){
                            setTimeout(

                                function () {
                                    var index = parent.layer.getFrameIndex(window.name);
                                    parent.$('.btn-refresh').click();
                                    parent.layer.close(index);
                                }

                                ,1000)
                            layer.msg(data.msg,{icon:1,time:1000});
                        }


                    },
                    error:function(data) {
                        console.log(data.msg);
                    },
                });

                setTimeout(

                    function () {
                        var index = parent.layer.getFrameIndex(window.name);
                        location.reload();
                        parent.layer.close(index);
                    }

                    ,1000)
            });
        }

        /*角色-启用*/
        function admin_start(obj,id){
            layer.confirm('确认要启用吗？',function(index){
                //此处请求后台程序，下方是成功后的前台处理……
                $.ajax({
                    type: 'POST',
                    url: 'identity_status/'+id,
                    dataType: 'json',
                    data:{status:'open'},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        // $(obj).parents("tr").remove();
                        console.log(data)
                        if (data.msg){
                            layer.msg(data.msg,{icon:1,time:1000});
                        }


                    },
                    error:function(data) {
                        console.log(data.msg);
                    },
                });

                setTimeout(

                    function () {
                        var index = parent.layer.getFrameIndex(window.name);
                        location.reload();
                        parent.layer.close(index);
                    }

                    ,1000)
                // $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
                // $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                // $(obj).remove();
                // layer.msg('已启用!', {icon: 6,time:1000});
            });
        }
    </script>
@stop




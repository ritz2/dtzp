@extends('admin.layouts.header')

@section('content')
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
        <span class="c-gray en">&gt;</span>
        系统管理
        <span class="c-gray en">&gt;</span>
        系统日志
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
    </nav>
    <div class="page-container">
        <div class="text-c"> 日期范围：
            <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin" class="input-text Wdate" style="width:120px;">
            -
            <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" class="input-text Wdate" style="width:120px;">
            <input type="text" name="" id="" placeholder="日志名称" style="width:250px" class="input-text">
            <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜日志</button>
        </div>
        <div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
		<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
		</span>
            <span class="r">共有数据：<strong>{{$data['lists']->total()}}</strong> 条</span>
        </div>
        <table class="table table-border table-bordered table-bg table-hover table-sort">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="80">ID</th>
                <th width="17%">用户名</th>
                <th width="100">描述</th>
                <th width="120">客户端IP</th>
                <th width="100">时间</th>
                <th width="100">控制器</th>
                <th width="100">行为</th>
                <th width="100">状态</th>

                <th width="70">操作</th>

            </tr>
            </thead>
            <tbody>
            @foreach ($data['lists'] as $item)
                <tr class="text-c">
                    <td><input type="checkbox" value="{{ $item->id }}" name=""></td>
                    <td>{{ $item->id }}</td>
                    <td> @if($item->type_id == 1) * @else {{$item->username}} @endif</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->client_ip }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->controller }}</td>
                    <td>{{ $item->action }}</td>
                    <td>
                        @if ($item->status == 1)
                            ok
                        @else
                            ok2
                        @endif</td>
                    <td>

                        <a title="详情" href="javascript:;" onclick="system_log_show('详情','log_info/{{ $item->id }}','10001','600','270')" class="ml-5" style="text-decoration:none">详情</a>
                        <a title="删除" href="javascript:;" onclick="system_log_del(this,{{$item->id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div id="pageNav" class="pageNav">


        </div>

        {!! $data['lists']->links('vendor.pagination.bootstrap5') !!}
    </div>



@endsection

@section('script')
    <script type="text/javascript">

        // $('.table-sort').dataTable({
        //     "lengthMenu":false,//显示数量选择
        //     "bFilter": false,//过滤功能
        //     "bPaginate": false,//翻页信息
        //     "bInfo": false,//数量信息
        //     "aaSorting": [[ 1, "desc" ]],//默认第几个排序
        //     "bStateSave": true,//状态保存
        //     "aoColumnDefs": [
        //         //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
        //         {"orderable":false,"aTargets":[0,7]}// 制定列不参与排序
        //     ]
        // });
        //
        // /*查看日志*/

        function system_log_show(title,url,id,w,h){
            layer_show(title,url,w,h);
        }
        // /*日志-删除*/
        // function system_log_del(obj,id){
        //     layer.confirm('确认要删除吗？',function(index){
        //         $.ajax({
        //             type: 'POST',
        //             url: '',
        //             dataType: 'json',
        //             success: function(data){
        //                 $(obj).parents("tr").remove();
        //                 layer.msg('已删除!',{icon:1,time:1000});
        //             },
        //             error:function(data) {
        //                 console.log(data.msg);
        //             },
        //         });
        //     });
        // }
    </script>
@stop




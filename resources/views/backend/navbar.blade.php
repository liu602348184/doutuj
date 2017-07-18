@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
        	<div class="panel panel-default">
                <div class="panel-heading">导航条管理</div>
                <div class="panel-body">
                	<form action="{{ url('/backend122/navbar/create') }}" id="form" method="post">
			        	<div class="input-group">
			        		<span class="input-group-addon" id="basic-addon1">栏目名</span>
			        		<input type="text" name="title" id='title' class="form-control">
			        	</div>
						<br/>
			        	<div class="input-group">
			        		<span class="input-group-addon" id="basic-addon1">排序号</span>
			        		<input type="number" name="sort" id='sort' class="form-control">
			        	</div>
			        	<br/>
			        	{{ csrf_field() }}
			        	<input type="hidden" name="id" id="id">
			        	<input type="button" class='btn btn-default btn-block' id="clear" value="清空">
			        	<input type="submit" class='btn btn-primary btn-block' value="提交">
                	</form>
                </div>
		    </div>
        </div>
        <div class="col-md-4">
        	<ul class="list-group" id="navlist">
        		@foreach ($navlist as $nav)
			  		<li class="list-group-item" navid="{{ $nav->id }}" sort="{{ $nav->sort }}">
			  			<a href="#">{{ $nav->title }}</a>
			  			<a href="#" navid="{{ $nav->id }}" class="delbtn btn btn-danger btn-xs pull-right">
							<span class="glyphicon glyphicon-trash"></span>
			  			</a>
			  		</li>
        		@endforeach
			</ul>
        </div>
    </div>
</div>
<script>
	var domain = "{{ url('/backend122/navbar') }}";
	var _token = "{{ csrf_token() }}";
	window.onload = function(){
		$("#form").submit(function(){
			if(!$("[name=title]", "#form").val()){
				alert("栏目名必填");
				return false;
			}

			if(!$("[name=sort]", "#form").val()){
				alert("排序号必填");
				return false;
			}

			return true;
		});

		$("#navlist>li").click(function(){
			var navid = $(this).attr('navid');
			var sort = $(this).attr('sort');
			var title = $(this).find('a').text();
			$("#id").val(navid);
			$("#sort").val(sort);
			$("#title").val(title);
		});

		$("#clear").click(function(){
			$("#id").val('');
			$("#sort").val('');
			$("#title").val('');
		});

		$(".delbtn").click(function(){
			if(!confirm("你确定要删除吗？")){
				return false;
			}

			var id = $(this).attr("navid");

			$.ajax({
			    url: domain + '/delete',
			    type: 'DELETE',
			    data: {id : id, _token: _token},
			    dataType: 'json',
			    success: function(result) {
			    	if(result.success){
			    		window.location.reload();
			    	} else {
			    		alert("服务器出错");
			    	}
			        // Do something with the result
			    }
			});
		});
	}
</script>
@endsection

@section('nav2')
	active
@endsection
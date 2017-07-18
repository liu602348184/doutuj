@extends('layouts.app')

@section('content')
<link href="{{ asset('css/docs.css') }}" rel="stylesheet">
<div class="container">
    <div class="row">
    	<div class="container">
    		<div class="row">
		        <div class="col-md-4">
		        	<form action="{{ env('APP_URL') }}/backend122/inserttplface" enctype="multipart/form-data" method="post">
			            <div class="panel panel-default">
			                <div class="panel-heading">Dashboard</div>
							
			                <div class="panel-body">
			                    <div class="form-group">
			                    	{{ csrf_field() }}
			                    	<label for="">选择上传文件：</label>
						          	<input type="file" class="form-control" multiple accept="image/png,image/gif,image/jpeg" name="templatefaces[]" placeholder="Search">
						          	<br/>
						          	<input class="btn btn-primary btn-block"  type="submit" value="上传">
							    </div>
			                </div>
			            </div>
		        	</form>
		        </div>

		        <div class="col-xs-12 col-md-8" style="height:353px">
					<div class="scrollpanel">
						<ul id="piclist">
							@foreach ($tpllist as $li)
							<li>
								<img style="display:block" src='{{ asset("storage/{$li->path }") }}' tplid="{{ $li->id }}" alt="">
								<button class="delbtn btn btn-xs btn btn-danger btn-block" tplid="{{ $li->id }}">删除</button>
							</li>
							@endforeach
						</ul>
						<div style="clear:both"></div>
					</div>
				</div>
    		</div>
    	</div>
    </div>
</div>
<script>
	var domain = "{{ url('/backend122') }}";
	var _token = "{{ csrf_token() }}";

	window.onload = function(){
		$(".delbtn").click(function(){
			if(!confirm("你确定要删除吗？")){
				return false;
			}

			var id = $(this).attr("tplid");
			
			$.ajax({
			    url: domain + '/deletetplface',
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

@section('nav1')
	active
@endsection
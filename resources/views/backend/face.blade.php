@extends('layouts.app')

@section('content')
	<link rel="stylesheet" href="/css/backend.css">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
	        	<form action="{{ env('APP_URL') }}/backend122/face/{{ $navid }}/create" enctype="multipart/form-data" method="post">
		            <div class="panel panel-default">
		                <div class="panel-heading">Dashboard</div>
		                <div class="panel-body">
		                	{{--
						    <div class="form-group">
						    	<label for="">选择栏目：</label>
						    	<select name="navid" id="" class="form-control">
						    		@foreach($navlist as $nav)
						    		<option value="{{ $nav->id }}">{{ $nav->title }}</option>
						    		@endforeach
						    	</select>
						    </div>
						    --}}
		                    <div class="form-group">
		                    	{{ csrf_field() }}
		                    	<label for="">选择上传文件：</label>
					          	<input type="file" class="form-control" multiple accept="image/png,image/gif,image/jpeg" name="faces[]" placeholder="Search">
						    </div>
				          	<input class="btn btn-primary btn-block"  type="submit" value="上传">

		                </div>
		            </div>
	        	</form>
	        </div>

	        <div class="col-md-8">
 				<div class="col-md-12">
	 	        	<div class="btn-group" role="group" aria-label="...">
		        		@foreach($navlist as $nav)
						<a href='{{ url("/backend122/face/{$nav->id}") }}' class="btn btn-default @if($navid==$nav->id) active @endif">{{ $nav->title }}</a>
						@endforeach
					</div>
 				</div>
 				<div class="col-md-12">
 					<ul class="piclist">
 						@foreach($faces as $face)
 						<li>
 							<div class="pic">
 								<img src='{{ asset("storage/{$face->path}") }}' alt="">
 							</div>
 							<a href="#" faceid="{{ $face->id }}" class="btn btn-danger btn-xs btn-block delbtn"><span class="glyphicon glyphicon-trash"></span></a>
 						</li>
 						@endforeach
 					</ul>
 					<div class="pull-left col-md-12" style="padding:0px">
 						{{ $faces->links() }}
 					</div>
 				</div>
	        </div>
		</div>
	</div>

	<script>
		var domain = "{{ env('APP_URL') }}";
		var _token = "{{ csrf_token() }}";

		window.onload = function(){
			$(".delbtn").click(function(){
				if(!confirm("你确定要删除吗？")){
					return false;
				}

				var id = $(this).attr("faceid");

				$.ajax({
				    url: domain + '/backend122/face/delete',
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

@section('nav3')
	active
@endsection
@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/backend.css') }}">
<div class="container">
	<div class="row">
        <div class="col-md-4 col-xs-12">
        	<form id='form' action="{{ url('backend122/article/create') }}" enctype="multipart/form-data" method="post">
	            <div class="panel panel-default">
	                <div class="panel-heading">Dashboard</div>
					
	                <div class="panel-body">
					    <div class="form-group">
	                    	<label for="">文章标题：</label>
				          	<input type="text" id="title" name='title' class="form-control" >
					    </div>
						
						<div class="form-group">
	                    	<label for="">文章描述：</label>
	                    	<textarea name="desc" id="desc" class="form-control" cols="30" rows="10"></textarea>
					    </div>

	                    <div class="form-group">
	                    	{{ csrf_field() }}
	                    	<label for="">选择上传文件：</label>
				          	<input id="files" type="file" class="form-control" multiple accept="image/png,image/gif,image/jpeg" name="imgs[]" placeholder="Search">
					    </div>

			          	<input class="btn btn-primary btn-block"  type="submit" value="上传">
	                </div>
	            </div>
        	</form>
        </div>

        <div class="col-md-8 col-xs-12">
        	@foreach($articles as $article)
        	<div class="media">
			  	<div class="media-left">
				    <a href="#">
				      	<img class="media-object" src='{{ url("storage/article/{$article->thumb}") }}' alt="...">
				    </a>
			    </div>
				<div class="media-body">
				    <h4 class="media-heading">{{ $article->title }}</h4>
				    {{ $article->desc }}
				</div>

			    <div class="media-right">
			    	<a href="#" class="delbtn" articleid='{{ $article->id }}'><span class='glyphicon glyphicon-trash'></span></a>
			    	<p>{{ $article->created_at }}</p>
			    </div>
			    <!-- <div class="pull-right">ss</div> -->
			</div>
			@endforeach
			<div class="pull-left">
				{{ $articles->links() }}
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

			var id = $(this).attr("articleid");

			$.ajax({
			    url: domain + '/article/delete',
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

		$("#form").submit(function(){
			
			if(!$("#title").val()) {
				alert("标题必填");
				return false;
			}

			// if($("#desc").val()) {
			// 	alert("标题必填");
			// 	return false;
			// }

			if(!$("#files").val()){
				alert("文件必选");
				return false;
			}

			return true;
		});
	}
</script>
@endsection

@section('nav4')
	active
@endsection
@extends('layout')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-12">
			<ol class="breadcrumb">
			 	<li><a href="{{ url('article') }}">表情包下载</a></li>
			  	<li class="active">{{ $article->title }}</li>
			</ol>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-md-8">
			<div class="detail">
				<div class="page-header">
				  	<h1>{{ $article->title }}</h1>
				  	<div class="detail-info">
				  		<div class="pull-left"><p><span class="glyphicon glyphicon-time"></span>&nbsp;{{ $article->created_at }}</p></div>
				  		<div class="pull-right">
				  			<p style="margin: 0px">
					  			<font size="4"><a articleid="{{ $article->id }}" class="glyphicon glyphicon-thumbs-up" id="thumbs-up" href="javascript:void(0)"></a></font>
								<span class="text thumbs-up">({{ $article->like }})</span>
								&nbsp;
								<font size="4"><span class="glyphicon glyphicon-eye-open"></span></font>
								<span class="text show-count">({{ $article->show }})</span>
							</p>
				  		</div>
				  		<div style="clear: both"></div>
				  	</div>
				</div>
				<p>{{ $article->desc }}</p>
				<ul class="imglist">
					@foreach($paths as $path)
					<li><img src='{{ asset("storage/{$path}") }}' alt=""></li>
					@endforeach
				</ul>
			</div>
			<ul class="pager">
			    @if($pre)<li><a href='{{ url("article/{$pre->id}") }}.html'>上一篇：{{ $pre->title }}</a></li>@endif
			    @if($next)<li><a href='{{ url("article/{$next->id}") }}.html'>下一篇：{{ $next->title }}</a></li>@endif
		  	</ul>
			
			<div class="pull-left">
				@foreach($article->tags() as $tag)
				<span class="label label-default">
					<span class="glyphicon glyphicon-tag"></span>
					&nbsp;{{ $tag }}
				</span>
				@endforeach
			</div>
		</div>

		<div class="hidden-xs col-md-4" style="padding-top:46px">
			<div class="page-header">
			  	<h4>最新文章</h4>
			</div>
			<div class="news" >
				@foreach($news as $article)
		        	<div class="media">
					  	<div class="media-left">
						    <a href='{{ url("article/{$article->id}") }}.html'>
						      	<img class="media-object" width="50" src='{{ url("storage/article/{$article->thumb}") }}' alt="...">
						    </a>
					    </div>
						<div class="media-body">
						    <h4 class="media-heading"><a href='{{ url("article/{$article->id}") }}.html'>{{ $article->title }}</a></h4>
						    {{ $article->desc }}
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>

<script>
var domain = "{{ url('') }}";
var _token = "{{ csrf_token() }}";

window.onload = function(){
	$("#thumbs-up").click(function(){

		var id = $(this).attr("articleid");

		$.ajax({
		    url: domain + '/article/thumbs_up',
		    type: 'POST',
		    data: {id : id, _token: _token},
		    dataType: 'json',
		    success: function(result) {
		    	if(result.success){
		    		$(".thumbs-up").text("(" + result.like + ")");
		    	} else {
		    		if(result.msg){
		    			alert(result.msg);
		    		}
		    	}
		        // Do something with the result
		    }
		});
	});
}
</script>
@endsection

@section('title')
	{{ $article->title }}
@endsection
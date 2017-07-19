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
				  	<h3>{{ $article->title }}</h3>
				  	<p><span class="glyphicon glyphicon-time"></span>&nbsp;{{ $article->created_at }}</p>
				</div>
				<p>{{ $article->desc }}</p>
				<ul class="imglist">
					@foreach($paths as $path)
					<li><img src='{{ asset("storage/{$path}") }}' alt=""></li>
					@endforeach
				</ul>
			</div>
			<nav aria-label="...">
				<ul class="pager">
				    @if($pre)<li><a href='{{ url("article/{$pre->id}") }}.html'>上一篇：{{ $pre->title }}</a></li>@endif
				    @if($next)<li><a href='{{ url("article/{$next->id}") }}.html'>下一篇：{{ $next->title }}</a></li>@endif
			  	</ul>
			</nav>
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
@endsection

@section('title')
	{{ $article->title }}
@endsection
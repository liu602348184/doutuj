@extends('layout')

@section('content')
	<div class="container">

		<div class="row">
			<div class="col-xs-12 col-md-8">
				<div class="page-header">
				  	<h1>{{ $subtitle }}</h1>
				</div>
				<ul class="facelist">
					@foreach($facelist as $face)
					<li class="col-xs-12 col-sm-6 col-md-3"><div class="facepic"><img src='{{ url("storage/{$face->path}") }}' alt=""></div></li>
					@endforeach
				</ul>
				<div class="pull-left">
					{{ $facelist->links() }}
				</div>
			</div>
			<div class="hidden-xs col-md-4">
				<div class="page-header" style="margin-top:27px">
				  	<h4><font class="glyphicon glyphicon-list-alt"></font>&nbsp;最新文章  <small><a href="{{ url('article') }}">更多>></a></small></h4>
				</div>
				<div class="news" style="padding-top: 10px">
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
	{{ $subtitle }}
@endsection
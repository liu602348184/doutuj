@extends('layout')

@section('content')
	<div class="container">

		<div class="row">
			<div class="col-xs-12 col-md-8">
				<div class="col-xs-12 col-md-12">
					<div class="page-header">
					  	<h3>{{ $subtitle }}</h3>
					</div>
				</div>
				<div class="col-xs-12 col-md-12">
					<ul class="facelist">
						@foreach($facelist as $face)
						<li><div class="facepic"><img src='{{ url("storage/{$face->path}") }}' alt=""></div></li>
						@endforeach
					</ul>
				</div>
				<div class="pull-left col-md-12">
					{{ $facelist->links() }}
				</div>
			</div>
			<div class="hidden-xs col-md-4">
				<div class="page-header" style="margin-top:27px">
				  	<h4>最新文章</h4>
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
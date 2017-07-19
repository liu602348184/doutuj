@extends('layout')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-12">
				<div class="page-header">
				  	<h3>@yield('title')</h3>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-md-12">
				<ul class="articlelist">
					@foreach($articles as $article)
					<li class="col-xs-12 col-md-6">
						<div class="media">

						  	<div class="media-left">
							    <a href='{{ url("article/{$article->id}.html") }}'>
							      	<img class="media-object" src='{{ url("storage/article/{$article->thumb}") }}' alt="...">
							    </a>
						    </div>

							<div class="media-body">
								<a href='{{ url("article/{$article->id}.html") }}'>
								    <h4 class="media-heading">{{ $article->title }}</h4>
								</a>
							    {{ $article->desc }}
							</div>

							<div class="media-right">
								<a href='{{ url("storage/download/{$article->zip}") }}'><font size="3" class="glyphicon glyphicon-download-alt"></font></a>
							</div>
						</div>
					</li>
					@endforeach
				</ul>
			</div>
			<div class="col-xs-12">
				<div class="pull-left">
					{{ $articles->links() }}
				</div>
			</div>
		</div>
	</div>
@endsection

@section('article')
	active
@endsection

@section('title')
	表情包下载
@endsection
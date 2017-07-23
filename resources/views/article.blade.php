@extends('layout')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-12">
				<div class="page-header">
				  	<h3>{{ $title }}</h3>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-md-12">
				<ul class="articlelist">
					@foreach($articles as $key => $article)
					<li class="col-xs-12 col-md-6 @if($key%2 == 0) linefirst @endif">
						<div class="media">

						  	<div class="media-left">
							    <a href='{{ url("article/{$article->id}.html") }}'>
							    	<div class="radius">
							      		<img class="media-object" src='{{ url("storage/article/{$article->thumb}") }}' alt="...">
							    		
							    	</div>
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
							<div class="media-bottom">
								<div class="pull-left">
									@foreach($article->tags() as $tag)
									<span class="label label-default">
										<span class="glyphicon glyphicon-tag"></span>
										&nbsp;{{ $tag }}
									</span>
									@endforeach
								</div>
								<div class="pull-right">
									<p style="margin: 0px">
										<font size="4"><span class="glyphicon glyphicon-thumbs-up"></span></font>
										<!-- <span class="badge">4</span> <--><span class="text">({{ $article->like }})</span>
										&nbsp;
										<font size="4"><span class="glyphicon glyphicon-eye-open"></span></font>
										<span class="text">({{ $article->show }})</span>
									</p>
								</div>
								<div style="clear: both"></div>
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


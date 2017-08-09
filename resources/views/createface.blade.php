@extends('layout')

@section('content')
	<div class="container">
		<div class="row" style="margin-bottom:30px">
			<div class="col-xs-12 col-md-12">
				<div class="page-header">
				  	<h1><span class="glyphicon glyphicon-picture"></span> {{ $title }} <small>快速生成表情包</small></h1>
				</div>
			</div>
			<div class="col-xs-12 col-md-3">
				<div class="editpic">
					<div class="thumbnail" style="margin-bottom:10px">
						@if(count($tpllist))
						<img src='{{ asset("storage/{$tpllist[0]->path}") }}' tplid="{{ $tpllist[0]->id }}" alt="" style="margin-bottom: -40px">
						@endif
						<div class="phrase">
							<input placeholder="在此输入你要说的话" id="phrase" name="phrase" type="text">
						</div>
					</div>
					<button style="width:100%" id="submit" class="btn btn-primary">一键生成</button>
				</div>
			</div>

			<div class="col-xs-12 col-md-9" style="height:310px">
				<div class="scrollpanel">
					<ul id="piclist">
						@foreach ($tpllist as $li)
						<li>
							<img src='{{ asset("storage/{$li->path}") }}' tplid="{{ $li->id }}" alt="">
						</li>
						@endforeach
					</ul>
					<div style="clear:both"></div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xs-12 col-md-6">
				<ul class="nav nav-tabs">
				  	<li class="active"><a href="#tab1" data-toggle="tab"><font class="glyphicon glyphicon-list-alt"></font>&nbsp;最新文章 </a></li>
				  	<li><a href="#tab2" data-toggle="tab"><font class="glyphicon glyphicon-fire"></font>&nbsp;最热文章 </a></li>
				</ul>
				<div class="tab-content" style="padding-top: 20px">
					<div class="tab-pane active" id="tab1">
						<div class="news">
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
					<div class="tab-pane" id="tab2">
						<div class="news" >
						@foreach($hot as $article)
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
			<div class="col-xs-12 col-md-6">
				<div class="page-header" style="padding: 1px">
				  	<h4><span class="glyphicon glyphicon-tags"></span>&nbsp;&nbsp;热门标签</h4>
				</div>
				<div class="row">
					<div class="col-xs-12" style="line-height: 25px">
					@foreach($hot_tags as $tag)
						<span class="label label-default">
							<span class="glyphicon glyphicon-tag"></span>
							&nbsp;{{ $tag }}
						</span>
					@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="createface" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog modal-sm" role="document">
		    <div class="modal-content">
		       	<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title">表情预览</h4>
			    </div>
			    <div class="modal-body">
			    	<div class="preview">
			    		<img width='100%' id="preview_pic" src="#" alt="">
			    	</div>
			    	<div>
			    		<a id="download" href="#">
			    			<span class="glyphicon glyphicon-download-alt pull-right"></span>
			    		</a>
			    		<div style="clear:both"></div>
			    	</div>
			    </div>
		    </div>
		</div>
	</div>	 
	<script>
		var domain = "{{ env('APP_URL') }}";
		var _token = "{{ csrf_token() }}";

		window.onload = function(){
			$("#piclist>li>img").click(function(){
				var src = $(this).attr('src');
				var tplid = $(this).attr('tplid');
				$(".thumbnail>img").attr('src', src).attr('tplid', tplid);
			});

			$("#submit").click(function(){
				var tplid = $(".thumbnail>img").attr('tplid');
				var phrase = $("#phrase").val();
				
				if(!phrase){
					alert("请输入你要说的话");
					return false;
				}

				$.post(domain + "/templateface/create", {
					tplid : tplid,
					phrase : phrase,
					_token : _token
				}, function(msg){
					if(msg.success){
						var src = domain + "/storage/" + msg.path;
						var href = domain + "/createface/download/" + msg.id + ".jpg";
						$("#preview_pic").attr("src", src);
						$("#download").attr("href", href);
						$("#createface").modal('show');
						$("#phrase").val('');
					}else{
						alert("服务器出错");
					}
				}, 'json');
			});
		}
	</script>
@endsection

@section('home')
	active
@endsection

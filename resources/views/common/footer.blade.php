			<footer class="footer">
				<div class="container">
					<p><img src="{{ env('APP_URL') }}/img/logo.png" alt=""></p>
					<p>版权声明：本站资源均来自于互联网，其著作权归原作者所有，如果有侵犯您的权益，请来信告知，我们将尽快作出处理。</p>
					<p>联系我们：602348184@qq.com</p>
					<p>苏ICP备17044940号-1</p>
					<script>
						var _hmt = _hmt || [];
						(function() {
							var hm = document.createElement("script");
							hm.src = "https://hm.baidu.com/hm.js?b65cb63dcf130578d0a512d90e96405e";
							var s = document.getElementsByTagName("script")[0]; 
							s.parentNode.insertBefore(hm, s);
						})();

						/* baidu pushing */
						(function(){
						    var bp = document.createElement('script');
						    var curProtocol = window.location.protocol.split(':')[0];
						    if (curProtocol === 'https') {
						        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';        
						    }
						    else {
						        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
						    }
						    var s = document.getElementsByTagName("script")[0];
						    s.parentNode.insertBefore(bp, s);
						})();
						/* baidu pushing */
					</script>
				</div>
			</footer>
			<!--[if lt IE 9]>
				<script src="{{ env('APP_URL') }}/js/jquery-1.9.1-min.js"></script>
			<![endif]-->
			<!--[if gte IE 9]>
				<script src="{{ env('APP_URL') }}/js/jquery.min.js"></script>
			<![endif]-->
			<!--[if !IE]>
				<!-->
				<script src="{{ env('APP_URL') }}/js/jquery.min.js"></script>
			<![endif]-->
			<script src="{{ env('APP_URL') }}/js/bootstrap.min.js"></script>
		</div>
	</body>
</html>
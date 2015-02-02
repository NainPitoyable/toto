<!DOCTYPE HTML>
<html>
<head>
<title><?=$display['title']?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<link href="view/css/style.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<!-----start-wrap--------->
	<div class="wrap">
		<!-----start-content--------->
		<div class="content">
			<!-----start-logo--------->
			<div class="logo">
				<h1><a href="index.php"><img src="view/images/logo.png"/></a></h1>
				<span><img src="view/images/signal.png"/><?=$display['error']?></span>
			</div>
			<!-----end-logo--------->
			<!-----start-search-bar-section--------->
			<div class="buttom">
				<div class="seach_bar">
					<br />
					<p><span><a href="index.php"><?=$display['return']?></a></span></p>
					<br />
					<br />
						
				</div>
			</div>
			<!-----end-sear-bar--------->
		</div>
		<!----copy-right-------------->

	</div>

	<!---------end-wrap---------->
</body>
</html>
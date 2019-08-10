<!DOCTYPE html>
<html>
<head>
	<title>Developers</title>
	<style type="text/css">
	body{
		background: lightgreen;
	}
		.founder{
			width: 200px;
			height: 200px;
			background: transparent;
			border: none;
			position: absolute;
			left: 30%;
			padding: 0px;
		}
		.founder img{
			z-index: -1;
			position: relative;
		}
		.founder .page-header{
			position: relative;
			top: 0px;
			color: white;
			text-align: center;
			background: rgba(0,0,0,.8);
			padding: 3px;
			z-index: 1;
		}
		.founder .footer{
			position: absolute;
			color: white;
			top: 83%;
			text-align: center;
			background: rgba(0,0,0,.4);
			padding: 3px;
			z-index: 1;
		}
		.founder:hover, img:focus{
			z-index: 1;
			transform: scale(1.1);
			cursor: pointer;
			transition: .4s ease-out;
			box-shadow: 3px 3px 6px rgba(0,0,0,.3);
		}
		.founder:hover, .page-header:focus{
			background: rgba(0,0,0,.3);
		}
	</style>
</head>
<body>
	<div class="founder">
		<div class="page-header">
			The Co-founder of Ulibrary.org
		</div>
		<img src="img/8.jpeg" width="200px" height="200px" title="hello am Arnauld Anguh, the co-founder of Ulibrary.org">
		<p class="footer">
		 Arnauld Anguh visit: <a href="">www.theblogger.com</a> for more
		</p>
	</div>
</body>
</html>
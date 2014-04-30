<!DOCTYPE html>
<html lang="en">
<html>
	<head>
		<meta charset="UTF-8">
		<style>
			@import url(//fonts.googleapis.com/css?family=Lato:700);

			body {
				margin:0;
				font-family:'Lato', sans-serif;
				text-align:center;
				color: #999;
			}

			.welcome {
				width: 300px;
				height: 200px;
				position: absolute;
				left: 50%;
				top: 50%;
				margin-left: -150px;
				margin-top: -100px;
			}

			a, a:visited {
				text-decoration:none;
			}

			h1 {
				font-size: 32px;
				margin: 16px 0 0 0;
			}
		</style>
		<title>My Auth System</title>
	</head>
	<body>
		@if(Session::has('global'))
			<p>{{ Session::get('global') }}</p>
		@endif
		
		@include('layout.navigation')
		@yield('content') 
	</body>
</html>
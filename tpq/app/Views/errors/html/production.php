<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="robots" content="noindex">

	<title>Whoops!</title>

	<style type="text/css">
		body {
			margin: 0;
			padding: 0;
		}

		* {
			box-sizing: border-box;
			font-family: "Open Sans", serif;
		}

		.container {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			height: 100vh;
		}

		.headline {
			font-size: 5rem;
			margin: 0;
		}

		.lead {
			font-weight: bold;
			color: #444;
			font-size: 120%;
		}

		#btn-coba {
			text-decoration: none;
			margin-top: 2rem;
			padding: .75rem 2rem .75rem 2rem;
			border: solid 2px black;
			font-size: 120%;
			color:  #6f42c1;
			font-weight: bold;
			position: relative;
			background: transparent;
			overflow: hidden;
			transition: color .3s;
		}

		#btn-coba::before {
			content: '';
			position: absolute;
			top: 0;
			left: 100%;
			width: 100%;
			height: 100%;
			background-color: #6f42c1;
			transition: left .3s;
			z-index: -1;
		}

		#btn-coba::after {
			content: '';
			position: absolute;
			bottom: 0;
			right: 100%;
			width: 100%;
			height: 100%;
			background-color: #6f42c1;
			transition: right .3s;
			z-index: -1;
		}

		#btn-coba:hover {
			color: white;
			transition: color .3s;
		}

		#btn-coba:hover::before {
			left: 50%;
			transition: left .3s;
		}

		#btn-coba:hover::after {
			right: 50%;
			transition: right .3s;
		}


		.btn-box {
			overflow: hidden;
			padding: 1rem 0;
			position: relative;
		}

		.btn-box > .overlay {
			background-color: rgba(111, 66, 193, 1);
			position: absolute;
			top: 4px;
			left: 2px;
			right: 2px;
			bottom: 4px;
			z-index: 2;
			display: flex;
			justify-content: center;
			align-items: center;
			font-weight: bold;
			font-size: 120%;
			color: white;
		}


	</style>
</head>
<body>

	<div class="container">
		<h1 class="headline">Oops!</h1>
		<p class="lead">Tidak dapat terhubung ke server, silahkan coba lagi ...</p>
		<div class="btn-box">
			<a href="/" id="btn-coba">Coba Lagi</a>
		</div>
	</div>

	<script>
		const btnCoba = document.querySelector('#btn-coba')
		const btnBox = document.querySelector('.btn-box')

		btnCoba.addEventListener('click', (e) => {
			let node = document.createElement('div')
			node.classList.add('overlay')
			node.innerHTML = "Loading ..."
			btnBox.appendChild(node)
		})
	</script>

</body>

</html>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet"
	href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.8/styles/monokai.min.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.8/highlight.min.js"></script>
	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body style="font-family: georgia, garamond, serif; font-size:16px; font-style:italic; width:90%">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/h5ai/#">Home</a></li>
			<?php foreach ($bread as $key => $value): ?>
				<li class="breadcrumb-item"><a href="/h5ai/<?=$key?>"><?=$value?></a></li>
			<?php endforeach ?>
		</ol>
	</nav>
	<div class="row">
		<div class="col-2 small">
			<div class="list-group list-group-flush" id="list-tab" role="tablist">
				<?php foreach ($files as $key => $value): ?>
					<a class="list-group-item h-25 p-1" href="<?=str_replace("//", "/", $_SERVER['REQUEST_URI'] . '/' . $key)?>" role="tab">
						<?=$key?>
					</a>
				<?php endforeach ?>
			</div>
		</div>
		<div class="offset-1 col-8">
			<div class="container col-12">
				<div class="tab-content row" id="nav-tabContent">
					<?php if ($current): ?>
						<pre><code class="<?=$extension?>" style="min-width:1200px; min-height:720px"><?=$current?></code></pre>
					<?php else: ?>
						<?php foreach ($files as $key => $value): ?>
							<div class="card" style="width: 10rem; border: 0px;" data-href="<?=str_replace("//", "/", $_SERVER['REQUEST_URI'] . '/' . $key)?>">
								<div class="card-body">
									<?php if ($value): ?>
										<img src="https://img.icons8.com/ultraviolet/40/000000/opened-folder.png">
									<?php else: ?>
										<img src="https://img.icons8.com/color/48/000000/document.png">
									<?php endif ?>
									<p class="card-text element"><?=$key?></p>
								</div>
							</div>
						<?php endforeach ?>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>		

	<!-- SCRIPTS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<script>
		window.onload = function() {
			$(".card").click(function(e){
				$('.card-body').removeClass("bg-primary");
				$('.card').removeClass("bg-primary");
				$(e.target.parentElement).addClass("bg-primary");
			});
			$(".card").dblclick(function(e){
				$('.card-body').removeClass("bg-primary");
				$('.card').removeClass("bg-primary");
				location.href = $(e.target.offsetParent).attr('data-href')
			});
		};
	</script>
</body>
</html>
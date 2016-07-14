<!doctype html>
<html lang="en">
<?php
//    header('Content-Disposition: inline; filename="file.pdf"');
?>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Activations</title>
	<link rel="stylesheet" href="<?=base_url('assets/css/foundation.css');?>">
	<link rel="stylesheet" href="<?=base_url('assets/css/foundation-icons/foundation-icons.css');?>">
	<script>
		var MyNameSpace = {
			config: {
				base_url: "<?php echo base_url(); ?>"
			}
		}
	</script>
	<script type="text/javascript" src="<?= base_url('assets/js/jquery-1.11.3.min.js');?>"></script>
	<script src="<?=base_url('assets/js/vendor/modernizr.js');?>"></script>
</head>
<body>
<a href="#" data-reveal-id="myModal">Click Me For A Modal</a>

<div id="myModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
	<h2 id="modalTitle">Awesome. I have it.</h2>
	<p class="lead">Your couch.  It is mine.</p>
	<p>I'm a cool paragraph that lives inside of an even cooler modal. Wins!</p>
	<a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>

<script src="<?=base_url('assets/js/vendor/jquery.js');?>"></script>
<script src="<?=base_url('assets/js/foundation.min.js');?>"></script>
<script>
	$(document).foundation({
		abide: {
			patterns: {
				password: /^(.){8,}$/
			}
		}
	});
</script>
</body>

</html>
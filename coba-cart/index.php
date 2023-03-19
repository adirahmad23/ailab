<?php
//index.php
?>
<!DOCTYPE html>
<html>

<head>
	<title>PHP Ajax Shopping Cart by using Bootstrap Popover</title>
	<script src="js/jquery.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<script src="js/bootstrap.min.js"></script>
	<style>
		.popover {
			width: 100%;
			max-width: 800px;
		}
	</style>
</head>

<body>
	<div class="container">
		<br />
		<h3 align="center"><a href="#">PHP Ajax Shopping Cart by using Bootstrap Popover</a></h3>
		<br />
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Menu</span>
						<span class="glyphicon glyphicon-menu-hamburger"></span>
					</button>
					<a class="navbar-brand" href="/">Webslesson</a>
				</div>

				<div id="navbar-cart" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li>
							<a id="cart-popover" class="btn" data-placement="bottom" title="List Barang Peminjaman">
								<span class="glyphicon glyphicon-shopping-cart"></span>
								<span class="badge"></span>
								<!-- <span class="total_price">$ 0.00</span> -->
							</a>
						</li>
					</ul>
				</div>

			</div>
		</nav>
		<div id="popover_content_wrapper" style="display: none">
			<span id="cart_details"></span>
			<div align="right">
				<a href="#" class="btn btn-primary" id="check_out_cart">
					<span class="glyphicon glyphicon-shopping-cart"></span> Check out
				</a>
				<a href="#" class="btn btn-default" id="clear_cart">
					<span class="glyphicon glyphicon-trash"></span> Clear
				</a>
			</div>
		</div>

		<div id="display_item">


		</div>

	</div>
</body>

</html>

<script>
	$(document).ready(function() {

		load_product();

		load_cart_data();

		function load_product() {
			$.ajax({
				url: "fetch_item.php",
				method: "POST",
				success: function(data) {
					$('#display_item').html(data);
				}
			});
		}

		function load_cart_data() {
			$.ajax({
				url: "fetch_cart.php",
				method: "POST",
				dataType: "json",
				success: function(data) {
					$('#cart_details').html(data.cart_details);
					$('.total_price').text(data.total_price);
					$('.badge').text(data.total_item);
				}
			});
		}

		$('#cart-popover').popover({
			html: true,
			container: 'body',
			content: function() {
				return $('#popover_content_wrapper').html();
			}
		});

		$(document).on('click', '.add_to_cart', function() {

			var idbarang = $(this).attr("id");

			var namabarang = $('#namabarang' + idbarang + '').val();
			var merek = $('#merek' + idbarang + '').val();
			var kuantiti = $('#kuantiti' + idbarang).val();
			var kdbarang = $('#kdbarang' + idbarang).val();
			var action = "add";
			if (kuantiti > 0) {
				$.ajax({
					url: "action.php",
					method: "POST",
					data: {
						idbarang: idbarang,
						namabarang: namabarang,
						merek: merek,
						kuantiti: kuantiti,
						kdbarang: kdbarang,
						action: action
					},
					success: function(data) {
						load_cart_data();
						alert("Item has been Added into Cart");
					}
				});
			} else {
				alert("lease Enter Number of Quantity");
			}
		});

		$(document).on('click', '.delete', function() {
			var idbarang = $(this).attr("id");
			var action = 'remove';
			if (confirm("Are you sure you want to remove this product?")) {
				$.ajax({
					url: "action.php",
					method: "POST",
					data: {
						idbarang: idbarang,
						action: action
					},
					success: function() {
						load_cart_data();
						$('#cart-popover').popover('hide');
						alert("Item has been removed from Cart");
					}
				})
			} else {
				return false;
			}
		});

		$(document).on('click', '#clear_cart', function() {
			var action = 'empty';
			$.ajax({
				url: "action.php",
				method: "POST",
				data: {
					action: action
				},
				success: function() {
					load_cart_data();
					$('#cart-popover').popover('hide');
					alert("Your Cart has been clear");
				}
			});
		});

	});
</script>
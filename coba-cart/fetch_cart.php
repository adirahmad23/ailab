<?php

//fetch_cart.php

session_start();

$total_price = 0;
$total_item = 0;

$output = '
<div class="table-responsive" id="order_table">
	<table class="table table-bordered table-striped">
		<tr>  
            <th width="10%">Kode Barang</th>  
            <th width="10%">Nama Barang</th>  
            <th width="20%">Merek</th>  
            <th width="15%">Kuantiti</th>  
            <th width="5%">Aksi</th>  
        </tr>
';
if (!empty($_SESSION["shopping_cart"])) {
	foreach ($_SESSION["shopping_cart"] as $keys => $values) {
		$output .= '
		<tr>
			<td>' . $values["kdbarang"] . '</td>
			<td>' . $values["product_name"] . '</td>
			<td align="right">' . $values["product_price"] . '</td>
			<td align="right">' . $values["product_quantity"] . '</td>
			<td><button name="delete" class="btn btn-danger btn-xs delete" id="' . $values["product_id"] . '">Remove</button></td>
		</tr>
		';
		$total_item = $total_item + 1;
	}
} else {
	$output .= '
    <tr>
    	<td colspan="5" align="center">
    		Your Cart is Empty!
    	</td>
    </tr>
    ';
}
$output .= '</table></div>';
$data = array(
	'cart_details'		=>	$output,
	'total_price'		=>	'$' . number_format($total_price, 2),
	'total_item'		=>	$total_item
);

echo json_encode($data);

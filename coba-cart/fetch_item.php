<?php
// fetch_item.php

include('database_connection.php');

$query = "SELECT * FROM tb_barang ORDER BY id_barang DESC";

$statement = $connect->prepare($query);

if ($statement->execute()) {
	$result = $statement->fetchAll();

	echo "<table class='table table-striped' id='table1'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Kode Barang</th>";
	echo "<th>Nama Barang</th>";
	echo "<th>Merek</th>";
	echo "<th>Jumlah Stock</th>";
	echo "<th>Aksi</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";

	foreach ($result as $row) {
		echo "<tr>";
		echo "<td>" . $row['kd_barang'] . "</td>";
		echo "<td>" . $row['nama_barang'] . "</td>";
		echo "<td>" . $row['merek'] . "</td>";
		echo "<td>" . $row['kuantiti'] . "</td>";
		echo "<td>";
		echo '	<input type="hidden" name="quantity" id="quantity' . $row["id_barang"] . '" class="form-control" value="1" />
				<input type="hidden" name="hidden_name" id="kdbarang' . $row["id_barang"] . '" value="' . $row["kd_barang"] . '" />
				<input type="hidden" name="hidden_name" id="name' . $row["id_barang"] . '" value="' . $row["nama_barang"] . '" />
				<input type="hidden" name="hidden_price" id="price' . $row["id_barang"] . '" value="' . $row["merek"] . '" />
				<input type="button" name="add_to_cart" id="' . $row["id_barang"] . '" style="margin-top:5px;" class="btn btn-warning form-control add_to_cart" value="Keranjang" />';
		// echo "<input type='button' class='btn btn-primary' value='Tambah'>";
		echo "</td>";
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
}

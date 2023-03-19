<?php
// fetch_item.php

include('database_connection.php');
$kon = new Koneksi();

$query = $kon->kueri("SELECT * FROM tb_barang ORDER BY id_barang DESC");

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

foreach ($query as $row) {
	echo "<tr>";
	echo "<td>" . $row['kd_barang'] . "</td>";
	echo "<td>" . $row['nama_barang'] . "</td>";
	echo "<td>" . $row['merek'] . "</td>";
	echo "<td>" . $row['kuantiti'] . "</td>";
	echo "<td>";
	echo '	<input type="hidden" name="kuantiti" id="kuantiti' . $row["id_barang"] . '" class="form-control" value="1" />
				<input type="hidden" name="kdbarang" id="kdbarang' . $row["id_barang"] . '" value="' . $row["kd_barang"] . '" />
				<input type="hidden" name="nama" id="namabarang' . $row["id_barang"] . '" value="' . $row["nama_barang"] . '" />
				<input type="hidden" name="merek" id="merek' . $row["id_barang"] . '" value="' . $row["merek"] . '" />
				<input type="button" name="add_to_cart" id="' . $row["id_barang"] . '" style="margin-top:5px;" class="btn btn-warning form-control add_to_cart" value="Keranjang" />';
	// echo "<input type='button' class='btn btn-primary' value='Tambah'>";
	echo "</td>";
	echo "</tr>";
}
echo "</tbody>";
echo "</table>";

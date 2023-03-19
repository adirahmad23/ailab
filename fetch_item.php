<?php
// fetch_item.php

include('koneksi.php');
$kon = new Koneksi();

$query = $kon->kueri("SELECT * FROM tb_barang ORDER BY id_barang DESC");

echo '<tr>
                                    <td>Graiden</td>
                                    <td>vehicula.aliquet@semconsequat.co.uk</td>
                                    <td>076 4820 8838</td>

                                    <td>
                                        <input type="button" class="btn btn-primary" value="Tambah">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dale</td>
                                    <td>fringilla.euismod.enim@quam.ca</td>
                                    <td>0500 527693</td>

                                    <td>
                                        <input type="button" class="btn btn-primary" value="Tambah">
                                    </td>
                                </tr>';

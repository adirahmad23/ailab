<?php
// data yang akan dikirim dalam format JSON
$data = array(
    "link" => "https://example.com",
);

// konversi data menjadi format JSON
$json_data = json_encode($data);

// atur tipe konten menjadi aplikasi/json
header('Content-Type: application/json');

// kirimkan data dalam format JSON ke ESP8266
echo $json_data;

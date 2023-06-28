<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Periksa apakah data 'ktm' ada dalam request
    if (isset($_POST['ktm'])) {
        $ktm = $_POST['ktm'];

        // Lakukan operasi yang diinginkan dengan nilai $ktm
        // Misalnya, menyimpannya dalam session
        session_start();
        $_SESSION['ktm'] = $ktm;

        // Kirim respons balik ke JavaScript
        $response = "Data KTM yang diterima dan disimpan dalam session: " . $ktm;
        echo $response;
    } else {
        // Jika data 'ktm' tidak ada dalam request
        echo "Data KTM tidak ditemukan dalam request.";
    }
} else {
    // Jika request bukan metode POST
    echo "Metode yang diterima bukan POST.";
}


if (isset($_POST['unset'])) {
    session_start();
    unset($_SESSION['ktm']);
}

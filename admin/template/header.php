      <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                   <?php
                    $file_name = basename($_SERVER['PHP_SELF']);
                    $directory = str_replace('/' . $file_name, '', $_SERVER['PHP_SELF']);
                    $url = $directory . '/' . str_replace('.php', '', $file_name);
                    $url = str_replace('/ailab/', '', $url);
                    ?>  
                <?php if ($url == 'admin/index') { echo '<title>Dashboard</title>';} ?>
                <?php if ($url == 'admin/barang') { echo '<title>List Barang</title>';} ?>
                <?php if ($url == 'admin/datamhsw') { echo '<title>Tambah Mahasiswa</title>';} ?>
                <?php if ($url == 'admin/peminjaman') { echo '<title>Peminjaman Barang</title>';} ?>
                <?php if ($url == 'admin/pengembalian') { echo '<title>Pengembalian Barang</title>';} ?>
                <?php if ($url == 'admin/persetujuan') { echo '<title>Persetujuan</title>';} ?>
                <?php if ($url == 'admin/riwayat') { echo '<title>Riwayat Peminjaman</title>';} ?>
                <link rel="stylesheet" href="assets/css/main/app.css">
                <link rel="stylesheet" href="assets/css/main/app-dark.css">
                <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/x-icon">
                <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/png">

                <link rel="stylesheet" href="assets/extensions/simple-datatables/style.css">
                <link rel="stylesheet" href="assets/css/pages/simple-datatables.css">

            </head>
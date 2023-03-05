<?php
include "koneksi.php";
$kon = new Koneksi();

//check if the form has been submitted
if(isset($_POST['delete'])){
    $id = $_POST['delete'];

    //create query to delete data from table
        $query = $kon->kueri("DELETE FROM tb_barang WHERE id = $id ");

    // $query = "DELETE FROM users WHERE id = $id";

    //execute the query
    $result = $kon->jumlah_data($query);

    //check if the query executed successfully
    if($result){
        echo "Data has been deleted successfully";
    }else{
        echo "Error deleting data";
    }
}

//display the table
$query = $kon->kueri("SELECT * FROM tb_barang");
$result = $kon->jumlah_data($query);
echo '<table>';
echo '<tr><th>ID</th><th>Name</th><th>Email</th><th>Action</th></tr>';
while($row= $kon->hasil_data($query)){
    echo '<tr>';
    echo '<td>' . $row['id_barang'] . '</td>';
    echo '<td>' . $row['nama_barang'] . '</td>';
    echo '<td>' . $row['kuantiti'] . '</td>';
    echo '<td>';
    echo '<button type="button" data-toggle="modal" data-target="#deleteModal-' . $row['id_barang'] . '">Delete</button>';
    echo '</td>';
    echo '</tr>';

    //modal confirmation dialog box
    echo '<div class="modal fade" id="deleteModal-' . $row['id_barang'] . '" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">';
    echo '<div class="modal-dialog" role="document">';
    echo '<div class="modal-content">';
    echo '<div class="modal-header">';
    echo '<h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>';
    echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
    echo '<span aria-hidden="true">&times;</span>';
    echo '</button>';
    echo '</div>';
    echo '<div class="modal-body">';
    echo 'Are you sure you want to delete this data?';
    echo '</div>';
    echo '<div class="modal-footer">';
    echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>';
    echo '<form method="POST">';
    echo '<button type="submit" class="btn btn-danger" name="delete" value="' . $row['id_barang'] . '">Delete</button>';
    echo '</form>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
echo '</table>';


?>



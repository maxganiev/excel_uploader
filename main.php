<?php
require('config.php');

//creating a query to get data from certain table in db:
$query = 'SELECT * FROM `delivery_pricelist`';

//get result of quering:
$res = mysqli_query($connection, $query);

$data = mysqli_fetch_all($res, MYSQLI_ASSOC);


$printMsg = [];

if ($_FILES['fileupload']['name'] !== '') {
  if (count($data) !== 0) {
    $removal =  'DELETE FROM  `delivery_pricelist`';

    if (mysqli_query($connection, $removal)) {
      $printMsg[] = 'Table successfully updated';
    } else {
      $printMsg[] = 'A problem has occured while updating the table';
    }
  }

  $file = $_FILES['fileupload']['tmp_name'];
  $file_open = fopen($file, 'r');
  while (($csv = fgetcsv($file_open, 1000, ';')) !== false) {
    $cbm = $csv[0];
    $freight = $csv[1];
    $export_charges = $csv[2];
    $pickup = $csv[3];
    $expd = $csv[4];

    mysqli_query($connection, "INSERT INTO delivery_pricelist VALUES ('$cbm','$freight', '$export_charges', '$pickup', '$expd')");
  }


  $printMsg[] = 'File has been successfully uploaded to db';
} else {
  $printMsg[] = 'Append the file!';
}


$encoded = '';
foreach ($printMsg as $msg) {
  $encoded = $encoded  .  $msg . '. ';
}

echo json_encode($encoded);




//free res:
mysqli_free_result($res);

//closing connection:
mysqli_close($connection);

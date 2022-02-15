<?php
$connection = mysqli_connect('playground', 'root', '', 'tutorial_pricelist_2');

//checking for connection errors:
if (mysqli_connect_errno()) {
  echo mysqli_connect_errno();
}

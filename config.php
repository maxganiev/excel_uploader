<?php
if (filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_URL) == "playground") {
  define("DB_HOST", 'playground');
  define("DB_USERNAME",  'root');
  define("DB_PASSWORD", '');
  define("DB_NAME", 'tutorial_pricelist_2');
} else {
  //Get Heroku ClearDB connection information
  $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));

  define("DB_HOST", $cleardb_url["host"]);
  define("DB_USERNAME",  $cleardb_url["user"]);
  define("DB_PASSWORD", $cleardb_url["pass"]);
  define("DB_NAME", substr($cleardb_url["path"], 1));
  $query_builder = TRUE;
}

$connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

//checking for connection errors:
if (mysqli_connect_errno()) {
  echo mysqli_connect_errno();
}

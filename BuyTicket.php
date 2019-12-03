<?php require_once('Connections/koneksi.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tiket (tempatberkunjung, jumlahpengunjung, tanggalberkunjung) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['tempatberkunjung'], "text"),
                       GetSQLValueString($_POST['jumlahpengunjung'], "text"),
                       GetSQLValueString($_POST['tanggalberkunjung'], "date"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());

  $insertGoTo = "http://localhost/liburanku/eticketprint.html";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>LiburanKu</title>
<!-- Bootstrap -->
<link href="css/bootstrap-4.0.0.css" rel="stylesheet">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: black;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}
.container1{
  padding: 16px;
}
.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
</head>
<body>
<div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container1"><a class="navbar-brand" href="#"><h2>LiburanKu</h2></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/liburanku/LiburanKu_HomePage.html#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active"> <a class="nav-link" href="http://localhost/liburanku/LiburanKu_Destination.html#">Destinations</a> </li>
   <li class="nav-item"> <a class="nav-link" href="http://localhost/liburanku/LiburanKu_AboutUs.html#">About Us<span class="sr-only">(current)</span></a> </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search Places" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
          <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="http://localhost/liburanku/photos.jpg" alt="User" width="40" class="rounded-circle"></a><br>
          
            <div class="dropdown-menu" aria-labelledby="navbarDropdown"><a class="dropdown-item" href="#">My Profile</a> <a class="dropdown-item" href="#">Settings</a>
              <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="http://localhost/liburanku/">Log Out</a>
              </div>
          </li>
        </div>
    
      </div>
    </nav>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <div class="container">
    <h1>Cari tempat wisata bandung terbaik disini</h1>
    <p>Silahkan isi data berikut untuk melanjutkan.</p>
    <hr>
    <label for="text"><strong>Pilih Tempat Wisata</strong></label>
    <br><br>
    <select style="width:100%" id="states" name="tempatberkunjung">
               <option value="KP">Kawah Putih</option>
         <option value="SP">Situ Patenggang</option>
         <option value="FH">Farm House</option>
              </select>
              <br><br>
   
 <label for="text"><strong>Tentukan Waktu Berkunjung</strong></label>
 <br><br>
 <input type="date" name="tanggalberkunjung" class="form-control input-md" required/>
 <br><br>
   
 <label for="nama"><b>Jumlah Pengunjung</b></label>
    <input type="text" placeholder="Masukan Jumlah Pengunjung" name="jumlahpengunjung" required>
    <hr>

    <h1>Informasi Biaya</h1>
    <p>Rp 100.000 (Termasuk tour guide)</p>

    <button type="submit" name="submit" class="registerbtn">Submit</button>
  </div>
  
  <div class="container1 signin">
  </div>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<div class="col-md-4 col-lg-5 col-6">
          <address>
          <strong>LiburanKu Company</strong><br>
Sukabirus Street<br>
Bandung
          </address>
          <address>
          <u>Customer Service : </u>(+62) 81285559743
          </address>
          <address>
          <strong>LiburanKu</strong><br>
          <a href="mailto:#">liburanku@gmail.com</a>
          </address>
        </div>
      </div>
    </div>
    <footer class="text-center">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <p>Copyright © LiburanKu. All rights reserved.</p>
          </div>
        </div>
      </div>
    </footer>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap-4.0.0.js"></script>
</body>
</html>

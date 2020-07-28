<?php
include('config.php');
$nombre       = $_POST['name'];
$precio       = $_POST['precio'];

$mifoto = $_FILES['imagen']['name'];
$foto   = $_FILES['imagen']['tmp_name'];
$folder ="fotos/".$mifoto;

if(move_uploaded_file($foto, $folder)){

$query = ("INSERT INTO productos(
    name,
    precio,
    imagen
    )
VALUES (
    '" .$nombre. "',
    '" .$precio. "',
    '" .$folder. "'
)");
$result = mysqli_query($con, $query);
if ($result > 0) {
    include 'products.php';
    }
} else {
 echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
    }
 ?>


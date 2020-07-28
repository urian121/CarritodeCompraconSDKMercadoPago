<?php
include('config.php');
$idproduct      = $_POST['id'];
$codUser        = $_POST['cod_user'];


$DeletProd = ("DELETE FROM temporalproducts WHERE  idproduct='" .$idproduct. "'");
$res = mysqli_query($con, $DeletProd);
if ($DeletProd) {
$SqlTotal = ("
SELECT
    p.id,
    t.idproduct,
    t.cod_user,
    SUM( p.precio ) AS TotalPaga

FROM productos p, temporalproducts t WHERE p.id=t.idproduct AND t.cod_user='".$codUser."' ");
$jqueryTotal = mysqli_query($con, $SqlTotal);
$arrayTotal = mysqli_fetch_array($jqueryTotal);

echo "Total a Pagar: <span style='color:crimson;'>". number_format($arrayTotal['TotalPaga'], 0, ",", ".") ." $ </span>";
 }
?>

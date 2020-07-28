<?php
session_start();
include('config.php');
if (isset($_SESSION['user']) == "") { ?>
    <script type="text/javascript">
        alert('debe Iniciar Session');
    </script>
<?php }else{


$idproduct      = $_POST['id'];
$cod_user       = $_POST['cod_user'];
$nombre_equipo  = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$mIp            = $_SERVER["REMOTE_ADDR"];
$fecha          = date("d-m-Y");
$cantDefecto           = "1";

//Buscando si el producto ya esta agregado con respecto a dicho usuario en session
$ConsultarProduct = ("SELECT idproduct, cantidad, cod_user FROM temporalproducts WHERE idproduct='".$idproduct."' AND cod_user='".$cod_user."' ");
$jqueryProduct = mysqli_query($con, $ConsultarProduct);
$CantProdExiste = mysqli_num_rows($jqueryProduct);
$arrayCant = mysqli_fetch_array($jqueryProduct);

//caso 1; si ya ese producto agregado con respecto a dicho usuario en session.
if ($CantProdExiste >0) {
$newCantidad = ($arrayCant['cantidad'] + 1);
$UdateCantidad = ("UPDATE temporalproducts SET cantidad='".$newCantidad."' WHERE idproduct='".$idproduct."' AND cod_user='".$cod_user."' ");
$resultUpdat = mysqli_query($con, $UdateCantidad);

$Product = ("SELECT SUM( cantidad ) AS cantidaP FROM temporalproducts WHERE cod_user='".$cod_user."' ");
$MisProducts = mysqli_query($con, $Product);
$arrayProd = mysqli_fetch_array($MisProducts);
echo "<a href='MisProduct.php' style='color:#fefefe;'><img src='img/a.svg' style='width: 40px;'> (". $arrayProd['cantidaP'] .")</a>";

}else{
//caso 2; si el usuario no tiene dicho producto agregado en la bd
$queryInsert = ("INSERT INTO temporalproducts (idproduct , cantidad, cod_user, ip, name_equipo, fecha) VALUES ('$idproduct', '$cantDefecto', '$cod_user', '$mIp', '$nombre_equipo', '$fecha')");
$result = mysqli_query($con, $queryInsert);

$Product = ("SELECT SUM( cantidad ) AS cantidaP FROM temporalproducts WHERE cod_user='".$cod_user."' ");
$MisProducts = mysqli_query($con, $Product);
$arrayProd = mysqli_fetch_array($MisProducts);

echo "<a href='MisProduct.php' style='color:#fefefe;'><img src='img/a.svg' style='width: 40px;'> (". $arrayProd['cantidaP'] .")</a>";

}
}?>

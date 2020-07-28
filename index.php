<?php
session_start();
include('config.php');

if (!empty($_POST)) {

    $usuario =  ($_POST['user']);
    $password = ($_POST['pass']);
    $error_sesion = '';
    $consulta = ("SELECT * FROM users WHERE user COLLATE utf8_bin ='" .$usuario. "' AND pass COLLATE utf8_bin='" .$password. "'");
    $res = mysqli_query($con, $consulta);
    if ($row = mysqli_fetch_assoc($res)) {
        $_SESSION['id']            = $row['id'];
        $_SESSION['user']          = $row['user'];
        $_SESSION['cod_user']      = $row['cod_user'];
        echo '<meta http-equiv="refresh" content="0;url=index.php">';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Carrito - Compra</title>
    <link rel="icon" href="img/logo-mywebsite-urian-viera.svg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
     <style type="text/css">
        a:hover{
            text-decoration: none;
        }
    </style>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="js/jquery-3.1.1.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top" style="background-color: #563d7c !important;">
  <span class="navbar-brand">
      <img src="img/logo-mywebsite-urian-viera.svg" alt="Web Developer Urian Viera" width="120">
        Web Developer Urian Viera
  </span>

<table style="width: 70%;">
    <tr>
        <th style="text-align: center; width: 45%;">
            <strong id="resp" style="color: #fefefe;">
                <?php
                if (isset($_SESSION['user']) != "") {
                $cod_user =  $_SESSION['cod_user'];
                $Product = ("SELECT SUM( cantidad ) AS cantidaP FROM temporalproducts WHERE cod_user='".$cod_user."' ");
                $MisProducts = mysqli_query($con, $Product);
                $arrayProd = mysqli_fetch_array($MisProducts);
                echo "<a href='MisProduct.php' style='color:#fefefe;'><img src='img/a.svg' style='width: 40px;'> (". ($arrayProd['cantidaP'] + 0 ) .")</a>";
                  }else{
                    echo "<img src='img/a.svg' style='width: 40px;'> ( 0 )";
                } ?>

            </strong>

        </th>
        <th>
            <div style="float: right">
            <?php if (isset($_SESSION['user']) != "") { ?>
            <img src="img/user.png" alt="" style="width: 50px;">
            <span style="color: white"><?php  echo ucwords($_SESSION['user']); ?></span>
            <a href="salir.php" style="padding: 0px 10px;">
                <img src="img/exit.png" alt="" style="width: 50px;">
            </a>
            <?php }else{ ?>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" accept-charset="utf-8">
                <input type="text" name="user" style="border: none;" required="true">
                <input type="password" name="pass"  style="border: none;" required="true">
                <button type="submit" class="btn btn-primary">Entrar</button>
            </form>
            <?php } ?>
            </div>
        </th>
    </tr>
</table>

</nav>


<br><br>
<div class="container">

<br><br>
<h4 class="text-center">Mi Tienda Con SDK de MercadoPago</h4>
<hr>
<br><br>

<div class="row">
<?php
$ConsultarProduct = ("SELECT * FROM productos ORDER BY id DESC");
$jqueryProduct = mysqli_query($con, $ConsultarProduct);
?>

<?php
while ($Product = mysqli_fetch_array($jqueryProduct)) { ?>

 <div class="col-md-3">
    <div class="thumbnail" style="text-align: center;border: 1px solid #ece; margin: 10px 0px;">
      <img src="<?php echo $Product['imagen']; ?>" id="<?php echo $Product['id']; ?>" alt="..." style="width: 150px; height: 100px;">
      <div class="caption">
        <h3><?php echo $Product['name'];  ?></h3>
        <p>
            <?php echo number_format($Product['precio'], 0, ",", "."); ?> $</p>
        <input type="hidden" name="cod_user" id="cod_user" value="<?php echo $_SESSION['cod_user']; ?>">
        <button type="submit"  class="botoncompar btn btn-primary" id="<?php echo $Product['id']; ?>">Comprar..</button>
        <br><br>
      </div>
    </div>
  </div>
<?php } ?>
</div>



<script type="text/javascript">
$(document).ready(function() {
$(".row button").on("click", function () {
var id = $(this).attr('id');
var cod_user = $("input#cod_user").val();

var dataString = 'id=' + id + '&cod_user=' + cod_user;
var ruta = "carrito.php";
$.ajax({
    url: ruta,
    type: "POST",
    data: dataString,
    success: function(data){
          $("#resp").html(data);
          console.log('perfecto.')
    }
});
return false;
});
});
</script>
</body>
</html>

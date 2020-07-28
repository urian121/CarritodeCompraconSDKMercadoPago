<?php
session_start();
include('config.php');
if (isset($_SESSION['user']) != "") {
$cod_user =  $_SESSION['cod_user'];
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
                <a href="MisProduct.php" title="">
                    <img src="img/a.svg" style="width: 40px;" alt="">
                </a>
            (
                <?php
                if (isset($_SESSION['user']) != "") {
                $cod_user =  $_SESSION['cod_user'];
                $Product = ("SELECT SUM( cantidad ) AS cantidaP FROM temporalproducts WHERE cod_user='".$cod_user."' ");
                $MisProducts = mysqli_query($con, $Product);
                $arrayProd = mysqli_fetch_array($MisProducts);
                echo ($arrayProd['cantidaP'] + 0 );
                  }else{
                    echo "0";
                } ?>
            )
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
<br><br>

<div class="container">

<h3 class="text-center" style="color: Crimson;">
<a href="index.php" title="">
    <img src="img/volver.png" style="width: 40px;" alt="">
</a>
Mis Productos</h3>
<hr>
<br>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Producto</th>
      <th scope="col">Precio</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Imagen</th>
      <th scope="col">Acción</th>
    </tr>
  </thead>
  <tbody>
<?php
$ConsultarProduct = ("
SELECT
    p.id,
    p.name,
    p.precio,
    p.imagen,
    t.idproduct,
    t.cantidad,
    t.cod_user

FROM productos p, temporalproducts t WHERE p.id=t.idproduct AND t.cod_user='".$cod_user."' ");
$jqueryProduct = mysqli_query($con, $ConsultarProduct);

while ($Product = mysqli_fetch_array($jqueryProduct)) { ?>
    <tr>
        <td><?php echo $Product['name'];  ?></td>
        <td><?php echo number_format($Product['precio'], 0, ",", "."); ?></td>
        <td><?php echo $Product['cantidad'];  ?></td>
        <td><img src="<?php echo $Product['imagen']; ?>" alt="" style='width:50px; text-align: center;'></td>
        <td>
            <form action="deletProd.php" id="<?php echo $Product['id'];  ?>" method="POST">
                <a href="#" class="btn-delete">
                    <img src="img/closed.png" alt="" style="width: 30px;">
                </a>
                <input type="hidden" name="id" value="<?php echo $Product['id']; ?>">
                <input type="hidden" name="cod_user" value="<?php echo $cod_user; ?>">
            </form>
        </td>
</tr>
<?php } ?>

</tbody>
</table>
</div>

<?php
$SqlTotal = ("
SELECT
    p.id,
    t.idproduct,
    t.cod_user,
    SUM( p.precio ) AS TotalPagar

FROM productos p, temporalproducts t WHERE p.id=t.idproduct AND t.cod_user='".$cod_user."' ");
$jqueryTotal = mysqli_query($con, $SqlTotal);
$arrayTotal = mysqli_fetch_array($jqueryTotal);
?>

<center>
<table>
    <tr>
        <th colspan="4" id="totalPrecio">
            <?php echo "Total a Pagar: <span style='color:crimson;'>". number_format($arrayTotal['TotalPagar'], 0, ",", ".")." $ </span>"; ?>
        </th>
        <th colspan="4">
            <a href="pagar.php?total=<?php echo $arrayTotal['TotalPagar']; ?>&cod_user=<?php echo $cod_user; ?>" class="boton"> Pagar Ahora! </a>
        </th>
    </tr>
</table>
</center>

<div id="msj"> </div>


<br><br>
<br><br>

<!--el envio del formulario sara por ajax--->
<script src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(".btn-delete").click(function(e){
        e.preventDefault();

        var row     = $(this).parents('tr');
        var form    = $(this).parents('form');
        var url     = form.attr('action');

        $.post(url, form.serialize(), function(result){
            row.fadeOut();  //ocultamos la fila
            $('#totalPrecio').html(result);
            console.log('Bien');
        }).fail(function(){
            $('#msj').html("algo salió mal");
        });
    });
});
</script>
</body>
</html>
<?php } ?>

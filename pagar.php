<?php
include('config.php');
$total        = $_REQUEST['total'];
$cod_user     = $_REQUEST['cod_user'];


$ConsultarProduct = ("
SELECT
    p.id,
    p.name,
    p.precio,
    t.idproduct,
    t.cantidad,
    t.cod_user

FROM productos p, temporalproducts t WHERE p.id=t.idproduct AND t.cod_user='".$cod_user."' ");
$jqueryProduct = mysqli_query($con, $ConsultarProduct);




include_once("ExtensionMercaPago/vendor/autoload.php");

// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-1607633198968333-051001-fe21aca3cec47522646df7ed2255d100-8196705');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

//Crea un ítem en la preferencia

//while ($Product   = mysqli_fetch_array($jqueryProduct)) {
$item = new MercadoPago\Item();
//$item->title      = $Product['name'];
$item->title      = "Mis Productos";
$item->quantity   = 1;
$item->unit_price = $total;

//}
//Las preferencias de pago permiten enviar varios elementos, pero el checkout mostrará sólo la descripción e imagen del primer ítem. Es una limitación visual, no de lógica.


$preference->items = array($item);
$preference->save();

 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pagando Producto</title>
     <link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>
<br><br>

<center>
<span>
  Confirmación de producto.
</span>
<br><br>

<form action="/procesar-pago" method="POST">
  <input type="hidden" name="idprodct" value="2">
  <script src="https://www.mercadopago.com.mx/integrations/v1/web-payment-checkout.js" data-preference-id="<?php echo $preference->id; ?>">
  </script>
</form>
</center>


</body>
</html>

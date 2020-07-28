<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AddProduct</title>
     <link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>
<br>

<table style="width: 95%;">
<tr>
    <th style="width: 5%;">
        <span id="circulo">
            <a href="index.php" title="Volver"> < </a>
        </span>
    </th>
    <th>
        <span>Agregar Nuevo Producto</span>
    </th>
</tr>
</table>
<br>

<form id="Miform" method="post" enctype="multipart/form-data">
<table>
  <tr>
    <th>Nombre</th>
    <th>Precio</th>
    <th>Imagen</th>
  </tr>
  <tr>
    <td>
        <input type="text" name="name"></td>
        <td><input type="text" name="precio"></td>
        <td><input type="file" name="imagen" id="imagen" accept="image/*"></td>
  </tr>
  <tr>
        <td colspan="3">
        <center>
            <button  type="submit" id="botonenviarform" name="botonenviarform" class="boton"> Registrar Producto  </button>
        </center>
        </td>
  </tr>
</table>

</form>


<br><br>
<h3 style="text-align: center; margin: 0 auto;">Lista de Productos</h3>

<div id="respuesta">
<?php include('products.php'); ?>
</div>



<!--el envio del formulario sara por ajax--->
<script src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
$(function(){
$('body').on('click', '#botonenviarform', function(e){
    e.preventDefault();
    var formData = new FormData($(this).parents('form')[0]);
    var botonenviarform = $("#botonenviarform");

    $.ajax({
        url: 'recibAddproduct.php',
        type: 'POST',
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
            return myXhr;
        },

       data: $("#Miform").serialize(), // Adjuntar los campos del formulario enviado.
        success: function(data){
        $("#respuesta").html(data); // Mostrar la respuestas del script PHP.
        $("#Miform")[0].reset();  //limpio mi formulario
        },
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    });
    return false;
    });
 });
</script>
</body>
</html>

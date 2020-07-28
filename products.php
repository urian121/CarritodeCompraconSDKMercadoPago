<?php
include('config.php');
$ConsultarProduct = ("SELECT * FROM productos ORDER BY id DESC");
$jqueryProduct = mysqli_query($con, $ConsultarProduct);
?>


<table width="100%" cellspacing="0">
<thead>
    <tr>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Imagen</th>
    </tr>
</thead>
<tbody>
<?php
while ($Product = mysqli_fetch_array($jqueryProduct)) { ?>
    <tr>
        <td style="text-align: center;"><?php echo $Product['name'];  ?></td>
        <td style="text-align: center;"><?php echo $Product['precio'];  ?></td>
        <td style="text-align: center;"><img src="<?php echo $Product['imagen']; ?>" alt="" style='width:40px; text-align: center;'></td>
</tr>
<?php } ?>
</tbody>
</table>

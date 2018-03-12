<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
</head>

<body>
	<div style="text-align: left;">
		<img src="https://stick-attack.fr/img/stick-attack-logo-1515078249.jpg" alt="image" title="image" style="width: 216px; height: 51px;">
	</div>
	<div style="text-align: center;">
		<b>Récapitulatif de la commande n°
			<?= $infosOrders["id_order"]?>
		</b>
	</div>

	<div style="text-align: center;">
		<b>
			<span style="color: #009de2;"></span>
		</b>
		<table style="width: 100%" border="1">
			<tbody>
				<tr>
					<td style="background-color: #dddddd;">
						<b>Destinataire</b>
					</td>
				</tr>
				<tr>
					<td>
						<?= $infosOrders["firstname"] . ' ' . $infosOrders["lastname"];?>
					</td>
				</tr>
				<tr>
					<td>
						<?= $infosOrders["address"]?>
					</td>
				</tr>
				<tr>
					<td>
						<?= $infosOrders["zip_code"] . ' ' . $infosOrders["city"];?>
					</td>
				</tr>
				<tr>
					<td>
						<?= $infosOrders["phone_number"] . ' / ' . $infosOrders["mobil_phone_number"];?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>


	<div style="text-align: center;">
		<b>
			<span style="color: #009de2;">Frais de port / Livraison :</span>
		</b>
	</div>
	<div style="text-align: center;">
		<b>
			<span style="color: #009de2;"></span>
		</b>
		<table style="width: 100%" border="1">
			<tbody>
				<tr>
					<td style="background-color: #dddddd;">
						<b>Méthode de livraison :
							<?= $infosOrders["method_shipping"]?>
						</b>
					</td>
				</tr>
				<tr>
					<td style="background-color: #dddddd;">
						<b>Montant des frais de port : 1.58 HT</b>
					</td>
				</tr>
			</tbody>
		</table>
		<b>
			<span style="color: #009de2;">
				<br>
			</span>
		</b>
	</div>
	<div style="text-align: center;">
		<span style="color: #009de2;">
			<strong>Récapitulatif des produits :</strong>
		</span>

	</div>
	<div style="text-align: center;">
		<b>
			<span style="color: #009de2;"></span>
		</b>
		<table style="width: 100%" border="1">
			<tbody>
				<tr>
					<td style="background-color: #dddddd;">
						<b>qté</b>
					</td>
					<td style="background-color: #dddddd;">
						<b>Ref</b>
					</td>
					<td style="background-color: #dddddd;">
						<b>Désign</b>
					</td>
					<td style="background-color: #dddddd;">
						<b>Taille</b>
					</td>
					<td style="background-color: #dddddd;">
						<b>Couleur</b>
					</td>
					<td style="background-color: #dddddd;">
						<b>Sens</b>
					</td>
					<td style="background-color: #dddddd;">
						<b>Prix</b>
					</td>

					<td style="background-color: #dddddd;">
						<b>Image</b>
					</td>
				</tr>


				<?php foreach($infosProductsOrders as $value)
				{
					echo '<tr>';
					echo '<td>' . $value["quantity_product"] . '</td>';
					echo '<td>' . $value["reference"] . '</td>';
					echo '<td>' . $value["product_name"] . '</td>';
					echo '<td>' . $value["size_name"] . '</td>';
					echo '<td>' . $value["color_name"] . '</td>';
					echo '<td>' . $value["meaning_name"] . '</td>';
					echo '<td>' . $value["base_price"] . '€' . '</td>';
					echo "<td><img  style=\"width:80px; height:80px;\" src=\"" .  base_url( "assets/img/uploaded/" . $value["img_url"] )  .  "\"></td>";
					echo '</tr>';
				}
				
				?>

			</tbody>
		</table>

		<b>
			<span style="color: #009de2;">
				<br>
			</span>
		</b>
	</div>
	<div style="text-align: left;">
		<b>
			<span style="color: #009de2;">Commentaire de la commande :</span>
		</b>
	</div>
	<div style="text-align: left;">
		<?= $infosOrders["comment_order"]?>
	</div>
	<br>
	<table style="width: 100%" border="1">
		<tbody>

			<tr>
				<td>Total de la livraison
					<b>HT</b>:</td>
				<td>
					<?= $infosOrders["price_method_shipping"] . ' ' . '€ HT' ?>
				</td>
			</tr>
			<tr>
				<td>Total de la commande
					<b>HT</b>:</td>
				<td>
					<?= $infosOrders["price_order"] . ' ' . '€ HT' ?>
				</td>
			</tr>

			<tr>
				<td>Total de la commande
					<b>TTC</b>: </td>
				<td>
					<?= $infosOrders["price_order"] * 1.2  . ' ' . '€ TTC' ?>
				</td>
			</tr>
		</tbody>
	</table>
</body>

</html>

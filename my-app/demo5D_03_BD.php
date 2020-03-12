<!DOCTYPE html>
<html lang="fr">
<head>
<title>Démo5D_03</title>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="styleTable.css" />
</head>
<body >
	<!-- ============================= Access BD =========================== -->
	<h1>Mise à jour de la BD (avec transaction)</h1>
		<?php
		    // Note  : pour simplification de l'exemple, sans try-catch. Il faudrait l'ajouter ...
			
			// Connexion et configuration
			$connexion = new PDO('mysql:host=localhost;dbname=commerce', "root", "root");
			$connexion->exec("SET character_set_results = 'utf8'");	
		?>	
		<?php	    
			// commande query pour voir le produit avec SELECT sur le produit avec code 101
			echo "<h2> Au début </h2>";
			$resultat = $connexion->query("SELECT code,description,quantite,prix FROM produit WHERE code=101");
			$rangee = $resultat->fetch();
			echo "[#".$rangee['code'].", Desc.:".$rangee['description'].", Qté:".$rangee['quantite'].", Prix:".$rangee['prix']."$]<br /><br />";
			
			
	        // commandes exec pour modifier le produit avec UPDATE sur le prix et la quantite pour le produit avec le code 101
			echo "<h2>Début de transaction : Nouveau résultat après UPDATE</h2>";
			$connexion->beginTransaction();
			
			$connexion->exec("UPDATE produit SET quantite=quantite+1 WHERE code=101");
			echo ".... Opération update sur la quantite (+=1) ....<br />";
			
			$connexion->exec("UPDATE produit SET prix=prix+0.10 WHERE code=101");
			echo ".... Opération update sur le prix (+=0.10) ....<br /><br/>";

			// commande query pour voir le produit avec SELECT sur le produit avec code 101, avec la nouvelle quantite et prix
			$resultat = $connexion->query("SELECT code,description,quantite,prix FROM produit WHERE code=101");
			$rangee = $resultat->fetch();
			echo "[#".$rangee['code'].", Desc.:".$rangee['description'].", Qté:".$rangee['quantite'].", Prix:".$rangee['prix']."$]<br /><br />";

			echo "<h2>Annulation de transaction avec rollback</h2>";
			$connexion->rollback(); // annule la transaction
			//$connexion->commit(); // confirme la transaction
			
			// commande query pour voir le produit avec SELECT sur le produit avec code 101 après l'annulation de la transaction
			$resultat = $connexion->query("SELECT code,description,quantite,prix FROM produit WHERE code=101");
			$rangee = $resultat->fetch();
			echo "[#".$rangee['code'].", Desc.:".$rangee['description'].", Qté:".$rangee['quantite'].", Prix:".$rangee['prix']."$]<br /><br />";

			$connexion=null;
		?>
</body>
</html>

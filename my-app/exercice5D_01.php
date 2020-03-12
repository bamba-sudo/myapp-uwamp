<!DOCTYPE html>
<!-- ++++++++++++++++++ À COMPLÉTER ++++++++++++++++++++++-->	
<html lang="fr">
<head>
<title>Démo5D_04</title>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="styleTable.css" />
</head>
<body >
	<!-- ============================= Access BD =========================== -->
	<h1>Requêtes programmables</h1>
		<?php
			// Note  : pour simplification de l'exemple, sans try-catch. Il faudrait l'ajouter ...

			// Connexion et configuration
			$connexion = new PDO('mysql:host=localhost;dbname=commerce', "root", "root");
			$connexion->exec("SET character_set_results = 'utf8'");	
		?>	

		<?php	  
		        // A) Avec une instruction query : Récupérez et affichez les produits, dont le 
                        //    dont le prix est supérieur à 16.0
			echo "<h3>Produit dont le prix est supérieur à 16.0</h3>";

			// B) Avec une instrction prepare/exec : Récupérez et affichez tous les produits 
                        //    qui sont entre 2 limites de prix et affichez les résultat
			echo "<h3>Produit dont le prix est entre 2 limites programmable</h3>";
			$limiteA=15.0;
			$limiteB=20.0;
			// $requeteEntre2Prix= ...

			// C) Avec une instruction exec : Ajoutez un outil #118, Scie, Stanley, à 24.55$ dont l'url
                        //    est 'Scie_118.png'
			echo "<h3>Ajouter un outil</h3>";


			// vérification
			$resultat = $connexion->query("SELECT code,description,quantite,prix FROM produit WHERE code=118");
			$rangee = $resultat->fetch();
			echo "[#".$rangee['code'].", Desc.:".$rangee['description'].", Qté:".$rangee['quantite'].", Prix:".$rangee['prix']."$]<br /><br />";


			// E) Avec une instruction exec : Supprimez le produit dont le code est 118 
			echo "<h3>Enlever un outil</h3>";



			// vérification
			$resultat = $connexion->query("SELECT code,description,quantite,prix FROM produit WHERE code=118");
			$rangee = $resultat->fetch();
			echo $rangee?"Encore là":"Bien supprimé";







                   



		?>	

		<?php	  
			$connexion = null;
		?>
</body>
</html>

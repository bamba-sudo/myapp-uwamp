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
		    // Préparation de la requête programmable #1, avec select pour un code
			echo "<h2> Select programmable avec code </h2>";
			// ********************************* À compléter *****************
			$requeteProgrammable1=$connexion->prepare("SELECT * FROM produit WHERE code=?");

		    // .... Execution de la requête programmble #1 avec le code 101
			echo "<h3> Produit 101 </h3>";
			// ********************************* À compléter *****************
			$requeteProgrammable1-> execute("...");
			$rangee=$requeteProgrammable1->fetch();
			echo "[#".$rangee['code'].", Desc.:".$rangee['description'].", Qté:".$rangee['quantite'].", Prix:".$rangee['prix']."$]<br /><br />";

		    // .... Execution de la requête programmble #1 avec le code 103
			echo "<h3> Produit 103 </h3>";
			$codeRecherche = 103;
			$requeteProgrammable1-> execute(array($codeRecherche));
			if ($requeteProgrammable1->rowCount() == 0) {
				echo "Pas trouvé <br /><br />";
			} else {
				$rangee=$requeteProgrammable1->fetch();
				echo "[#".$rangee['code'].", Desc.:".$rangee['description'].", Qté:".$rangee['quantite'].", Prix:".$rangee['prix']."$]<br /><br />";
			}

		    // Préparation de la requête programmable #2, avec update pour un code pour ajouter une quantite
			echo "<h2> Update programmable avec code et quantite</h2>";
			echo "<h3> Produit 101  en augmentant la quantite de 3</h3>";
			// ********************************* À compléter *****************
			// $requeteProgrammable2=$connexion->prepare(...);

		    // .... Execution de la requête programmble #2 avec le code 101 et quanitite a ajaouter de 3
			$quantiteAAjouter = 3;
			$codeRecherche = 101;
			// ********************************* À compléter *****************
			//$requeteProgrammable2-> execute(...);
			
		    // .... Execution de la requête programmble #1 avec le code 101 (pour vérifier l'update ...)
			$requeteProgrammable1-> execute(array(101));
			$rangee=$requeteProgrammable1->fetch();
			echo "[#".$rangee['code'].", Desc.:".$rangee['description'].", Qté:".$rangee['quantite'].", Prix:".$rangee['prix']."$]<br /><br />";

		    // .... Retourner à l'état initial en enlevant 3 items sur l'item 101 avec la requête programmable #2
			$requeteProgrammable2-> execute(array(-3,101));

			$connexion = null;
		?>
</body>
</html>

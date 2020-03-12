<!DOCTYPE html>
<!-- ++++++++++++++++++ À COMPLÉTER ++++++++++++++++++++++-->
<html lang="fr">
<head>
<title>Démo5D_00</title>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="styleTable.css" />
</head>
<body >
	<!-- ============================= Access BD =========================== -->
	<h1>Accès direct à la BD</h1>
	<?php
	    // try catch pour attraper les erreurs de connexion ...
		try {
			// Connexion et configuration pour les caracrtères UTF-8
			$connexion = new PDO('mysql:host=localhost;dbname=commerce', "root", "root");
			$connexion->exec("SET character_set_results = 'utf8'");	
		
			// Étape 1 : Exécuter la requête SELECT avec query
			$resultat=$connexion->query("SELECT * FROM produit");

			// Étape 2 : Vérifier si le résultat est vide
			if ($resultat->rowCount()==0){
					echo "Pas trouvé";
			} else {
				// Étape 3 : Utiliser les résultats
				foreach ($resultat as $rangee) {
					echo "Description: ".", prix:"."\$<br />";
				}
			}
		 } catch (PDOException $e) {
			echo "Erreur : ".$e->getMessage()."<br />";
		}
		$connexion=null;
	?>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
<title>Démo5D_01</title>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="styleTable.css" />
</head>
<body >
	<!-- ============================= Access BD =========================== -->
	<h1>Accès direct à la BD</h1>
		<!-------------------------- Connexion à la BD ----------------------->
		<?php
		try {
			// Connexion et configuration
			$connexion = new PDO('mysql:host=localhost;dbname=commerce', "root", "root");
			$connexion->exec("SET character_set_results = 'utf8'");	
		
		?>	

		<!-------------------------- Accès aux produits avec SELECT (Façon 1 : comme pour la démo 0) ----------------------->
		<h2>Façon 1 : Directement avec foreach sur l'objet PDOStatement</h2>
		<?php
			$resultat = $connexion->query('SELECT * FROM produit');
			if ($resultat!=false) {
				foreach($resultat as $rangee) {
					echo "Description: ".$rangee['description'].", prix:".$rangee['prix']."\$<br />";
				}
				$resultat->closeCursor();
			} else {
				echo "Pas trouvé";
			}
		?>	

		<!-------------------------- Accès aux produits avec SELECT (Façon 2 : avec Fetch) ----------------------->
		<h2>Façon 2 : Avec la méthode fetch sur l'objet PDOStatement</h2>
		<?php
			$resultat = $connexion->query('SELECT * FROM produit');
			if ($resultat!=false) {
				//$resultat->setFetchMode(PDO::FETCH_ASSOC);
				// ..... $rangee : tableau associatif pour un enregistrement
				$rangee = $resultat->fetch();
				while ($rangee) {
					echo "Description: ".$rangee['description'].", prix:".$rangee['prix']."\$<br />";
					$rangee = $resultat->fetch();
				}
				$resultat->closeCursor();
			} else {
				echo "Pas trouvé";
			}
		?>	

		<!-------------------------- Accès aux produits avec SELECT (Façon 3 : avec FetchAll) ----------------------->
		<h2>Façon 3 : Avec la méthode fetchAll sur l'objet PDOStatement</h2>
		<?php
			$resultat = $connexion->query('SELECT * FROM produit');
			if ($resultat!=false) {
				// ..... $rangees tableau 2D, $rangee : tableau associatif pour un enregistrement
				$rangees = $resultat->fetchAll();
				foreach ($rangees as $rangee) {
					echo "Description: ".$rangee['description'].", prix:".$rangee['prix']."\$<br />";
				}
				$resultat->closeCursor();
			} else {
				echo "Pas trouvé";
			}
			$connexion = null;
		?>
		
		<!-------------------------- Gestion d'erreurs et fermerture de la connexion ----------------------->
		<?php
		} catch (PDOException $e) {
			echo "Erreur : ".$e->getMessage()."<br />";
		}
		$connexion=null;	
		?>
</body>
</html>

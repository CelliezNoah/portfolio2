<?php
// Configuration de la base de données
$serveur = "localhost";
$utilisateur = "nom_utilisateur";
$mot_de_passe = "mot_de_passe";
$base_de_donnees = "nom_base_de_donnees";

// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("Erreur de connexion à la base de données : " . $connexion->connect_error);
}

// Récupération des données du formulaire
$pseudo = $_POST['pseudo'];
$avis = $_POST['avis'];
$jour = $_POST['jour'];

// Préparation de la requête SQL pour l'insertion
$sql = "INSERT INTO avis (pseudo, avis, jour) VALUES (?, ?, ?)";
$requete = $connexion->prepare($sql);

// Liaison des paramètres et exécution de la requête
$requete->bind_param("sss", $pseudo, $avis, $jour);
$requete->execute();

// Vérification et gestion des erreurs
if ($requete->errno) {
    echo "Erreur lors de l'insertion dans la base de données : " . $requete->error;
} else {
    echo "Votre avis a été enregistré avec succès !";
}

// Fermeture de la connexion et de la requête
$requete->close();
$connexion->close();
?>

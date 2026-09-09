<?php
/**
 * generate.php — Endpoint appelé en AJAX (fetch) par scan.js.
 *
 * IMPORTANT : ce script n'est appelé QUE lors d'un premier scan sur un terminal donné
 * (c'est-à-dire quand scan.js n'a rien trouvé dans le localStorage pour ce point).
 * Un rescan du même point, sur le même terminal, ne doit JAMAIS déclencher un nouvel appel ici.
 *
 * Reçoit en paramètres GET : batiment, point
 *
 * Doit :
 *   1. Générer un nombre aléatoire
 *   2. Déterminer le prochain identifiant (auto-incrémenté) à partir du CSV existant
 *   3. Ajouter UNE ligne au fichier CSV (data/scans.csv) SANS écraser les lignes existantes
 *   4. Renvoyer uniquement ce nombre au navigateur (le JS l'affichera et le stockera)
 *
 * Colonnes attendues dans le CSV (voir cahier des charges, section 5) :
 *   Identifiant, Batiment, Point, Date, Heure, Nombre
 */

$fichierCsv = __DIR__ . '/data/scans.csv';

// TODO 1 : récupérer $_GET['batiment'] et $_GET['point']
$BATIMENT = $_GET['batiment'];
$POINT = $_GET['point'];

// TODO 2 : générer le nombre aléatoire
// Indice : fonction rand()
$nombre = rand(1,10000);

// TODO 3 : déterminer le prochain identifiant auto-incrémenté
// Indice : combien de lignes contient déjà $fichierCsv avant d'y ajouter la nouvelle ?
//          (attention à ne pas compter la ligne d'en-têtes)
$lignes = file($fichierCsv);
$nbLignes = count($lignes) - 1;
$identifiant = $nbLignes + 1;

// TODO 4 : ouvrir $fichierCsv en mode "ajout" (pas en écrasement) et y écrire la nouvelle ligne
// Indice : fopen($fichierCsv, 'a') puis fputcsv(), ne pas oublier fclose()
$date = date('d-m-Y');
$heure = date('H:i:s');

$fp = fopen($fichierCsv, 'a');
fputcsv($fp, [$identifiant, $BATIMENT, $POINT, $date, $heure, $nombre]);
fclose($fp);

// TODO 5 : renvoyer uniquement le nombre généré au navigateur (un simple echo suffit)
echo $nombre;
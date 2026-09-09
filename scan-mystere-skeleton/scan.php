<?php
/**
 * scan.php — Page affichée quand quelqu'un scanne un QR code.
 *
 * Chaque QR code pointe vers cette page avec deux paramètres dans l'URL, par exemple :
 *   https://jeu.lycee-schuman.fr/scan.php?batiment=Batiment_6&point=3
 *
 * Cette page ne fait QUE :
 *   1. récupérer les paramètres batiment/point de l'URL
 *   2. les transmettre au script JavaScript (scan.js), qui gère toute la logique
 *      d'affichage du nombre (voir scan.js)
 *
 * Elle n'écrit RIEN dans le CSV elle-même : c'est generate.php qui s'en charge,
 * et seulement si scan.js décide de l'appeler (cf. section 4 du cahier des charges).
 */

// TODO : récupérer les paramètres GET "batiment" et "point"
// Rappel : $_GET['nom_du_parametre']
// Pensez à gérer le cas où l'un des deux serait absent de l'URL.

$batiment = $_GET['batiment'];
$point    = $_GET['point']; 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Scan Mystère</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main class="scan-box">
    <p id="number" class="number">…</p>
  </main>

  <!-- On transmet le bâtiment et le point au script JS -->
  <script>
    const BATIMENT = "<?php echo $batiment; ?>";
    const POINT    = "<?php echo $point; ?>";
  </script>
  <script src="scan.js"></script>
</body>
</html>

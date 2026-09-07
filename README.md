📱 Projet QR Code Tracker

Une application web légère permettant d'identifier les utilisateurs via le scan d'un QR code, tout en récoltant des statistiques d'utilisation (date, heure, type d'appareil)

🚀 Fonctionnalités

- Identification Unique (ID) : Génération et attribution d'un numéro unique par appareil grâce à localStorage.
- Reconnaissance des Visiteurs : Détection automatique si l'utilisateur a déjà scanné le QR code auparavant (visiteur récurrent).
- Collecte de Métadonnées : Envoi discret des informations de scan vers une base de données (horodatage, navigateur, etc...

🛠 Technologies Utilisées

- Frontend : HTML5, CSS3, JavaScript 
- Stockage Local : localStorage du navigateur
- Backend & Base de données : 
- Hébergement : github page, ou via le lycée ? à voir 

🏗 Comment ça marche ? (Flux utilisateur)

1. L'utilisateur scanne le QR code avec son smartphone.
2. Le QR code ouvre l'URL du site web.
3. Le script JavaScript s'exécute et vérifie le `localStorage` du téléphone :
   - Si nouveau visiteur : Génère un numéro aléatoire unique, le sauvegarde localement et l'affiche.
   - Si visiteur existant : Récupère le numéro déjà existant et l'affiche.
4. En arrière-plan, une requête est envoyée à la base de données avec l'identifiant du visiteur et les détails techniques de son appareil (navigateur, date, heure, etc..).

⚙️ Installation et Configuration

Hébergement (Mise en ligne)
- Héberger le site web et le backend
- Connecter le dépôt à une plateforme d'hébergement.
- Déployer le projet pour obtenir une URL publique.

Génération du QR Code
- Utiliser un générateur de QR codes gratuit (ex: QRCode Monkey ou Canva).
- Collez l'URL publique du site web.
- Téléchargez l'image du QR code et le collé.

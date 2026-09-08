Projet « Scan Mystère »
Sensibilisation à la cybersécurité des usagers par QR codes


1. Contexte et objectifs
Le lycée souhaite mener une opération de sensibilisation à la cybersécurité auprès de l'ensemble des élèves et des personnels. L'objectif est de mesurer, de façon très concrète, combien de personnes scannent un QR code affiché dans un lieu public sans en connaître ni la destination ni le contenu — une situation directement transposable aux risques réels (QR code piégé, hameçonnage, lien malveillant, faux point d'accès Wi-Fi, etc.).
Il ne s'agit pas ici de produire une application «sécurisée» au sens du développement défensif : l'application ne traite et ne stocke aucune donnée personnelle, elle est mise en ligne puis retirée au bout de quelques jours. La «cybersécurité» du projet réside dans le message de sensibilisation qu'il permet de délivrer, pas dans un durcissement technique du code.

3. Principe de fonctionnement
Des QR codes sont affichés sans aucune indication à plusieurs endroits.
Une personne curieuse scanne un QR code avec son smartphone.
Elle arrive sur une page web qui affiche uniquement un nombre généré aléatoirement, sans aucune autre explication.
Si elle scanne à nouveau le même QR code depuis le même terminal, le même nombre doit s'afficher.
Chaque «nouveau» scan (première visite de ce point, sur ce terminal) est journalisé dans un fichier CSV côté serveur.
Au bout d'une semaine maximum, on récupère le fichier CSV et l'application est retirée du serveur.

4. Exigences fonctionnelles
F1 — Aucune authentification, aucun formulaire : l'utilisateur n'a rien à faire d'autre que scanner.
F2 — Aucune donnée personnelle n'est demandée ni stockée, à aucun moment.
F3 — Un nombre aléatoire (rand()) est généré à la première visite d'un point de scan donné, sur un terminal donné.
F4 — Ce nombre reste identique lors des scans suivants du même QR code depuis le même terminal.
F5 — Aucun cookie n'est utilisé pour assurer cette persistance.
F6 — Aucune base de données : la seule persistance côté serveur est un fichier CSV.
F7 — Chaque point de scan correspond à une URL distincte et statique.
F8 — L'affichage doit être pleinement utilisable sur smartphone (seul terminal utilisé par les scanneurs).

5. Mécanisme technique clé : identifier un « nouveau » scan sans cookie ni base de données
C'est le point technique central du projet : comment garantir qu'un même terminal obtient toujours le même nombre pour un même QR code, sans cookie et sans base de données ? La logique attendue est la suivante (l'implémentation précise est laissée aux étudiants) :
Le navigateur vérifie s'il possède déjà, en stockage local (localStorage), un identifiant anonyme. Sinon, il en génère un et le conserve localement — cet identifiant ne contient aucune donnée personnelle, il sert uniquement à distinguer les terminaux dans le fichier CSV.
Le navigateur vérifie s'il possède déjà, en stockage local, un nombre enregistré pour ce point de scan précis (ex. une clé du type scan_batiment6_point3).
Si oui, ce nombre est réaffiché directement, sans nouvel enregistrement côté serveur.
Si non, le navigateur interroge le script PHP du point de scan, qui génère le nombre, écrit une ligne dans le fichier CSV, puis renvoie le nombre au navigateur, qui le stocke localement avant de l'afficher.
Le stockage local (localStorage) sur le téléphone remplace ici le cookie ; il ne garantit pas une unicité parfaite (navigation privée, changement de navigateur, réinitialisation du téléphone entraîneront un nouveau comptage). Cette limite est assumée compte tenu du caractère volontairement léger et temporaire de ce test statistique.

6. Structure du fichier CSV
Liste de colonnes proposée, à valider ou compléter :
Colonne
Description
Identifiant anonyme
Identifiant généré, sans lien avec une personne réelle autoincrémentation
Bâtiment
Batiment_6 / Batiment_1 / Batiment_Self
Point de scan
Numéro du QR code au sein du bâtiment (ex. 1 à 8)
Date
Date du scan (jj/mm/aaaa)
Heure
Heure du scan (hh:mm:ss)
Nombre généré
Nombre aléatoire attribué à ce point pour ce terminal (rand())

7. Exigences techniques et contraintes
T1 — Langages imposés : HTML, CSS, JavaScript (bibliothèques front autorisées) et PHP natif (aucun framework imposé).
T2 — Aucune base de données.
T3 — Persistance serveur uniquement via un fichier CSV.
T4 — Hébergement fourni par l'enseignant à l'adresse jeu.lycee-schuman.fr.
T5 — Aucune interface d'administration à développer : la récupération du fichier CSV se fait manuellement par l'enseignant en fin de test.
T6 — Site pleinement utilisable sur mobile.

8. QR codes : génération et déploiement
Environ 8 QR codes par bâtiment (6, 1, self), soit environ 24 points de scan au total.
Chaque QR code pointe vers une URL distincte et statique (par exemple via un paramètre d'URL identifiant le bâtiment et le point, ou une page dédiée par point).
Génération des QR codes : au choix des étudiants, via un service en ligne de génération de QR codes statiques.
Impression et pose : réalisées par l'enseignant avec les étudiants, la semaine suivant la livraison du code.

9. Organisation et livrables
Livrable unique : dépôt Git contenant l'intégralité du code source.
Aucune méthodologie de gestion de projet imposée, aucun barème (projet non noté).
Échéance : code fonctionnel et déployé pour le vendredi 11 septembre 2026, avant la pose des QR codes la semaine suivante.

10. Points de vigilance à garder en tête
Le mécanisme anti-doublon par stockage local a des limites connues (cf. section 4) — elles sont assumées, pas à corriger.
Le nombre affiché n'a aucune utilité fonctionnelle : il sert uniquement à donner une réponse visuelle au scan, à but statistique.
Le projet sera retiré du serveur au bout d'une semaine maximum : prévoir que le fichier CSV soit facilement récupérable avant suppression.

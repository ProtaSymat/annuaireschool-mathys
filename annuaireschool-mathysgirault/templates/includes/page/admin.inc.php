<?php
// include_once './templates/includes/elements/html_header.inc.php';
// fromInc("menu");
// // Vérifiez si l'utilisateur est connecté
// if (!isset($_SESSION['username'])) {
//     // Redirigez l'utilisateur vers la page de connexion
//     header("Location:?page=login&layout=html");
//     exit;
// }
?>
<?php $pageTitle="Admin"; ?>

<body>
    <?php include './templates/includes/elements/listUsers.inc.php'; ?>

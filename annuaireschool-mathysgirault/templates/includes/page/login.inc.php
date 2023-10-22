<?php $pageTitle="Login"; ?>

<?php
// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $host = 'localhost';
//     $username = 'mathys';
//     $password = 'root';
//     $database = 'php_framework';

//     $conn = new mysqli($host, $username, $password, $database);

//     $conn->set_charset("utf8mb4");

//     if ($conn->connect_error) {
//         die("La connexion à la base de données a échoué : " . $conn->connect_error);
//     }

//     $username = $_POST["username"] ?? "";
//     $password = $_POST["password"] ?? "";

//     $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
//     $stmt->bind_param("ss", $username, $password);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     $user = $result->fetch_assoc();

//     if ($user) {
//         session_start();
//         $_SESSION['username'] = $username;
//         header("Location: ?page=admin&layout=html");
//         exit();
//     } else {
//         $error = true;
//     }

//     $stmt->close();
//     $conn->close();
// }
?>

<body>
    <section class="form-login-section">
        <form class="form-login" action="" method="post">
            <h1>Connecte toi pour accéder à la page admin (PAS DISPO ENCORE)</h1>
            <p class="choose-email">Utilise tes informations de contact</p>
            <div class="inputs">
                <input class="search-input" type="text" name="username" placeholder="admin" required>
                <input class="search-input" type="password" name="password" placeholder="admin123" required>
            </div>
            <p class="inscription">Je n'ai pas de compte. Je m'en <span><a href="#">crée</a></span> un. (BIENTOT DISPONIBLE)</p>
            <div style="text-align:center;">
                <button type="submit">Se connecter</button>
            </div>
        </form>
    </section>
</body>

<?php require_once 'connect.php'; ?>
<?php
// Simpele logincheck 
session_start();

$users = [
    'admin' => 'wachtwoord123',
    'gebruiker' => 'test456'
];

$melding = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $gebruikersnaam = $_POST['gebruikersnaam'] ?? '';
    $wachtwoord = $_POST['wachtwoord'] ?? '';

    if (isset($users[$gebruikersnaam]) && $users[$gebruikersnaam] === $wachtwoord) {
        $_SESSION['ingelogd'] = $gebruikersnaam;
        $melding = "Welkom, $gebruikersnaam!";
    } else {
        $melding = "Ongeldige gebruikersnaam of wachtwoord.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Inloggen</title>
    <style>
        body {
            background-color: #1e1e1e;
            font-family: Arial, sans-serif;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #2c2c2c;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(255, 165, 0, 0.4);
            width: 300px;
        }

        h2 {
            color: #ffa500;
            text-align: center;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 6px;
        }

        input[type="submit"] {
            background-color: #ffa500;
            color: #1e1e1e;
            border: none;
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .melding {
            margin-top: 10px;
            color: #ff6347;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST">
            <input type="text" name="gebruikersnaam" placeholder="Gebruikersnaam" required>
            <input type="password" name="wachtwoord" placeholder="Wachtwoord" required>
            <input type="submit" value="Inloggen">
        </form>
        <?php if ($melding): ?>
            <div class="melding"><?= htmlspecialchars($melding) ?></div>
        <?php endif; ?>
    </div>
</body>
</html>

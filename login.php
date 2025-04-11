<?php require_once 'connect.php'; ?>
<?php
session_start();

$melding = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $gebruikersnaam = trim($_POST['gebruikersnaam']);
    $wachtwoord = $_POST['wachtwoord'];

    if (empty($gebruikersnaam) || empty($wachtwoord)) {
        $melding = "Vul alle velden in.";
    } else {
        // Get user from database
        $stmt = $conn->prepare("SELECT * FROM accounts WHERE gebruikersnaam = ?");
        $stmt->bind_param("s", $gebruikersnaam);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($wachtwoord, $user['password'])) {
                $_SESSION['ingelogd'] = $gebruikersnaam;
                $_SESSION['user_id'] = $user['id'];
                header("Location: index.php");
                exit();
            } else {
                $melding = "Ongeldige gebruikersnaam of wachtwoord.";
            }
        } else {
            $melding = "Ongeldige gebruikersnaam of wachtwoord.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Inloggen - Boekenbibliotheek</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-page">
        <a href="index.php" class="back-button">← Terug naar Home</a>
        <div class="login-container">
            <h2>Login</h2>
            <form method="POST" class="login-form">
                <input type="text" name="gebruikersnaam" placeholder="Gebruikersnaam" required>
                <input type="password" name="wachtwoord" placeholder="Wachtwoord" required>
                <input type="submit" value="Inloggen">
            </form>
            <?php if ($melding): ?>
                <div class="error-message"><?= htmlspecialchars($melding) ?></div>
            <?php endif; ?>
            <div class="login-links">
                <p>Nog geen account?</p>
                <a href="register.php" class="signup-link">Registreer hier</a>
            </div>
        </div>
    </div>
</body>
</html>

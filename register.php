<?php require_once 'connect.php'; ?>
<?php
session_start();

$melding = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $gebruikersnaam = trim($_POST['gebruikersnaam']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validate input
    if (empty($gebruikersnaam) || empty($email) || empty($password)) {
        $melding = "Alle velden zijn verplicht.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $melding = "Ongeldig email adres.";
    } else {
        // Check if username already exists
        $stmt = $conn->prepare("SELECT gebruikersnaam FROM accounts WHERE gebruikersnaam = ?");
        $stmt->bind_param("s", $gebruikersnaam);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $melding = "Deze gebruikersnaam bestaat al.";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert new user
            $stmt = $conn->prepare("INSERT INTO accounts (gebruikersnaam, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $gebruikersnaam, $email, $hashed_password);
            
            if ($stmt->execute()) {
                $melding = "Account succesvol geregistreerd! Je kunt nu inloggen.";
                header("refresh:2;url=login.php");
            } else {
                $melding = "Er is een fout opgetreden. Probeer het opnieuw.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Registreren - Boekenbibliotheek</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-page">
        <a href="index.php" class="back-button">← Terug naar Home</a>
        <div class="login-container">
            <h2>Account Registreren</h2>
            <form method="POST" class="login-form">
                <input type="text" name="gebruikersnaam" placeholder="Gebruikersnaam" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Wachtwoord" required>
                <input type="submit" value="Registreren">
            </form>
            <?php if ($melding): ?>
                <div class="error-message"><?= htmlspecialchars($melding) ?></div>
            <?php endif; ?>
            <div class="login-links">
                <p>Heb je al een account?</p>
                <a href="login.php" class="signup-link">Log hier in</a>
            </div>
        </div>
    </div>
</body>
</html>

<?php require_once 'connect.php'; ?>
<?php
session_start();

$melding = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $melding = "Vul alle velden in.";
    } else {
        // Get user from database
        $stmt = $conn->prepare("SELECT * FROM accounts WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['ingelogd'] = $username;
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Boekenbibliotheek</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="pagestyles.css">
</head>
<body>
    <div class="login-page">
        <a href="index.php" class="back-button">← Back to Home</a>
        
        <div class="login-container">
            <h2>Login to your Account</h2>
            
            <!-- PHP can display errors here -->
            <?php if ($melding): ?>
                <div class="error-message"><?= htmlspecialchars($melding) ?></div>
            <?php endif; ?>
            
            <form method="POST" class="login-form">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="Login">
            </form>
            
            <div class="login-links">
                <p>Don't have an account? <a href="register.php" class="signup-link">Sign up</a></p>
            </div>
        </div>
    </div>
</body>
</html>

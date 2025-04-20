<?php require_once 'connect.php'; ?>
<?php
session_start();

$melding = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate input
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $melding = "Alle velden zijn verplicht.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $melding = "Ongeldig email adres.";
    } elseif ($password !== $confirm_password) {
        $melding = "Wachtwoorden komen niet overeen.";
    } else {
        // Check if username already exists
        $stmt = $conn->prepare("SELECT username FROM accounts WHERE username = ?");
        if (!$stmt) {
            $melding = "Database error: " . $conn->error;
        } else {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $melding = "Deze gebruikersnaam bestaat al.";
            } else {
                // Hash password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                // Insert new user
                $stmt = $conn->prepare("INSERT INTO accounts (username, email, password) VALUES (?, ?, ?)");
                if (!$stmt) {
                    $melding = "Database error: " . $conn->error;
                } else {
                    $stmt->bind_param("sss", $username, $email, $hashed_password);
                    
                    if ($stmt->execute()) {
                        $melding = "Account succesvol geregistreerd! Je kunt nu inloggen.";
                        header("refresh:2;url=login.php");
                    } else {
                        $melding = "Er is een fout opgetreden. Probeer het opnieuw.";
                    }
                    $stmt->close();
                }
            }
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Boekenbibliotheek</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="pagestyles.css">
</head>
<body>
    <div class="login-page">
        <a href="index.php" class="back-button">← Back to Home</a>
        
        <div class="login-container">
            <h2>Create an Account</h2>
            
            <?php if(!empty($melding)): ?>
                <div class="error-message"><?php echo $melding; ?></div>
            <?php endif; ?>
            
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="login-form">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <input type="submit" value="Register">
            </form>
            
            <div class="login-links">
                <p>Already have an account? <a href="login.php" class="signup-link">Login</a></p>
            </div>
        </div>
    </div>
</body>
</html>

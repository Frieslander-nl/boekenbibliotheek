<?php
require_once 'connect.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Not logged in, redirect to login page with return URL
    $_SESSION['redirect_after_login'] = 'edit_user.php';
    header("Location: login.php");
    exit();
}

// Check if user has admin role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // User doesn't have admin permission
    header("Location: index.php");
    $_SESSION['message'] = "Je hebt geen toegang tot deze pagina.";
    exit();
}

// User has admin access, continue with the page
$message = "";

// Fetch all users to display in the table
$stmt = $conn->prepare("SELECT id, username, email, role FROM accounts");
$stmt->execute();
$users = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gebruikers beheren - Boekenbibliotheek</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="pagestyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="page-header">
        <div class="container">
            <h2>Gebruikers beheren</h2>
        </div>
    </div>

    <section class="system-section">
        <div class="container">
            <div class="system-header">
                <h3>Gebruikerslijst</h3>
            </div>
            
            <?php if (isset($message) && !empty($message)): ?>
                <div class="message"><?php echo $message; ?></div>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['message'])): ?>
                <div class="message"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
            <?php endif; ?>
            
            <div class="table-container">
                <table class="system-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Gebruikersnaam</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($user = $users->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['role']); ?></td>
                            <td>
                                <a href="user_edit.php?id=<?php echo $user['id']; ?>" class="action-btn edit">Bewerken</a>
                                <a href="user_delete.php?id=<?php echo $user['id']; ?>" class="action-btn delete" onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')">Verwijderen</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</body>
</html>
<?php $conn->close(); ?>

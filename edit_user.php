<?php require_once 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - City Library</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <h1>De<span>Boeken Bibliotheek</span></h1>
            </div>
            <nav>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="index.php">Boeken</a></li>
                    <li><a href="overview.php" class="active">Leners</a></li>
                </ul>
                <a href="login.php" class="login-icon" title="Login"><i class="fas fa-user"></i></a>
            </nav>
        </div>
    </header>

    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM gebruikers WHERE id=$id";
        $result = $conn->query($sql);
        $gebruiker = $result->fetch_assoc();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $naam = $_POST['naam'];
        $email = $_POST['email'];
        $telefoonnummer = $_POST['telefoonnummer'];
        $boekengeleend = $_POST['boekengeleend'];

        $sql = "UPDATE gebruikers SET naam='$naam', email='$email', telefoonnummer='$telefoonnummer', boekengeleend='$boekengeleend' WHERE id=$id";
        if ($conn->query($sql)) {
            header("Location: overview.php");
        } else {
            echo "<div class='alert error'>Fout bij bijwerken: " . $conn->error . "</div>";
        }
    }
    ?>

    <section class="page-header">
        <div class="container">
            <h2>Lener Bewerken</h2>
        </div>
    </section>

    <section class="system-section">
        <div class="container">
            <form method="post" class="system-table">
                <div class="service-card">
                    <input type="hidden" name="id" value="<?php echo $gebruiker['id']; ?>">
                    <div class="form-group">
                        <label for="naam">Naam:</label>
                        <input type="text" id="naam" name="naam" value="<?php echo $gebruiker['naam']; ?>" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo $gebruiker['email']; ?>" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="telefoonnummer">Telefoonnummer:</label>
                        <input type="number" id="telefoonnummer" name="telefoonnummer" value="<?php echo $gebruiker['telefoonnummer']; ?>" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="boekengeleend">Boeken geleend:</label>
                        <input type="number" id="boekengeleend" name="boekengeleend" value="<?php echo $gebruiker['boekengeleend']; ?>" required class="form-control">
                    </div>
                    <div class="button-group">
                        <button type="submit" class="btn">Opslaan</button>
                        <a href="overview.php" class="btn">Annuleren</a>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Openings tijden</h3>
                    <p>Maandag - Vrijdag: 9 uur - 8 uur</p>
                    <p>Zaterdag: 10 uur  - 6 uur</p>
                    <p>Zondag: 12 uur  - 5 uur</p>
                </div>
                <div class="footer-section">
                    <h3>Neem contact met ons op</h3>
                    <p>123 Dokkumerhoofdweg 36</p>
                    <p>Dokkum, Friesland 9131 XP</p>
                    <p>telefoonnummer: (123) 456-7890</p>
                    <p>Email: info@DeBoekenBibliotheek.com</p>
                </div>
                <div class="footer-section">
                    <h3>Snelle links</h3>
                    <ul>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="index.php">Catalogus</a></li>
                        <li><a href="overview.php">Overzicht</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 De boeken Bibliotheek. Alle rechten voorbehouden.</p>
            </div>
        </div>
    </footer>
</body>
</html>
<?php $conn->close(); ?>

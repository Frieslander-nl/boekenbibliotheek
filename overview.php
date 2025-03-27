<?php require_once 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Overview - City Library</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <h1>De<span>Boeken Bibliotheek</span></h1>
            </div>
            <nav>
                <ul>
                <li><a href="home.php" class="active">Home</a></li>
                    <li><a href="index.php">Boeken</a></li>
                    <li><a href="overview.php" class="active">Leners</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="page-header">
        <div class="container">
            <h2>Leners Management</h2>
        </div>
    </section>

    <section class="system-section">
        <div class="container">
            <div class="system-header">
                <h3>Voeg een nieuwe lener toe</h3>
            </div>
            <form action="overview.php" method="POST" class="system-table">
                <div class="service-card">
                    <div class="form-group">
                        <label for="naam">Naam:</label>
                        <input type="text" id="naam" name="naam" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="telefoonnummer">telefoonnummer:</label>
                        <input type="number" id="telefoonnummer" name="telefoonnummer" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="boekengeleend">Boeken geleend:</label>
                        <input type="number" id="boekengeleend" name="boekengeleend" required class="form-control">
                    </div>
                    <input type="submit" name="submit2" value="Add User" class="btn">
                </div>
            </form>

            <?php
            // Handle user submission
            if (isset($_POST['submit2'])) {
                $naam = $_POST['naam'];
                $email = $_POST['email'];
                $telefoonnummer = $_POST['telefoonnummer'];
                $boekengeleend = $_POST['boekengeleend'];

                $sql = "INSERT INTO gebruikers (naam, email, telefoonnummer, boekengeleend) VALUES ('$naam', '$email', '$telefoonnummer', '$boekengeleend')";
                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert success'>User successfully added</div>";
                } else {
                    echo "<div class='alert error'>Error: " . $sql . "<br>" . $conn->error . "</div>";
                }
            }

            // Handle user deletion
            if (isset($_GET['delete_user'])) {
                $id = $_GET['delete_user'];
                $sql = "DELETE FROM gebruikers WHERE id = '$id'";
                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert success'>User successfully deleted</div>";
                } else {
                    echo "<div class='alert error'>Error deleting user: " . $conn->error . "</div>";
                }
            }
            ?>

            <div class="system-header">
                <h3>User List</h3>
            </div>
            <div class="table-container">
                <table class="system-table">
                    <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Email</th>
                            <th>telefoonnummer</th>
                            <th>Boeken geleend</th>
                            <th>Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT id, naam, email, telefoonnummer, boekengeleend FROM gebruikers";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['naam'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['telefoonnummer'] . "</td>";
                                echo "<td>" . $row['boekengeleend'] . "</td>";
                                echo "<td>";
                                echo "<a href='overview.php?delete_user=" . $row['id'] . "' class='action-btn delete' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No users found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
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
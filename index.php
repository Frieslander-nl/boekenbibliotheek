<?php require_once 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Catalog - De Boeken Bibliotheek</title>
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
                    <li><a href="index.php" class="active">Boeken</a></li>
                    <li><a href="overview.php">Leners</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="page-header">
        <div class="container">
            <h2>Boeken Catalogus</h2>
        </div>
    </section>

    <section class="system-section">
        <div class="container">
            <div class="system-header">
                <h3>Voeg een nieuw boek toe.</h3>
            </div>
            <form action="index.php" method="POST" class="system-table">
                <div class="service-card">
                    <div class="form-group">
                        <label for="titel">Titel</label>
                        <input type="text" id="titel" name="titel" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="auteur">Auteur: </label>
                        <input type="text" id="auteur" name="auteur" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="year">Jaar: </label>
                        <input type="text" id="year" name="year" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="genre">Catergorie: </label>
                        <input type="text" id="genre" name="genre" required class="form-control">
                    </div>
                    <input type="submit" name="submit" value="Add Book" class="btn">
                </div>
            </form>

            <?php
            // Handle book submission
            if (isset($_POST['submit'])) {
                $titel = $_POST['titel'];
                $auteur = $_POST['auteur'];
                $year = $_POST['year'];
                $genre = $_POST['genre'];

                $sql = "INSERT INTO boeken (titel, auteur, year, genre) VALUES ('$titel', '$auteur', '$year', '$genre')";
                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert success'>Book successfully added</div>";
                } else {
                    echo "<div class='alert error'>Error: " . $sql . "<br>" . $conn->error . "</div>";
                }
            }

            // Handle book deletion
            if (isset($_GET['delete_book'])) {
                $id = $_GET['delete_book'];
                $sql = "DELETE FROM boeken WHERE id = '$id'";
                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert success'>Book successfully deleted</div>";
                } else {
                    echo "<div class='alert error'>Error deleting book: " . $conn->error . "</div>";
                }
            }
            ?>

            <div class="system-header">
                <h3>Book Collection</h3>
            </div>
            <div class="books-grid">
                <?php
                $sql = "SELECT id, titel, auteur, year, genre FROM boeken";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='book-card'>";
                        echo "<div class='book-cover'></div>";
                        echo "<h3>" . $row['titel'] . "</h3>";
                        echo "<p>By " . $row['auteur'] . "</p>";
                        echo "<p>Year: " . $row['year'] . "</p>";
                        echo "<p>Genre: " . $row['genre'] . "</p>";
                        echo "<a href='index.php?delete_book=" . $row['id'] . "' class='action-btn delete' onclick='return confirm(\"Are you sure you want to delete this book?\");'>Delete</a>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='service-card'><p>No books found.</p></div>";
                }
                ?>
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
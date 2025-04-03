<!DOCTYPE html>
<html lang="en">
<head> <!--Edit knop toevoegen-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Library</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="animations.css">
    <script src="script.js" defer></script>
</head>
<body>
    <div class="loading-screen">
        <div class="loader"></div>
    </div>

    <header>
        <div class="container">
            <div class="logo">
                <h1>De<span>Boeken Bibliotheek</span></h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.html" class="active">Home</a></li>
                    <li><a href="index.php" class="active">Boeken</a></li>
                    <li><a href="overview.php">Leners</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="container">
                <div class="hero-content fade-in">
                    <h2>Welkom bij De Boeken Bibliotheek</h2>
                    <p>Verken duizenden boeken voor alle leeftijden!</p>
                    <a href="index.php" class="btn">Bekijk Catalogus</a>
                </div>
            </div>
        </section>

        <section id="services" class="services scroll-reveal">
            <div class="container">
                <h2>Onze diensten</h2>
                <div class="services-grid">
                    <div class="service-card">
                        <div class="icon">📚</div>
                        <h3>Boeken lenen</h3>
                        <p>Leen tot 10 boeken voor 3 weken!</p>
                    </div>
                    <div class="service-card">
                        <div class="icon">💻</div>
                        <h3>Computer toegang</h3>
                        <p>Gratis computer en internet toegang voor leden.</p>
                    </div>
                    <div class="service-card">
                        <div class="icon">🎓</div>
                        <h3>Studeer ruimtes</h3>
                        <p>Stille studeer ruimtes beschikbaar als we open zijn.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="featured-books scroll-reveal">
            <div class="container">
                <h2>Uitgelichte boeken</h2>
                <div class="books-grid">
                    <div class="book-card">
                        <div class="book-cover"></div>
                        <h3>The Great Adventure</h3>
                        <p>By John Smith</p>
                        <span class="status available">Available</span>
                    </div>
                    <div class="book-card">
                        <div class="book-cover"></div>
                        <h3>Mystery of the Lost Key</h3>
                        <p>By Sarah Johnson</p>
                        <span class="status available">Available</span>
                    </div>
                    <div class="book-card">
                        <div class="book-cover"></div>
                        <h3>The History of Everything</h3>
                        <p>By David Williams</p>
                        <span class="status borrowed">Borrowed</span>
                    </div>
                    <div class="book-card">
                        <div class="book-cover"></div>
                        <h3>Cooking Masterclass</h3>
                        <p>By Maria Garcia</p>
                        <span class="status available">Available</span>
                    </div>
                </div>
            </div>
        </section>
    </main>

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
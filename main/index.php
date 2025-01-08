<?php
include '../functions/infoSection.php';
include '../functions/contactForm.php';
include '../functions/db_connect.php'; // Dodajemy połączenie z bazą danych
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Korepetycje z matematyki</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

<header class="header">
    <div class="header_item"><a href="#form">Umów się na korepetycje</a></div>
    <div class="header_item"><a href="#calendar">Sprawdź terminy</a></div>
    <div class="header_item"><a href="#about">O mnie</a></div>
    <div class="header_item"><a href="#contact">Kontakt</a></div>
</header>

<main>
    <!-- Sekcja o mnie -->
    <section id="about">
        <h1>O mnie</h1>
        <p><?php infoSection(); ?></p>
    </section>

    <!-- Sekcja kalendarza -->
    <section id="calendar">
        <h2>Wybierz termin</h2>
        <div id="slots-container">
            <!-- Terminy będą dynamicznie wczytywane tutaj za pomocą JS -->
        </div>
    </section>

    <!-- Formularz rezerwacji -->
    <section class="form" id="form">
        <h1>Umów się na korepetycje</h1>
        <form id="reservation-form">
            <label for="name">Imię:</label>
            <input type="text" id="name" name="name" placeholder="Twoje imię (opcjonalne)">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Telefon:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="class">Klasa:</label>
            <input type="text" id="class" name="class" required>

            <label for="description">Opis:</label>
            <textarea id="description" name="description" required></textarea>

            <input type="hidden" id="slot-id" name="slot-id">
            <button type="submit">Zarezerwuj</button>
        </form>
    </section>

    <!-- Sekcja kontaktowa -->
    <section class="contact" id="contact">
        <h1>Kontakt</h1>
        <p><?php contactForm(); ?></p>
    </section>
</main>

<footer class="footer"><p>&copy; 2024 Magdalena Brzozowska. Wszystkie prawa zastrzeżone.</p></footer>

<script src="script.js"></script> <!-- Załadowanie skryptu JS -->
</body>
</html>

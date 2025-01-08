<?php
function contactForm() {
    echo '<section id="appointment">';
    echo '<h2>Formularz kontaktowy</h2>';
    echo '<form id="appointment-form" method="POST" action="../php/process.php">';
    echo '<label for="name">Imię i nazwisko:</label>';
    echo '<input type="text" id="name" name="name" required>';

    echo '<label for="email">Email:</label>';
    echo '<input type="email" id="email" name="email" required>';

    echo '<label for="date">Wybierz datę:</label>';
    echo '<input type="date" id="submission_date" name="submission_date" required>';

    echo '<label for="message">Treść wiadomości:</label>';
    echo '<textarea id="message" name="message" rows="5" required></textarea>';

    echo '<button type="submit">Wyślij </button>';
    echo '</form>';
    echo '</section>';
}
?>

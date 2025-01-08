<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$servername = "localhost";
$username = "root"; // Zmienna środowiskowa lub ustawienie hasła
$password = "3Wkasta123!";
$dbname = "tutoring";

// Odbiór danych z formularza
$data = json_decode(file_get_contents('php://input'), true);

// Sprawdzanie, czy wszystkie dane zostały przekazane
if (!isset($data['name'], $data['email'], $data['submission_date'], $data['message'])) {
    echo json_encode(["success" => false, "message" => "Brak wymaganych danych"]);
    exit;
}

// Tworzenie połączenia z bazą danych
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzanie połączenia
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Wstawianie danych kontaktowych do bazy
$stmt = $conn->prepare("INSERT INTO contact_form (name, email, submission_date, message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $data['name'], $data['email'], $data['submission_date'], $data['message']);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Dziękujemy za kontakt!"]);
} else {
    echo json_encode(["success" => false, "message" => "Wystąpił błąd podczas przesyłania formularza"]);
}

$stmt->close();
$conn->close();
?>

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
if (!isset($data['name'], $data['email'], $data['phone'], $data['class'], $data['description'], $data['slot-id'])) {
    echo json_encode(["success" => false, "message" => "Brak wymaganych danych"]);
    exit;
}

// Tworzenie połączenia z bazą danych
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzanie połączenia
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Wstawianie danych rezerwacji do bazy
$stmt = $conn->prepare("INSERT INTO reservations (name, email, phone, class, description, slot_id) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssi", $data['name'], $data['email'], $data['phone'], $data['class'], $data['description'], $data['slot-id']);

if ($stmt->execute()) {
    // Aktualizacja statusu dostępności terminu
    $slotId = $data['slot-id'];
    $conn->query("UPDATE slots SET available = 0 WHERE id = $slotId");

    echo json_encode(["success" => true, "message" => "Rezerwacja zakończona sukcesem!"]);
} else {
    echo json_encode(["success" => false, "message" => "Wystąpił błąd podczas rezerwacji"]);
}

$stmt->close();
$conn->close();
?>

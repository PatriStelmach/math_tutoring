<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Dopuszcza zapytania z innych domen

$servername = "localhost";
$username = "root"; // Zmienna środowiskowa lub ustawienie hasła
$password = "3Wkasta123!";
$dbname = "tutoring";

// Tworzenie połączenia
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzanie połączenia
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Zapytanie do bazy danych w celu pobrania dostępnych terminów
$sql = "SELECT id, date, time FROM slots WHERE available = 1";
$result = $conn->query($sql);

$slots = [];

if ($result->num_rows > 0) {
    // Pobieranie wyników i dodawanie ich do tablicy
    while ($row = $result->fetch_assoc()) {
        $slots[] = $row;
    }
} else {
    echo json_encode(["error" => "Brak dostępnych terminów"]);
}

$conn->close();

// Zwracanie danych w formacie JSON
echo json_encode($slots);
?>

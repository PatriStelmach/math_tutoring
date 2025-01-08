document.addEventListener('DOMContentLoaded', function () {
    const slotsContainer = document.getElementById('slots-container');
    const reservationForm = document.getElementById('reservation-form');
    const slotIdInput = document.getElementById('slot-id');

    // Pobieranie dostępnych terminów
    function fetchSlots() {
        fetch('../functions/getSlots.php')
            .then(response => response.json())
            .then(slots => {
                slotsContainer.innerHTML = ''; // Czyścimy zawartość kontenera
                if (slots.length === 0) {
                    slotsContainer.innerHTML = '<p>Brak dostępnych terminów</p>';
                } else {
                    slots.forEach(slot => {
                        const button = document.createElement('button');
                        button.textContent = `${slot.date} ${slot.time}`;
                        button.dataset.slotId = slot.id;
                        button.addEventListener('click', () => selectSlot(slot.id));
                        slotsContainer.appendChild(button);
                    });
                }
            })
            .catch(error => {
                console.error('Błąd podczas pobierania terminów:', error);
                slotsContainer.innerHTML = '<p>Wystąpił błąd przy ładowaniu terminów. Spróbuj ponownie.</p>';
            });
    }

    // Wybór terminu
    function selectSlot(slotId) {
        slotIdInput.value = slotId;
        alert('Wybrano termin: ' + slotId);
    }

    // Obsługa rezerwacji
    reservationForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(reservationForm);
        const data = Object.fromEntries(formData.entries());

        fetch('../functions/bookSlot.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert(result.message);
                    fetchSlots(); // Odśwież dostępne terminy
                } else {
                    alert('Wystąpił błąd: ' + result.message);
                }
            })
            .catch(error => {
                console.error('Błąd przy rezerwacji:', error);
                alert('Wystąpił błąd przy rezerwacji. Spróbuj ponownie.');
            });
    });

    fetchSlots(); // Inicjalne pobranie terminów
});

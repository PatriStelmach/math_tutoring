import React, { useState } from 'react';

function ReservationForm({ selectedSlot }) {
    const [formData, setFormData] = useState({
        name: '',
        email: '',
        phone: '',
        class: '',
        description: '',
        slotId: selectedSlot || ''
    });

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData(prevData => ({
            ...prevData,
            [name]: value
        }));
    };

    const handleSubmit = (e) => {
        e.preventDefault();

        fetch('/api/bookslot.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(formData)
        })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert(result.message);
                } else {
                    alert('Błąd rezerwacji');
                }
            })
            .catch(err => console.error('Error:', err));
    };

    return (
        <section id="form">
            <h1>Umów się na korepetycje</h1>
            <form id="reservation-form" onSubmit={handleSubmit}>
                <label htmlFor="name">Imię:</label>
                <input type="text" id="name" name="name" value={formData.name} onChange={handleChange} placeholder="Twoje imię" />

                <label htmlFor="email">Email:</label>
                <input type="email" id="email" name="email" value={formData.email} onChange={handleChange} required />

                <label htmlFor="phone">Telefon:</label>
                <input type="text" id="phone" name="phone" value={formData.phone} onChange={handleChange} required />

                <label htmlFor="class">Klasa:</label>
                <input type="text" id="class" name="class" value={formData.class} onChange={handleChange} required />

                <label htmlFor="description">Opis:</label>
                <textarea id="description" name="description" value={formData.description} onChange={handleChange} required></textarea>

                <input type="hidden" id="slot-id" name="slot-id" value={formData.slotId} />
                <button type="submit">Zarezerwuj</button>
            </form>
        </section>
    );
}

export default ReservationForm;

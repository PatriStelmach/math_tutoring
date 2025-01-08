import React, { useState } from 'react';

function ContactForm() {
    const [contactData, setContactData] = useState({
        name: '',
        email: '',
        submission_date: '',
        message: ''
    });

    const handleChange = (e) => {
        const { name, value } = e.target;
        setContactData(prevData => ({
            ...prevData,
            [name]: value
        }));
    };

    const handleSubmit = (e) => {
        e.preventDefault();

        fetch('/api/process.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(contactData)
        })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert('Dziękuję za kontakt!');
                } else {
                    alert('Wystąpił błąd');
                }
            })
            .catch(err => console.error('Error:', err));
    };

    return (
        <section id="contact">
            <h1>Kontakt</h1>
            <form onSubmit={handleSubmit}>
                <label htmlFor="name">Imię i nazwisko:</label>
                <input type="text" id="name" name="name" value={contactData.name} onChange={handleChange} required />

                <label htmlFor="email">Email:</label>
                <input type="email" id="email" name="email" value={contactData.email} onChange={handleChange} required />

                <label htmlFor="date">Wybierz datę:</label>
                <input type="date" id="submission_date" name="submission_date" value={contactData.submission_date} onChange={handleChange} required />

                <label htmlFor="message">Treść wiadomości:</label>
                <textarea id="message" name="message" value={contactData.message} onChange={handleChange} required></textarea>

                <button type="submit">Wyślij</button>
            </form>
        </section>
    );
}

export default ContactForm;

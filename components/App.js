import React, { useState, useEffect } from 'react';
import Header from 'Header';
import About from 'About';
import Calendar from 'Calendar';
import ReservationForm from 'ReservationForm';
import ContactForm from 'ContactForm';

function App() {
    const [slots, setSlots] = useState([]);
    const [selectedSlot, setSelectedSlot] = useState(null);

    useEffect(() => {
        fetch('/api/getslots.php')
            .then(response => response.json())
            .then(data => setSlots(data))
            .catch(error => console.error('Error fetching slots:', error));
    }, []);

    return (
        <div className="App">
            <Header />
            <main>
                <About />
                <Calendar slots={slots} setSelectedSlot={setSelectedSlot} />
                <ReservationForm selectedSlot={selectedSlot} />
                <ContactForm />
            </main>
        </div>
    );
}

export default App;

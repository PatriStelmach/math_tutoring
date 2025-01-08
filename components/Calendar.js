import React from 'react';

function Calendar({ slots, setSelectedSlot }) {
    return (
        <section id="calendar">
            <h2>Wybierz termin</h2>
            <div id="slots-container">
                {slots.map(slot => (
                    <button key={slot.id} onClick={() => setSelectedSlot(slot.id)}>
                        {slot.date} {slot.time}
                    </button>
                ))}
            </div>
        </section>
    );
}

export default Calendar;

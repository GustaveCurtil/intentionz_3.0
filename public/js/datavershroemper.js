document.querySelector('form').addEventListener('submit', (e) => {
    const uitnodigingen = localStorage.getItem('events');
    const koosnaam = localStorage.getItem('koosnaam');
    if (uitnodigingen) {
        document.getElementById('localEvents').value = uitnodigingen;
    }
    if (koosnaam) {
        document.getElementById('localKoosnaam').value = koosnaam;
    }
});
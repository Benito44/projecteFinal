const createEventDialog = document.getElementById('createEventDialog');
const openCreateEventFormButton = document.getElementById('eliminarCompte');
const cerrar_boton = document.getElementById('closeCreateEventDialog');

openCreateEventFormButton.addEventListener('click', function() {
    createEventDialog.showModal();
});
cerrar_boton.addEventListener('click', function() {
    createEventDialog.close();
});
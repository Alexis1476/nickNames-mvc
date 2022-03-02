function confirmDelete(url) {
    if (confirm("Etes-vous sûr de vouloir supprimer l'enseignant?") === true) {
        document.location = url;
    }
}
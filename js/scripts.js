document.getElementById('create-album-btn').addEventListener('click', function() {
    const albumName = prompt('Введите название альбома:');
    if (albumName) {
        alert(`Альбом "${albumName}" создан!`);
        // AJAX-запрос для отправки на сервер
    }
});
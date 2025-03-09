// Открытие модального окна для создания альбома
function openModal() {
    document.getElementById('modal').style.display = 'flex';
    document.getElementById('upload-image-form').reset();
}

// Закрытие модального окна
function closeModal() {
    document.getElementById('modal').style.display = 'none';
}

// Закрыть модальное окно при клике вне его области
window.onclick = function(event) {
    const modal = document.getElementById('modal');
    if (event.target === modal) {
        closeModal();
    }
};


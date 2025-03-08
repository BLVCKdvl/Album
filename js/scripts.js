// Открытие модального окна для создания альбома
function openModal() {
    document.getElementById('modal').style.display = 'flex';
    if (document.getElementById('upload-image-form') != null)
    {
        document.getElementById('upload-image-form').reset(); // Сброс формы
    }
}

// Закрытие модального окна
function closeModal() {
    document.getElementById('modal').style.display = 'none';
}

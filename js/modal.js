// Модальное окно создания альбома
function openModal() {
    document.getElementById('modal').style.display = 'flex';
    document.getElementById('upload-image-form').reset();
}

function closeModal() {
    document.getElementById('modal').style.display = 'none';
}

window.onclick = function(event) {
    const modal = document.getElementById('modal');
    if (event.target === modal) {
        closeModal();
    }
};


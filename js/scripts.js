//добавление изображения
function openUploadModal(){
    document.getElementById('uploadModal').style.display = 'flex';
}

function closeUploadModal(){
    document.getElementById('uploadModal').style.display = 'none';
}

window.onclick = function(event) {
    const uploadModal = document.getElementById('uploadModal');
    if (event.target === uploadModal) {
        closeUploadModal();
    }

    const createAlbumModal = document.getElementById('createAlbumModal');
    if (event.target === createAlbumModal) {
        closeModal();
    }
};

// модальное окно редактирования описания
function openEditDescriptionModal() {
    const descriptionElement = document.getElementById('album-description');
    const currentDescription = descriptionElement.innerText;

    const textarea = document.getElementById('edit-description-textarea');
    textarea.value = currentDescription;

    const modal = document.getElementById('editDescriptionModal');
    modal.style.display = 'flex';
}

function closeEditDescriptionModal() {
    const modal = document.getElementById('editDescriptionModal');
    modal.style.display = 'none';
}

function saveDescriptionChanges() {
    const newDescription = document.getElementById('edit-description-textarea').value;
    const albumId = document.getElementById('album-id').dataset.albumId;

    fetch('php/update_album_description.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            album_id: albumId,
            description: newDescription,
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const descriptionElement = document.getElementById('album-description');
            descriptionElement.innerText = newDescription;

            closeEditDescriptionModal();
        } else {
            alert('Ошибка при сохранении описания: ' + (data.error || 'Неизвестная ошибка'));
        }
    })
    .catch(error => {
        console.error('Ошибка:', error);
        alert('Произошла ошибка при сохранении описания. Проверьте консоль для подробностей.');
    });
}
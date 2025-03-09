// Открытие модального окна с изображением
function openImageModal(imageId) {
    fetch(`php/get_image_details.php?id=${imageId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('fullSizeImage').src = data.file_path;
            document.getElementById('imageName').textContent = data.name;
            document.getElementById('imageDescription').textContent = data.description;
            document.getElementById('likeCount').textContent = data.likes;
            document.getElementById('commentCount').textContent = data.comments;
            document.getElementById('imageModal').style.display = 'flex';
        });
}

// Закрытие модального окна с изображением
function closeImageModal() {
    document.getElementById('imageModal').style.display = 'none';
}

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
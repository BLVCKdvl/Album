let imageIdForPost;

function openImageModal(imageId) {

    fetch(`php/get_image_data.php?id=${imageId}`)
        .then(response => response.json())
        .then(data => {

            const modalImage = document.querySelector('#image-modal .image-modal-panel img');
            const imageNameText = document.getElementById('image-modal-image-name-text');
            const likeCount = document.getElementById('image-modal-like-count');
            const commentsList = document.getElementById('image-modal-comments-list');
            const descriptionText = document.getElementById('image-modal-description-text');
            
            modalImage.src = data.file_path;
            modalImage.alt = data.name;
            likeCount.innerText = data.likes;
            descriptionText.innerText = data.description || 'Описание отсутствует';
            imageNameText.innerText = data.name;

            commentsList.innerHTML = '';

            if (data.comments > 0) {
                loadComments(imageId);
            }

            imageIdForPost = imageId;

            checkIfLiked(imageId);

            document.getElementById('image-modal').style.display = 'flex';
        })
        .catch(error => {
            console.error('Ошибка при загрузке данных:', error);
        });
}

function closeImageModal() {
    document.getElementById('image-modal').style.display = 'none';
    location.reload();
}
window.onclick = function (event) {
    const modal = document.getElementById('image-modal');
    if (event.target === modal) {
        closeImageModal();
    }
};

function loadComments(imageId) {
    fetch(`php/get_comments.php?id=${imageId}`)
        .then(response => response.json())
        .then(data => {
            const commentsList = document.getElementById('image-modal-comments-list');
            commentsList.innerHTML = ''; 

            if (data.comments && data.comments.length > 0) {
                data.comments.forEach(comment => {
                    const commentElement = document.createElement('div');
                    commentElement.className = 'image-modal-comment';
                    commentElement.innerText = comment;
                    commentsList.appendChild(commentElement);
                });
            } else {
                commentsList.innerHTML = '<p>Комментариев пока нет.</p>';
            }
        })
        .catch(error => {
            console.error('Ошибка при загрузке комментариев:', error);
        });
}

function addComment() {
    const imageId = imageIdForPost; 
    const commentInput = document.getElementById('image-modal-comment-input');
    const commentText = commentInput.value.trim();

    if (commentText === '') {
        alert('Комментарий не может быть пустым.');
        return;
    }

    fetch('php/add_comment.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ image_id: imageId, text: commentText })
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => {
                throw new Error(err.error || 'Ошибка сервера');
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            commentInput.value = '';

            loadComments(imageId);
        } else {
            alert(data.error || 'Ошибка при добавлении комментария');
        }
    })
    .catch(error => {
        console.error('Ошибка при добавлении комментария:', error);
        alert(error.message);
    });
}


function likeImage() {
    const imageId = imageIdForPost; 
    const likeButton = document.getElementById('image-modal-like-button');
    const likeCount = document.getElementById('image-modal-like-count');

    const likedImages = JSON.parse(localStorage.getItem('likedImages')) || [];
    if (likedImages.includes(imageId)) {
        alert('Вы уже поставили лайк на это изображение.');
        return;
    }

    fetch('php/like_image.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ image_id: imageId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
         
            likeCount.textContent = data.likes;

            likedImages.push(imageId);
            localStorage.setItem('likedImages', JSON.stringify(likedImages));

            likeButton.disabled = true;
            likeButton.textContent = '❤️ Лайк поставлен';
        } else {
            alert('Ошибка при постановке лайка: ' + (data.error || ''));
        }
    })
    .catch(error => {
        console.error('Ошибка:', error);
        alert('Ошибка при постановке лайка.');
    });
}

function checkIfLiked(imageId) {
    const likedImages = JSON.parse(localStorage.getItem('likedImages')) || [];
    if (likedImages.includes(imageId)) {
        const likeButton = document.getElementById('image-modal-like-button');
        likeButton.disabled = true;
        likeButton.textContent = '❤️ Лайк поставлен';
    }
}

let imageIdForPost;

function openImageModal(imageId) {
    // Загружаем данные об изображении через AJAX
    fetch(`php/get_image_data.php?id=${imageId}`)
        .then(response => response.json())
        .then(data => {
            // Заполняем модальное окно данными
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

            // Очищаем список комментариев
            commentsList.innerHTML = '';

            // Загружаем комментарии (если есть)
            if (data.comments > 0) {
                loadComments(imageId);
            }

            imageIdForPost = imageId;

            // Открываем модальное окно
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

// Закрытие модального окна при клике вне его области
window.onclick = function (event) {
    const modal = document.getElementById('image-modal');
    if (event.target === modal) {
        closeImageModal();
    }
};

// Функция для загрузки комментариев
function loadComments(imageId) {
    fetch(`php/get_comments.php?id=${imageId}`)
        .then(response => response.json())
        .then(data => {
            const commentsList = document.getElementById('image-modal-comments-list');
            commentsList.innerHTML = ''; // Очищаем список

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
    const imageId = imageIdForPost; // Получаем ID текущего изображения
    const commentInput = document.getElementById('image-modal-comment-input');
    const commentText = commentInput.value.trim();

    if (commentText === '') {
        alert('Комментарий не может быть пустым.');
        return;
    }

    // Отправляем данные на сервер
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
            // Очищаем поле ввода
            commentInput.value = '';

            // Обновляем список комментариев
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
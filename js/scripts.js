// Фокусирование на элементе с классом "focus"
const focusElement = document.getElementsByClassName('focus')
if (focusElement.length > 0) {
    focusElement[0].focus()
    focusElement[0].scrollIntoView({
        behavior: "smooth",
        block: "center",
        inline: "start"
    });
}

// Обновление изображения после загрузки файла
const inputFile = document.getElementById('imgName')
if (inputFile) {
    const preview = document.getElementById('preview')
    const error = document.getElementsByClassName('error')
    const noError = document.getElementsByClassName('no-error')
    inputFile.addEventListener('change', updateImage)
    function updateImage() {
        // Изменить путь к отображаемому файлу, если инпут заполнен данными
        if (this.files && this.files.length) {
            preview.src = window.URL.createObjectURL(this.files[0]);
            // Скрыть сообщение об ошибка загрузки файла, если оно есть
            if (error.length) {
                error[0].hidden = true;
                noError[0].hidden = false;
            }
        }
    }
}

import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {

// Adding spinner to submit button and disable the button
document.querySelectorAll('form.form').forEach(form => {
    form.addEventListener('submit', function () {
        const button = form.querySelector('button[type="submit"]');
        const spinner = button.querySelector('.spinner');

        // Disable the button
        button.disabled = true;

        // Show the spinner
        spinner.style.display = 'inline-block';
    });
});

// Adding a preview image when selecting an image in the form
const fileInput = document.getElementById('image');
const preview = document.getElementById('image-preview');
const removeButton = document.getElementById('remove-image');

fileInput.addEventListener('change', function (event) {
    preview.innerHTML = '';
    const file = event.target.files[0];

    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.maxWidth = '80px';
            //img.style.maxHeight = '300px';
            img.style.border = '1px solid #ccc';
            img.style.padding = '5px';
            preview.appendChild(img);
            removeButton.style.display = 'inline-block';
        };
        reader.readAsDataURL(file);
    }
});

removeButton.addEventListener('click', function () {
    // Clear input and preview
    fileInput.value = '';
    preview.innerHTML = '';
    removeButton.style.display = 'none';
});

});

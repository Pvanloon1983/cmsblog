import './bootstrap';

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

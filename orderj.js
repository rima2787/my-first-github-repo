document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('billing-form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        alert('Order placed successfully!');
    });
});
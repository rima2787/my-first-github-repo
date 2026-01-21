document.getElementById('shipping-form').addEventListener('submit', function(event) {
    event.preventDefault();
    calculateShipping();
});

function calculateShipping() {
    const postcode = document.getElementById('postcode').value;
    if (postcode) {
        alert(Shipping calculated for postcode: ${postcode});
        // You can add more complex logic to calculate and display shipping costs here.
    } else {
        alert('Please enter a valid postcode.');
    }
}

document.querySelectorAll('.btn-remove').forEach(button => {
    button.addEventListener('click', function() {
        removeCartItem(this);
    });
});

function removeCartItem(button) {
    const row = button.closest('tr');
    row.remove();
    updateTotals();
}

function updateTotals() {
    // Logic to update totals after removing an item
    alert('Totals updated.');
}
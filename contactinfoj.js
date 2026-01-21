document.addEventListener('DOMContentLoaded', () => {
  const editButtons = document.querySelectorAll('.edit-btn');
  const editForm = document.getElementById('edit-form');
  const fieldInput = document.getElementById('field-input');
  const saveButton = document.getElementById('save-btn');
  const cancelButton = document.getElementById('cancel-btn');
  let currentField = null;

  // Open edit form
  editButtons.forEach(button => {
    button.addEventListener('click', (e) => {
      currentField = e.target.getAttribute('data-field');
      const displayElement = document.getElementById(`${currentField}-display`);
      fieldInput.value = displayElement.textContent;
      editForm.style.display = 'block';
    });
  });

  // Save changes
  saveButton.addEventListener('click', () => {
    if (currentField) {
      const displayElement = document.getElementById(`${currentField}-display`);
      displayElement.textContent = fieldInput.value;
      editForm.style.display = 'none';
    }
  });

  // Cancel editing
  cancelButton.addEventListener('click', () => {
    editForm.style.display = 'none';
    currentField = null;
  });
});

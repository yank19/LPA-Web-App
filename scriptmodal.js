document.addEventListener('DOMContentLoaded', function() {
    // script for Dialog invoice saved 

    // Seleccionar elementos
    const showmodal = document.getElementById("showmodal");
    const closemodal = document.getElementById("closemodal");
    const modal = document.getElementById("modal");

    // Abrir el diálogo al hacer clic en el botón con ID 'showmodal'
    if (showmodal) {
        showmodal.addEventListener("click", () => {
            modal.showModal(); // Usar showModal() para abrir el diálogo
        });
    }

    // Cerrar el diálogo al hacer clic en la "X"
    if (closemodal) {
        closemodal.addEventListener("click", () => {
            modal.close(); // Usar close() para cerrar el diálogo
        });
    }

});

/*
 // script for Dialog new invoice 

// Seleccionar elementos
const showmodalnewinvoice = document.getElementById("showmodalnewinvoice");
const closemodalnewinvoice = document.getElementById("closemodalnewinvoice");
const modalnewinvoice = document.getElementById("modalnewinvoice");
const addItemButton = document.getElementById('addItemButton');
const itemsContainer = document.getElementById('itemsContainer');

// Abrir el diálogo al hacer clic en el botón con ID 'showmodal'
if (showmodalnewinvoice) {
    showmodalnewinvoice.addEventListener("click", () => {
        modalnewinvoice.showModal(); // Usar showModal() para abrir el diálogo
    });
}

// Cerrar el diálogo al hacer clic en la "X"
if (closemodalnewinvoice) { 
 closemodalnewinvoice.addEventListener("click", () => { 
     modalnewinvoice.close(); // Usar close() para cerrar el diálogo 
     }); 
 }


        // Función para agregar nuevos artículos
        addItemButton.addEventListener('click', () => {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><input type="text" class="itemId" name="itemId[]" required></td>
                <td><input type="text" class="itemName" name="itemName[]" required></td>
                <td><input type="number" class="units" name="units[]" required></td>
                <td><input type="number" class="unitPrice" name="unitPrice[]" required></td>
                <td><input type="number" class="totalPrice" name="totalPrice[]" required></td>
                <td><button type="button" class="deleteItemButton">Eliminar Artículo</button></td>
            `;
            tbody.appendChild(newRow);
            attachDeleteEvent(newRow);
        });
    
        // Función para eliminar artículos
        function attachDeleteEvent(row) {
            const deleteButton = row.querySelector('.deleteItemButton');
            deleteButton.addEventListener('click', () => {
                row.remove();
            });
        }
    
        // Adjuntar evento de eliminación a los artículos existentes
        const existingItems = tbody.querySelectorAll('tr');
        existingItems.forEach(row => {
            attachDeleteEvent(row);
        });
 
    */
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('modalnewinvoice');
            const showModalButton = document.getElementById('showmodalnewinvoice');
            const closeModalButton = document.getElementById('closemodalnewinvoice');
            const addItemButton = document.getElementById('addItemButton');
            const tbody = document.querySelector('.tableitensnewinvoice tbody');
        
            // Verificar si los elementos existen antes de agregar eventos
            if (showModalButton && closeModalButton && modal && addItemButton && tbody) {
                // Función para abrir el diálogo
                showModalButton.addEventListener('click', () => {
                    modal.showModal();
                });
        
                // Función para cerrar el diálogo
                closeModalButton.addEventListener('click', () => {
                    modal.close();
                });
        
                // Función para agregar nuevos artículos
                addItemButton.addEventListener('click', () => {
                    const newRow = document.createElement('tr');
                    newRow.innerHTML = `
                        <td><input type="text" class="itemId" name="itemId[]" required></td>
                        <td><input type="text" class="itemName" name="itemName[]" required></td>
                        <td><input type="number" class="units" name="units[]" required></td>
                        <td><input type="number" class="unitPrice" name="unitPrice[]" required></td>
                        <td><input type="number" class="totalPrice" name="totalPrice[]" required readonly></td>
                        <td><button type="button" class="deleteItemButton">Delete
                        </button></td>
                    `;
                    tbody.appendChild(newRow);
                    attachDeleteEvent(newRow);
                    attachCalculateTotalEvent(newRow);
                });
        
                // Función para eliminar artículos
                function attachDeleteEvent(row) {
                    const deleteButton = row.querySelector('.deleteItemButton');
                    if (deleteButton) {
                        deleteButton.addEventListener('click', () => {
                            row.remove();
                            calculateTotals();
                        });
                    } else {
                        console.error("No se encontró el botón de eliminar en la fila", row);
                    }
                }
        
                // Función para calcular el total de cada artículo
                function attachCalculateTotalEvent(row) {
                    const unitsInput = row.querySelector('.units');
                    const unitPriceInput = row.querySelector('.unitPrice');
                    const totalPriceInput = row.querySelector('.totalPrice');
        
                    if (unitsInput && unitPriceInput && totalPriceInput) {
                        function calculateTotal() {
                            const units = parseFloat(unitsInput.value) || 0;
                            const unitPrice = parseFloat(unitPriceInput.value) || 0;
                            totalPriceInput.value = (units * unitPrice).toFixed(2);
                            calculateTotals();
                        }
        
                        unitsInput.addEventListener('input', calculateTotal);
                        unitPriceInput.addEventListener('input', calculateTotal);
                    } else {
                        console.error("No se encontraron los campos necesarios en la fila", row);
                    }
                }
        
                // Función para calcular los totales generales
                function calculateTotals() {
                    const totalPrices = document.querySelectorAll('.totalPrice');
                    let subtotal = 0;
                    totalPrices.forEach(price => {
                        subtotal += parseFloat(price.value) || 0;
                    });
                    document.getElementById('subtotal').innerText = subtotal.toFixed(2);
                    const tax = subtotal * 0.1; // Assuming a 10% tax rate
                    document.getElementById('tax').innerText = tax.toFixed(2);
                    document.getElementById('total').innerText = (subtotal + tax).toFixed(2);
                }
        
                // Adjuntar evento de eliminación y cálculo a los artículos existentes
                const existingItems = tbody.querySelectorAll('tr');
                existingItems.forEach(row => {
                    attachDeleteEvent(row);
                    attachCalculateTotalEvent(row);
                });
            } else {
                console.error("Uno o más elementos no existen en el DOM");
            }
        });


        // script for Dialog new client

        document.addEventListener('DOMContentLoaded', function() {
            
        
            // Seleccionar elementos
            const showmodal = document.getElementById("showmodalclient");
            const closemodal = document.getElementById("closemodalclient");
            const modal = document.getElementById("modalclient");
        
            // Abrir el diálogo al hacer clic en el botón con ID 'showmodal'
            if (showmodal) {
                showmodal.addEventListener("click", () => {
                    modal.showModal(); // Usar showModal() para abrir el diálogo
                });
            }
        
            // Cerrar el diálogo al hacer clic en la "X"
            if (closemodal) {
                closemodal.addEventListener("click", () => {
                    modal.close(); // Usar close() para cerrar el diálogo
                });
            }
        
        });
          
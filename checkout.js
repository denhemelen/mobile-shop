document.addEventListener('DOMContentLoaded', function() {
    function loadOrderItems() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_cart.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                const cart = JSON.parse(xhr.responseText);
                const orderItemsContainer = document.querySelector('#order-items');
                orderItemsContainer.innerHTML = '';
                
                cart.forEach(item => {
                    orderItemsContainer.innerHTML += `
                        <div class="order-item">
                            <h4>${item.name}</h4>
                            <p>Ціна: ${item.price} грн</p>
                            <p>Кількість: ${item.quantity}</p>
                        </div>
                    `;
                });
            } else {
                console.error('Помилка завантаження кошика.');
            }
        };
        xhr.onerror = function() {
            console.error('Помилка AJAX-запиту.');
        };
        xhr.send();
    }

    loadOrderItems(); // Завантажуємо товари при завантаженні сторінки
});

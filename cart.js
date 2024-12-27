document.addEventListener('DOMContentLoaded', function() {
    function loadCart() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_cart.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                const cart = JSON.parse(xhr.responseText);
                const cartContainer = document.querySelector('#cart-list');
                cartContainer.innerHTML = '';
                
                cart.forEach(item => {
                    cartContainer.innerHTML += `
                        <div class="cart-item">
                            <h4>${item.name}</h4>
                            <p>Ціна: ${item.price} грн</p>
                            <p>Кількість: ${item.quantity}</p>
                            <button class="remove-from-cart" data-product-id="${item.id}">Видалити</button>
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

    document.querySelector('#cart-list').addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-from-cart')) {
            const productId = event.target.getAttribute('data-product-id');
            removeFromCart(productId);
        }
    });

    function removeFromCart(productId) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'remove_from_cart.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                loadCart(); // Оновлюємо кошик
            } else {
                console.error('Помилка видалення товару з кошика.');
            }
        };
        xhr.onerror = function() {
            console.error('Помилка AJAX-запиту.');
        };
        xhr.send(`product_id=${productId}`);
    }

    loadCart(); // Завантажуємо кошик при завантаженні сторінки
});

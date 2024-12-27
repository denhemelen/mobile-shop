function addToCart(productId, productName) {
    const product = products.find(p => p.id == productId);

    if (!product) {
        alert('Продукт не знайдено.');
        return;
    }

    // Підготовка даних для відправлення
    const data = new URLSearchParams();
    data.append('product_id', productId);
    data.append('product_name', productName);

    // Надсилання AJAX-запиту
    fetch('add_to_cart.php', {
        method: 'POST',
        body: data
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
            } else {
                alert(`Помилка: ${data.message}`);
            }
        })
        .catch(error => console.error('Помилка:', error));
}

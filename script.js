document.addEventListener('DOMContentLoaded', function() {
    const products = [
        {
            id: 1,
            brand: 'Apple',
            model: 'iPhone 14',
            price: 29999.00,
            description: 'Новий iPhone 14 з поліпшеними функціями. Великий і яскравий екран, потужний процесор і великий асортимент доступних аксесуарів.',
            image: 'photo/Apple iPhone 14.jpg',
            accessories: [
                {
                    name: 'Чохол для iPhone 14',
                    price: 499.00,
                    description: 'Захисний чохол для iPhone 14 з водовідштовхувальним покриттям.',
                    image: 'photo/Apple iPhone 14 чохол.jpg'
                },
                {
                    name: 'Зарядний кабель Lightning',
                    price: 299.00,
                    description: 'Оригінальний зарядний кабель для iPhone 14 з підтримкою швидкої зарядки.',
                    image: 'photo/Apple iPhone 14 кабель.jpg'
                }
            ]
        },
        {
            id: 2,
            brand: 'Samsung',
            model: 'Galaxy S22',
            price: 25999.00,
            description: 'Флагманський смартфон Samsung з потужним процесором і чудовою камерою для фото та відео зйомки.',
            image: 'photo/Samsung Galaxy S22.jpg',
            accessories: [
                {
                    name: 'Зарядний пристрій для Galaxy S22',
                    price: 799.00,
                    description: 'Оригінальний зарядний пристрій для Galaxy S22 з підтримкою швидкої зарядки.',
                    image: 'photo/Зарядний пристрій для Galaxy S22.jpg'
                },
                {
                    name: 'Бездротові навушники Samsung Galaxy Buds Pro',
                    price: 1399.00,
                    description: 'Бездротові навушники Samsung Galaxy Buds Pro з відмінним звуком та шумозаглушенням.',
                    image: 'photo/Samsung Galaxy Buds Pro.jpg'
                }
            ]
        },
        {
            id: 3,
            brand: 'Xiaomi',
            model: 'Mi 12',
            price: 18999.00,
            description: 'Новий Xiaomi Mi 12 з високою продуктивністю та гарним співвідношенням ціна-якість.',
            image: 'photo/Xiaomi Mi 12.jpg',
            accessories: [
                {
                    name: 'Навушники для Mi 12',
                    price: 999.00,
                    description: 'Бездротові навушники для Xiaomi Mi 12 з чудовим звуком.',
                    image: 'photo/Навушники для Mi 12.jpg'
                },
                {
                    name: 'Силіконовий чохол для Xiaomi Mi 12',
                    price: 199.00,
                    description: 'Захисний чохол для Xiaomi Mi 12 з міцного силікону.',
                    image: 'photo/Силіконовий чохол для Xiaomi Mi 12.jpg'
                }
            ]
        },
        {
            id: 4,
            brand: 'OnePlus',
            model: 'OnePlus 9',
            price: 24999.00,
            description: 'Флагманський смартфон OnePlus з чудовою камерою та високоякісним екраном для найвимогливіших користувачів.',
            image: 'photo/OnePlus OnePlus 9.jpg',
            accessories: [
                {
                    name: 'Захисне скло для OnePlus 9',
                    price: 299.00,
                    description: 'Міцне захисне скло для OnePlus 9 для захисту екрану від подряпин і ударів.',
                    image: 'photo/Захисне скло для OnePlus 9.jpg'
                },
                {
                    name: 'Фітнес-браслет OnePlus Band',
                    price: 899.00,
                    description: 'Фітнес-браслет OnePlus Band для вимірювання активності та серцевих показників.',
                    image: 'photo/OnePlus Band.jpg'
                }
            ]
        },
        {
            id: 5,
            brand: 'Google',
            model: 'Pixel 6',
            price: 27999.00,
            description: 'Новий Google Pixel 6 з потужним процесором і відмінною камерою для фотографій у будь-яких умовах.',
            image: 'photo/Pixel 6.jpg',
            accessories: [
                {
                    name: 'Чохол для Google Pixel 6',
                    price: 599.00,
                    description: 'Захисний чохол для Google Pixel 6 для збереження естетики та захисту пристрою.',
                    image: 'photo/Чохол для Google Pixel 6.jpg'
                },
                {
                    name: 'Бездротові навушники Google Pixel Buds',
                    price: 1599.00,
                    description: 'Бездротові навушники Google Pixel Buds з активним шумозаглушенням і гарним звуком.',
                    image: 'photo/Google Pixel Buds.jpg'
                }
            ]
        },
        {
            id: 6,
            brand: 'Sony',
            model: 'Xperia 5 III',
            price: 30999.00,
            description: 'Смартфон Sony Xperia 5 III з преміальною камерою і великим дисплеєм для любителів фотографії та відео.',
            image: 'photo/Sony Xperia 5 III.jpg',
            accessories: [
                {
                    name: 'Навушники для Xperia 5 III',
                    price: 1199.00,
                    description: 'Бездротові навушники для Sony Xperia 5 III з високоякісним звуком і комфортною посадкою.',
                    image: 'photo/Навушники для Xperia 5 III.jpg'
                },
                {
                    name: 'Чохол для Sony Xperia 5 III',
                    price: 499.00,
                    description: 'Захисний чохол для Sony Xperia 5 III з міцного матеріалу.',
                    image: 'photo/Чохол для Sony Xperia 5 III.jpg'
                }
            ]
        },
        {
            id: 7,
            brand: 'Huawei',
            model: 'Mate 50 Pro',
            price: 32999.00,
            description: 'Флагманський смартфон Huawei з потужним процесором і високоякісною камерою для найвимогливіших користувачів.',
            image: 'photo/Huawei Mate 50 Pro.jpg',
            accessories: [
                {
                    name: 'Зарядний пристрій SuperCharge для Huawei',
                    price: 899.00,
                    description: 'Оригінальний зарядний пристрій SuperCharge для Huawei з швидкою зарядкою.',
                    image: 'photo/Зарядний пристрій SuperCharge для Huawei.jpg'
                },
                {
                    name: 'Смарт-годинник Huawei Watch GT 3',
                    price: 2199.00,
                    description: 'Смарт-годинник Huawei Watch GT 3 з великим AMOLED екраном і довгим часом автономної роботи.',
                    image: 'photo/Huawei Watch GT 3.jpg'
                }
            ]
        }
    ];

    function createProductHTML(product) {
        const accessoriesHTML = product.accessories.map(accessory => `
            <li>
                <img src="${accessory.image}" alt="${accessory.name}">
                <h4>${accessory.name}</h4>
                <p>${accessory.description}</p>
                <p>Ціна: ${accessory.price} грн</p>
                <button class="add-to-cart" data-product-id="${product.id}" data-product-name="${accessory.name}">Додати до кошика</button>
            </li>
        `).join('');

        const productHTML = `
            <div class="product">
                <img src="${product.image}" alt="${product.model}">
                <div class="product-details">
                    <h3>${product.brand} ${product.model}</h3>
                    <p>${product.description}</p>
                    <p>Ціна: ${product.price} грн</p>
                </div>
                <ul class="accessories-list">
                    ${accessoriesHTML}
                </ul>
            </div>
        `;

        return productHTML;
    }

    function displayProducts() {
        const productContainer = document.querySelector('#product-list');
        
        // Clear existing content to prevent duplicates
        productContainer.innerHTML = '';

        products.forEach(product => {
            const productHTML = createProductHTML(product);
            productContainer.innerHTML += productHTML;
        });

        // Add event listeners after the products have been added to the DOM
        addEventListeners();
    }

    function addEventListeners() {
        const addToCartButtons = document.querySelectorAll('.add-to-cart');
        addToCartButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const productName = this.getAttribute('data-product-name');
                addToCart(productId, productName);
            });
        });
    }

    function addToCart(productId, productName) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_to_cart.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                alert('Продукт успішно додано до кошика.');
            } else {
                console.error('Помилка додавання продукту до кошика.');
            }
        };
        xhr.onerror = function() {
            console.error('Помилка AJAX-запиту.');
        };
        xhr.send(`product_id=${productId}&product_name=${productName}`);
    }

    // Call the function to display products when the DOM is fully loaded
    displayProducts();
});
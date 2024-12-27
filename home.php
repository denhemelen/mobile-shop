<?php
// Підключення до бази даних
$host = 'localhost'; // Зазначте хост вашої бази даних
$dbname = 'mobile_store'; // Назва вашої бази даних
$user = 'root'; // Ваше ім'я користувача бази даних
$pass = '1234'; // Ваш пароль до бази даних

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Помилка підключення до бази даних: ' . $e->getMessage());
}

// Отримання трьох випадкових продуктів з бази даних
try {
    $stmt = $pdo->prepare("SELECT * FROM products ORDER BY RAND() LIMIT 3");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Помилка запиту: ' . $e->getMessage());
}

// Функція для створення HTML-коду продукту
function createProductHTML($product) {
    $accessoriesHTML = '';
    if (!empty($product['accessories'])) {
        foreach (json_decode($product['accessories'], true) as $accessory) {
            $accessoriesHTML .= "
                <li>
                    <img src=\"{$accessory['image']}\" alt=\"{$accessory['name']}\">
                    <h4>{$accessory['name']}</h4>
                    <p>{$accessory['description']}</p>
                    <p>Ціна: {$accessory['price']} грн</p>
                </li>";
        }
    }

    $productHTML = "
        <div class=\"product\">
            <img src=\"{$product['image']}\" alt=\"{$product['model']}\">
            <div class=\"product-details\">
                <h3>{$product['brand']} {$product['model']}</h3>
                <p>{$product['description']}</p>
                <p>Ціна: {$product['price']} грн</p>
            </div>
            <ul class=\"accessories-list\">
                {$accessoriesHTML}
            </ul>
        </div>";

    return $productHTML;
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазин стільникових телефонів</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Магазин стільникових телефонів</h1>
            <nav>
                <ul>
                    <li><a href="home.php">Головна</a></li>
                    <li><a href="product.php">Товари</a></li>
                    <li><a href="cart.php">Кошик</a></li>
                    <li><a href="contact.php">Контакти</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <main>
        <section id="home">
            <h2>Ласкаво просимо до нашого магазину!</h2>
            <p>Ми пропонуємо широкий вибір стільникових телефонів за найкращими цінами.</p>
        </section>
        
        <section id="recommendations">
            <h2>Рекомендації</h2>
            <div id="product-list" class="product-list">
                <?php
                // Виведення трьох випадкових продуктів на сторінку
                foreach ($products as $product) {
                    echo createProductHTML($product);
                }
                ?>
            </div>
        </section>
    </main>
    
    <footer>
        <p>&copy; 2024 Магазин стільникових телефонів. Всі права захищені.</p>
    </footer>
</body>
</html>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазин мобільних телефонів</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Магазин мобільних телефонів</h1>
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
        <h2>Наші продукти</h2>
        <div id="product-list" class="product-list">
            <?php
            // Параметри підключення до бази даних
            $servername = "localhost";
            $username = "root";
            $password = "1234";
            $dbname = "mobile_store";

            // Створюємо підключення до бази даних
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Перевірка підключення
            if ($conn->connect_error) {
                die("Помилка підключення: " . $conn->connect_error);
            }

            // SQL-запит для отримання продуктів з бази даних
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            // Перевірка результату запиту
            if ($result->num_rows > 0) {
                // Виведення даних кожного продукту
                while($row = $result->fetch_assoc()) {
                    echo "<div class='product'>";
                    echo "<img src='" . $row["image"] . "' alt='" . $row["model"] . "'>";
                    echo "<div class='product-details'>";
                    echo "<h3>" . $row["brand"] . " " . $row["model"] . "</h3>";
                    echo "<p>" . $row["description"] . "</p>";
                    echo "<p>Ціна: " . $row["price"] . " грн</p>";
                    echo "<button class='add-to-cart' data-product-id='" . $row["id"] . "' data-product-name='" . $row["model"] . "'>Додати до кошика</button>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "Немає доступних продуктів.";
            }

            // Закриваємо з'єднання
            $conn->close();
            ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Магазин мобільних телефонів. Всі права захищені.</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>

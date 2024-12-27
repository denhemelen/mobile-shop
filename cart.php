<?php
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

// Видалення продукту з кошика
if (isset($_POST['remove'])) {
    $cart_id = $_POST['cart_id'];
    $sql = "DELETE FROM cart WHERE id='$cart_id'";
    $conn->query($sql);
}

// Обробка замовлення
if (isset($_POST['checkout'])) {
    // Логіка оформлення замовлення може бути додана тут
    // Наприклад, збереження замовлення в окремій таблиці, очищення кошика тощо.
    echo "<script>alert('Замовлення оформлено успішно!');</script>";
    $conn->query("TRUNCATE TABLE cart"); // Очищення кошика після оформлення замовлення
}

// Отримуємо дані з таблиці cart
$sql = "SELECT cart.id as cart_id, products.brand, products.model, products.price FROM cart INNER JOIN products ON cart.product_id = products.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Кошик</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .cart-container {
            width: 80%;
            margin: 0 auto;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #ccc;
        }
        .cart-item img {
            width: 100px;
            height: auto;
        }
        .cart-details {
            flex-grow: 1;
            padding-left: 20px;
        }
        .cart-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }
        .remove-btn, .checkout-btn {
            background-color: #ff4c4c;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 10px;
        }
        .checkout-btn {
            background-color: #4caf50;
        }
        .checkout-btn:hover,
        .remove-btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Ваш Кошик</h1>
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

    <div class="cart-container">
        <h2>Ваші товари</h2>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="cart-item">
                    <div class="cart-details">
                        <h3><?php echo $row['brand'] . ' ' . $row['model']; ?></h3>
                        <p>Ціна: <?php echo $row['price']; ?> грн</p>
                    </div>
                    <div class="cart-actions">
                        <form method="post">
                            <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                            <button type="submit" name="remove" class="remove-btn">Видалити</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
            <form method="post">
                <button type="submit" name="checkout" class="checkout-btn">Оформити замовлення</button>
            </form>
        <?php else: ?>
            <p>Ваш кошик порожній.</p>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2024 Магазин мобільних телефонів. Всі права захищені.</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>

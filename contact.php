<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакти</title>
    <link rel="stylesheet" href="/bred/styles.css">
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
    <h2>Зв'яжіться з нами</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

        // Отримуємо дані з POST-запиту
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        // Захист від SQL-ін'єкцій
        $name = $conn->real_escape_string($name);
        $email = $conn->real_escape_string($email);
        $message = $conn->real_escape_string($message);

        // SQL-запит для вставки даних в таблицю feedback
        $sql = "INSERT INTO feedback (name, email, message) VALUES ('$name', '$email', '$message')";

        if ($conn->query($sql) === TRUE) {
            echo "<p class='success-message'>Ваше повідомлення було відправлено. Дякуємо за зворотний зв'язок!</p>";
        } else {
            echo "<p class='error-message'>Помилка: " . $sql . "<br>" . $conn->error . "</p>";
        }

        $conn->close();
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="name">Ім'я:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Повідомлення:</label>
        <textarea id="message" name="message" required></textarea>

        <button type="submit">Відправити</button>
    </form>
</main>

<footer>
    <p>&copy; 2024 Магазин мобільних телефонів. Всі права захищені.</p>
</footer>

</body>
</html>

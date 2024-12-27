<?php
// Перевіряємо, чи було надіслано POST-запит
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname = "mobile_store";

    // Підключення до бази даних
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Перевірка підключення
    if ($conn->connect_error) {
        die(json_encode(["status" => "error", "message" => "Помилка підключення: " . $conn->connect_error]));
    }

    // Отримуємо дані з POST-запиту та виконуємо валідацію
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $product_name = isset($_POST['product_name']) ? trim($_POST['product_name']) : '';

    // Перевірка, чи дані валідні
    if ($product_id <= 0 || empty($product_name)) {
        echo json_encode(["status" => "error", "message" => "Некоректні дані."]);
        $conn->close();
        exit;
    }

    // Підготовлений SQL-запит для вставки даних у таблицю `cart`
    $stmt = $conn->prepare("INSERT INTO cart (product_id, product_name) VALUES (?, ?)");
    $stmt->bind_param("is", $product_id, $product_name);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Продукт успішно додано до кошика."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Помилка: " . $stmt->error]);
    }

    // Закриваємо підготовлений запит і з'єднання
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Неправильний метод запиту."]);
}
?>

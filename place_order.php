<?php
session_start();
require_once 'config.php'; // Підключення до бази даних

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    if (empty($name) || empty($email) || empty($phone) || empty($address)) {
        die('Будь ласка, заповніть усі поля.');
    }

    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        die('Ваш кошик порожній.');
    }

    $orderItems = $_SESSION['cart'];
    $orderTotal = 0;

    foreach ($orderItems as $item) {
        $orderTotal += $item['price'] * $item['quantity'];
    }

    $stmt = $pdo->prepare('INSERT INTO orders (name, email, phone, address, total) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$name, $email, $phone, $address, $orderTotal]);
    $orderId = $pdo->lastInsertId();

    foreach ($orderItems as $item) {
        $stmt = $pdo->prepare('INSERT INTO order_items (order_id, product_id, name, price, quantity) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$orderId, $item['id'], $item['name'], $item['price'], $item['quantity']]);
    }

    // Очистити кошик після оформлення замовлення
    unset($_SESSION['cart']);

    // Відправити підтвердження на електронну пошту (необов'язково)
    $subject = 'Підтвердження замовлення';
    $message = "Дякуємо за ваше замовлення!\n\nНомер замовлення: $orderId\nСума: $orderTotal грн\n\nВаше замовлення буде оброблено найближчим часом.";
    mail($email, $subject, $message);

    echo 'Ваше замовлення успішно оформлено!';
}
?>

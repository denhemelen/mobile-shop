<?php
session_start();

if (isset($_POST['product_id'])) {
    $productId = intval($_POST['product_id']);

    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
        echo 'Товар видалено з кошика.';
    } else {
        echo 'Товар не знайдено в кошику.';
    }
} else {
    echo 'Помилка: недостатньо даних.';
}
?>

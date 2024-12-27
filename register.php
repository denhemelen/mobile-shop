<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Реєстрація</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        .container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }
        h1 {
            margin-bottom: 20px;
            color: #007bff;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            margin-top: 15px;
        }
        .message.error {
            color: #dc3545;
        }
        .message.success {
            color: #28a745;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Реєстрація</h1>
        <?php
        require_once('config.php');

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nickname'], $_POST['email'], $_POST['password'])) {
            $nickname = $_POST['nickname'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (empty($nickname) || empty($email) || empty($password)) {
                echo '<p class="message error">Будь ласка, заповніть всі обов\'язкові поля.</p>';
            } else {
                // Перевірка, чи вже існує користувач з таким email
                $sql = "SELECT * FROM users WHERE email = :email";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['email' => $email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    echo '<p class="message error">Цей email вже зареєстрований.</p>';
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                    $sql = "INSERT INTO users (nickname, email, password) VALUES (:nickname, :email, :password)";
                    $stmt = $pdo->prepare($sql);
                    try {
                        $stmt->execute([
                            'nickname' => $nickname,
                            'email' => $email,
                            'password' => $hashedPassword
                        ]);
                        echo '<p class="message success">Ви успішно зареєстровані!</p>';
                        header("Location: login.php"); // Перенаправлення до login.php
                        exit();
                    } catch (PDOException $e) {
                        echo '<p class="message error">Помилка вставки даних: ' . $e->getMessage() . '</p>';
                    }
                }
            }
        }
        ?>
        <form method="post" action="">
            <label for="nickname">Nickname:</label>
            <input type="text" id="nickname" name="nickname" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Зареєструватися</button>
        </form>
        <p>Вже маєте акаунт? <a href="login.php">Увійти</a></p>
    </div>
</body>
</html>

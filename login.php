<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .main-container {
            display: flex;
            width: 80%;
            max-width: 900px;
            border: 1px solid #ddd;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background-color: #fff;
        }

        .left-section {
            width: 50%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right-section {
            width: 50%;
            background: linear-gradient(135deg, #3a7bd5, #3a6073);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .right-section img {
            max-width: 70%;
            height: auto;
            margin-bottom: 20px;
        }

        .right-section h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .right-section p {
            font-size: 16px;
            line-height: 1.5;
        }

        h2 {
            margin: 0 0 20px;
            font-size: 28px;
            color: #2c3e50;
        }

        input[type="email"],
        input[type="password"],
        button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
        }

        input[type="email"],
        input[type="password"] {
            background-color: #f9f9f9;
            color: #333;
        }

        input::placeholder {
            color: #888;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }

        button:hover {
            background-color: #0056b3;
            transition: background-color 0.3s ease-in-out;
        }

        p {
            text-align: center;
            margin-top: 15px;
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="left-section">
            <h2>Login</h2>
            <form method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
                <!-- New Redirect Button -->
                <button type="button" onclick="window.location.href='landing.php'">Go to Landing Page</button>
            </form>
            <p>Don't have an account? <a href="signup.php">Signup here</a></p>
        </div>
        <div class="right-section">
            <img src="login.png" alt="Project Progress Illustration">
        </div>
    </div>

    <?php
    // Include the database connection
    $host = '127.0.0.1:3307';
    $username = 'root';
    $password = '';
    $database = 'faculty';

    $con = mysqli_connect($host, $username, $password, $database);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $con->real_escape_string($_POST['email']);
        $password = $_POST['password'];

        $query = "SELECT * FROM signup WHERE email='$email'";
        $result = $con->query($query);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                header("Location: index.php");
                exit();
            } else {
                echo '<div class="alert alert-danger">Invalid password!</div>';
            }
        } else {
            echo '<div class="alert alert-danger">No account found with this email. <a href="signup.php">Signup here</a></div>';
        }
    }
    ?>
</body>
</html>

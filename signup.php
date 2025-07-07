<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9; /* Simple light background */
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
            background-color: #ffffff;
        }

        .left-section {
            width: 50%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #ffffff;
        }

        .right-section {
            width: 50%;
            background-color: #007BFF; /* Simple solid background for the right section */
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .right-section img {
            max-width: 80%;
            height: auto;
            margin-bottom: 20px;
        }

        h2 {
            margin: 0 0 20px;
            font-size: 28px;
            color: #2c3e50;
            text-align: center;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            transition: all 0.3s ease-in-out;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            background-color: #fdfdfd;
            color: #333;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #007BFF;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.5); /* Soft glow around input */
            transform: translateY(-3px); /* Moves the input slightly upwards */
        }

        input::placeholder {
            color: #aaa;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s ease-in-out, transform 0.2s ease-in-out;
        }

        button:hover {
            background-color: #0056b3;
            transform: translateY(-3px); /* Moves the button slightly upwards */
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

        .message {
            margin-top: 20px;
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="left-section">
            <h2>Signup</h2>
            <form method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Signup</button>
            </form>
            <p>Already have an account? <a href="login.php">Login here</a></p>

            <?php
            // Database connection
            $host = 'localhost';
            $username = 'root';
            $password = '';
            $database = 'faculty';

            $con = mysqli_connect($host, $username, $password, $database);

            // Handle POST request
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = $con->real_escape_string($_POST['username']);
                $email = $con->real_escape_string($_POST['email']);
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

                // Check if email already exists
                $checkQuery = "SELECT * FROM signup WHERE email='$email'";
                $result = $con->query($checkQuery);

                if ($result->num_rows > 0) {
                    echo "<div class='message'>Email already registered. <a href='login.php'>Login here</a></div>";
                } else {
                    $sql = "INSERT INTO signup (username, email, password, dt) VALUES ('$username', '$email', '$password', current_timestamp())";
                    if ($con->query($sql)) {
                        echo "<div class='message'>Signup successful. <a href='login.php'>Login here</a></div>";
                    } else {
                        echo "<div class='message'>Error: " . $con->error . "</div>";
                    }
                }
            }
            ?>
        </div>
        <div class="right-section">
            <img src="signup.png" alt="Signup Illustration">
        </div>
    </div>
</body>
</html>

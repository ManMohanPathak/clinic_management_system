<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-image: url('https://avatars.mds.yandex.net/i?id=0a6ba0eefae53ce3f617f89ed7362e05f8fae9d5-5261734-images-thumbs&n=13'); /* Replace with your image path */
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
        }

        header {
            width: 100%;
            padding: 10px 0;
            background-color: rgba(0, 123, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
        }

        header img {
            margin-right: 10px;
            border-radius: 50%;
        }

        h1 {
            margin: 0;
            font-size: 24px;
            text-align: center;
        }

        .container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding-top: 80px; /* Height of the header */
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            padding: 20px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-top: -50px; /* Offset to pull it upwards */
        }

        .login-container h1 {
            margin-bottom: 20px;
            font-size: 20px;
            color: #333;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .login-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <header>
        <img src="logo2.jpg" alt="Company Logo" width="40" height="40">
        <h1>Welcome to the Login Page</h1>
    </header>
    <div class="container">
        <div class="login-container">
            <h1>Login</h1>
            <form method="POST" action="login.php">
    <label for="email">Email</label>
    <input type="text" id="email" name="email" placeholder="Enter your Email" required>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Enter your Password" required>
    <button type="submit">Login</button>
</form>

        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            box-sizing: border-box;
        }

      /*add image backgroundا*/
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-image: url('assets/images/slide_02.jpg'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
        }

        .form-container {
            width: 400px;
            background: rgba(255, 255, 255, 0.8); /* */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #03a9f4;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #007bb5;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 10px;
            padding: 5px;
            border: 1px solid red;
            background-color: #ffcccc;
            border-radius: 5px;
            width: 100%;
            text-align: center;
        }

        .nav a {
            text-decoration: none;
            color: #007bb5;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="form-container">
        
        <?php 
        session_start();
        if (isset($_SESSION['errors'])) {
            // echo '<div class="error-box">';
            foreach ($_SESSION['errors'] as $err) {
               echo "<div class='error'>$err</div>";
            }
            echo '</div>';
            unset($_SESSION['errors']); 
        }
        ?>

        <form action="handel/login.php" method="post">
            <h3>Login </h3>
            <input placeholder="Enter Email" class="input" type="email" name="email" required>
            <input class="input" placeholder="Enter Password" type="password" name="password" required>
            <button type="submit" name="submit">Login</button>
        </form>

        <div class="nav">
            <p> <a href="register.php">Register</a></p>
        </div>
    </div>

</body>

</html>

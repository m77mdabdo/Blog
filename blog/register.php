<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-image: url('assets/images/pexels-photo-1370295.jpeg'); /* ضع هنا مسار الصورة */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
        }

        .form-container {
            width: 400px;
            background: rgba(255, 255, 255, 0.8); /* شفافية لجعل النموذج واضحًا */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .nav .links a:hover, button:hover {
            background-color: #8000ff;
        }
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            padding: 20px;
            background-color: #607d8b4a;
        }
        .form {
            width: 430px;
            height: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.423);
            backdrop-filter: blur(30px);
            padding: 30px;
            border-radius: 30px;
        }
        .input {
            outline: none;
            border: 1px solid #ccc;
            width: 300px;
            height: 45px;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
        }
        form button {
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            color: white;
            background-color: #03a9f47a;
            transition: all 0.5s;
            cursor: pointer;
        }
        form button:hover {
            background-color: #8000ff;
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
    </style>
</head>

<body>
   

    <div>
        <form class="form" action="handel/register.php" method="post">
            <h3>Register Here</h3>

            <?php
            if (isset($_SESSION['errors'])) {
                foreach ($_SESSION['errors'] as $err) {
                    echo "<div class='error'>$err</div>";
                }
                unset($_SESSION['errors']);
            }
            ?>

            <input placeholder="Enter Name" class="input" type="text" name="name">
            <input placeholder="Enter Email" class="input" type="email" name="email">
            <input class="input" placeholder="Enter Password" type="password" name="password">
            <input class="input" placeholder="Enter your phone" type="number" name="phone">
            <button type="submit" name="submit">Register</button>

            <div class="nav">
        <div class="links">
            <a href="login.php">Log in</a>
           
        </div>
    </div>
        </form>
    </div>
   
    </div>
</body>

</html>

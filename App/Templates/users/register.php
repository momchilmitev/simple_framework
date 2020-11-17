<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Framework</title>
</head>
<body>
    <h1>Register page</h1>

    <form method="post">
        <label>
            Username: <input type="text" name="username"/>
        </label>
        <br>
        <label>
            Password: <input type="password" name="password"/>
        </label>
        <br>
        <label>
            Confirm Password: <input type="password" name="confirm_password"/>
        </label>
        <br>
        <label>
            First Name: <input type="text" name="first_name"/>
        </label>
        <br>
        <label>
            Last Name: <input type="text" name="last_name"/>
        </label>
        <br>
        <label>
            Born On: <input type="date" name="born_on"/>
        </label>
        <br>
        <input type="submit" name="register" value="Register"/>
    </form>

    <br>
    <h3>If you recall your credentials just <a href="login.php">log in :)</a></h3>
</body>
</html>

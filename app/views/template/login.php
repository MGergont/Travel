<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Ta</title>
</head>
<body>
    <h1>Login</h1>

    <form method="post" action="/login-now">
        <input type="hidden" name="type" value="login">
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="pwd" placeholder="Password">
        <button type="submit" name="submit">Login</button>
    </form>
</body>
</html>
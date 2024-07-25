<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Task</title>
</head>
<body>
    <h1>Login</h1>

    <?php FeedbackMess('login') ?>

    <form method="post" action="/">
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="pwd" placeholder="Password" required>
        <button type="submit" name="submit">Login</button>
    </form>
</body>
</html>
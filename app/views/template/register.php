<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Task</title>
</head>
<body>
    <h1>Register</h1>

    <?php FeedbackMess('register') ?>


    <form method="post" action="/register">
        <input type="text" name="usersName" placeholder="Full name..."required><br>
        <br>
        <input type="text" name="usersEmail" placeholder="Email..."required><br>
        <br>
        <input type="number" name="phone" placeholder="Numer tel..."required><br>
        <br>
        <input type="password" name="usersPwd" placeholder="Password..."required><br>
        <br>
        <input type="password" name="pwdRepeat" placeholder="Repeat password" required><br>
        <br>
        <button type="submit" name="submit">Register</button>
    </form>
</body>
</html>
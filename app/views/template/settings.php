<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Task</title>
</head>
<body>
    <h1>Settings</h1>

    <h3>Profil</h3><br>
    <label>Login</label>
    <input type="text" name="email" placeholder="<?php echo $params['user']['email'] ?>">
    <br>
    <br>
    <h3>User info</h3>
    <?php FeedbackMess('userSet') ?>
    <form method="post" action="/settings">
        <label>First name</label>
        <input type="text" name="firstName" value="<?php echo $params['user']['user_name'] ?>" required>
        <label>Last name</label>
        <input type="text" name="lastName" value="<?php echo $params['user']['user_last_name'] ?>" required>
        <label>Phone number</label>
        <input type="text" name="phone" value="<?php echo $params['user']['phone_number'] ?>" required>

        <button type="submit" name="submit">Change</button>
    </form>

    <h3>Change Password</h3>
    <?php FeedbackMess('passCh') ?>
    <form method="post" action="/pass-change">
        <label>Last Password</label>
        <input type="password" name="passLast" required>
        <label>New Password</label>
        <input type="password" name="passNew" required>
        <label>Repeat Password</label>
        <input type="password" name="passRepe" required>

        <button type="submit" name="submit">Change</button>
    </form>
    
</body>
</html>
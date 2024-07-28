<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Task</title>
</head>
<body>
    <h1>Route</h1>

    <p>Select route</p>
    <form method="post" action="/route">
        <input type="text" name="StartRoute" placeholder="Start location" required>
        <input type="text" name="StopRoute" placeholder="Stop location" required>
        <button type="submit" name="submit">Start</button>
    </form>

    <p>Castom route</p>
    <form method="post" action="/route-">
        <input type="text" name="StartRoute" placeholder="Start location" required>
        <input type="number" name="Distance" placeholder="distance" required>
        <input type="text" name="StopRoute" placeholder="Stop location" required>
        <button type="submit" name="submit">Start</button>
    </form>

    <p>Add cost</p>
    <form method="post" action="">
        <input type="text" name="StartRoute" placeholder="Start location" required>
        <input type="text" name="StopRoute" placeholder="Stop location" required>
        <button type="submit" name="submit">Start</button>
    </form>
</body>
</html>
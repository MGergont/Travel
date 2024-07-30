<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Task</title>
</head>
<body>
    <h1>Route</h1>
        <?php
            switch ($_SESSION['statusDel']) {
                case 'start':
                    ?>
                    <form method="post" action="/route-castom-start">
                        <input type="text" name="StartRoute" placeholder="Start location" required>
                        <input type="number" name="Distance" placeholder="distance" required>
                        <input type="text" name="StopRoute" placeholder="Stop location" required>
                        <button type="submit" name="submit">Start</button>
                    </form>
                    <?php
                    break;
                case 'next':
                    ?>
                    <form method="post" action="/route-castom-next">
                        <input type="text" name="StartRoute" placeholder="Next location">
                        <input type="number" name="NextDistance" placeholder="Next Distance">
                        <input type="text" name="StopRoute" placeholder="Stop location">
                        <button type="submit" name="submit">Start</button><br>
                        <a href="/route-castom-end">Stop</a>
                    </form>
                    <?php
                    break;
                case 'runtime':
                    ?>
                    <p>Trasa trwa...</p>
                    <a href="/route-castom-stop"><button  name="submit">Stop</button></a>
                    <?php
                    break;
                default:
                    ?>
                    <p>Witaj! Twoja rola jest nieznana.</p>
                    <?php
                    break;
            }
        ?>

<!-- to ma się pokazać gdzy w sesji pojawi się id travel -->
    <p>Add cost</p>
    <form method="post" action="">
        <input type="text" name="StartRoute" placeholder="Start location" required>
        <input type="text" name="StopRoute" placeholder="Stop location" required>
        <button type="submit" name="submit">Start</button>
    </form>
</body>
</html>
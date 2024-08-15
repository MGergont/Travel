<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Task</title>
</head>
<body>
    <a href="/home">< Back</a><br>

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

    <?php FeedbackMess('route') ?>    
    <p>Start a route to add costs</p>
    <?php if($_SESSION['statusDel'] != 'start'): ?>
    <p>Add cost</p>
    <form method="post" action="/route-cost">
        <input type="number" name="amount" placeholder="Koszt" required>
        <input type="text" name="descript" placeholder="Opis" required>
        <button type="submit" name="submit">Start</button>
    </form>
    <?php endif; ?>
</body>
</html>
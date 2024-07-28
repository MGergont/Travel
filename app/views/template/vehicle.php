<?php

function addOneYear($date) {
    // Tworzymy obiekt DateTime z podanej daty
    $dateTime = new DateTime($date);
    
    // Dodajemy jeden rok
    $dateTime->modify('+1 year');
    
    // Zwracamy zmodyfikowaną datę jako string w tym samym formacie
    return $dateTime->format('Y-m-d H:i:s');
}


?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Task</title>
    <script>
        function addVehicle() {
            document.getElementById('editForm1').style.display = 'block';
        }

        function editVehicle(id, make, model, year, engine_car, course, path_photo) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_Mark').value = make;
            document.getElementById('edit_Model').value = model;
            document.getElementById('edit_Year').value = year;
            document.getElementById('edit_Engine').value = engine_car;
            document.getElementById('edit_Course').value = course;
            document.getElementById('edit_Picture').value = path_photo;
            document.getElementById('editForm').style.display = 'block';
        }
    </script>
</head>
<body>
    <h1>Vehicle panel</h1>

    <?php FeedbackMess('vehicle') ?>

    <button onclick="addVehicle()">Add</button>

    <div id="editForm1" style="display:none;">
        <h2>Dodaj pojazd</h2>
        <form action="/vehicle" method="post">
            <label for="Mark">Mark:</label>
            <input type="text" id="Mark" name="mark">
            <br>
            <label for="Model">Model:</label>
            <input type="text" id="Model" name="model">
            <br>
            <label for="Year">Year:</label>
            <input type="datetime-local" id="Year" name="year">
            <br>
            <label for="Engine">Engine:</label>
            <input type="text" id="Engine" name="engine">
            <br>
            <label for="Course">Course:</label>
            <input type="text" id="Course" name="course">
            <br>
            <label for="Picture">Picture:</label>
            <input type="text" id="Picture" name="picture">
            <br>
            <button type="submit">Add</button>
        </form>
    </div>

    <div>
        <?php if(!empty($params['vehicle'])) : ?>
        <?php foreach ($params['vehicle'] as $vehicle): ?>
        <div>
            <p><?php echo $vehicle['make']; ?></p>
            <p><?php echo $vehicle['model']; ?></p>
            <p><?php echo $vehicle['year']; ?></p>
            <p><?php echo $vehicle['engine_car']; ?></p>
            <p><?php echo $vehicle['course']; ?></p>
            <p><?php echo $vehicle['path_photo']; ?></p>
            <p>Last Service: <?php echo $vehicle['last_service']; ?></p>
            <p>Next Service: <?php echo addOneYear($vehicle['last_service']); ?></p>
            <p>
                <form action="/vehicle-del" method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $vehicle['id_vehicle']; ?>">
                    <button type="submit">Delete</button>
                </form>
                <button onclick="editVehicle(
                '<?php echo $vehicle['id_vehicle'];?>',
                '<?php echo $vehicle['make'];?>',
                '<?php echo $vehicle['model'];?>',
                '<?php echo $vehicle['year'];?>',
                '<?php echo $vehicle['engine_car'];?>',
                '<?php echo $vehicle['course'];?>',
                '<?php echo $vehicle['path_photo'];?>'
                )">Edit</button>
                <form action="/vehicle-serv" method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $vehicle['id_vehicle']; ?>">
                    <button type="submit">Service</button>
                </form>
            </p>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    <div>

    <div id="editForm" style="display:none;">
        <h2>Edytuj notatke</h2>
        <form action="/vehicle-edit" method="post">
            <input type="hidden" id="edit_id" name="id">
            <label for="edit_Mark">Mark:</label>
            <input type="text" id="edit_Mark" name="mark">
            <br>
            <label for="edit_Model">Model:</label>
            <input type="text" id="edit_Model" name="model">
            <br>
            <label for="edit_Year">Year:</label>
            <input type="datetime-local" id="edit_Year" name="year">
            <br>
            <label for="edit_Engine">Engine:</label>
            <input type="text" id="edit_Engine" name="engine">
            <br>
            <label for="edit_Course">Course:</label>
            <input type="text" id="edit_Course" name="course">
            <br>
            <label for="edit_Picture">Picture:</label>
            <input type="text" id="edit_Picture" name="picture">
            <br>
            <button type="submit">Save Changes</button>
        </form>
    </div>

    <?php FeedbackMess('vehiclecost') ?>

    <p>Add cost</p>
    <form method="post" action="/vehicle-costs">
        <input type="number" name="amount" placeholder="Koszt" required>
        <input type="text" name="description" placeholder="Opis" required>
        <select name="idcostVehicle" id="costVehicle">
        <?php foreach ($params['vehicle'] as $veh): ?>
            <option value="<?php echo $veh['id_vehicle']; ?>">
                <?php echo $veh['make']. " " . $veh['model']; ?>
            </option>   
        <?php endforeach; ?>
        </select>
        <button type="submit" name="submit">Start</button>
    </form>
</body>
</html>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Task</title>
    <script>
        function editNote(id, title, content) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_title').value = title;
            document.getElementById('edit_content').value = content;
            document.getElementById('editForm').style.display = 'block';
        }
    </script>
</head>
<body>
    <h1>Note</h1>

    <?php FeedbackMess('note') ?>

    <form method="post" action="/notes">
        <input type="text" name="Title" placeholder="Title" required>
        <input type="text" name="Content" placeholder="Content" required>
        <button type="submit" name="submit">Start</button>
    </form>
        <br>


    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Action</th>
        </tr>
        <?php if(!empty($params['note'])) : ?>
        <?php foreach ($params['note'] as $apart): ?>
        <tr>
            <td><?php echo $apart['id']; ?></td>
            <td><?php echo $apart['title']; ?></td>
            <td><?php echo $apart['content']; ?></td>
            <td><?php echo $apart['created_at']; ?></td>
            <td><?php echo $apart['updated_at']; ?></td>
            <td>
                <form action="/notes-del" method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $apart['id']; ?>">
                    <button type="submit">Delete</button>
                </form>
                <button onclick="editNote(
                '<?php echo $apart['id'];?>',
                '<?php echo $apart['title'];?>',
                '<?php echo $apart['content'];?>'
                )">Edit</button>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>

    <div id="editForm" style="display:none;">
        <h2>Edytuj notatke</h2>
        <form action="/notes-edit" method="post">
            <input type="hidden" id="edit_id" name="id">
            <label for="edit_title">Title:</label>
            <input type="text" id="edit_title" name="title">
            <br>
            <label for="edit_ontent">Content:</label>
            <input type="text" id="edit_content" name="content">
            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>
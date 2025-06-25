<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Submission</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Form Submission</h2>
<form action="insert.php" method="POST">
    <input type="text" name="name" placeholder="Name" required><br>
    <input type="text" name="mobile" placeholder="Mobile" required><br>
    <input type="email" name="email" placeholder="Email" required><br>

    Gender:<br>
    <label><input type="radio" name="gender" value="Male" required> Male</label>
    <label><input type="radio" name="gender" value="Female"> Female</label><br>

    Proof:<br>
    <select name="proof" required>
        <option value="Aadhaar">Aadhaar</option>
        <option value="Driving License">Driving License</option>
    </select><br>

    Skills:<br>
    <label><input type="checkbox" name="skills[]" value="HTML"> HTML</label>
    <label><input type="checkbox" name="skills[]" value="CSS"> CSS</label>
    <label><input type="checkbox" name="skills[]" value="JavaScript"> JavaScript</label><br>

    <button type="submit">Submit</button>
</form>

<hr>

<h3>Submitted Data</h3>
<table border="1">
    <tr>
        <th>ID</th><th>Name</th><th>Mobile</th><th>Email</th><th>Gender</th><th>Proof</th><th>Skills</th><th>Actions</th>
    </tr>

    <?php
    $result = $conn->query("SELECT * FROM users");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['mobile']}</td>
            <td>{$row['email']}</td>
            <td>{$row['gender']}</td>
            <td>{$row['proof']}</td>
            <td>{$row['skills']}</td>
            <td>
                <a href='update.php?id={$row['id']}'>Edit</a> | 
                <a href='delete.php?id={$row['id']}' onclick=\"return confirm('Are you sure?')\">Delete</a>
            </td>
        </tr>";
    }
    ?>
</table>

</body>
</html>

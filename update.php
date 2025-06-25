<?php
include 'db.php';

$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $proof = $_POST['proof'];
    $skills = isset($_POST['skills']) ? implode(", ", $_POST['skills']) : '';

    $sql = "UPDATE users SET name=?, mobile=?, email=?, gender=?, proof=?, skills=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $name, $mobile, $email, $gender, $proof, $skills, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Update failed: " . $stmt->error;
    }
    $stmt->close();
}

$result = $conn->query("SELECT * FROM users WHERE id=$id");
$row = $result->fetch_assoc();

$selectedSkills = explode(", ", $row['skills']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Edit Submission</h2>

<form method="POST" action="">
    <input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>" required><br>
    <input type="text" name="mobile" value="<?= htmlspecialchars($row['mobile']) ?>" required><br>
    <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" required><br>

    Gender:<br>
    <label><input type="radio" name="gender" value="Male" <?= $row['gender'] == 'Male' ? 'checked' : '' ?>> Male</label>
    <label><input type="radio" name="gender" value="Female" <?= $row['gender'] == 'Female' ? 'checked' : '' ?>> Female</label><br>

    Proof:<br>
    <select name="proof" required>
        <option value="Aadhaar" <?= $row['proof'] == 'Aadhaar' ? 'selected' : '' ?>>Aadhaar</option>
        <option value="Driving License" <?= $row['proof'] == 'Driving License' ? 'selected' : '' ?>>Driving License</option>
    </select><br>

    Skills:<br>
    <label><input type="checkbox" name="skills[]" value="HTML" <?= in_array('HTML', $selectedSkills) ? 'checked' : '' ?>> HTML</label>
    <label><input type="checkbox" name="skills[]" value="CSS" <?= in_array('CSS', $selectedSkills) ? 'checked' : '' ?>> CSS</label>
    <label><input type="checkbox" name="skills[]" value="JavaScript" <?= in_array('JavaScript', $selectedSkills) ? 'checked' : '' ?>> JavaScript</label><br>

    <button type="submit">Update</button>
</form>

</body>
</html>

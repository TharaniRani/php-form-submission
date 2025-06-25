<?php
include 'db.php';

$name = $_POST['name'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$proof = $_POST['proof'];
$skills = isset($_POST['skills']) ? implode(", ", $_POST['skills']) : '';

$sql = "INSERT INTO users (name, mobile, email, gender, proof, skills) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $name, $mobile, $email, $gender, $proof, $skills);

if ($stmt->execute()) {
    header("Location: index.php");
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>

<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "users_crud";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM users WHERE id=$id");
$row = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>

<h2>Edit User</h2>
<form method="post" action="">
    <label>Name:</label>
    <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
    <button type="submit" name="update">Update User</button>
</form>

</body>
</html>

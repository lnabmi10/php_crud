<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "users_crud";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "Record added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Read
$result = $conn->query("SELECT * FROM users");

// Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM users WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>   
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f2f2f2;
      margin: 20px;
      padding: 0;
    }

    table {
      width: 80%;
      margin: 50px auto;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    th, td {
      padding: 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: gray;
      color: white;
    }

    tr:hover {
      background-color: #f5f5f5;
    } </style>

    </style>
    <title>CRUD Application</title>
</head>
<body>

<h2>Add User</h2>
<form method="post" action="">
    <label>Name:</label>
    <input type="text" name="name" required>
    <label>Email:</label>
    <input type="email" name="email" required>
    <button type="submit" name="submit">Add User</button>
</form>

<h2>User List</h2>
<table >
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>
                <a href="?delete=<?php echo $row['id']; ?>">Delete</a>
                <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>

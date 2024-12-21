<?php
require_once('./../../adminconfig/config-database.php');
$conn = openCon();

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET username='$username', password='$password', name='$name', phone='$phone', email='$email', role='$role' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php?page=manageUser");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<form method="POST" action="">
    <label>Username: </label><input type="text" name="username" value="<?= $user['username'] ?>" required><br>
    <label>Password: </label><input type="password" name="password" value="<?= $user['password'] ?>" required><br>
    <label>Name: </label><input type="text" name="name" value="<?= $user['name'] ?>" required><br>
    <label>Phone: </label><input type="text" name="phone" value="<?= $user['phone'] ?>" required><br>
    <label>Email: </label><input type="email" name="email" value="<?= $user['email'] ?>" required><br>
    <label>Role: </label>
    <select name="role">
        <option value="1" <?= $user['role'] == '1' ? 'selected' : '' ?>>Admin</option>
        <option value="2" <?= $user['role'] == '2' ? 'selected' : '' ?>>User</option>
    </select><br>
    <button type="submit">Update User</button>
</form>

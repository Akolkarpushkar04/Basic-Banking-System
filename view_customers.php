<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "banking_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, email, age, balance FROM customers";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>All Customers</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>All Customers</h1>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Balance</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['age']; ?></td>
                <td><?php echo $row['balance']; ?></td>
                <td><a href="view_customer.php?id=<?php echo $row['id']; ?>">View</a></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>

<?php $conn->close(); ?>
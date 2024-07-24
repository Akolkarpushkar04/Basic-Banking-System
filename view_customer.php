<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View All Customers</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>View All Customers</h1>
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

        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<tr><th>ID</th><th>Name</th><th>Email</th><th>Age</th><th>Balance</th></tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['age'] . '</td>';
                echo '<td>$' . $row['balance'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo "No customers found.";
        }

        $conn->close();
        ?>
        <br>
        <a href="index.php">Back to Home</a>
    </div>
</body>

</html>
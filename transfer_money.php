<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "banking_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";
$success_message = "";

$from_id = null;

if (isset($_SESSION['user_id'])) {
    $from_id = $_SESSION['user_id'];
} elseif (isset($_GET['from_customer_id'])) {
    $from_id = $_GET['from_customer_id'];
} elseif (isset($_POST['from_customer_id'])) {
    $from_id = $_POST['from_customer_id'];
} else {
    die("From customer ID is missing.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate form data
    if (isset($_POST['to_id'], $_POST['amount'])) {
        $to_id = $_POST['to_id'];
        $amount = $_POST['amount'];

        if (empty($to_id) || empty($amount)) {
            $error = "Please fill in all fields.";
        } elseif (!is_numeric($amount) || $amount <= 0) {
            $error = "Please enter a valid positive amount.";
        } else {
            
            $conn->begin_transaction();

            $sql1 = "UPDATE customers SET balance = balance - $amount WHERE id = $from_id";
            $sql2 = "UPDATE customers SET balance = balance + $amount WHERE id = $to_id";

            if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
                $conn->commit();
                $success_message = "Transfer successful.";
            } else {
                $conn->rollback();
                $error = "Transfer failed: " . $conn->error;
            }
        }
    } else {
        $error = "Missing value in the form!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Transfer Money</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Transfer Money</h1>
        <?php if (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (!empty($success_message)): ?>
            <div class="success"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="hidden" name="from_customer_id" value="<?php echo htmlspecialchars($from_id); ?>">
            <label for="to_id">Select Customer to Transfer To:</label>
            <select name="to_id" id="to_id" required>
                <?php
                
                $sql = "SELECT id, name FROM customers WHERE id != $from_id";
                $result = $conn->query($sql);

                if ($result === FALSE) {
                    echo "Error: " . $conn->error;
                }

                while ($row = $result->fetch_assoc()) {
                    echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
                ?>
            </select>
            <br><br>
            <label for="amount">Amount:</label>
            <input type="number" name="amount" id="amount" required>
            <br><br>
            <button type="submit">Transfer</button>
        </form>
        <br>
        <a href="index.php">Back to Home</a>
    </div>
</body>

</html>

<?php
$conn->close();
?>
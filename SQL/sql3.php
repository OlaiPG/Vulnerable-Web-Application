<!DOCTYPE html>
<html>
<head>
    <title>SQL Injection Prevention</title>
    <link rel="shortcut icon" href="../Resources/hmbct.png" />
</head>
<body>

<div style="background-color:#c9c9c9;padding:15px;">
    <button type="button" name="homeButton" onclick="location.href='../homepage.html';">Home Page</button>
    <button type="button" name="mainButton" onclick="location.href='sqlmainpage.html';">Main Page</button>
</div>

<div align="center">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <p>Give me book's number and I give you book's name in my library.</p>
        Book's number: <input type="text" name="number">
        <input type="submit" name="submit" value="Submit">
        <!-- <p>//Is this same with the level 2?</p>-->
    </form>
</div>

<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "1ccb8097d0e9ce9f154608be60224c7c";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully";

    if (isset($_POST["submit"])) {
        $number = $_POST['number'];

        // Preparar la consulta
        $stmt = $conn->prepare("SELECT bookname, authorname FROM books WHERE number = ?");
        $stmt->bind_param("i", $number);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<hr>";
                echo htmlspecialchars($row['bookname']) . " ----> " . htmlspecialchars($row['authorname']);
            }
        } else {
            echo "0 results";
        }

        $stmt->close();
    }

    $conn->close();
?>
</body>
</html>


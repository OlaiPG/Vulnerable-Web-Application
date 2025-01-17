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
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" >
        <p>John -> Doe</p>
        First name : <input type="text" name="firstname">
        <input type="submit" name="submit" value="Submit">
    </form>
</div>
<?php 
    // Usar un gestor de secretos para almacenar las credenciales de manera segura
    require 'path/to/secretManager.php'; // Ejemplo de cómo se puede cargar un gestor de secretos

    $servername = getSecret("DB_SERVERNAME");
    $username = getSecret("DB_USERNAME");
    $password = getSecret("DB_PASSWORD");
    $db = getSecret("DB_NAME");

    // Crear conexión
    $conn = mysqli_connect($servername, $username, $password, $db);

    // Verificar la conexión
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } 

    if(isset($_POST["submit"])){
        $firstname = htmlspecialchars($_POST["firstname"]); // Sanitizar la entrada

        // Preparar la consulta
        $stmt = $conn->prepare("SELECT lastname FROM users WHERE firstname = ?");
        $stmt->bind_param("s", $firstname);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Mostrar los datos de cada fila
            while($row = $result->fetch_assoc()) {
                echo htmlspecialchars($row["lastname"]);
                echo "<br>";
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

<html>  
   <head>
      <meta charset="utf-8">
      <link rel="shortcut icon" href="../../Resources/hmbct.png" />
      <title> Level 4 </title>
   </head>

   <body>
      <div style="background-color:#c9c9c9;padding:15px;">
         <button type="button" name="homeButton" onclick="location.href='../../homepage.html';">Home Page</button>
         <button type="button" name="mainButton" onclick="location.href='fileinc.html';">Main Page</button>      
      </div>
      
      <div align="center"><b><h3>This is Level 4</h3></b></div>
      <div align="center">
         <a href="lvl4.php?file=1"><button>Button</button></a>
         <a href="lvl4.php?file=2"><button>The Other Button!</button></a>
      </div>
      
      <?php     
         echo "</br></br>";

         if (isset($_GET['file'])) {
            // Crear un conjunto de archivos permitidos
            $allowed_files = array('1', '2');

            // Obtener la entrada del usuario y validarla
            $file = $_GET['file'];
            if (in_array($file, $allowed_files)) {
               include "$file.php";
               echo "<div align='center'><b><h5>" . htmlspecialchars($file) . ".php</h5></b></div>";
            } else {
               echo "<div align='center'><b><h5>Archivo no permitido</h5></b></div>";
            }
         }
      ?>
   </body>
</html>


<!--
    Fahrtenbuch
    Autor: Fabian Siebels (fabian.siebels@gmail.com)
    Dieses Projekt steht unter der MIT Lizenz!

    Version: 1.2
-->

<?php 
    ini_set('display_errors', 1);

    // Verbindung zur Datenbank 
    // Passwort und Benutzername muss geändert werden!

    // Passwort
    $pw = '';
    // Benutzername
    $bn = '';
    
    $pdo = new PDO('mysql:host=localhost;dbname=fahrtenbuch', $bn, $pw);
    
    // Anzahl der Hin und Rückfahrten
    $sql = "SELECT * FROM fahrtenbuchtbl";
    $statement = $pdo->prepare("SELECT COUNT(*) AS hin FROM fahrtenbuchtbl WHERE hin = ?");
    $statement->execute(array('1'));
    $vhin = $statement->fetch();

    $statement = $pdo->prepare("SELECT COUNT(*) AS zurueck FROM fahrtenbuchtbl WHERE zurueck = ?");
    $statement->execute(array('1'));
    $vz = $statement->fetch();

    $statement = $pdo->prepare("SELECT COUNT(*) AS nicht FROM fahrtenbuchtbl WHERE nicht = ?");
    $statement->execute(array('1'));
    $vnicht = $statement->fetch();

    // Hinfahrt in die DB schreiben
    if(isset($_POST["hin"])) { 
        
        $statement = $pdo->prepare("INSERT INTO fahrtenbuchtbl (gefahren, hin, zurueck, nicht) VALUES ('Hin', '1', '0', '0')");
        $statement->execute(array('Hin', '1', '0', '0'));
        header('Location: '.$_SERVER['REQUEST_URI']);   
                    
    
    }
    // Zurueck in die DB schreiben
    if(isset($_POST["zurueck"])) {
        
        $statement = $pdo->prepare("INSERT INTO fahrtenbuchtbl (gefahren, hin, zurueck, nicht) VALUES ('Zur&uuml;ck', '0', '1', '0')");
        $statement->execute(array('Zur&uuml;ck', '0', '1', '0'));
        header('Location: '.$_SERVER['REQUEST_URI']);
    }
    // Nicht in die DB schreiben
    if(isset($_POST["nicht"])) {
        
        $statement = $pdo->prepare("INSERT INTO fahrtenbuchtbl (gefahren, hin, zurueck, nicht) VALUES ('Nicht', '0', '0', '1')");
        $statement->execute(array('Nicht', '0', '0', '1'));
        header('Location: '.$_SERVER['REQUEST_URI']);
    }
    // Reset
    if(isset($_POST["reset"])){
        
        $sql = "TRUNCATE TABLE fahrtenbuchtbl";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        header('Location: '.$_SERVER['REQUEST_URI']);
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Fabian Siebels">
    <link href="assets/css/mein.css" rel="stylesheet">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/bootstrap-grid.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    <title>Fahrtenbuch</title>
    
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="platz50"></div>
                    <div>
                        <form method="post" action="index.php">
                            <input class="btn btn-success btn-lg btn-block" type="submit" value="Hin" name="hin"><hr>
                            <input class="btn btn-primary btn-lg btn-block" type="submit" value="Zurück" name="zurueck"><hr>
                            <input class="btn btn-danger btn-lg btn-block" type="submit" value="Nicht" name="nicht">
                        </form>
                        
                    </div>
                        <div class="platz50"></div>
                    <div>
                        <div>
                            <!-- Anzeige der Hin/Rück und Nichtfahrten sowie Gesamtpreis -->
                            
                            <?php echo "Hin: ".$vhin['hin']." mal</br>"; ?>
                            <?php echo "Zurück: ".$vz['zurueck']." mal</br>"; ?>
                            <?php echo "Nicht: ".$vnicht['nicht']."</br><hr>"; ?>
                            <?php 
                            
                            $zusam = $vhin['hin'] + $vz['zurueck'];
                            
                            echo "Gesamtpreis: $zusam €";
                            ?>
                            
                        </div>
                        <hr>

                        <!-- Tabelle zum Anzeigen der Fahrten -->
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Gefahren</th>
                                <th scope="col">Datum</th>
                            </tr>
                            
                            </thead>
                            
                            
                            <tbody>
                                <?php foreach ($pdo->query($sql) as $row) : ?>
                                <tr>
                                    <td><?=$row['id']?></td>
                                    <td><?=$row['gefahren']?></td>
                                    <td><?=$row['datum']?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <hr>
                    <div class="platz25"></div>
                        
                        <!-- Modal für den Reset y/n -->
                        
                        <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#reset">Reset</button>

                        <div class="modal fade" id="reset" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" >Reset?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Möchtest du wirklich resetten?</p>
                                        <hr>
                                        <p>Diese Entscheidung kann nicht rückgängig gemacht werden!</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Nein</button>
                                        <form method="post" action="index.php">
                                            <input class="btn btn-danger" type="submit" value="Ja!" name="reset">                   
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="platz50"></div>    
                </div>
            </div>
        </div>
    </div>
    
</body>
<footer>
</footer>
</html>

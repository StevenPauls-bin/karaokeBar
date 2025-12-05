<html>
    <head>
        <title>Group 3 | Karaoke Bar</title>
        <link rel="shortcut icon" href="https://seeklogo.com/images/N/niu-huskies-logo-7821F4963B-seeklogo.com.png"/>
        <link rel="apple-touch-icon" href="https://seeklogo.com/images/N/niu-huskies-logo-7821F4963B-seeklogo.com.png"/>
    </head>
    <body style="background-image:url('brick_wall_texture_192138_2560x1440.png')">
        <style> 
        @import url('https://fonts.googleapis.com/css2?family=Tilt+Neon&display=swap');
            @keyframes pulsate{
                100%{
                    text-shadow:
                    0 0 7px #97c0fc,
                    0 0 10px #97c0fc,
                    0 0 21px #97c0fc,
                    0 0 42px #182ac7,
                    0 0 82px #182ac7,
                    0 0 92px #182ac7,
                    0 0 102px #182ac7,
                    0 0 151px #182ac7; 
                }
                0% {
                text-shadow:
                    0 0 2px #97c0fc,
                    0 0 3px #97c0fc,
                    0 0 7px #97c0fc,
                    0 0 18px #182ac7,
                    0 0 37px #182ac7,
                    0 0 43px #182ac7,
                    0 0 47px #182ac7,
                    0 0 78px #182ac7; 
                }
            }	
            @keyframes pulsate2{
                100% {
                    text-shadow:
                    0 0 7px #F797FC,
                    0 0 10px #F797FC,
                    0 0 21px #F797FC,
                    0 0 42px #C718BF,
                    0 0 82px #C718BF,
                    0 0 92px #C718BF,
                    0 0 102px #C718BF,
                    0 0 151px #C718BF; 
                }
                0%{
                    text-shadow:
                    0 0 2px #F797FC,
                    0 0 3px #F797FC,
                    0 0 7px #F797FC,
                    0 0 18px #C718BF,
                    0 0 37px #C718BF,
                    0 0 43px #C718BF,
                    0 0 47px #C718BF,
                    0 0 78px #C718BF; 
                }
            }	
                        
            h1 { text-align:center;
                font-family: 'Tilt Neon',sans-serif;
                        font-optical-sizing:auto;
                font-weight: 400; 
                        font-size: 60px;
                        font-style: normal;
                        font-variation-settings: 
                            "XROT" 0,
                            "YROT" 0;
                color: #fff;
                        text-shadow: 
                            0 0 7px #bcefff,
                            0 0 10px #bcefff,
                0 0 21px #bcefff,
                            0 0 42px #182ac7,
                            0 0 82px #182ac7,
                0 0 92px #182ac7,
                            0 0 102px #182ac7,
                0 0 151px #182ac7; 
                animation: pulsate 2.5s infinite alternate; animation-fill-mode:forwards;
            }
            input[type=text] {
                padding: 0;
                height: 30px;
                width: 200px;
                position: relative;
                left: 0;
                outline: none;
                border: 1px solid #cdcdcd;
                background-color: #1F3150;
                font-size: 16px;
                color: white;
            }
            input[type="text"]::placeholder {
             text-align: center;
            }		
        </style>
        <h1 style="text-align: center;">
            Sign up to sing
        </h1> 
        <?php
            include('globalVars.php');
            if($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['user'] == NULL || key($_POST) == "tryAgain")){ // song picked confirming sign up
                session_start();
                $styling = "background-color: transparent;
                border: none;
                color: white;
                padding: 16px 32px;
                text-decoration: none;
                font-size: 14px;
                margin: auto;
                cursor: pointer;"; // Would have used CSS for this but adding submit button styling breaks my $_SESSION VARIABLES
                try{
                    if(is_numeric(key($_POST))){
                        $_SESSION['idKey'] = key($_POST);
                    }
                    $dsn = "mysql:host=courses;dbname=".$username;
                    $pdo = new PDO($dsn, $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "SELECT DISTINCT song.title, song.artist, karaokeFile.version 
                                FROM song
                                LEFT JOIN contribution ON contribution.title = song.title
                                INNER JOIN karaokeFile ON karaokeFile.title = song.title
                                WHERE karaokeFile.id = :id;";

                    $query = $pdo->prepare($sql);
                    $query->execute(array(':id' => $_SESSION['idKey']));
                    $row = $query->fetch(PDO::FETCH_ASSOC);
                    echo "<div align=\"center\">";
                    echo "<p style=\"text-align: center; color: #F797FC; font-family: Trebuchet MS; font-size: 18px;\"
                            >Sign up for: ".$row['title']." | by: ".$row['artist']." | version: ";
                    echo $row['version']."</p>";
                    $_SESSION['data'] = $row;
                    if($_POST['user'] == NULL){ // generating form
                        echo "<form action=\"./karaokeBar_finishSignUp.php\" method=\"POST\">";
                        echo "$<input style=\"margin-top: 1px; height:35px; width: 325px; font-family: Trebuchet MS; font-size: 18px; margin-top: 5px;\"";
                        echo "type = \"text\" name=\"bribe\" placeholder = \"Optional: add pay amount (whole $'s)\"/>";
                        echo "<input style=\"margin-top: 1px; height:35px; width: 300px; font-family: Trebuchet MS; font-size: 18px; margin-top: 5px;\"";
                        echo "type = \"text\" name=\"user\" placeholder = \"Enter a Username/Alias* \" required/>";
                        echo "<input style=\"margin-top: 1px; height:35px; width: 300px; font-family: Trebuchet MS; font-size: 18px; margin-top: 5px;\"";
                        echo "type = \"text\" name=\"name\" placeholder = \"Enter your name* \" required/>";
                        echo "<input style=\"height:35px; width:150px;".$styling." font-size: 18px; margin-top: 10px;\"";
                        echo "type=\"submit\" name=\"submit\" value=\"Submit\"/>"; 
                        echo "</form>";
                        echo "<p style=\"text-align: center; color: #F797FC; font-family: Trebuchet MS; font-size: 18px;\"
                                >Note: entering a pay amount will enter you into a priority queue!</p>";
                    }
                    echo "</div>";
                }
                catch(PDOexception $e){
                    echo "Connection to database failed: ".$e->getMessage();
                }
            }
        ?>
        <div style ="font-family: Trebuchet MS; font-size: 18px;" align="center">
            <?php
                if($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['user'] != NULL){ // song picked confirming sign up
                    session_start();
                    $styling = "background-color: transparent;
                        border: none;
                        color: white;
                        length: 30px
                        padding: 16px 32px;
                        text-decoration: none;
                        font-size: 20px;
                        margin: auto;
                        cursor: pointer;"; // Would have used CSS for this but adding submit button styling breaks my $_SESSION VARIABLES
                    try{
                        echo $_POST[3];
                        $dsn = "mysql:host=courses;dbname=".$username;
                        $pdo = new PDO($dsn, $username, $password);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "SELECT username, name FROM user 
                                        WHERE username = :user;";
                        $query = $pdo->prepare($sql);
                        $query->execute(array(':user' => $_POST['user']));
                        $row = $query->fetch(PDO::FETCH_ASSOC);
                        $_SESSION['userDetails'] = $row;
                        if($row['username'] == NULL){ // if new user
                            $sql = "INSERT INTO user 
                                        (username, name)
                                        VALUES
                                        (:user, :name);";
                            $query = $pdo->prepare($sql);
                            $query->execute(array(':user' => $_POST['user'], ':name' => $_POST['name']));
                        }
                        if($row['name'] != $_POST['name'] && $row['username'] != NULL){
                            echo "<p style=\"text-align: center; color: #F797FC; font-family: Trebuchet MS; font-size: 18px;\"
                                    >The username has already been taken, </p>";
                            echo "<form action=\"./karaokeBar_finishSignUp.php\" method=\"POST\">";
                            echo "<input style=\"height:35px; width:150px; font-size: 18px;".$styling." margin-top: 10px;\"";
                            echo "type=\"submit\" name=\"tryAgain\" value=\"try again\"/>"; 
                        } else {
                            $sql = "SELECT username FROM signUp 
                                            WHERE username = :user AND id = :id;";
                            $query = $pdo->prepare($sql);
                            $query->execute(array(':user' => $_POST['user'], ':id' => $_SESSION['idKey']));
                            $row = $query->fetch(PDO::FETCH_ASSOC);
                            if($row['username'] == NULL) { // if user is not in queue for song
                                $qtype = "r";
                                $time = date("H:i:s");
                                if(is_numeric($_POST['bribe'])){ // if an amount was entered that is valid
                                    $qtype = "p";
                                    $sql = "INSERT INTO signUp 
                                                (username, id, qType, time, payment)
                                                VALUES
                                                (:user, :id, :qtype, :time, :amount);";
                                    $query = $pdo->prepare($sql);
                                    $query->execute(array(':user' => $_POST['user'], ':id' => $_SESSION['idKey'], ':qtype' => $qtype, 
                                    ':time' => $time, ':amount' => $_POST['bribe']));
                                    echo "<p style=\"text-align: center; color: #F797FC; font-family: Trebuchet MS; font-size: 18px;\"
                                            >Thank you, you have been entered into the Priority Queue</p>";
                                } else{ // not valid or not entered, put in regular queue
                                    $sql = "INSERT INTO signUp 
                                                (username, id, qType, time)
                                                VALUES
                                                (:user, :id, :qtype, :time);";
                                    $query = $pdo->prepare($sql);
                                    $query->execute(array(':user' => $_POST['user'], ':id' => $_SESSION['idKey'], ':qtype' => $qtype, 
                                    ':time' => $time));
                                    echo "<p style=\"text-align: center; color: #F797FC; font-family: Trebuchet MS; font-size: 18px;\"
                                            >Thank you, you have been entered into the Regular Queue</p>";
                                }
                            } else {
                                echo "<p style=\"text-align: center; color: #F797FC; font-family: Trebuchet MS; font-size: 18px;\"
                                        >You are already in Queue for this song, search for another</p>";
                            }
                        }
                    }
                    catch(PDOexception $e){
                        echo "Connection to database failed: ".$e->getMessage();
                    }
                }
            ?>
        </div>
        <form action="./karaokeBar_home.php" method="POST">
            <div align="center">
                <input type="submit" name="Homepage" value="Go Home"  style = "background-color: transparent;
                            border: none; color: white; padding: 16px 32px; text-decoration: none; margin: auto; cursor: pointer;"/> 
            </div>
        </form>
    </body>
</html>

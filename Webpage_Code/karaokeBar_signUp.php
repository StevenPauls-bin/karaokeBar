<html>
    <head>
        <title>Group 3 | Karaoke Bar</title>
        <link rel="shortcut icon" href="https://seeklogo.com/images/N/niu-huskies-logo-7821F4963B-seeklogo.com.png"/>
        <link rel="apple-touch-icon" href="https://seeklogo.com/images/N/niu-huskies-logo-7821F4963B-seeklogo.com.png"/>
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
            h1 { 
                text-align:center;
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
            table tr:nth-child(even) { 
                background-color:#1F3150; 
                border-color:#1F3150;
            }
            table tr:nth-child(odd) { 
                background-color:#152A4F; 
                border-color:#152A4F;
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
    </head>
    <body style="background-image:url('brick_wall_texture_192138_2560x1440.png')">
        <h1 style="text-align: center; color: #FFFFFF;">
            Sign up to sing
        </h1> 
        <form action="./karaokeBar_signUp.php" method="GET">
            <p style="text-align: center; color: #F797FC; font-family: Trebuchet MS; font-size: 40px;">
                Search for Songs
            </p> 
            <div align="center">
                <input style="margin-top: 1px; height:35px; width: 250px; font-family: Trebuchet MS; font-size: 18px; margin-top: 5px;"
                        type = "text" name="artist:contributor" placeholder = "Artist, Contributor or Title" required/>
                <input type="submit" name="searchButton" value="Search" style = "background-color: transparent;
                        border: none; color: white; padding: 16px 32px; text-decoration: none; margin: auto; cursor: pointer;"/> 
            </div>
        </form>
        <div style ="font-family: Trebuchet MS; font-size: 18px;" align="center">
            <?php
            $styling = "background-color: transparent;
                        border: none;
                        color: white;
                        padding: 16px 32px;
                        text-decoration: none;
                        font-size: 14px;
                        margin: auto;
                        cursor: pointer;"; // Would have used CSS for this but adding submit button styling breaks table

                include('globalVars.php');
                if($_SERVER['REQUEST_METHOD'] === 'GET' || $_POST != NULL){
                    session_start();
                    try{
                        $dsn = "mysql:host=courses;dbname=".$username;
                        $pdo = new PDO($dsn, $username, $password);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        if($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET["artist:contributor"] != NULL){ // intial search
                            $_SESSION['search'] = $_GET["artist:contributor"];
                            $_SESSION['orderBy'] = 'title';
                            $_SESSION['order'] = 'ASC';
                        } else {
                            if($_SESSION['orderBy'] == key($_POST)){ // user clicked same header twice
                                if($_SESSION['order'] == "DESC"){
                                    $_SESSION['order'] = "ASC";
                                } else {
                                    $_SESSION['order'] = "DESC";
                                }
                            } else  { // clicked on different header
                                $_SESSION['order'] = "ASC";
                                $_SESSION['orderBy'] = key($_POST);
                            }
                        }
                        $sql = "SELECT DISTINCT song.title, song.artist, karaokeFile.version, karaokeFile.id 
                                    FROM song
                                    LEFT JOIN contribution ON contribution.title = song.title
                                    INNER JOIN karaokeFile ON karaokeFile.title = song.title
                                    WHERE contribution.contributorName = :conName OR song.artist = :artist OR song.title = :title
                                    ORDER BY ".$_SESSION['orderBy']." ".$_SESSION['order'].";";
                        $query = $pdo->prepare($sql);
                        $query->execute(array(':conName' =>  $_SESSION['search'], ':artist' => $_SESSION['search'], ':title' => $_SESSION['search']));
                        $rows = $query->fetchAll(PDO::FETCH_ASSOC);
                        if($rows[0]['title'] != NULL){ // query cam back with data
                            echo "<table border=\"1\" align=\"center\" cellpadding=\"5\" style=\"margin-top:10px;
                            border: none; border-collapse: collapse; width: 65%; color: #B9B9B9; border: 2px #464646;\">\n";
                            echo "<form action=\"./karaokeBar_signUp.php\" method=\"POST\">";
                            echo "<tr align=\"center\" style =\"background-color:#122445;\">\n";
                            echo "<th><input type=\"submit\" name=\"title\" value=\"Title\" style=\"".$styling."\"/></th>\n";
                            echo "<th><input type=\"submit\" name=\"artist\" value=\"Artist\" style=\"".$styling."\"/></th>\n";
                            echo "<th><input type=\"submit\" name=\"version\" value=\"Version\" style=\"".$styling."\"/></th>\n<th> </th>\n</tr>\n";
                            echo "</form>";
                            echo "<form action=\"./karaokeBar_finishSignUp.php\" method=\"POST\">";
                            foreach($rows as $row){
                                echo "<tr>\n";
                                echo "<td>".$row['title']."</td>\n";
                                echo "<td>".$row['artist']."</td>\n";
                                echo "<td>".$row['version']."</td>\n";
                                echo "<td><input type=\"submit\" name=\"".$row['id']."\" value=\"select\" style=\"".$styling."\"/></td>\n";
                                echo "</tr>\n";
                            }
                            echo "</table>\n";
                            echo "</form>";
                        } else {
                            echo "<p style=\"text-align: center; color: #F797FC; font-family: Trebuchet MS; font-size: 18px;\">";
                            echo "no songs found, please try a different search.";
                            echo "</p>";
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

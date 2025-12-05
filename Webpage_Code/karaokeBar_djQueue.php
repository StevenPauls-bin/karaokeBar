<html>
    <head>
        <link rel="stylesheet" href="styles.css">
        <h1> DJ Booth </h1>
        <h4 style = "font-family: 'Tilt Neon'; color: #bcefff; text-align: center; margin-top: -30px; margin-bottom: 0px"> click pink header once for ascending, again for descending, and so on... </h4>
    </head>
    <form id = "regularForm" method = "POST">
        <img src = "RegularQueue.png" style = "margin-left: auto; margin-right: auto; display: block;" width = "120" height = "auto" class = "neon" />
        <table border = 1 style = "font-family: Monaco, monospace;">
            <tr><th style = "border:none;"><button type = "submit" name = "sort_button" value = "time"> Place in Queue </button></th>
	    <th style = "border:none;"><button type = "submit" name = "sort_button" value = "name"> Name </button></th>
            <th style = "border:none;"><button type = "submit" name = "sort_button" value = "username"> Username </button></th>
            <th style = "border:none;"><button type = "submit" name = "sort_button" value = "id"> ID </button></th>
            <th style = "border:none;"><button type = "submit" name = "sort_button" value = "title"> Title </button></th>
            <th style = "border:none;"><button type = "submit" name = "sort_button" value = "artist"> Artist </button></th>
            <th style = "border:none;"><button type = "submit" name = "sort_button" value = "version"> Version </button></th>
            <th style = "border:none;"><button type = "submit" name = "sort_button" value = "time"> Time </button></th>
        </tr>
    </form>
    <body style = "background-image:url('brick_wall_texture_192138_2560x1440.png');">
    <?php
        session_start();

        /////////////////////////////////
        error_reporting(E_ALL);
        ini_set('display_errors',1);
        ////////////////////////////////

        function connect(){                     //connect for sql
            include("globalVars.php");

            try{
                $dsn = "mysql:host=courses;dbname=".$username;
                $pdo = new PDO($dsn, $username, $password);
            }
            catch(PDOException $e){
                echo "Connection to database failed". $e->getMessage();
            }

            return $pdo;
        }

        if(!isset($_SESSION['clickAmount'])){   //Times the sort button was clicked
            $_SESSION['clickAmount'] = 0;
        }
        if(!isset($_SESSION['prevSort'])){      //Sort button chosen on previous submit
            $_SESSION['prevSort'] = "time";
        }
        if(isset($_POST['sort_button'])){       //If sort button wasn't clicked, uses default (time)
            $sortType = $_POST['sort_button'];
            ++$_SESSION['clickAmount'];         //increment click counter
        }
        else{
            $sortType = $_SESSION['prevSort'];
        }

        if($_SESSION['prevSort'] != $sortType){     //if current sort choice differs from last, resets click counter
            $_SESSION['clickAmount'] = 0;
            $_SESSION['prevSort'] = $sortType;      //sets session sort choice to current
        }

        $con = connect();                       //connect for sql

        $sql = "SELECT username,id FROM signUp WHERE qType = 'r' ORDER BY time;";
        $result = $con->query($sql);
        $allrows = $result->fetchAll();

        $tempArray = array();
        $lineOrder = array();
        $arrayIndex = 1;

        foreach($allrows as $row){
            for ($i = 0; $i < $result->columnCount(); ++$i){
                $tempArray[0] = $row[0];
                $tempArray[1] = $row[1];
                $lineOrder[$arrayIndex] = $tempArray;
                ++$i;
                ++$arrayIndex;
            }
        }

        if($_SESSION['clickAmount'] == 1){       //if first click, sort ascending
            $sql = "SELECT name,signUp.username,signUp.id,karaokeFile.title,artist,version,time FROM signUp,karaokeFile,song,user WHERE qType = 'r' AND signUp.id = karaokeFile.id AND karaokeFile.title = song.title AND user.username = signUp.username ORDER BY $sortType ASC;";
        }
        else{                                   //if second click, sort descending
            $sql = "SELECT name,signUp.username,signUp.id,karaokeFile.title,artist,version,time FROM signUp,karaokeFile,song,user WHERE qType = 'r' AND signUp.id = karaokeFile.id AND karaokeFile.title = song.title AND user.username = signUp.username ORDER BY $sortType DESC;";
            $_SESSION['clickAmount'] = 0;
        }

        $result = $con->query($sql);
        $allrows = $result->fetchAll();

        foreach($allrows as $row){
			$storename = $row[1];
			$storekid= $row[2];
            echo "<tr>";
            $tempArray[0] = $row[1];
            $tempArray[1] = $row[2];
            $key = array_search($tempArray, $lineOrder);
            echo "<td>$key</td>";
            for($i = 0; $i < $result->columnCount(); ++$i){
                echo "<td>$row[$i]</td>";
            }
			echo "<form action='' method='POST'  onSubmit='window.location.reload()' ><input type='hidden' name='userName' value='$storename'><input type='hidden' name='kid1' value='$storekid'><td><button name = 'delete'> Remove </form></td>\n";
        }

        if(isset($_POST['delete'])){
            echo "<meta http-equiv='refresh' content='0'>";
        }

        echo "</tr></table>;";
		try{
		include("globalVars.php");
		$dsn = "mysql:host=courses;dbname=".$username;
		$pdo = new PDO($dsn, $username, $password);
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$dsn = "mysql:host=courses;dbname=".$username;
				$pdo = new PDO($dsn, $username, $password);
				if (isset($_POST['userName']) && isset($_POST['kid1'])) {
					// Access $_POST['userName'] and $_POST['kid1'] safely
					$userName = $_POST['userName'];
					$kid1 = $_POST['kid1'];
				}
				
				if (!empty($userName)) {
				$sql_d = $pdo->prepare("DELETE FROM signUp WHERE username = :username and id = :kid1");
				$sql_d->bindParam(':username', $userName);
				$sql_d->bindParam(':kid1', $kid1);
				$sql_d->execute();
				}
		}
		}//end try block
		catch(PDOexception $e){
			echo "Connection to database failed: " . $e->getMessage();
		}	

    ?>
    </body>

    <form id = "priorityForm" method = "POST">
        <input type = "hidden" id = "tableContents" name = "tableContents" value = "notSet" />
        <img src = "PriorityQueue.png" style = "margin-left: auto; margin-right: auto; display: block;" width = '120' height = 'auto' class = neon />
        <table border = 1 style = "font-family: Monaco, monospace;">
        <tr><th style = "font-familt:'Tilt Neon', sans-serif; border:none" colspan = "10"> Queue By: <br>
            <input type = "radio" id = "time" name = "qBy" value = "time" onclick = "submitOnClick('priorityForm')"
                <?php if((isset($_POST['qBy']) && $_POST['qBy'] == 'time') || !isset($_POST['qBy'])){echo "checked";} ?> />
                <label for = "time"> Time </label>
            <input type = "radio" id = "payment" name = "qBy" value = "payment DESC" onclick = "submitOnClick('priorityForm')"
                <?php if((isset($_POST['qBy']) && $_POST['qBy'] == 'payment DESC')){echo "checked";} ?> />
                <label for = "payment"> Bribe </label>
            <input type = "radio" id = "custom" name = "qBy" value = "custom" onclick = "submitOnClick('priorityForm')"
                <?php if((isset($_POST['qBy']) && $_POST['qBy'] == 'custom')){echo "checked";} ?> />
                <label for = "custom"> Custom </label>
        </th></tr>
        <tr><th style = "border:none;"><button type = "submit" name = "sort_button2" value =
                <?php if((isset($_POST['qBy']))){echo "$_POST[qBy]";} else{echo "time";} ?>> Place in Queue </button></th>
	    <th style = "border:none;"><button type = "submit" name = "sort_button2" value = name> Name </button></th>
            <th style = "border:none;"><button type = "submit" name = "sort_button2" value = username> Username </button></th>
            <th style = "border:none;"><button type = "submit" name = "sort_button2" value = id> ID </button></th>
            <th style = "border:none;"><button type = "submit" name = "sort_button2" value = title> Title </button></th>
            <th style = "border:none;"><button type = "submit" name = "sort_button2" value = artist> Artist </button></th>
            <th style = "border:none;"><button type = "submit" name = "sort_button2" value = version> Version </button></th>
            <th style = "border:none;"><button type = "submit" name = "sort_button2" value = time> Time </button></th>
            <th style = "border:none;"><button type = "submit" name = "sort_button2" value = payment> Bribe </button></th>
        </tr>
    </form>
    <body>
        <?php
            $con = connect();

            if(!isset($_SESSION['clickAmount2'])){              //Times the sort button was clicked
                $_SESSION['clickAmount2'] = "0";
            }
            if(!isset($_SESSION['prevSort2'])){                 //Sort button chosen on previous submit
                $_SESSION['prevSort2'] = "time";
            }
            if(isset($_POST['sort_button2'])){                  //If sort button wasn't clicked, uses default (time)
                $sortType2 = $_POST['sort_button2'];
                ++$_SESSION['clickAmount2'];
            }
            else{
                $sortType2 = $_SESSION['prevSort2'];
            }
            if(!isset($_SESSION['customTimes'])){               //Times the custom button was clicked
                $_SESSION['customTimes'] = "0";
            }
            if($_SESSION['prevSort2'] != $sortType2){           //if current sort choice differs from last, resets click counter
                $_SESSION['clickAmount2'] = 0;
                $_SESSION['prevSort2'] = $sortType2;            //sets session sort choice to current
            }

            if(!isset($_SESSION['prevQueue'])){                 //Queue By button chosen on previous submit
                $_SESSION['prevQueue'] = "time";
            }
            if(!isset($_SESSION['tableContents'])){             //Previous contents of table as customized by user
                $_SESSION['tableContents'] = "notSet";
            }

            if(!isset($_POST['tableContents']) || $_POST['tableContents'] == "notSet"){    //if no posted custom table contents, sets to previous
                $tableContents = $_SESSION['tableContents'];
            }
            else{                                               //otherwise sets session and current to posted
                $tableContents = $_POST['tableContents'];
                $_SESSION['tableContents'] = $tableContents;
            }

            if(isset($_POST['qBy'])){                           //saves whether Queue By was chosen in variable
                $qBy = $_POST['qBy'];
            }
            else{
                $qBy = "time";
            }

            $arrayIndex = 0;                                    //used in LineOrder array
            $lineOrder2 = array();

            if($qBy != $_SESSION['prevQueue']){      //if posted Queue By was changed from previous, resets counter or custom
                $_SESSION['customTimes'] = 0;
                $_SESSION['prevQueue'] = $qBy ;     //sets session Queue By to current
            }

            if($qBy != "custom"){                   //orders users based on Queue By choice with sql
                $sql = "SELECT username,id FROM signUp WHERE qType = 'p' ORDER BY $qBy";
                $result = $con->query($sql);
                $allrows2 = $result->fetchAll();

                foreach($allrows2 as $row){                           //places ordered sql results in array to link with line place key
                    for ($i = 0; $i < $result->columnCount(); ++$i){
                        $tempArray[0] = $row[0];
                        $tempArray[1] = $row[1];
                        $lineOrder2[$arrayIndex] = $tempArray;
                        ++$i;
                        ++$arrayIndex;
                    }
                }
            }
            else{                            //orders users based on Queue By choice with submitted custom tableContents
                $sql = "SELECT username,id FROM signUp WHERE qType = 'p';";
                $customPieces = explode("~",$tableContents);         //splits username and song id
                for($i = 1; $i < count($customPieces); ++$i){
                    $tempArray[0] = $customPieces[$i];
                    ++$i;
                    $trimmed = ltrim($customPieces[$i]);             //trim irrelavent chars
                    if($i != count($customPieces)-1){
                        $trimmed = substr($trimmed, 0, -5);
                    }
                    $tempArray[1] = $trimmed;
                    $lineOrder2[$arrayIndex] = $tempArray;
                    $arrayIndex++;
                }
            }

            if(($qBy == "custom" && $sortType2!= "custom") || ($qBy != "custom")){  //if Queue By is custom and sorting isn't Place in Queue, or Queue By isn't custom                                //increase click counter
                if($_SESSION['clickAmount2'] == 1){                                 //if first click, sort ascending
                    $sql = "SELECT name,signUp.username,signUp.id,karaokeFile.title,artist,version,time,payment FROM signUp,karaokeFile,song,user WHERE qType = 'p' AND signUp.id = karaokeFile.id AND karaokeFile.title = song.title AND user.username = signUp.username ORDER BY $sortType2 ASC";
                    if ($sortType2 == 'time'){
                        $sql.= ",payment ASC;";
                    }
                    else if ($sortType2 == 'payment'){
                        $sql.= ",time DESC;";
                    }
                }
                else{                 //if second click, sort descending
                    $sql = "SELECT name,signUp.username,signUp.id,karaokeFile.title,artist,version,time,payment FROM signUp,karaokeFile,song,user WHERE qType = 'p' AND signUp.id = karaokeFile.id AND karaokeFile.title = song.title AND user.username = signUp.username ORDER BY $sortType2 DESC";
                    if ($sortType2 == 'time'){
                        $sql.= ",payment DESC;";
                    }
                    else if ($sortType2 == 'payment'){
                        $sql.= ",time ASC;";
                    }
                    $_SESSION['clickAmount2'] = 0;      //reset click counter
                }
            }

            $result = $con->query($sql);
            $allrows2 = $result->fetchAll();

            $entryCount = 0;           //number of signUp entries

            if($qBy == "custom" && $_SESSION['customTimes'] == "0"){        //if creating custom Queue, display instructions
                echo "<caption style = 'color:#bcefff; caption-side:top; margin-top: -50px'>usernames/ids are now draggable</caption><br><br>";
            }

            if($qBy  == "custom" && $sortType2 != "custom" || ($qBy != "custom")){      //if Queue By is custom and sorting isn't Place in Queue, or Queue By isn't custom
                foreach($allrows2 as $row){
					$storename2 = $row[1];
					$storekid2= $row[2];
                    echo "<tr>";
                    $tempArray[0] = $row[1];
                    $tempArray[1] = $row[2];
                    $key = array_search($tempArray, $lineOrder2);       //set key to line placement of current entry

                    if($qBy == "custom" && $_SESSION['customTimes'] == 0){    //if first time clicking custom, set up droppable area in Place in Queue
                        $entryCount++;
                        echo "<td>";
                        ?>
                        <div name = "blankCustom" id = "div<?php echo $entryCount; ?>" style="width:100%" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">&nbsp;</div>
                        <?php  echo "</td>";
                    }
                    else{
                        echo "<td>",$key+1,"</td>";             //otherwise output Place in Queue number
                    }
                    for($i = 0; $i < $result->columnCount(); ++$i){
                        if($qBy == "custom" && $i == 1 && $_SESSION['customTimes'] == 0){     //if first time clicking custom + col is username, set up draggables
                            ?><td colspan=2>
                            <div id = "drag<?php echo $entryCount; ?>" draggable = 'true' ondragstart = "drag(event)">
                            <?php
                            echo "<pre style = 'font-family: Monaco, monospace'>", str_pad("~$row[$i]~", 15, ' ');
                            echo "$row[2]</pre></div>";
                            ++$i;
                        }
                        else{                             //otherwise output column contents
                            echo "<td>$row[$i]</td>";
                        }
                    }
					echo "<form action='' method='POST'  onSubmit='window.location.reload()' ><input type='hidden' name='userName2' value='$storename2'><input type='hidden' name='kid2' value='$storekid2'><td><button name = 'delete'> Remove </form></td>\n";
        }

        if(isset($_POST['delete'])){
            echo "<meta http-equiv='refresh' content='0'>";
        }
            }
            else{                                       //if custom queue order and sort by Place in Queue
                ++$_SESSION['clickAmount2'];            //increment click counter
				if($_SESSION['clickAmount2'] == 2){             //if second click, sort desc
					$lineOrder2 = array_reverse($lineOrder2);
                }
				for ($i = 0; $i < $arrayIndex; ++$i)
				{
					$userName = $lineOrder2[$i][0];
					$songID = $lineOrder2[$i][1];
					if($_SESSION['clickAmount2'] == 1)  //ascending line numbers
					{
						echo "<td>", $i+1, "</td>";
					}
					else{                                //descending line numbers
						echo "<td>",$arrayIndex-$i,"</td>";
                    }
					$sql = "SELECT name,signUp.username,signUp.id,karaokeFile.title,artist,version,time,payment FROM signUp,karaokeFile,song,user
                            WHERE qType = 'p' AND signUp.id = karaokeFile.id AND karaokeFile.title = song.title AND user.username = signUp.username
                            AND signUp.username = '$userName' AND karaokeFile.id = '$songID';";        //find full info of entry at current line number
					$result = $con->query($sql);
					$allrows2 = $result->fetchAll();

					foreach($allrows2 as $row){
						for($j = 0; $j < $result->columnCount(); ++$j){
							echo "<td>$row[$j]</td>";
                        }
						echo "</tr>";
                    }
				}
				if($_SESSION['clickAmount2'] == 2){     //reset click counter
					$_SESSION['clickAmount2'] = 0;
                }
            }

            echo "</tr></table>";
			try{
				include("globalVars.php");
				$dsn = "mysql:host=courses;dbname=".$username;
				$pdo = new PDO($dsn, $username, $password);
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
						$dsn = "mysql:host=courses;dbname=".$username;
						$pdo = new PDO($dsn, $username, $password);
						if (isset($_POST['userName2']) && isset($_POST['kid2'])) {
							$userName2 = $_POST['userName2'];
							$kid2 = $_POST['kid2'];
						}
						
						if (!empty($userName2)) {
							$sql_d = $pdo->prepare("DELETE FROM signUp WHERE username = :username and id = :kid2");
							$sql_d->bindParam(':username', $userName2);
							$sql_d->bindParam(':kid2', $kid2);
							$sql_d->execute();
						}
				}
				}//end try block
				catch(PDOexception $e){
					echo "Connection to database failed: " . $e->getMessage();
				}	

        ?>
        <script>

            let rowCount = "<?php echo $entryCount; ?>";    //number of entries in table
	    	let tableCont = [];

            function submitOnClick(form,){
                document.forms[form].submit();
            }
            function allowDrop(ev,el){
                if(el.children.length == 0){
                    ev.preventDefault();
                }
            }
            function drag(ev){
                ev.dataTransfer.setData("text",ev.target.id);
            }
            function drop(ev,el){
                ev.preventDefault();
                let data = ev.dataTransfer.getData("text");
                el.appendChild(document.getElementById(data));
                let idNum = el.id.substr(3);            //find what number div currently dropped into
                idNum = parseInt(idNum);
                tableCont[idNum-1] = el.innerText;      //set array spot for that num div to new contents
                let m = 0;
                let full = false;
                for(let n = 0; n < tableCont.length; ++n){  //check if every div is full
                    if (tableCont[n]!= null){
                        ++m;
                    }
                }
                if (m == rowCount){
                    full = true;
                }
                if(full){           //sends array of custom table contents to html
                    <?php $_SESSION['customTimes'] = 1; ?>
                    document.getElementById("tableContents").value = tableCont;
                    document.getElementById("priorityForm").submit();
                }
            }

        </script>
        <form action="./karaokeBar_home.php" method="POST">
            <div align="center">
                <input type="submit" name="Homepage" value="Go Home"  style = "background-color: transparent;
                            border: none; color: white; padding: 16px 32px; text-decoration: none; margin: auto; cursor: pointer;"/> 
            </div>
        </form>
    </body>
</html>


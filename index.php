<?php
    include_once 'includes/dbh.inc.php'
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title></title>
<style>
    body {
        color: white;
        background: black;
        font-family: arial;
    }
    .medium {
        font-size: 1em;
        margin: 5px auto;
    }
    .margin_bottom {
        font-size: 1em;
        margin-top: 5px;
    }
    .small {
        font-size: 0.8em;
    }
    .bold {
        font-weight: 900;
    }
    .sugg {
        margin-top: 2em;
        background: rgb(50,50,50);
        padding: 10px;
        border-radius: 5px;
    }
    #clear_form {
        position: absolute;
        width: 50%;
        height: 30%;
        top: 35%;
        left: 25%;
        background: gray;
        display: none;
        flex-direction: column;
        justify-content: center;
        border-radius: 30px;
    }
    #clear_form > * {
        margin: 1% 30%;
    }
    #clear_sugg_but {
        position: fixed;
        bottom: 10px;
        right: 10px;
    }
    #sugg_form_with_textarea {
        margin-top: 2em;
        background: rgb(50,50,50);
        padding: 10px;
        border-radius: 5px;
    }
</style>
</head>
<body>
    <p class="bold">Suggestions:</p> 
    <?php 
        ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
        if (isset($_GET["msg"])) {
            if ($_GET["succ"] == 0) {
                echo "<p style='color: red'>".$_GET["msg"]."</p>";
            }
            elseif ($_GET["succ"] == 1) {
                echo "<p style='color: lightgreen'>".$_GET["msg"]."</p>";
            }
            
        }
        $sql = "SELECT * FROM suggestions;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        
        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='sugg'><p class='medium bold'>Suggestion:</p><p class='medium'>".htmlspecialchars($row["suggestion"])."</p><p class='small'>By: ".htmlspecialchars($row["display_name"])."</p></div>";
            }
        } else {
            echo "No suggestion yet!";
        }
    ?>
    <br>
    <br>
    <p class="bold">Suggest something:</p> 
    <div id="sugg_form_with_textarea">
        <textarea rows="4" cols="50" name="suggestion" placeholder="Suggestion" form="sugg_form"></textarea><p class="margin_bottom">Max 1000 characters.</p>
        <form action="includes/sugg_handler.inc.php" method="POST" id="sugg_form">
            <input type="text" name="display_name" placeholder="Name"><p class="margin_bottom">Will be publicly displayed under your suggestion. (Max 40 characters)</p>
            <input type="text" name="email" placeholder="Email"><p class="margin_bottom">Won't be publicly displayed. </p>
            <button type="submit" name="submit">Suggest</button>
        </form>
    </div>
    <div id="clear_form">
        <form action="includes/clear_handler.inc.php" method="POST">
            <input type="password" name="pass" placeholder="Admin Key"><br>
            <button type="submit" name="submit">Clear Suggestions</button><br>
        </form>
        <button onclick="document.getElementById('clear_form').style.display = 'none'">Close</button>
    </div>
    <button id="clear_sugg_but" onclick="document.getElementById('clear_form').style.display = 'flex'">Clear Suggestions</button>

</body>
</html>

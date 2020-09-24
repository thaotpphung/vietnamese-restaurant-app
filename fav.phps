<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Pholicious</title>
    <script src="script.js"></script>
    <link href="localstyle.css" type="text/css" rel="stylesheet">
</head>

<body id="homepage">
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0"></script>
    <div id="wrapper">
        <div id="mashead">
            <div id="heading">
                <h1>Pholicious</h1>
                <h2>Authentic Vietnamese Cuisine </h2>
            </div>
            <div id="navbar">
                <ul>
                    <li><a href="home.html">Home</a></li>
                    <li><a href="menu.html">Menu</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="hours.html">Hours</a></li>
                    <li><a href="review.html">Reviews</a></li>
                    <li><a href="fav.php">Favorite Order</a></li>
                </ul>
            </div>
        </div>

        <div id="content">
            <div id="intro">
                <h3>We proudly serve the best quality, most authentic Vietnamese food in town.
                </h3>
            </div>
            <div id="fav_order">

<?php
// print the input forms
function print_form() {
    echo <<<END
    <form action="$_SERVER[PHP_SELF]" method="post">
        <div id="input_data">
            <label>Name:
            <input type="text" name="Name" size="20" required maxlength="20" pattern="[A-Z a-z]{1,20}" title="Name must be less than or equal to 20 alphabet characters">
            </label>
            <span>  </span>
            
            <label>Quantity:
            <input type="number" name="Quantity" min="0" max="100" required/>
            </label>
            <span>  </span>
        
            <br>
            <input type="hidden" name="stage" value="process">
            <input class="submitbutton" type="submit" value="Add to Favorite">
            <input  class="submitbutton" type="reset" value="Clear">
            </div>
            <hr />
            <br>
    </form>
END;
}

// process input and add to database
function process_form() {

    try {
        $db = new PDO("mysql:dbname=ttp7428CS315;host=mysql.truman.edu", ttp7428, ahshaeng);
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare sql and bind parameters
        $stmt = $db->prepare("INSERT INTO Fav (Name, Quantity)
        VALUES (:Name, :Quantity)");
        $stmt->bindParam(':Name', $Name);
        $stmt->bindParam(':Quantity', $Quantity);

        // insert a row
        $Name = htmlspecialchars($_POST["Name"]);
        $Quantity = htmlspecialchars($_POST["Quantity"]);
        $stmt->execute();

        ?>
            <div id="message">New entry added successfully!
                <br>
            <form action="http://ice.truman.edu/~ttp7428/milestone4/fav.php">
                <input class="submitbutton" type="submit" value="Add another entry" />
            </form>
            <div>
            <br /> 
            <hr />
            <br />
<?php
        }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }
    $db = null;
}

if (isset($_POST['stage']) && ('process' == $_POST['stage'])) {
    process_form();
} else {
    print_form();
}
?>

<!-- print the database in an html table -->
            <div id="fav_table">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Quantity</th>
                    </tr>
<?php
try {
    $db = new PDO("mysql:dbname=ttp7428CS315;host=mysql.truman.edu", ttp7428, ahshaeng);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $rows = $db->query("SELECT * FROM Fav");
    foreach ($rows as $row) {
        echo "<tr><td>".$row["ID"]."</td><td>"
        .$row["Name"]."</td><td>"
        .$row["Quantity"]."</td></tr>";
    }
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}
$db = null;
?>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
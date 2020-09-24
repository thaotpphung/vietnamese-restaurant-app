<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>Pholicious</title>
    <script src="script.js"></script>
    <link href="localstyle.css" type="text/css" rel="stylesheet" />
</head>

<!-- Processes the order described in menu.html -->

<body id="orderhomepage">
    <div id="wrapper">
        <div id="mashead">
            <div id="heading">
                <h1>Pholicious</h1>
                <h2>Authentic Vietnamese Cuisine</h2>
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
                <h3>
                    We proudly serve the best quality, most authentic Vietnamese food in
                    town.
                </h3>
            </div>

            <div id="confirmorder">
                <?php
                // If any of the quantities are blank, set them to zero

                // The following eight lines are required on all machines, such as xenon
                // where register_globals is off.

                $nemnuong = $_POST["nemnuong"];
                $banhcuon = $_POST["banhcuon"];
                $pho = $_POST["pho"];
                $chebamau = $_POST["chebamau"];

                $name = $_POST["name"];
                $street = $_POST["street"];
                $city = $_POST["city"];
                $payment = $_POST["payment"];

                if ($nemnuong == "") $nemnuong = 0;
                if ($banhcuon == "") $banhcuon = 0;
                if ($pho == "") $pho = 0;
                if ($chebamau == "") $chebamau = 0;

                // Compute the item costs and total cost

                $nemnuong_cost = 5.0 * $nemnuong;
                $banhcuon_cost = 7.0 * $banhcuon;
                $pho_cost = 8.0 * $pho;
                $chebamau_cost = 5.0 * $chebamau;
                $total_price = $nemnuong_cost + $banhcuon_cost + $pho_cost +
                    $chebamau_cost;
                $total_items = $nemnuong + $banhcuon + $pho + $chebamau;

                // Return the results to the browser in a table

                ?>
                <div id="customeraddress">
                    <h4>Customer:</h4>
                    <?php
                    // print("$name <br /> $street <br /> $city <br />");
                    echo htmlspecialchars($name);
                    print("<br/>");
                    echo htmlspecialchars($street);
                    print("<br/>");
                    echo htmlspecialchars($city);
                    print("<br/>");
                    ?>

                </div>
                <div id="ordertotal">
                    <div id="total">
                        <table class="total">
                            <caption>
                                <strong>Order Information</strong>
                            </caption>
                            <tr>
                                <th>Product</th>
                                <th>Unit Price</th>
                                <th>Quantity Ordered</th>
                                <th>Item Cost</th>
                            </tr>
                            <tr>
                                <td>Nem Nuong</td>
                                <td>$5.00</td>
                                <td><?php echo htmlspecialchars($nemnuong); ?></td>
                                <td><?php printf("$ %4.2f", $nemnuong_cost); ?></td>
                            </tr>
                            <tr>
                                <td>Banh Cuon</td>
                                <td>$7.00</td>
                                <td><?php echo htmlspecialchars($banhcuon); ?> </td>
                                <td><?php printf("$ %4.2f", $banhcuon_cost); ?> </td>
                            </tr>
                            <tr>
                                <td>Pho</td>
                                <td>$8.00</td>
                                <td><?php echo htmlspecialchars($pho) ?> </td>
                                <td><?php printf("$ %4.2f", $pho_cost); ?></td>
                            </tr>
                            <tr>
                                <td>Che Ba Mau</td>
                                <td>$5.00</td>
                                <td><?php echo htmlspecialchars($chebamau) ?></td>
                                <td><?php printf("$ %4.2f", $chebamau_cost); ?> </td>
                            </tr>
                        </table>
                    </div>
                    <div id="finalinfo">
                        <h4> Summary </h4>
                        <p> </p>
                        <?php
                        print("You ordered $total_items items <br />");
                        printf("Your total bill is: $ %5.2f <br />", $total_price);
                        print("Your chosen method of payment is: $payment <br />"); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
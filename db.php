
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "jewelrystore";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $card = $_POST['card'];
    $expiry = $_POST['expiry'];
    $cvv = $_POST['cvv'];
    $items = $_POST['items'];
    $created_at = $_POST['created_at'];

    // Insert data into database
    $sql = "INSERT INTO purchases (id,name,address,card,expiry,cvv,items,created_at)
    VALUES ('$id','$name','$address','$card','$expiry','$cvv','$items','$created_at')";

    if ($conn->query($sql) === TRUE) {

        echo "<script>alert('Checkout complete');</script>";

        echo "<script>window.setTimeout(function(){ window.location.href = 'index.html'; }, 1000);</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>
data.php
Displaying data.php.
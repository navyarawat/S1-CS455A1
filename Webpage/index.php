<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!DOCTYPE html>
<html>
<head>
<title>Feedback</title>
</head>
<body>

<?php
if (isset($_POST['submit'])) {

	require "config.php";

	try {
		$connection = new PDO($dsn, $username, $password, $options);
		
		$newf = array(
			"resp1" => $_POST['f1'],
			"resp2" => $_POST['f2'],
			"resp3" => $_POST['f3'],
			"resp4" => $_POST['f4'],
			"respOp" => $_POST['f5']
                );
                 $sql = sprintf(
                        "INSERT INTO %s (%s) values (%s)",
                        "feedback",
                        implode(", ", array_keys($newf)),
                        ":" . implode(", :", array_keys($newf))
                );
        
        $statement = $connection->prepare($sql);
        $statement->execute($newf);
	//echo "New record created successfully";
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
	
}
?>


<form method="post">

<h1>Feedback</h1>

<h3>Are our satisfied overall with our products?<br>(1 means extremely dissatisfied, 5
        means extremely satisfied) </h3>
<input type="radio" name="f1" value="1" > 1<br>
<input type="radio" name="f1" value="2"> 2<br>
<input type="radio" name="f1" value="3"> 3<br>
<input type="radio" name="f1" value="4"> 4<br>
<input type="radio" name="f1" value="5"> 5<br>

<h3>Do you find our products easy to use?<br>(1 means they are not usable at all, 5
        means they are extremely easy to use) </h3>
<input type="radio" name="f2" value="1" > 1<br>
<input type="radio" name="f2" value="2"> 2<br>
<input type="radio" name="f2" value="3"> 3<br>
<input type="radio" name="f2" value="4"> 4<br>
<input type="radio" name="f2" value="5"> 5<br>

<h3>How much impact our products have made on your daily routine?<br>(1 means no
        impact at all, 5 means a huge impact)</h3>
<input type="radio" name="f3" value="1" > 1<br>
<input type="radio" name="f3" value="2"> 2<br>
<input type="radio" name="f3" value="3"> 3<br>
<input type="radio" name="f3" value="4"> 4<br>
<input type="radio" name="f3" value="5"> 5<br>

<h3>Would you recommend our products to your friends and family?<br>(1 means
        strongly advice against our products, 5 means strongly recommend our
        products)</h3>
<input type="radio" name="f4" value="1" > 1<br>
<input type="radio" name="f4" value="2"> 2<br>
<input type="radio" name="f4" value="3"> 3<br>
<input type="radio" name="f4" value="4"> 4<br>
<input type="radio" name="f4" value="5"> 5<br>

<h3>Any other feedback</h3>
<input type="text" name="f5" value="Type"><br>
<br>
<input type="submit" name = "submit" value="submit">
</form>
</body>
</html>
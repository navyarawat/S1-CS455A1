<!DOCTYPE html>
<html>

<head>
<title>Results</title>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 60%%;
}

th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

/* Style the button that is used to open and close the collapsible content */
.collapsible {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 12px;
  width: 50%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 20px;
}

/* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
.active, .collapsible:hover {
  background-color: #ccc;
}

/* Style the collapsible content. Note: hidden by default */
.content {
  padding: 0 18px;
  display: none;
  overflow: hidden;
  background-color: #f1f1f1;
  width: 50%;
}

.collapsible:after {
  content: '\02795'; /* Unicode character for "plus" sign (+) */
  font-size: 13px;
  color: white;
  float: right;
  margin-left: 5px;
}

.active:after {
  content: "\2796"; /* Unicode character for "minus" sign (-) */
}
</style>
</head>

<body>

<?php 

require "config.php";

try {
        $connection = new PDO($dsn, $username, $password, $options);
        $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);
        
        $sql1 = "SELECT AVG(resp1) FROM feedback;";
        $sql2 = "SELECT AVG(resp2) FROM feedback;";
        $sql3 = "SELECT AVG(resp3) FROM feedback;";
        $sql4 = "SELECT AVG(resp4) FROM feedback;";
        $sql5 = "SELECT respOp FROM feedback;";

        $statement1 = $connection->prepare($sql1);
        $statement2 = $connection->prepare($sql2);
        $statement3 = $connection->prepare($sql3);
        $statement4 = $connection->prepare($sql4);
        $statement5 = $connection->prepare($sql5);

        $statement1->execute();
        $statement2->execute();
        $statement3->execute();
        $statement4->execute();
        $statement5->execute();

        $r1 = $statement1->fetchAll();
        $r2 = $statement2->fetchAll();
        $r3 = $statement3->fetchAll();
        $r4 = $statement4->fetchAll();
        $r5 = $statement5->fetchAll();
        //echo $r5[0]['respOp'];
        //echo " <br> Got Averages";
} catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
}
?>

<h1>Feedback Results</h1> <br>
<table align="center">

<tr>
        <th>Are our satisfied overall with our products?<br>(1 means extremely dissatisfied, 5
        means extremely satisfied)</th>
        <th><?php echo $r1[0]['AVG(resp1)'];?></th>
</tr>

<tr>
        <th>Do you find our products easy to use?<br>(1 means they are not usable at all, 5
        means they are extremely easy to use)</th>
        <th><?php echo $r2[0]['AVG(resp2)'];?></th>
</tr>

<tr>
        <th> How much impact our products have made on your daily routine?<br>(1 means no
        impact at all, 5 means a huge impact)</th>
        <th><?php echo $r3[0]['AVG(resp3)'];?></th>
</tr>

<tr>
        <th> Would you recommend our products to your friends and family?<br>(1 means
        strongly advice against our products, 5 means strongly recommend our
        products)</th>
        <th><?php echo $r4[0]['AVG(resp4)'];?></th> 
</tr>

</table>

<br>

<button class="collapsible">Any other feedback!</button>
<div class="content">
        <?php
        for($i=0; $i<count($r5); $i++) {
                echo "<h4>" . $r5[$i]['respOp'] . "</h4>";
                echo "<br>"; 
        }
        
        ?>

</div>

<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
</body>
</html>
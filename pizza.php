<?php
include 'db.php';
$conn = OpenCon();
session_start();
$user_id=$_SESSION["user_id"];
print "Thank you for you Order:"."<br>";

if(isset($_POST["submit"])){
  $largepizza = $_POST['Largepizza'];
  $Mediumpizza = $_POST['Mediumpizza'];
  $Smallpizza = $_POST['Smallpizza'];

if(isset($_REQUEST['service'])&& ($_REQUEST['service']=="donations")){
    $D=200;
  }else{
    $D=0;
  }
   $l=$largepizza*1000;
   $m=$Mediumpizza*700;
   $s=$Smallpizza*400;
   $d=$D;
   $lms=$l+$m+$s+$d;

   while ($_POST['Largepizza'] == "0" && $_POST['Mediumpizza'] == "0" && $_POST['Smallpizza'] == "0") {
       echo "error: all fields are required";
       exit;}


   switch ($_REQUEST['toppings'])
{
    case "Meattoppings":
    $Q=$lms+100;
    print "LargePizza"."\r"."=".$largepizza."<br>"."Mediumpizza"."\r"."=".$Mediumpizza."<br>"."Smallpizza"."\r"."=".$Smallpizza."<br>"."Your total amount is=".$Q;
    break;
    case "Vegetabletoppings":
    $R=$lms+100;
    print  "LargePizza"."\r"."=".$largepizza."<br>"."Mediumpizza"."\r"."=".$Mediumpizza."<br>"."Smallpizza"."\r"."=".$Smallpizza."<br>"."Your total amount is=".$R;
    break;
    case "Notoppings":
    $L=$lms+0;
    print  "LargePizza"."\r"."=".$largepizza."<br>"."Mediumpizza"."\r"."=".$Mediumpizza."<br>"."Smallpizza"."\r"."=".$Smallpizza."<br>"."Your total amount is=".$L;
    break;
}
  $date = date("Y-m-d H:i:s");
  $sql2 = "INSERT INTO orders(user_id, date_created,amount, status) VALUES('$user_id', '$date', '$lms', '0')";
  if (mysqli_query($conn, $sql2)) {
    	$last_id = mysqli_insert_id($conn);
      $sqllarge = "INSERT INTO order_details(order_id, unit_amount, description, quantity, date_created, status) VALUES('$last_id', '1000', 'large_pizza', '$largepizza', '$date','0')";
      $sqlmedium = "INSERT INTO order_details(order_id, unit_amount, description, quantity, date_created, status) VALUES('$last_id', '700', 'Medium_pizza', '$Mediumpizza', '$date','0')";
      $sqlsmall = "INSERT INTO order_details(order_id, unit_amount, description, quantity, date_created, status) VALUES('$last_id', '400', 'large_pizza', '$Smallpizza', '$date','0')";
      $conn->query($sqllarge);
      $conn->query($sqlmedium);
      $conn->query($sqlsmall);
}

}

?>

<?php
$temp="'https://www.google.com/maps/embed/v1/place?key=yourkey&q=";
if (!empty($_REQUEST['search'])){
$store_name=$_REQUEST['search'] . "'";
$map_src=$temp.$_SESSION['city'].'+'.$_SESSION['region'].','.$store_name;
echo "<br/>" . "<iframe width=" . "'600'" . " height=" . "'450'" . " src=" . $map_src . ">"."</iframe>" . "<br/>";
}
else{echo "請選擇餐廳";}
?>

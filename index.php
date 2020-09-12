<?php session_start();
if(!isset($_SESSION['UserData']['Username'])){
header("location:login.php");
exit;
}
?>

<?php include_once("mysql_conn.php");?>

<!-- 變數宣告 -->
<?php
$select_data='';	//餐廳條件搜尋結果
$result_data='';	//餐廳搜尋結果
$city='';
$region='';
$cate='';
$price='';
$store_name='';
$pages=0;
$page=1;		//設定每頁餐廳顯示數量
$data_nums=0;
$url='';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>餐廳推薦系統</title>
        <link href="http://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" type="text/css" />
		<!-- 強制更新快取 -->
		<link rel="stylesheet" type="text/css" href="style.css?version=&lt;?php echo time(); ?&gt;">  
		<link rel="icon" type="image/x-icon" href="images/img.png" />
    </head>
	
    <body>
		<div id="bg">
			<div id="outer">
				<div id="header">
					<div id="logo">
					<h1><a href="#">餐廳推薦系統</a></h1>
					</div>

					<form  method="post">
					<div id="search">
						<input class="text" name="search" /><input class="button" type="submit" value="餐廳名稱搜尋" />
					</div>
						<?php
						// 設定縣市、地區、食物種類、價格區間
						$option_city = isset($_POST['City']) ? $_POST['City'] : false;
						if ($option_city) {
							$city=$_POST['City'];
							$_SESSION['city']=$city;
							$select_data=$select_data.$_SESSION['city']."\t";
						}

						$option_region = isset($_POST['region']) ? $_POST['region'] : false;
						if ($option_region) {
							$region=$_POST['region'];
							$_SESSION['region']=$region;
							$select_data=$select_data.$_SESSION['region']."\t";
						}

						$option_cate = isset($_POST['cate']) ? $_POST['cate'] : false;
						if ($option_cate) {
							$cate=$_POST['cate'];
							$_SESSION['cate']=$cate;
							$select_data=$select_data.$_SESSION['cate']."\t";
						}

						$option_price = isset($_POST['price']) ? $_POST['price'] : false;
						if ($option_price) {
							$price=$_POST['price'];
							$_SESSION['price']=$price;
							$select_data=$select_data.$_SESSION['price']."\t";
						}

						if (!$con){die('Could not connect: ' . mysql_error());}
						
						// 餐廳名稱搜尋
						mysqli_select_db($con,'restaurant');
						if (!empty($_REQUEST['search'])) {
							$term = mysqli_real_escape_string($con,$_REQUEST['search']);  
							$sql = "SELECT * FROM restaurant WHERE Store_name='$term' AND City='$city' AND region='$region' AND $cate='$cate' AND $price='true' "; 
							$r_query = mysqli_query($con,$sql) or die( mysqli_error($con)); 
							while ($row = mysqli_fetch_array($r_query)){
								$result_data=$result_data."縣市 : ".$row['City']."<br/>"."店名 : ".$row['Store_name']."<br/>".
								"價格 : ".$row['Price']."<br/>"."地址 : ".$row['Address']."<br/>"."營業時間 : ".$row['time']."<br/>".
								"..........................................."."<br/>";
								$url=substr($row['url'],92);
								}
						}
						?>
					<div id="nav">
					
					<!-- 縣市地區查詢開始 -->
					<select class="shortselect" name="City" onchange="this.form.submit()">
					<option >請選擇縣市</option>
						<?php
							$result = mysqli_query($con, "SELECT * FROM `city` ");
							while ($row = mysqli_fetch_array($result)) {
								$selected = "";
								if($city == $row[1]) {
									$selected = " selected='selected'";
								}
								echo ("<option value=$row[1]$selected>$row[1]</option>\n\t\t\t\t\t\t");
							}
						?>
					</select>
					<!-- 縣市地區查詢結束 -->

					<!-- 地區欄位查詢開始 -->
					<select class="shortselect" name="region" onchange="this.form.submit()"> 
						<?php
						$sql = "SELECT * FROM  region WHERE city LIKE '%".$city."%'"; 
						$r_query = mysqli_query($con,$sql); 
						while ($row = mysqli_fetch_row($r_query)){
							foreach ($row as $value) {
								$selected_reigon = "";
								if($region == $value) {
									$selected_reigon = " selected='selected'";
								}
								if ($value != $city && $value !=""){
									echo "<option value=$value$selected_reigon>$value</option>\n\t\t\t\t\t\t";
								}
							} 
						}
						?>
					</select>
					<!-- 地區欄位查詢結束 -->

					<!-- 食物類別欄位開始 -->
					<select class="shortselect" name="cate" onchange="this.form.submit()"> 
						<?php
							$result = mysqli_query($con, "SELECT * FROM `category` ");
							while ($row = mysqli_fetch_array($result)) {
								$selected_food = "";
								if($cate == $row[1]) {
									$selected_food = " selected='selected'";
								}
								echo "<option value=".$row[1]."$selected_food>".$row[1]."</option>\n\t\t\t\t\t\t";
							} 
						?> 
					</select>
					<!-- 食物類別欄位結束 -->

					<!-- 價格區間欄位開始 -->
					<select class="shortselect" name="price" onchange="this.form.submit()"> 
					<option >請選擇價格區間</option>
						<?php
							$result = mysqli_query($con, "SELECT * FROM `price` ");
							while ($row = mysqli_fetch_array($result)) {
								$selected_price = "";
								if($price == $row[0]) {
									$selected_price = " selected='selected'";
								}
								echo "<option value=".$row[0]."$selected_price>".$row[0]."</option>\n\t\t\t\t\t\t";
							} 
						?> 
					</select>
					<!-- 價格區間欄位結束 -->
					
					</div>
					</form>
				</div>

				<div id="banner">
					<img src="images/bg2.jpg" width="1055" height="320" alt="" />
				</div>

				<p id="result">
				<?php echo "目前的篩選條件 : "."<br/>".$select_data;?>
				</p>

				<div id="main">
					<div id="sidebar">
						<?php 
						echo "餐廳搜尋結果:"."<br/>".$result_data."<br/>";
						include("page.php");
						?>
						<hr>
					</div>
					<div><h2><button class="button"><a href="./logout.php">Logout</a></button></h2></div>
					<div id="content">
						<div id="box1">
							<h3>評論趨勢:</h3>
							<hr>
							<?php 
							mysqli_query($con, "TRUNCATE TABLE `trend_count`");    // 清空資料表 
							$l = exec("(python.exe path) trend.py $url",$Array,$ret);
							include("trend_count.php");
							?>
						</div>
						<div id="box2">
							<?php 
							include_once("show_map.php");
							?>
						</div>
						<br class="clear" />
					</div>
					<br class="clear" />
				</div>
			</div>
			<div id="copyright">
				&copy; 餐廳推薦系統 | Design by <a href="http://jummy1124.github.io" rel="nofollow" target="_blank">林映辰</a>
			</div>
		</div>
    </body>
</html>

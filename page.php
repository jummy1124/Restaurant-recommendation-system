<?php
    //資料庫連結
    include_once("mysql_conn.php");
    mysqli_select_db($con,'restaurant');
    if(isset($_SESSION['city']) && isset($_SESSION['region']) && isset($_SESSION['cate']) && isset($_SESSION['price'])){
        $city=$_SESSION['city'];
        $region=$_SESSION['region'];
        $cate=$_SESSION['cate'];
        $price=$_SESSION['price'];
        $sql = "SELECT * FROM restaurant WHERE City='$city' AND region='$region' AND $cate='$cate' AND $price='true'"; 
        $r_query = mysqli_query($con,$sql) or die(mysqli_error($con));
        $data_nums = mysqli_num_rows($r_query); //統計總比數
        $per = 10; //每頁顯示項目數量
        $pages = ceil($data_nums/$per); //取得不小於值的下一個整數
        if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
            $page=1; //則在此設定起始頁數
        } else {
            $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
        }
        $start = ($page-1)*$per; //每一頁開始的資料序號
        $result = mysqli_query($con,$sql.' LIMIT '.$start.', '.$per) or die(mysqli_error($con));
    }
?>

<table>
<tr>
    <hr>
    <td style="text-align: center;">餐廳名稱:</td>
</tr>
<?php
//輸出資料內容
$i=0;
while ($row = mysqli_fetch_array ($result))
{
    $id=$row[1];
    exec("(python.exe path) get_star.py $id",$Array,$ret);
    ?>
    <tr>
        <td style="text-align: center;"><?php echo $id."<br/>"." 平均星數:".$Array[$i]."<br/>"."........................................."; ?></td>
    </tr>
    
<?php 
    $i++;
    }
?>
</table>

<br />

<?php
    //分頁頁碼
    echo '共 '.$data_nums.' 筆-在第 '.$page.' 頁-共 '.$pages.' 頁';
    echo "<br /><a href=?page=1 >首頁</a> ";
    echo "第 ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
        if ( $page-3 < $i && $i < $page+3 ) {
            echo "<a href=?page=".$i.">".$i."</a> ";
        }
    } 
    echo " 頁 <a href=?page=".$pages.">末頁</a><br /><br />";
?>
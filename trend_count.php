<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <?php
    include_once("mysql_conn.php");
    mysqli_select_db($con,"trend_count");
    $sql = "SELECT * from trend_count";
    $result=mysqli_query($con,$sql);

    while($row = mysqli_fetch_array($result))
    {
    $day[]=$row['month'];
    $count[]=intval($row['count']);
    }
    if (!empty($day) && !empty($count)){
    $day = json_encode($day);
    $data = array(array("name"=>"count","data"=>$count));
    $data = json_encode($data); //把獲取的資料物件轉換成json格式
    }
    else{echo "無法取得評論";}
    ?>

    <script type="text/javascript" src="http://cdn.hcharts.cn/jquery/jquery-1.8.3.min.js"></script>
    <script src="js/highcharts.js"></script>
    <!-- <script src="js/modules/exporting.js"></script> -->
    <script type="text/javascript">
    $(function () {
    $('#container').highcharts({
    title: {
    text: '每月評論次數統計',
    x: -20 //置中
    },
    xAxis: {
    categories: <?php echo $day; ?>
    },
    yAxis: {
    title: {
    text: '次 數'
    },
    plotLines: [{
    value: 0,
    width: 1,
    color: '#808080'
    }]
    },
    tooltip: {
    valueSuffix: ' 次'
    },
    legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'middle',
    borderWidth: 0
    },
    series: <?php echo $data; ?>
    });
    });
    </script>
    </head>
    <body>
        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </body>
</html>
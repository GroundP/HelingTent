<script>
    function alert() 
    {
        alert("예약 되었습니다!");
    }

</script>
<?php
    $name   = $_POST["name"];
    $phone = $_POST["phone"];
    $package = $_POST["package"];
    $add_time = isset($_POST["add_time"]) ? $_POST["add_time"] : 0;
    $add_item = isset($_POST["add_item"]) ? $_POST["add_item"] : "";
    $Request  = isset($_POST["Request"]) ? $_POST["Request"] : "";

    date_default_timezone_set('Asia/Seoul');

    $times = mktime();
    $startTime = date("Y-m-d H:i:s");
    $endTime = date("Y-m-d H:i:s", $times + (4 * 3600 ) + ($add_time * 3600));  

    $con = mysqli_connect("localhost", "root", "8077", "healing_tent");
    $sql = "select * from package where package_name = '".$package."'";
    
    $result = mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
    if ( !$result )
    {
        echo mysqli_error($con);
        exit;
    }

    $row = mysqli_fetch_array($result);
    $package_id = $row['id'];
    $weekday_price = $row['weekday_price'];

	$sql = "insert into client(name, phone_number, package_id, add_time, add_item_id,
    start_time, end_time, request, profit, updated_at) ";
	$sql .= "values('$name', '$phone', $package_id, $add_time, 1, '$startTime', '$endTime', '$request',$weekday_price, now())";

	$result = mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
    if ( !$result )
    {
        echo mysqli_error($con);
        exit;
    }

    mysqli_close($con);     

    echo "alert()";
    echo "
	      <script>
	          location.href = 'index.php';
	      </script>
	  ";
?>

   

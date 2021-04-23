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
    $day = date('w');
    $bWeekend = ($day == 0 || $day == 5 || $day == 6);

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
    $price = $bWeekend ? $row['weekend_price'] : $row['weekday_price'];
    $price += $bWeekend ? $add_time * 5000 : $add_time * 3000;

    if ( empty($add_item)  )
    {
        $add_item_id = 0;
    }
    else
    {
        $con = mysqli_connect("localhost", "root", "8077", "healing_tent");
        $sql = "select * from add_items where add_item = '".$add_item."'";
        
        $result = mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
        if ( !$result )
        {
            echo mysqli_error($con);
            exit;
        }
        $row = mysqli_fetch_array($result);
        $add_item_id = $row['id'];
        $price += $row['price'];
    }

	$sql = "insert into client(name, phone_number, package_id, add_time, add_item_id,
    start_time, end_time, request, profit, updated_at) ";
	$sql .= "values('$name', '$phone', $package_id, $add_time, $add_item_id, '$startTime', '$endTime', '$request', $price, now());";

    echo $sql;

	$result = mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
    if ( !$result )
    {
        echo mysqli_error($con);
        exit;
    }

    mysqli_close($con);

    echo "<script>alert('예약 되었습니다!');</script>";
    echo "
	      <script>
	          location.href = 'index.php';
	      </script>
	  ";
?>

   

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

    $now = date("Y-m-d (H:i:s)");  // 현재의 '년-월-일-시-분'을 저장

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
	$sql .= "values('$name', '$phone', $package_id, $add_time, 1, now(), now(), '$request',$weekday_price, now())";

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

   

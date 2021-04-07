<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>힐링텐트</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/main.css">
</head>
<body>
<form  name="board_form" method="post" action="board_insert.php" enctype="multipart/form-data">
    <ul id="board_form">
        <li>
            <span class="col1">이름 : </span>
            <span class="col2"><input name="name" type="text"></span>
        </li>		
        <li>
            <span class="col1">연락처 : </span>
            <span class="col2"><input name="subject" type="tel" placeholder="010-1234-5678" pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}" required></span>
        </li>
        <li>
            <span class="col1">인원수 : </span>
            <span class="col2"><input name="people" type="number" min="1" max="10" value="2"></span>
        </li>
        <li>
            <span class="col1">패키지 : </span>
            <span class="col2"><input name="subject" type="text"></span>
        </li>
        <li>
            <span class="col1">대여시간 : </span>
            <span class="col2"><input name="subject" type="number" min="1" max="10" value="2"></span>
        </li>
        <li id="text_area">	
            <span class="col1">요청사항 : </span>
            <span class="col2">
                <textarea name="content"></textarea>
            </span>
        </li>
        </ul>
    <ul class="buttons">
        <li><button type="button" onclick="check_input()">완료</button></li>
    </ul>
</form>

	<!-- <header>
    	<?php include "header.php";?>
    </header>
	<section>
	    <?php include "main.php";?>
	</section> 
	<footer>
    	<?php include "footer.php";?>
    </footer> -->
</body>
</html>

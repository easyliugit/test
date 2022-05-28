<?php
// 是否有來自其他頁面的月份參數傳遞
if (isset($_GET['month'])) {
	$month = $_GET['month'];
	$year = $_GET['year'];
} else {
	$month = date('n');
	$year = date("Y");
}

// 前後頁月份參數傳遞預設值   
switch ($month) {
	case 1:
		$prevMonth = 12;
		$prevYear = $year - 1;
		$nextMonth = $month + 1;
		$nextYear = $year;
		break;
	case 12:
		$prevMonth = $month - 1;
		$prevYear = $year;
		$nextMonth = 1;
		$nextYear = $year + 1;
		break;
	default:
		$prevMonth = $month - 1;
		$prevYear = $year;
		$nextMonth = $month + 1;
		$nextYear = $year;
}


// 設定月曆用參數 
$firstDay = $year . "-" . $month . "-1"; // 當月第一天日期"Y-m-d"
$firstWeekday = date("w", strtotime($firstDay)); // 當月第一天在星期幾
$monthDays = date("t", strtotime($firstDay)); // 當月總天數
$lastDay = $year . "-" . $month . "-" . $monthDays; // 當月最後一天日期"Y-m-d"
$lastWeekday = date("w", strtotime($lastDay)); // 當月最後一天在星期幾
$today = date("Y-m-d");
$dateHouse = [];

// 開始組合月曆存入陣列
// 當月一號以前註記空白
for ($i = 0; $i < $firstWeekday; $i++) {
	$dateHouse[] = "";
}
// 當月全部日期
for ($i = 0; $i < $monthDays; $i++) {
	$date = date("Y-m-d", strtotime("+$i days", strtotime($firstDay)));
	$dateHouse[] = $date;
}
// 當月最後一天以後註記空白
for ($i = 0; $i < (6 - $lastWeekday); $i++) {
	$dateHouse[] = "";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>線上月曆</title>
	<link rel="stylesheet" href="./css/style.css">
</head>

<body>
	<div class="calendar_body">
		<header class="header">
			<h1>使用陣列來做月曆</h1>
			<p><?php echo "要顯示的月份為" . $year . '年' . $month . '月'; ?></p>
	
			<div class='nav'>
				<span>
					<a href='index.php?year=<?= $prevYear; ?>&month=<?= $prevMonth; ?>'>上一個月</a>
				</span>
				<span><?= $year . '年' . $month . '月'; ?></span>
				<span>
					<a href='index.php?year=<?= $nextYear; ?>&month=<?= $nextMonth; ?>'>下一個月</a>
				</span>
			</div>
		</header>
		<section class="calendar_month">
			<div>一月</div>
			<div>二月</div>
			<div>三月</div>
			<div>四月</div>
			<div>五月</div>
			<div>六月</div>
			<div>七月</div>
			<div>八月</div>
			<div>九月</div>
			<div>十月</div>
			<div>十一月</div>
			<div>十二月</div>
		</section>
		<section class="calendar_day_th">
			<div>週日</div>
			<div>週一</div>
			<div>週二</div>
			<div>週三</div>
			<div>週四</div>
			<div>週五</div>
			<div>週六</div>			
		</section>
		<section class="calendar_week">
			<?php

			// 依據月曆陣列畫格子，並帶入月曆值
			foreach ($dateHouse as $k => $day) {
				// 是否為假日套用.weekend CSS樣式
				$hol = ($k % 7 == 0 || $k % 7 == 6) ? 'weekend' : "";
				echo "<div class='calendar_day'>";
				// 是否帶入日期
				if (!empty($day)) {
					$dayFormat = date("j", strtotime($day));
					echo "<span class='calendar_date'>{$dayFormat}</span>";
				} else {
					echo "<span class='calendar_date'></span>";
				}
				echo "<span class='calendar_task'>1</span>";
				echo "</div>";
			}

			?>
			<div class="calendar_day">
				<span class='calendar_date'></span>
				<span class="calendar_task"></span>
			</div>
		</section>		

	</div>
</body>

</html>
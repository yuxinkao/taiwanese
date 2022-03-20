<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>開團查詢</title>
</head>
<body>
<?php
// 建立MySQL的資料庫連接
$link = mysqli_connect("acw2033ndw0at1t7.cbetxkdyhwsb.us-east-1.rds.amazonaws.com", "z8y4hkwuta4idw8j", "hht2nnf7ny55ajx6") 
        or die("無法開啟MySQL資料庫連接!<br/>");
mysqli_select_db($link, "gk4xqozmcqv07zee");  // 選擇gk4xqozmcqv07zeev資料庫
// 設定SQL查詢字串
$sql = "SELECT * FROM delivery";
//送出UTF8編碼的MySQL指令
mysqli_query($link, 'SET NAMES utf8'); 
$records_per_page = 20;  // 每一頁顯示的記錄筆數
// 取得URL參數的頁數
if (isset($_GET["Pages"])) $pages = $_GET["Pages"];
else                       $pages = 1;
// 執行SQL查詢
$result = mysqli_query($link, $sql);
$total_fields=mysqli_num_fields($result); // 取得欄位數
$total_records=mysqli_num_rows($result);  // 取得記錄數
// 計算總頁數
$total_pages = ceil($total_records/$records_per_page);
// 計算這一頁第1筆記錄的位置
$offset = ($pages - 1)*$records_per_page;
mysqli_data_seek($result, $offset); // 移到此記錄
echo "開團總數: $total_records 團<br/>";
echo "<table border=0><tr>";
while ( $meta=mysqli_fetch_field($result) )
   echo "<td>".$meta->date."</td>";
echo "</tr>";
$j = 1;
while ($rows = mysqli_fetch_array($result, MYSQLI_NUM)
       and $j <= $records_per_page) {
   echo "<tr>";
   for ( $i = 0; $i<= $total_fields-1; $i++ )
      echo "<td>".$rows[$i]."</td>";
   echo "</tr>";
   $j++;
}
echo "</table><br>";
if ( $pages > 1 )  // 顯示上一頁
   echo "<a href='Ch11_3.php?Pages=".($pages-1).
        "'>上一頁</a>| ";
for ( $i = 1; $i <= $total_pages; $i++ )
   if ($i != $pages)
     echo "<a href=\"Ch11_3.php?Pages=".$i."\">".
          $i."</a> ";
   else
     echo $i." ";
if ( $pages < $total_pages )  // 顯示下一頁
   echo "|<a href='Ch11_3.php?Pages=".($pages+1).
        "'>下一頁</a> ";
mysqli_free_result($result);  // 釋放佔用的記憶體
mysqli_close($link);  // 關閉資料庫連接
?>
</body>
</html>


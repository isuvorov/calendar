<?php
  $date = '2014-03-01';
  $time = strtotime($date);
  // Вычисляем число дней в текущем месяце
  $dayofmonth = date('t', $time);
  // Счётчик для дней месяца
  $day_count = 1;

  // 1. Первая неделя
  $num = 0;
  for($i = 0; $i < 7; $i++)
  {
    // Вычисляем номер дня недели для числа
    $dayofweek = date('w',
                      mktime(0, 0, 0, date('m', $time), $day_count, date('Y', $time)));
    // Приводим к числа к формату 1 - понедельник, ..., 6 - суббота
    $dayofweek = $dayofweek - 1;
    if($dayofweek == -1) $dayofweek = 6;

    if($dayofweek == $i)
    {
      // Если дни недели совпадают,
      // заполняем массив $week
      // числами месяца
      $week[$num][$i] = $day_count;
      $day_count++;
    }
    else
    {
      $week[$num][$i] = "";
    }
  }

  // 2. Последующие недели месяца
  while(true)
  {
    $num++;
    for($i = 0; $i < 7; $i++)
    {
      $week[$num][$i] = $day_count;
      $day_count++;
      // Если достигли конца месяца - выходим
      // из цикла
      if($day_count > $dayofmonth) break;
    }
    // Если достигли конца месяца - выходим
    // из цикла
    if($day_count > $dayofmonth) break;
  }

  // 3. Выводим содержимое массива $week
  // в виде календаря
  // Выводим таблицу
  
  ?>
  <div class="container">
  <h1><?php echo date('F', $time); ?> <?php echo date('Y', $time); ?></h1>
  <table >
  <tr class="header">
	<td>
		Mon
	</td>
	<td>
		Tue
	</td>
	<td>
		Wen
	</td>
	<td>
		Thu
	</td>
	<td>
		Fri
	</td>
	<td class="holy">
		Sat
	</td>
	<td class="holy">
		Sun
	</td>
  </tr>
  <?php
  for($i = 0; $i < count($week); $i++)
  {
    echo "<tr>";
    for($j = 0; $j < 7; $j++)
    {
      if(!empty($week[$i][$j]))
      {
        // Если имеем дело с субботой и воскресенья
        // подсвечиваем их
        if($j == 5 || $j == 6) 
             echo "<td class='holy'>".$week[$i][$j]."</td>";
        else echo "<td>".$week[$i][$j]."</td>";
      }
      else echo "<td>&nbsp;</td>";
    }
    echo "</tr>";
  } 
  echo "</table>";
?>
<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
<style>
body{
	font-family: 'PT Sans', sans-serif;
}
table{
	border-collapse:collapse;
}
td{
	height:70px;
	width:160px;
	border:1px black solid;
	text-align:center;
	font-size:48pt;
}
.header td{
	font-size:36pt;
	
}
.holy{
	color:red;
}
h1{
	text-align:center;
}
.container{
	width:1000px;
	margin:0 auto;
}
</style>
</div>
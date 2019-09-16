<!DOCTYPE html>
<html lang="en">
<head>
	<title>Horizontal Bar Chart</title>
    <script src="js/charloader.js"></script>
</head>
<body>
<div id="chart_div" style="height: 300px;"></div>
    <?php 
          $typecluse[10][2];
          $count1=1;
          $count2=1;
          $count3=1;
          $count4=1;
          $count5=1;
          $count6=1;
          $count7=1;
          $count8=1;
          $count9=1;
          $typecluse[0][0]="สถานบริการ";
          $typecluse[0][1]=2;
          $typecluse[1][0]="การค้าประเวณี";
          $typecluse[1][1]=0;
          $typecluse[2][0]="ยาเสพติด";
          $typecluse[2][1]=0;
          $typecluse[3][0]="การพนันทั่วไป";
          $typecluse[3][1]=0;
          $typecluse[4][0]="อาวุธและวัตถุระเบิด";
          $typecluse[4][1]=0;
          $typecluse[5][0]="ลักทรัพย์";
          $typecluse[5][1]=0;
          $typecluse[6][0]="รับของโจร";
          $typecluse[6][1]=0;
          $typecluse[7][0]="ปล้นทรัพย์";
          $typecluse[7][1]=0;
          $typecluse[8][0]="อื่นๆ";
          $typecluse[8][1]=3;
    ?>
	<script>
	google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = google.visualization.arrayToDataTable([
        ['ประเภทพฤติกรรมเสี่ยง', 'จำนวนครั้ง',{ role: 'style' }],
        ['<?php echo $typecluse[0][0]?>',<?php echo $typecluse[0][1]?>,'color: #f22613'],
        ['<?php echo $typecluse[1][0]?>', <?php echo $typecluse[1][1]?>,'color: #f62459'],
        ['<?php echo $typecluse[2][0]?>', <?php echo $typecluse[2][1]?>,'color: #736598'],
        ['<?php echo $typecluse[3][0]?>', <?php echo $typecluse[3][1]?>,'color: #9a12b3'],
        ['<?php echo $typecluse[4][0]?>', <?php echo $typecluse[4][1]?>,'color: #00b5cc'],
        ['<?php echo $typecluse[5][0]?>', <?php echo $typecluse[5][1]?>,'color: #1f3a93'],
        ['<?php echo $typecluse[6][0]?>', <?php echo $typecluse[6][1]?>,'color: #2ecc71'],
        ['<?php echo $typecluse[7][0]?>', <?php echo $typecluse[7][1]?>,'color: #00e640'],
        ['<?php echo $typecluse[8][0]?>', <?php echo $typecluse[8][1]?>,'color: #f7ca18']
      ]);

      var options = {
        title: '',
        legend: { position: 'none' },
        chartArea: {width: '70%'},
        hAxis: {
          title: 'จำนวนครั้ง',
          minValue: 0
        },
        vAxis: {
          title: 'ประเภทพฤติกรรมเสี่ยง'
        }
        
      };

      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

      chart.draw(data, options);
    }
	</script>



</body>
</html>
<!--main content start-->
<style>
  .label { font-size:120%; }
</style>
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->

 
		<style type="text/css">
.highcharts-figure, .highcharts-data-table table {
    min-width: 310px; 
    max-width: 800px;
    margin: 1em auto;
}

#gontainer {
    height: 400px;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

		</style> 
 
<script src="<?php echo base_url('public/admin/') ?>code/highcharts.js"></script>
<script src="<?php echo base_url('public/admin/') ?>code/modules/exporting.js"></script>
<script src="<?php echo base_url('public/admin/') ?>code/modules/export-data.js"></script>
<script src="<?php echo base_url('public/admin/') ?>code/modules/accessibility.js"></script>

<div class="row">
	<aside class="col-lg-2">
		<a href="<?php echo base64_decode($this->input->get('source_url')) ?>">
			<button class="btn btn-white btn-xs">&laquo; Back to users</button>
		</a>
	</aside> 
	<br>
	<br>
</div>
<figure class="highcharts-figure">
    <div id="gontainer"></div>
    <!-- <p class="highcharts-description">
        A basic column chart compares rainfall values between four cities.
        Tokyo has the overall highest amount of rainfall, followed by New York.
        The chart is making use of the axis crosshair feature, to highlight
        months as they are hovered over.
    </p> -->
</figure>



		<script type="text/javascript">
Highcharts.chart('gontainer', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Progress <?php echo @$progress ?>'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
categories: [
      <?php $numItems = count($categories); $i = 0; foreach($categories as $value): ?>'<?php echo $value; ?>'<?php 
        if(++$i === $numItems) { 
          //
        } 
        else {
         echo ','; 
        } # if not last item put comma?>
      <?php endforeach; ?>
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Average Weight per month (lbs)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} lbs</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Average Weight per month',
        data: [
	      <?php $numItems = count($series_data); $i = 0; foreach($series_data as $value): ?><?php echo $value; ?><?php 
	        if(++$i === $numItems) { 
	          //
	        } 
	        else {
	         echo ','; 
	        } # if not last item put comma?>
	      <?php endforeach; ?>
        ]

    }]
});
		</script>
	</body>
</html>


        <!-- page end-->
    </section>
</section>
<!--main content end-->
 
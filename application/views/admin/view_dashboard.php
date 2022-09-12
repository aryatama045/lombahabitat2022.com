<div class="content-wrapper">

  

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <?php include 'grafik_pengunjung.php'; ?>
        </div>

      </div>
    </div>
  </section>

</div>



<script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/chart.js/Chart.min.js"></script>
<script>
  $(function() {
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData = {
      labels: <?php echo json_encode($nama); ?>,
      datasets: [{
        data: <?php echo json_encode($total); ?>,
        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc'],
      }]
    }
    var pieOptions = {
      maintainAspectRatio: !0,
      responsive: !0,
      legend: {
        display: !0,
        position: 'right'
      }
    }
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })
  })
</script>
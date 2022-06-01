
<script src="https://code.jquery.com/jquery-3.5.1.slim.js" integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/OrtacFinal./public/js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script type="text/javascript">

$(document).ready(function () {

  $('#research-list').DataTable();
  $('#student-list').DataTable();
  $('#professor-list').DataTable();
  $('#other-list').DataTable();
  $('#forum-list').DataTable();



  <?php if (isset($views)): ?>
      var pieChartCanvas = $('#visitedChart').get(0).getContext('2d')
      var pieData        = {
        labels: [
          <?php
          foreach ($views as $view) {
            ?>
              <?php echo ucwords("'" . $view['title']) . "'"?>,
            <?php
          }
          ?>
        ],
        datasets: [
          {
            data: [
              <?php
              foreach ($views as $view) {
                ?>
                  <?php echo ucwords($view['views']) ?>,
                <?php
              }
              ?>
            ],
              backgroundColor : ['#00c0ef', '#f56954', '#ff0051', '#9f3030', '#ffc63a', '#03221d', '#971498', '#1bc540', '#0f84db' ],
          }
        ]
      }
      var pieOptions     = {
        maintainAspectRatio : false,
        responsive : true,
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      var pieChart = new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
      })
      <?php endif; ?>

      <?php if (isset($downloads)): ?>
          var pieChartCanvas = $('#citedChart').get(0).getContext('2d')
          var pieData        = {
            labels: [
              <?php
              foreach ($downloads as $download) {
                ?>
                  <?php echo ucwords("'" . $download['title']) . "'"?>,
                <?php
              }
              ?>
            ],
            datasets: [
              {
                data: [
                  <?php
                  foreach ($downloads as $download) {
                    ?>
                      <?php echo ucwords($download['downloads']) ?>,
                    <?php
                  }
                  ?>
                ],
                  backgroundColor : ['#00c0ef', '#f56954', '#ff0051', '#9f3030', '#ffc63a', '#03221d', '#971498', '#1bc540', '#0f84db' ],
              }
            ]
          }
          var pieOptions     = {
            maintainAspectRatio : false,
            responsive : true,
          }
          //Create pie or douhnut chart
          // You can switch between pie and douhnut using the method below.
          var pieChart = new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
          })
          <?php endif; ?>
/////////////////////////////////////////
  var dateToday = new Date();
  var dates = $("#from, #to").datepicker({
    defaultDate: "+1w",
    changeMonth: true,
    numberOfMonths: 3,
    minDate: dateToday,
    onSelect: function(selectedDate) {
        var option = this.id == "from" ? "minDate" : "maxDate",
            instance = $(this).data("datepicker"),
            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
        dates.not(this).datepicker("option", option, date);
    }
  });



});
});

</script>


</body>
</html>

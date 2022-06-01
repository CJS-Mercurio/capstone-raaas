
<!-- Footer Starts Here -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="sub-footer">
          <p>Copyright &copy; 2021
            - Developed by 2BMT</p>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- Footer Ends Here -->




<script src="<?=base_url()?>/public/js/chart.min.js" charset="utf-8"></script>
<script src="<?=base_url()?>/public/js/jquery.min.js" charset="utf-8"></script>
<script src="<?=base_url()?>/public/assets/js/custom.js" charset="utf-8"></script>
<script src="<?=base_url()?>/public/assets/js/script.js" charset="utf-8"></script>
<script src="<?=base_url()?>/public/assets/js/accordions.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"> -->
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> -->
<script src="<?=base_url()?>/public/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/public/assets/js/jquery.slim.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.24/b-1.7.0/b-html5-1.7.0/datatables.min.js"></script>

<!-- FOR SCROLLING EFFECT -->
<script src="./public/js/nav_effect.js"></script>

</body>
</html>
<script type="text/javascript">
$(function () {
    $(document).scroll(function () {
      var $nav = $(".navbar-expand-lg");
      $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
    });
});
</script>
<script type="text/javascript">
  function myFunction() {
    var navbar = document.getElementById('navbarResponsive');
    navbar.classList.toggle('show');
  }
</script>
<script type="text/javascript">
$(document).ready(function () {

       $('#research-list').DataTable({
         responsive: true
       });
       $('#student-list').DataTable({
         responsive: true
       });
       $('#professor-list').DataTable({
         responsive: true
       });
       $('#other-list').DataTable({
         responsive: true
       });
       $('#forum-list').DataTable({
         responsive: true
       });
       $('#pResearch-list').DataTable({
         responsive: true
       });
       $('#seminar-list').DataTable({
         responsive: true
       });

});

<?php if (!empty($views)): ?>
  var pieChartCanvas = $('#visitedChart').get(0).getContext('2d')
  var pieData        = {
    labels: [
      <?php
        if($views){
          foreach ($views as $view) {
            ?>
            <?php if($view['research_status'] == 3): ?>

              <?php echo ucwords("'" . $view['title']) . "'"?>,
            <?php endif; ?>
            <?php
          }
        }
      ?>
    ],

    datasets: [
      {
        data: [
          <?php
            if($views){
              foreach ($views as $view) {
                ?>
                <?php if($view['research_status'] == 3): ?>

                  <?php echo ucwords($view['views']) ?>,
                <?php endif; ?>
                <?php
              }
            }
          ?>
        ],
          backgroundColor : ['#00c0ef', '#f56954', '#ff0051', '#9f3030', '#ffc63a', '#03221d', '#971498', '#1bc540', '#0f84db' ],
      }
    ]
  }
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  var pieChart = new Chart(pieChartCanvas, {
    type: 'bar',
    data: pieData,
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    callback: function(value) {if (value % 1 === 0) {return value;}}
                }
            }],
            xAxes: [{
                display:false,
            }]
        },
        legend: {
            display: false
         },
         tooltips: {
            enabled: true
         }
    }
  })
  <?php endif; ?>

  <?php if (!empty($downloads)): ?>
      var pieChartCanvas = $('#citedChart').get(0).getContext('2d')
      var pieData        = {
        labels: [
          <?php
          if($downloads){
            foreach ($downloads as $download) {
              ?>
                <?php if($download['research_status'] == 3): ?>
                  <?php echo ucwords("'" . $download['title']) . "'"?>,
                <?php endif; ?>
              <?php
            }
          }
          ?>
        ],
        datasets: [
          {
            data: [
              <?php
              if($downloads){
                foreach ($downloads as $download) {
                  ?>
                    <?php if($download['research_status'] == 3): ?>
                        <?php echo ucwords($download['downloads']) ?>,
                    <?php endif; ?>
                  <?php
                }
              }
              ?>
            ],
              backgroundColor : ['#00c0ef', '#f56954', '#ff0051', '#9f3030', '#ffc63a', '#03221d', '#971498', '#1bc540', '#0f84db' ],
          }
        ]
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      var pieChart = new Chart(pieChartCanvas, {
        type: 'bar',
        data: pieData,
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {if (value % 1 === 0) {return value;}}
                    }
                }],
                xAxes: [{
                    display:false,
                }]
            },
            legend: {
                display: false
             },
             tooltips: {
                enabled: true
             }
        }
      })
      <?php endif; ?>

      <?php if (!empty($category)): ?>
          var categoryCanvas = $('#categoryChart').get(0).getContext('2d')
          var categoryData        = {
            labels: [
              <?php
              if($category){
                foreach ($category as $c) {
                  ?>
                      <?php echo ucwords("'". $c['category'])."'"?>,
                  <?php
                }
              }
              ?>
            ],
            datasets: [
              {
                data: [
                  <?php
                  if($category){
                    foreach ($category as $c) {
                      ?>
                        <?php echo ucwords($c['number']) . '' ?>,
                      <?php
                    }
                  }
                  ?>
                ],
                  backgroundColor : ['#00c0ef', '#f56954', '#ff0051', '#9f3030', '#ffc63a', '#03221d', '#971498', '#1bc540', '#0f84db' ],
              }
            ]
          }
          //Create pie or douhnut chart
          // You can switch between pie and douhnut using the method below.
          var category = new Chart(categoryCanvas, {
              type: 'bar',
            data: categoryData,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) {if (value % 1 === 0) {return value;}}
                        }
                    }],
                    xAxes: [{
                        display:false,
                    }]
                },
                legend: {
                    display: false
                 },
                 tooltips: {
                    enabled: true
                 }
            }
          })
          <?php endif; ?>


</script>

<script language = "text/Javascript">
  cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
  function clearField(t){                   //declaring the array outside of the
  if(! cleared[t.id]){                      // function makes it static and global
      cleared[t.id] = 1;  // you could use true and false, but that's more typing
      t.value='';         // with more chance of typos
      t.style.color='#fff';
      }
  }
  </script>

  <script type="text/javascript">

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

  </script>

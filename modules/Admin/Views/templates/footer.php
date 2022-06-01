
</div>
<!-- /#wrapper -->
<script src="<?=base_url()?>/public/js/chart.min.js" charset="utf-8"></script>
<script src="<?=base_url()?>/public/js/jquery.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"> -->
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.24/b-1.7.0/b-html5-1.7.0/datatables.min.js"></script>


<script>

$(".sidebar-dropdown > a").click(function() {
  $(".sidebar-submenu").slideUp(200);
  if (
    $(this)
      .parent()
      .hasClass("active")
  ) {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .parent()
      .removeClass("active");
  } else {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .next(".sidebar-submenu")
      .slideDown(200);
    $(this)
      .parent()
      .addClass("active");
  }
});

window.onload = function () {

// Construct options first and then pass it as a parameter
var options1 = {
	animationEnabled: true,
	title: {
		text: "Chart inside a jQuery Resizable Element"
	},
	data: [{
		type: "column", //change it to line, area, bar, pie, etc
		legendText: "Try Resizing with the handle to the bottom right",
		showInLegend: true,
		dataPoints: [
			{ y: 10 },
			{ y: 6 },
			{ y: 14 },
			{ y: 12 },
			{ y: 19 },
			{ y: 14 },
			{ y: 26 },
			{ y: 10 },
			{ y: 22 }
			]
		}]
};

$("#resizable").resizable({
	create: function (event, ui) {
		//Create chart.
		$("#chartContainer1", "#chartContainer2", "#chartContainer3").CanvasJSChart(options1);
	},
	resize: function (event, ui) {
		//Update chart size according to its container size.
		$("#chartContainer1", "#chartContainer2", "#chartContainer3").CanvasJSChart().render();
	}
});

}
</script>


<script>

  $.ajax({
    url: 'reports/perYearGraph',
    type: 'GET',
    success: function(data) { //
      const report = JSON.parse(data); //

      const school_year = []; //
      const number = [];

      for(var i in report) {
        school_year.push(report[i].school_year);
        number.push(report[i].count);
      }

      const ctx = $("#perYearGraph");
      const graph = new Chart(ctx, {
        type: 'line',
        data: {
          labels: school_year,
          datasets: [{ //
            label: '# of research',
            data: number,
            backgroundColor: '#00CC00',
            fill: false,
            borderColor: '#00CC00',
            borderWidth: 5
          }]
        },
    //confi
    options: {
      responsive: true,
         scales: {
             yAxes: [{
                 ticks: {
                     beginAtZero: true,
                     stepSize: 1
                 }
             }]
         }
     }
      });
    }
  });

  $.ajax({
    url: 'reports/perCourseGraph',
    type: 'GET',
    success: function(data) { //
      const report = JSON.parse(data); //

      const courses = []; //
      const number = [];
      for(var i in report) {
        courses.push(report[i].course);
        number.push(report[i].count);
      }

      const ctx = $("#perCourseGraph");
      const graph = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: courses,
          datasets: [{ //
            label: '# of research',
            data: number,
            borderColor: '#1b2021',
            backgroundColor: ["#FF9900", "#FF0000", "#000099", "#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"],
            borderWidth: 1
          }]
        },
    //confi
        options: {
             scales: {
                 yAxes: [{
                     ticks: {
                         beginAtZero: true,
                         stepSize: 1
                     }
                 }]
             }
         }
      });
    }
  });

  $.ajax({
    url: 'reports/perAdviserGraph',
    type: 'GET',
    success: function(data) { //
      const report = JSON.parse(data); //

      const adviser = []; //
      const number = [];

      for(var i in report) {
        adviser.push(report[i].adviser);
        number.push(report[i].count);
      }

      const ctx = $("#perAdviserGraph");
      const graph = new Chart(ctx, {
        type: 'line',
        data: {
          labels: adviser,
          datasets: [{ //
            label: '# of research',
            data: number,
            backgroundColor: '#FFC107',
            fill: false,
            borderColor: '#FFC107',
            borderWidth: 5
          }]
        },
        options: {
             scales: {
                 yAxes: [{
                     ticks: {
                         beginAtZero: true,
                         stepSize: 1
                     }
                 }]
             }
         }
      });
    }
  });

    $('#downloadPdf').click(function(event) {
    // get size of report page
    var reportPageHeight = $('#reportPage').innerHeight();
    var reportPageWidth = $('#reportPage').innerWidth();

    // create a new canvas object that we will populate with all other canvas objects
    var pdfCanvas = $('<canvas />').attr({
      id: "canvaspdf",
      width: reportPageWidth,
      height: reportPageHeight
    });

    // keep track canvas position
    var pdfctx = $(pdfCanvas)[0].getContext('2d');
    var pdfctxX = 0;
    var pdfctxY = 0;
    var buffer = 100;

    // for each chart.js chart
    $("canvas").each(function(index) {
      // get the chart height/width
      var canvasHeight = $(this).innerHeight();
      var canvasWidth = $(this).innerWidth();

      // draw the chart into the new canvas
      pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
      pdfctxX += canvasWidth + buffer;

      // our report page is in a grid pattern so replicate that in the new canvas
      if (index % 2 === 1) {
        pdfctxX = 0;
        pdfctxY += canvasHeight + buffer;
      }
    });

    // create new pdf and add our new canvas as an image
    var pdf = new jsPDF('l', 'in', [14, 8]);
    pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);

    // download the pdf
    pdf.save('report.pdf');
  });

    $(document).ready( function () {
    	 $('#course-list').DataTable();
     	 $('#faculty-list').DataTable();
       $('#researchHome-list').DataTable();
     	 $('#research-list').DataTable();
       $('#student-list').DataTable();
       $('#professor-list').DataTable();
       $('#other-list').DataTable();
       $('#pendingResearch-list').DataTable();


   });
</script>

<script type="text/javascript">
$(document).ready(function(){
  $('[data-toggle="popover"]').popover();
});
</script>

</body>
</html>

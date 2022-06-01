
<script src="https://code.jquery.com/jquery-3.5.1.slim.js" integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>/public/js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.24/b-1.7.0/b-html5-1.7.0/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="<?= base_url() ?>/public/chart/Chart.min.js"></script>
<script type="text/javascript">
  function myFunction() {
    var navbar = document.getElementById('navbarResponsive');
    navbar.classList.toggle('show');
  }
</script>
<script type="text/javascript">

$(document).ready(function () {
  $('#research-list').DataTable();
  $('#student-list').DataTable();
  $('#professor-list').DataTable();
  $('#other-list').DataTable();
  $('#forum-list').DataTable();
  $('#pResearch-list').DataTable();
  $('#seminar-list').DataTable();


});


  function scan(){
    const slug = $("#slug").val();
    $.ajax({
      type: 'GET',
      data:{
        'slug': slug
      },
      url: 'research/scan',
      dataType: 'JSON',
      success: function(data){
        console.log(data)
        if (data['info'] == false) {
          Swal.fire({
            title: 'Research not found',
            icon: 'error',
          });
        }
        else {
          Swal.fire({
            title: 'Research found',
            icon:  'success',
            html: '<b>Title: </b>' + data[0]['title'] + '<br> <b>Date Uploaded: </b>' + moment(data[0]['created_at']).format('MM/DD/YYYY'),
            footer:`<a href='<?= base_url().'/research/viewResearchHome/'?>`+data[0]['id']+`'>Click here to view the full research</a>`
          });
        }
      }
    });
  }



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

</body>
</html>

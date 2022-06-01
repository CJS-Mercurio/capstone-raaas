</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.js" integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {

       $('#research-list').DataTable();
       $('#research_student-list').DataTable();
       $('#seminar-list').DataTable();
       $('#pResearch-list').DataTable();


       var trigger = $('.hamburger'),
           overlay = $('.overlay'),
          isOpen = true;

         trigger.click(function () {
           hamburger_cross();
         });

         function hamburger_cross() {

           if (isOpen == true) {
             overlay.hide();
             trigger.removeClass('is-open');
             trigger.addClass('is-closed');
             isOpen = false;
           } else {
             overlay.show();
             trigger.removeClass('is-closed');
             trigger.addClass('is-open');
             isOpen = true;
           }
       }

$('[data-toggle="offcanvas"]').click(function () {
      $('#wrapper').toggleClass('toggled');
});
});

</script>


</body>
</html>

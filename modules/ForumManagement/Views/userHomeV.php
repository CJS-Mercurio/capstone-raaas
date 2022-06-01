<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/student">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">List of Research</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="flexbox">
  <div class="fav-btn">
    <span href="" class="favme dashicons dashicons-heart"></span>
  </div>
</div>
</div>

  <div class="container-fluid form">

    <div class="row">
      <div class="col-lg-12 form-col">
       <table class = "table table-bordered table-striped" id = "forum-list">

         <h3 style="color: black ">Conferences, Meetings and Seminars</h3>
         <thead>
           <tr>
             <th>Title</th>
             <th>Location</th>
             <th>Month</th>
             <th>Action</th>
           </tr>
         </thead>
         <tbody>
           <?php if($forum_view): ?>
             <?php foreach($forum_view as $f): ?>
              <?php if($f['status'] == 3): ?>
               <?php if($f['deleted_at'] == NULL): ?>
                   <tr>
                     <td> <?php echo $f['title']; ?> </td>
                     <td> <?php echo $f['location']; ?> </td>
                     <td> <?php echo date("F", strtotime($f['dateFrom']))?></td>

                         <td>
                             <form method="post" action="<?=base_url()?>/forum/viewUserForum/<?= $f['id'] ?>">
                              <button type="submit" class="btn btn-info fa fa-eye"></button>

                             </form>

                         </td>
                   </tr>
                 <?php endif; ?>
                <?php endif; ?>
             <?php endforeach; ?>
           <?php endif; ?>
         </tbody>
       </table>

    </div>
	</div>
</div>

<div class="container-fluid mt-5">
  <div class="row">
    <div class="col-lg-12 prof-form">

  <?php foreach ($allowed_task as $at): ?>
    <?php if($at['tid'] == 17): ?>
      <button type="button" class="btn btn-warning approve-btn mb-4" onclick="document.location = '<?=base_url()?>/research/profApproval'">To approve researches</button>
    <?php endif; ?>
  <?php endforeach; ?>

  <?php foreach ($allowed_task as $at): ?>
    <?php if($at['tid'] == 7): ?>
      <button type="button" class="btn btn-warning approve-btn mb-4" onclick="document.location = '<?=base_url()?>/research/adminApproval'">To approve researches</button>
    <?php endif; ?>
  <?php endforeach; ?>
  <?php $status = 0; ?>

  <?php if($allowed_task): ?>
      <?php foreach($allowed_task as $at): ?>
        <?php if($at['tid'] == 9): ?>
            <?php $status = 1; ?>
            <div class="container-header">
              <label for="">List of Researches</label>
            </div>

            <button type="button" class="btn btn-outline-dark mb-4" onclick="document.location = '<?=base_url()?>/home'">All Researches</button>
            <button type="button" class="btn btn-outline-dark mb-4" onclick="document.location = '<?=base_url()?>/research/getStudentResearch'">Student Researches</button>
            <button type="button" class="btn btn-outline-dark mb-4" onclick="document.location = '<?=base_url()?>/research/getProfResearch'">Professor Researches</button>

               <div class="mt-3">
                 <div class="row">

                 <?php if($document): ?>
                   <?php foreach ($document as $r): ?>
                     <?php if($r['research_status'] == 3): ?>
                         <div class="col-md">
                           <div class="card mt-3" style="width: 20rem;">
                              <div class="card-body">
                                <h5 class="card-title"><?php echo $r['title']; ?></h5>
                                <hr>
                                <p class="card-text"><?php echo $r['abstract']; ?></p>
                                <form method="post" action="<?=base_url()?>/research/viewResearchHome/<?= $r['id'] ?>">
                                  <button type="submit" class="btn btn-info">View</button>
                                </form>



                                <!-- <label for="id-of-input" class="custom-checkbox">
                                  <input type="checkbox" id="id-of-input"/>
                                  <i class="glyphicon glyphicon-star-empty"></i>
                                  <i class="glyphicon glyphicon-star"></i>
                                </label> -->

                                 <input type="hidden" name="document_id" id="document_id" value="<?= $r['id']; ?>">
                              </div>
                            </div>
                         </div>
                     <?php endif; ?>


                   <?php endforeach; ?>
                 <?php endif; ?>

          </div>
          <?php endif; ?>
     <?php endforeach; ?>
   <?php endif; ?>
   <?php if($status == 0): ?>
     <center><h3>Welcome to Research Archiving and Approval System</h3></center>
   <?php endif; ?>
  </div>
</div>
</div>


<script>

$(document).ready(function() {
  $('#favorite').on('click', function() {
      $("#favorite").attr("disabled", "disabled");
      var user_id = $('#user_id').val();
      var research_id = $('#research_id').val();
      if(user_id!="" && document_id!=""){
  			$.ajax({
  				url: ".php",
  				type: "POST",
  				data: {
  					user_id: user_id,
  					document_id: document_id,
  				},
  				cache: false,
  				success: function(dataResult){
  					var dataResult = JSON.parse(dataResult);
  					if(dataResult.statusCode==200){
  						$("#favorite").removeAttr("disabled");
  						$('#fupForm').find('input:text').val('');
  						$("#success").show();
  						$('#success').html('Data added successfully !');
  					}
  					else if(dataResult.statusCode==201){
  					   alert("Error occured !");
  					}

  				}
  			});
  		}
  		else{
  			alert('Please fill all the field !');
  		}
  });
});

</script>

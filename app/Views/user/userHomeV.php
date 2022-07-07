<div class="container breadcrumb-container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">List of Research</li>
        </ol>
      </nav>
    </div>
  </div>
</div>


<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 form-col">

      <?php if($allowed_task): ?>
        <?php foreach ($allowed_task as $at): ?>
          <?php if($at['tid'] == 17 && $at['deleted_at'] == NULL): ?>
            <button type="button" class="btn btn-primary approve-btn float-right btn-sm" onclick="document.location = '<?=base_url()?>/research/profApproval'"><i class="fas fa-tasks"></i> Research Approval</button>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>

      <?php if($allowed_task): ?>
        <?php foreach ($allowed_task as $at): ?>
          <?php if($at['tid'] == 7 && $at['deleted_at'] == NULL): ?>
            <button type="button" class="btn btn-primary approve-btn float-right btn-sm" onclick="document.location = '<?=base_url()?>/research/adminApproval'"><i class="fas fa-tasks"></i> Research Approval</button>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>

        <?php $status = 0; ?>

        <h3>List of Researches</h3>
        <div class="container-table">
          <?php if($allowed_task): ?>
            <?php foreach($allowed_task as $at): ?>
              <?php if($at['tid'] == 9): ?>
                <?php $status = 1; ?>
                <table class="table table-responsive" id="research-list">
                  <thead>
                    <tr>
                      <th class="table-header">Researches</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($document): ?>
                      <?php foreach($document as $r): ?>
                        <?php if($r['research_status'] == 3 && $r['deleted_at'] == null): ?>
                          <tr>
                            <td>
                              <div class="row">
                                <div class="col-10">
                                  <p class="research-title">
                                      <a class="text-primary" href="<?=base_url()?>/research/viewResearchHome/<?= $r['did']?>"> <?php echo $r['title']; ?></a>
                                  </p>
                                  <p class="course">
                                    <b class="text-success">
                                      <?php echo $r['course_name']; ?>
                                    </b>
                                  </p>
                                  <?php if(empty($r['abstract'])): ?>
                                    <p class="text-secondary no-abstract">No abstract available</p>
                                  <?php else: ?>
                                    <p class="abstract"><?php echo mb_strimwidth($r['abstract'], 0, 150, "...") ?></p>
                                  <?php endif; ?>
                                  <p class="keywords">
                                        <?php if($r['keywords']): ?>
                                        <b>Keywords: </b><?php echo $r['keywords']; ?>
                                        <?php else: ?>
                                        <b>Keywords: </b>Not Available
                                        <?php endif; ?>
                                  </p>
                                  <div class="row">

                                    <?php if($r['category_id']): ?>
                                      <?php echo $r['category_id']; ?>
                                    <?php endif; ?>
                                    <!-- <?php if(empty($r['downloads'])):?>
                                      <p class="text-primary cited">
                                        Not yet cited
                                    <?php else:?>
                                        Cited by </p>
                                      <?php echo $r['downloads'] ?>
                                    <?php endif;?> -->
                                    <p class="text-primary school-year">
                                      S.Y. <?php echo $r['school_year'];?>
                                    </p>

                                 </div>
                                  </div>
                                <div class="col text-primary type-col">
                                  <p class="type"><b> <?php echo "[" . $r['type']. "]"?></b></p>
                                </div>
                              </div>
                            </div>


                            </td>

                          </tr>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    <?php endif; ?>

                  </tbody>
                </table>

              <?php endif; ?>
            <?php endforeach; ?>
          <?php endif; ?>


          <?php if($status == 0): ?>
            <center><h3>Welcome to Research Archiving and Approval System</h3></center>
          <?php endif; ?>
        </div>
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

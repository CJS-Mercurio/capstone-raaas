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

  <div class="container-fluid form">
    <div class="row">
      <div class="col-lg-12 form-col">
        <h3>List of Researches</h3>
    <?php $status = 0; ?>

    <?php if($allowed_task): ?>
        <?php foreach($allowed_task as $at): ?>
          <?php if($at['tid'] == 9): ?>
              <?php $status = 1; ?>

              <button type="button" class="btn btn-outline-dark mb-4" onclick="document.location = '<?=base_url()?>/research/adminApproval'">All Researches</button>
              <button type="button" class="btn btn-outline-dark mb-4" onclick="document.location = '<?=base_url()?>/research/listStudent'">Student Researches</button>
              <button type="button" class="btn btn-outline-dark mb-4" onclick="document.location = '<?=base_url()?>/research/listProf'">Professor Researches</button>

                 <div class="mt-3">
                   <table class="table table-bordered table-striped" id="research-list">
                     <thead>
                       <tr>
                         <th>Id</th>
                         <th>Research Title</th>
                         <th>Keyword</th>
                         <th>School Year</th>
                         <th>Status</th>
                         <th>Action</th>
                       </tr>
                     </thead>
                     <tbody>


                    <?php if($list_res): ?>

      		              <?php foreach($list_res as $r): ?>
                          <!--  && $r['research_status'] != 3 && $r['deleted_at'] == null -->
                    			<?php if($r['research_status'] == 1 || $r['research_status'] == 0): ?>
      			              <tr>
      			                 <td><?php echo $r['id']; ?></td>
      			                 <td><?php echo $r['title']; ?></td>
      			                 <td><?php echo $r['keywords']; ?></td>
      			                 <td><?php echo $r['school_year']; ?></td>

                               <?php if($r['research_status'] == 0): ?>
                                  <td>Waiting for Adviser approval</td>
                               <?php else: ?>
                                 <td>Waiting for Admin approval</td>
                               <?php endif; ?>
      			                 <td>
                               <form method="post" action="<?=base_url()?>/research/adminViewRes/<?= $r['id'] ?>">
                                <button type="submit" class="btn btn-info">View</button>
                              </form>
                             </td>
      			               </tr>
                     			<?php endif; ?>
      		             <?php endforeach; ?>
                     <?php endif; ?>
                 </tbody>
               </table>
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

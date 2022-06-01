<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Approve Researches</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

  <div class="container-fluid form">
    <div class="row">
      <div class="col-lg-12 form-col">

        <?php $status = 0; ?>

      <?php if($allowed_task): ?>
          <?php foreach($allowed_task as $at): ?>
            <?php if($at['tid'] == 9): ?>
                <?php $status = 1; ?>
                  <h3>List of Researches</h3>

                <?php if($document): ?>
                <?php $ctr =1; ?>
                <!-- <button type="button" class="btn btn-outline-dark mb-4" onclick="document.location = '<?=base_url()?>/research/adminApproval'">All Researches</button>
                <button type="button" class="btn btn-outline-dark mb-4" onclick="document.location = '<?=base_url()?>/research/listStudent'">Student Researches</button>
                <button type="button" class="btn btn-outline-dark mb-4" onclick="document.location = '<?=base_url()?>/research/listProf'">Professor Researches</button> -->
                      <?php if(session()->getTempdata('approved')): ?>
                       <div class="alert alert-success">
                         <?= session()->getTempdata('approved'); ?>
                       </div>
                      <?php endif; ?>

                      <?php if(session()->getTempdata('disapproved')): ?>
                       <div class="alert alert-success">
                         <?= session()->getTempdata('disapproved'); ?>
                       </div>
                      <?php endif; ?>

                     <table class="table table-bordered" id="forum-list">
                       <thead>
                         <tr>
                           <th class="hidden">#</th>
                           <th class="hidden">Research ID</th>
                           <th>Research Title</th>
                           <th class="hidden">Keyword</th>
                           <th>School Year</th>
                           <th>Status</th>
                         </tr>
                       </thead>
                       <tbody>
                          <?php $bool = false; ?>
        		              <?php foreach($document as $r): ?>
                      			<?php if($r['research_status'] == 1): ?>
                            <?php $bool = true; ?>
        			              <tr>
        			                 <td class="hidden"><?php echo $ctr++; ?></td>
        			                 <td class="hidden"><?php echo $r['did']; ?></td>
        			                 <td>
                                 <a class="text-primary forum-research-title" href="<?=base_url()?>/research/adminViewRes/<?= $r['did'] ?>">
                                  <?php echo $r['title']; ?>
                                </a>
                               </td>
        			                 <td class="hidden"><?php echo $r['keywords']; ?></td>
        			                 <td><?php echo $r['school_year']; ?></td>
                               <td>Waiting for Approval</td>
        			                 <!-- <td>
                                 <form method="post" action="<?=base_url()?>/research/adminViewRes/<?= $r['did'] ?>">
                                  <button type="submit" class="btn btn-info">View</button>
                                </form>
                               </td> -->
          			              </tr>
                              <tbody class="collapse" id="collapse">
                                <tr>
                                  <th scope="row">Keywords: </th>
                                  <td colspan="2"><?php echo $r['keywords']; ?></td>
                                </tr>
                                <tr>
                                  <th scope="row">School Year:</th>
                                  <td colspan="2"><?php echo $r['school_year']; ?></td>
                                </tr>
                              </tbody>
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

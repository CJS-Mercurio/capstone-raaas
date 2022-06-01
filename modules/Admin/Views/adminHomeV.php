<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">List of Researches</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

  <div class="container-fluid form">
    <div class="row">
      <div class="col-lg-12 form-col">
        <h3>List of Researches</h3>
    <?php if($allowed_task): ?>
       <?php foreach($allowed_task as $at): ?>
           <?php if($at['tid'] == 1): ?>
           <?php endif; ?>
      <?php endforeach; ?>
    <?php endif; ?>

    <?php if($allowed_task): ?>
       <?php foreach($allowed_task as $at): ?>
           <?php if($at['tid'] == 2): ?>
                  <button type="button" class="btn btn-outline-dark" onclick="document.location = '<?=base_url()?>/admin'">All Researches</button>
                  <button type="button" class="btn btn-outline-dark" onclick="document.location = '<?=base_url()?>/admin/getStudentResearch'">Student Researches</button>
                  <button type="button" class="btn btn-outline-dark" onclick="document.location = '<?=base_url()?>/admin/getProfResearch'">Professor Researches</button>
                  <button type="button" class="btn btn-warning approve-btn ml-auto" onclick="document.location = '<?=base_url()?>/admin/pending'">To approve researches</button>

                     <div class="mt-2">
                       <table class="table table-bordered table-striped" id="research-list">
                         <thead>
                           <tr>
                             <th>Code</th>
                             <th>Research Title</th>
                             <th>Keyword</th>
                             <th>School Year</th>
                             <th>Action</th>
                           </tr>
                         </thead>
                         <tbody>


                        <?php if($research): ?>

          		              <?php foreach($research as $r): ?>
                        			<?php if($r['research_status'] != 0): ?>
          			              <tr>
          			                 <td><?php echo $r['id']; ?></td>
          			                 <td><?php echo $r['title']; ?></td>
          			                 <td><?php echo $r['keywords']; ?></td>
          			                 <td><?php echo $r['school_year']; ?></td>

          			                 <td>
                                   <form method="post" action="<?=base_url()?>/admin/viewResearch/<?= $r['id'] ?>">
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
              </div>
            <?php endif; ?>
         <?php endforeach; ?>
     <?php endif; ?>
	</div>
</div>

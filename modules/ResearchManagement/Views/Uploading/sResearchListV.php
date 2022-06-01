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
    <div class="row">
      <?php if($allowed_task): ?>
         <?php foreach($allowed_task as $at): ?>
             <?php if($at['tid'] == 7): ?>
               <button type="button" class="btn btn-warning approve-btn mb-4" onclick="document.location = '<?=base_url()?>/research/adminApproval'">To approve researches</button>
             <?php elseif($at['tid'] == 17): ?>
               <button type="button" class="btn btn-warning approve-btn mb-4" onclick="document.location = '<?=base_url()?>/research/profApproval'">To approve researches</button>

             <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>
      <div class="col-lg-12 admin-form mb-3">
        <div class="header">
          <h3 class="std-header mb-3">List of Researches</h3>
        </div>

        <button type="button" class="btn btn-outline-dark mb-4" onclick="document.location = '<?=base_url()?>/home'">All Researches</button>
        <button type="button" class="btn btn-outline-dark mb-4" onclick="document.location = '<?=base_url()?>/research/getStudentResearch'">Student Researches</button>
        <button type="button" class="btn btn-outline-dark mb-4" onclick="document.location = '<?=base_url()?>/research/getProfResearch'">Professor Researches</button>

           <div class="mt-3">
             <table class="table table-bordered table-striped" id="research-list">
               <thead>
                 <tr>
                   <th>Code</th>
                   <th>Research Title</th>
                   <th>Keyword</th>
                   <th>Course</th>
                   <th>School Year</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>


              <?php if($stud_research): ?>

                  <?php foreach($stud_research as $r): ?>
                    <?php if($r['research_status'] != 0 && $r['research_status'] != 3 && $r['deleted_at'] == null): ?>
                    <tr>
                       <td><?php echo $r['id']; ?></td>
                       <td><?php echo $r['title']; ?></td>
                       <td><?php echo $r['keywords']; ?></td>
                       <td><?php echo $r['course_name']; ?></td>
                       <td><?php echo $r['school_year']; ?></td>
                       <td>
                         <form method="post" action="<?=base_url()?>/research/viewResearchHome/<?= $r['id'] ?>">
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
  </div>
</div>

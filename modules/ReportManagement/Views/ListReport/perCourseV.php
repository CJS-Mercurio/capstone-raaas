<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/report">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/report/reports">Report</a></li>
          <li class="breadcrumb-item active" aria-current="page">Generate Per Course</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

  <div class="container-fluid form">
    <div class="row">
      <div class="col-lg-12 form-col">
        <a href="<?=base_url()?>/report/reportPerCoursePdf/<?=$sy['year_start'].'/'.$sy['year_end'].'/'.$sy['course_id']?>" target="_blank" class="btn btn-success btn-sm float-right std-researchV-btn mb-3">
          <i class="fa fa-download std-researchV-icon"></i> Download as PDF </a>
        <a href="<?=base_url()?>/report/reportPerCourseCsv/<?=$sy['year_start'].'/'.$sy['year_end']. '/'.$sy['course_id']?>" class="btn btn-success btn-sm float-right std-researchV-btn mb-3 mr-1">
          <i class="fa fa-download std-researchV-icon"></i> Download as CSV </a>
          <h3><?php echo ucwords($sy['course_name']). " Researches (". $sy['year_start']. "-". $sy['year_end']. ")";?></h3>
        <?php if($research): ?>

           <div class="mt-3">
             <table class="table table-bordered table-striped" id="research-list">
               <thead>
                 <tr>
                   <th>Research Title</th>
                   <th>School Year</th>
                 </tr>
               </thead>
               <tbody>

                <?php foreach($research as $r): ?>
                    <?php if($r['research_status'] != 0 && $r['research_status'] != 2 && $r['research_status'] != 4 && $r['deleted_at'] == null): ?>
                    <tr>
                       <td><?php echo $r['title']; ?></td>
                       <td><?php echo $r['school_year'];?></td>

                     </tr>
                    <?php endif; ?>
                 <?php endforeach; ?>
               <?php else: ?>
                 <div class="alert alert-dark" role="alert">
                  No data found
                 </div>
               <?php endif; ?>

           </tbody>
         </table>
      </div>
    </div>
  </div>
</div>

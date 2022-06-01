<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin/reports">Report</a></li>
          <li class="breadcrumb-item active" aria-current="page">Generate Per Course</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 superadmin-form">
        <div class="header">
          <h3 class="admin-header mb-3"><?php echo ucwords($sy['course_name']). " Researches (". $sy['year_start']. "-". $sy['year_end']. ")";?></h3>
        </div>

        <a href="<?=base_url()?>/admin/reportByCoursePdf/<?=$sy['year_start'].'/'.$sy['year_end'].'/'.$sy['course_id']?>" target="_blank" class="btn btn-success float-right std-researchV mb-3">
          <i class="fa fa-download std-researchV-icon"></i> Download as PDF </a>
        <a href="<?=base_url()?>/admin/reportPerCourseCsv/<?=$sy['year_start'].'/'.$sy['year_end']. '/'.$sy['course_id']?>" target="_blank" class="btn btn-success float-right std-researchV mb-3 mr-3">
          <i class="fa fa-download std-researchV-icon"></i> Download as CSV </a>

           <div class="mt-3">
             <table class="table table-bordered table-striped" id="">
               <thead>
                 <tr>
                   <th>Code</th>
                   <th>Research Title</th>
                   <th>School Year</th>
                 </tr>
               </thead>
               <tbody>



              <?php if($research): ?>
                <?php foreach($research as $r): ?>
                    <?php if($r['research_status'] != 0 && $r['research_status'] != 3 && $r['deleted_at'] == null): ?>
                    <tr>
                       <td><?php echo $r['id']; ?></td>
                       <td><?php echo $r['title']; ?></td>
                       <td><?php echo $r['school_year'];?></td>

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

<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/report">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/report/reports">Report</a></li>
          <li class="breadcrumb-item active" aria-current="page">List</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 form-col">
      <a href="<?=base_url()?>/report/reportAllCoursePdf/<?=$sy['year_start'].'/'.$sy['year_end'].'/0'?>" target="_blank" class="btn btn-success btn-sm float-right std-researchV-btn mb-3">
        <i class="fa fa-download std-researchV-icon"></i> Download as PDF </a>
      <a href="<?=base_url()?>/report/reportAllCourseCsv/<?=$sy['year_start'].'/'.$sy['year_end']?>" target="_blank" class="btn btn-success btn-sm float-right std-researchV-btn mb-3 mr-1">
        <i class="fa fa-download std-researchV-icon"></i> Download as CSV </a>
      <h3><?php echo "List of Researches (". $sy['year_start']. "-". $sy['year_end']. ")";?>
      </h3>


  <?php if($research): ?>


      <?php $ctr=0; ?>
       <?php foreach($research as $r): ?>

        <?php if($r['id'] == $ctr): ?>
          <?php $loop = true; ?>
        <?php endif; ?>

        <?php if($r['id'] > $ctr): ?>
          <?php $loop = false; $ctr = $r['id']; ?>
        <?php endif; ?>

<?php if($loop == false): ?>

  <table class="table table-bordered table-striped researches-table" id="">

  <div class="course-list mt-5 mb-3">
    <button type="button" class="btn" data-toggle="tooltip" data-placement="top" title="See more">
      <a class="course-link" href="<?=base_url()?>/report/listCourse/<?=$sy['year_start'].'/'.$sy['year_end'].'/'.$r['course_id']?>"><?php echo ucwords($r['course_name']); ?></a>
    </button>
  </td>
  </div>

       <thead>
         <tr>
           <th>Research Title</th>
           <th style="width: 30%; ">School Year</th>

         </tr>
       </thead>

         <tbody>
           <?php $counter = 0; ?>
            <?php foreach($research as $r): ?>
              <?php if($r['research_status'] != 0 && $r['research_status'] != 2 && $r['research_status'] != 4 && $r['deleted_at'] == null): ?>
                <?php if($counter < 5): ?>
                   <?php if($r['id'] == $ctr): ?>
                    <tr>
                      <?php $counter += 1; ?>
                       <td><?php echo $r['title']; ?></td>
                       <td><?php echo $r['school_year'];?></td>

                     </tr>

                    <?php else: ?>
                      <?php $loop = true; ?>
                    <?php endif; ?>
                  <?php endif;  ?>

              <?php endif; ?>
           <?php endforeach; ?>
         </tbody>
  <?php endif; ?>


    <?php endforeach; ?>
  <?php else: ?>
    <div class="alert alert-dark" role="alert">
     No data found
    </div>
<?php endif; ?>
  </table>
  </div>
</div>
</div>

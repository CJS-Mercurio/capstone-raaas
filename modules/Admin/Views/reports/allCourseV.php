<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin/reports">Report</a></li>
          <li class="breadcrumb-item active" aria-current="page">List</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 superadmin-form">
      <div class="header">
        <h3 class="admin-header mb-3"><?php echo "List of Researches (". $sy['year_start']. "-". $sy['year_end']. ")";?>
        </label>
      </div>

      <a href="<?=base_url()?>/admin/reportAllCoursePdf/<?=$sy['year_start'].'/'.$sy['year_end'].'/0'?>" target="_blank" class="btn btn-success float-right std-researchV mb-3">
        <i class="fa fa-download std-researchV-icon"></i> Download as PDF </a>
      <a href="<?=base_url()?>/admin/reportAllCourseCsv/<?=$sy['year_start'].'/'.$sy['year_end']?>" target="_blank" class="btn btn-success float-right std-researchV mb-3 mr-3">
        <i class="fa fa-download std-researchV-icon"></i> Download as CSV </a>

        <table class="table table-bordered table-striped" id="">

             <thead>
               <tr>
                 <th>Course</th>
                 <th>Id</th>
                 <th>School Year</th>
                 <th>Research Title</th>
               </tr>
             </thead>

        <?php if($research): ?>
         <div class="mt-3">
          <?php $ctr=0; ?>
           <?php foreach($research as $r): ?>

            <?php if($r['id'] == $ctr): ?>
              <?php $loop = true; ?>
            <?php endif; ?>

            <?php if($r['id'] > $ctr): ?>
              <?php $loop = false; $ctr = $r['id']; ?>
            <?php endif; ?>



           <?php if($loop == false): ?>

           <td><?php echo ucwords($r['course_name']); ?></td>
           <td></td>
           <td></td>
           <td></td>

             <tbody>
                <?php foreach($research as $r): ?>
                  <?php if($r['research_status'] != 0 && $r['research_status'] != 3 && $r['deleted_at'] == null): ?>

                       <?php if($r['id'] == $ctr): ?>
                        <tr>
                           <td></td>
                           <td><?php echo $r['rid']; ?></td>
                           <td><?php echo $r['school_year'];?></td>
                           <td><?php echo $r['title']; ?></td>
                         </tr>

                        <?php else: ?>
                          <?php $loop = true; ?>
                        <?php endif; ?>


                  <?php endif; ?>
               <?php endforeach; ?>
             </tbody>

        </div>
      <?php endif; ?>


        <?php endforeach; ?>
        <?php endif; ?>
      </table>
  </div>
</div>
</div>

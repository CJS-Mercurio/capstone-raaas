<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/report">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/report/reports">Report</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/report/seminar">Seminar</a></li>
          <li class="breadcrumb-item active" aria-current="page">List</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

  <div class="container-fluid form">
    <div class="row">
      <div class="col-lg-12 form-col">
        <a href="<?=base_url()?>/profile/perSeminarPDF/<?= $detail['id'];?>" target="_blank" class="btn btn-success btn-sm float-right std-researchV-btn mb-3">
          <i class="fa fa-download std-researchV-icon"></i> Download as PDF </a>
        <a href="<?=base_url()?>/profile/perSeminarCSV/<?= $detail['id'];?>" class="btn btn-success btn-sm float-right std-researchV-btn mb-3 mr-1">
          <i class="fa fa-download std-researchV-icon"></i> Download as CSV </a>
        <h3><?php echo "List of Seminars";?></h3>

      <?php if($all_seminar): ?>

          <table class="table table-bordered table-striped" id="research-list">
          <div class="text-center mt-2 mb-3" style="position: relative;">
            <button type="button" class="btn" data-toggle="tooltip" data-placement="top" title="See more">
              <b><a href=""><?php echo ucwords($detail['fullname']); ?></a></b>
            </button>
          </td>
          </div>

               <thead>
                 <tr>
                   <th>Seminar Title </th>
                   <th>Sponsor</th>
                   <th>Venue</th>
                   <th>Event Date</th>


                 </tr>
               </thead>

             <tbody>
                  <?php foreach($all_seminar as $r): ?>
                        <tr>
                           <td><?php echo $r['event_title']; ?></td>
                           <td><?php echo $r['sponsor']; ?></td>
                           <td><?php echo $r['venue']; ?></td>
                           <?php $t=strtotime($r['date_attended']); ?>
                           <?php $date = date("M-d-Y", $t);?>
                           <td><?php echo $date; ?></td>

                         </tr>
               <?php endforeach; ?>
             </tbody>

        </div>

        <?php else: ?>
          <div class="alert alert-dark" role="alert">
           No data found
          </div>
        <?php endif; ?>
      </table>

    </div>
  </div>
</div>

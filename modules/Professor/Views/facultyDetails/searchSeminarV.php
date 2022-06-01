<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Seminars</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

  <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 admin-form mb-3">
          <div class="container-header">
            <label for="">Faculty Seminar/ Training/ Conference Attended</label>
          </div>

          <!-- <button class="btn btn-success float-right std-researchV" type="button" name="button">
              <i class="fa fa-download std-researchV-icon"></i>
              <a href="<?=base_url()?>/admin/profSeminarPdf">Download as PDF</a>
          </button>
          <button class="btn btn-success float-right std-researchV" type="button" name="button" href= "<?=base_url()?>/admin/profSeminarCsv">
              <i class="fa fa-download std-researchV-icon"></i>Download as CSV
          </button> -->

          <nav class="navbar navbar-light bg-light">
            <form method="post" action="<?=base_url()?>/professor/searchProfSeminar" class="form-inline">
              <input class="form-control mr-sm-2" name="prof_name" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
          </nav>

          <!-- <a href="<?=base_url()?>/professor/profSeminarPdf" target="_blank" class="btn btn-success float-right std-researchV mb-3">
            <i class="fa fa-download std-researchV-icon"></i> Download as PDF </a>
          <a href="<?=base_url()?>/professor/profSeminarCsv" target="_blank" class="btn btn-success float-right std-researchV mb-3 mr-3">
            <i class="fa fa-download std-researchV-icon"></i> Download as CSV </a> -->



             <table class="table table-bordered table-striped" id="profSeminar-list">
                   <thead class="thead-dark">
                      <tr>
                         <th>Professor</th>
                         <th>Title</th>
                         <th>Sponsor</th>
                         <th>Venue</th>
                         <th>Event Date</th>

                         </tr>
                    </thead>


                        <?php if($p_seminar): ?>
                              <div class="col-12 mt-3">
                              <?php  $ctr=0; ?>
                                <?php foreach($p_seminar as $ps): ?>

                                  <?php if($ps['professor_id'] == $ctr): ?>
                                    <?php $loop = true; ?>
                                  <?php endif; ?>


                                  <?php if($ps['professor_id'] > $ctr): ?>
                                    <?php $loop = false; $ctr = $ps['professor_id'];?>
                                  <?php endif; ?>

                                  <?php if($loop == false): ?>



                                          <tbody>
                                            <td><?php echo ucwords($ps['f_firstname']. " " .$ps['f_lastname']); ?></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>

                                            <?php foreach($p_seminar as $ps): ?>
                                              <?php if($ps['professor_id'] == $ctr): ?>

                                           <tr>
                                                <td></td>
                                                <td><?php echo $ps['seminar_title']; ?></td>
                                                <td><?php echo $ps['sponsor']; ?></td>
                                                <td><?php echo $ps['venue']; ?></td>
                                                <td><?php echo $ps['event_date']; ?></td>


                                            </tr>
                                              <?php else: ?>
                                                <?php $loop = true; ?>
                                              <?php endif; ?>

                                            <?php endforeach; ?>
                                          </tbody>

                                    </div>
                                  <?php endif; ?>


                               <?php endforeach; ?>
                            <?php endif; ?>



                        </div>
                    </table>





    </div>
  </div>
</div>

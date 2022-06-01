  <div class="container-fluid">
    <div class="row">

        <div class="col-lg-12 mb-3">
          <div class="container-header">

            <label for="">Student Seminar/ Training/ Conference Attended</label>
          </div>


            <?php if($s_seminar): ?>
                  <div class="col-12 mt-3">
                  <?php  $ctr=0; ?>
                    <?php foreach($s_seminar as $ss): ?>

                      <?php if($ss['student_id'] == $ctr): ?>
                        <?php $loop = true; ?>
                      <?php endif; ?>

                      <?php if($ss['student_id'] > $ctr): ?>
                        <?php $loop = false; $ctr = $ss['student_id'];?>
                      <?php endif; ?>


                      <?php if($loop == false): ?>
                        <label for=""><?php echo ucwords($ss['first_name']. " " .$ss['last_name']); ?></label>
                        <table class="table table-bordered table-striped">
                          <thead class="thead-dark">
                            <tr>
                              <th>Title</th>
                              <th>Sponsor</th>
                              <th>Venue</th>
                              <th>Event Date</th>

                            </tr>
                          </thead>


                              <tbody>
                                <?php foreach($s_seminar as $ss): ?>
                                  <?php if($ss['student_id'] == $ctr): ?>

                               <tr>

                                    <td><?php echo $ss['seminar_title']; ?></td>
                                    <td><?php echo $ss['sponsor']; ?></td>
                                    <td><?php echo $ss['venue']; ?></td>
                                    <td><?php echo $ss['event_date']; ?></td>

                                </tr>

                                  <?php else: ?>
                                    <?php $loop = true; ?>
                                  <?php endif; ?>

                                <?php endforeach; ?>
                              </tbody>
                          </table>
                        </div>
                      <?php endif; ?>


                   <?php endforeach; ?>
                <?php endif; ?>



            </div>




          </div>
  </div>
</div>

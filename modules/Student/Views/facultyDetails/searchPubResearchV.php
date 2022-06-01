<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Published Research</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

 <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 admin-form mb-3">
          <div class="container-header">
            <label for="">Faculty Published Researches</label>
          </div>

           <nav class="navbar navbar-light bg-light">
            <form method="post" action="<?=base_url()?>/student/searchPubResearch" class="form-inline">
              <input class="form-control mr-sm-2" name="prof_name" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
          </nav>

         <!--  <a href="<?=base_url()?>/student/profpResearchPdf" target="_blank" class="btn float-right btn-success std-researchV">
            <i class="fa fa-download std-researchV-icon"></i> Download as PDF </a>
          <a href="<?=base_url()?>/student/profpResearchCsv" target="_blank" class="btn float-right btn-success std-researchV mr-3 mb-3">
            <i class="fa fa-download std-researchV-icon"></i> Download as CSV </a>
 -->


 <table class="table table-bordered table-striped">
        <thead class="thead-dark">
          <tr>
            <th>Professor</th>
            <th>Title</th>
            <th>Publication</th>
            <th>Volume</th>
            <th>Institute</th>
            <th>Event Date</th>

          </tr>
        </thead>
            <?php if($p_research): ?>
                  <div class="col-12 mt-3">
                  <?php  $ctr=0; ?>
                    <?php foreach($p_research as $pr): ?>

                      <?php if($pr['professor_id'] == $ctr): ?>
                        <?php $loop = true; ?>
                      <?php endif; ?>

                      <?php if($pr['professor_id'] > $ctr): ?>
                        <?php $loop = false; $ctr = $pr['professor_id'];?>
                      <?php endif; ?>


                      <?php if($loop == false): ?>
                              <tbody>
                                <td><?php echo ucwords($pr['f_firstname']. " " .$pr['f_lastname']); ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                                <?php foreach($p_research as $pr): ?>
                                  <?php if($pr['professor_id'] == $ctr): ?>

                               <tr>
                                    <td></td>
                                    <td><?php echo $pr['research_title']; ?></td>
                                    <td><?php echo $pr['publication']; ?></td>
                                    <td><?php echo $pr['volume']; ?></td>
                                    <td><?php echo $pr['institute']; ?></td>
                                    <td><?php echo $pr['event_date']; ?></td>



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

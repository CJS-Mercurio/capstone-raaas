<?php $page_session = \Config\Services::session()?>
<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/profile/view">Seminars & Completed Researches</a></li>
          <li class="breadcrumb-item active" aria-current="page">Information Sheet</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 form-col">
      <div class="col-md-12">
        <div class="right-content">
          <div class="tabbable-responsive">
            <div class="tabbable">
              <ul class="nav nav-tabs" role="tablist" id="myTab">
                <li class="nav-item">
                  <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true">Seminars, Trainings and Conference</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="false">Completed Researches</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                <h3 class="">Seminars, Trainings and Conference Attended</h3>
                <table class="table table-bordered table-striped" id="seminar-list">
                  <thead>
                    <tr>
                      <th class="hidden">No.</th>
                      <th>Title</th>
                      <th>Sponsor Agency</th>
                      <th>Venue</th>
                      <th>Date</th>

                    </tr>
                  </thead>
                  <tbody>

                    <?php if($p_seminar): ?>
                      <?php $num = 0; ?>
                      <?php foreach($p_seminar as $ps): ?>
                        <tr>
                          <?php if($ps['deleted_at'] == NULL): ?>
                            <td class="hidden"><?php $num++; echo $num; ?></td>
                            <td><?php echo $ps['event_title']; ?></td>
                            <td><?php echo $ps['sponsor']; ?></td>
                            <td><?php echo $ps['venue']; ?></td>
                            <?php $t=strtotime($ps['date_attended']); ?>
                            <?php $date = date("M-d-Y", $t);?>
                            <td><?php echo $date; ?></td>

                          <?php endif; ?>
                        </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>


                  </tbody>
                </table>
                </div>
              <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
                <h3 class="">Completed Researches</h3>
                <table class="table table-bordered table-striped" id="pResearch-list">
                  <thead>
                    <tr>
                      <th class="hidden">No.</th>
                      <th>Title</th>
                      <th>Status</th>
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tbody>

                    <?php if($p_research): ?>
                      <?php $num = 0; ?>

                      <?php foreach($p_research as $pr): ?>
                        <tr>
                          <?php if($pr['deleted_at'] == NULL): ?>
                            <td class="hidden"><?php $num++; echo $num; ?></td>
                            <td><?php echo $pr['research_title']; ?></td>
                            <td>
                                <?php if($pr['publication'] != null): ?>
                                  Published
                                <?php else: ?>
                                  Not published
                                <?php endif; ?>
                              </td>
                            <td>
                              <form class="" action="<?= base_url() ?>/profile/professors/pResearchDetail/<?= $pr['id']?>" method="post">
                                <button type="submit" class="btn btn-info">
                                  View
                                </button>
                              </form>


                            </td>

                          <?php endif; ?>

                        </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

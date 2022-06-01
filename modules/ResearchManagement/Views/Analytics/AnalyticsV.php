<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Metrics</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

    <div class="container-fluid form">
      <div class="row">
        <div class="col-md-12 form-col">
          <div class="right-content">
            <div class="tabbable-responsive">
              <div class="tabbable">
                <ul class="nav nav-tabs" role="tablist" id="myTab">
                  <li class="nav-item">
                    <a class="nav-link" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true">Top Cited Researches</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" id="second-tab" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="false">Top Visited Researches</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab" aria-controls="third" aria-selected="false">Top Research Category</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane fade" id="first" role="tabpanel" aria-labelledby="first-tab">
                  <h4 class="card-title">Top cited researches</h4>
                  <p class="card-text">List of top cited researches</p>

                  <?php if($downloads): ?>

                  <div class="row">
                          <div class="card-body col-md-12">
                              <canvas id="citedChart"></canvas>
                          </div>
                        </div>
                        <div class="col-12">
                          <table class="table table-bordered table-striped" id="faculty-list">
                            <thead>
                              <tr>
                                <th>No.</th>
                                <th>Title</th>
                                <th>Count</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $count = 0; ?>
                                <?php foreach ($downloads as $v): ?>
                                  <?php if($v['research_status'] == 3): ?>
                                    <tr>

                                      <?php $count += 1; ?>
                                          <td><?php echo $count; ?></td>
                                          <td><?php echo $v['title']; ?></td>
                                          <td><?php echo $v['downloads']; ?></td>
                                    </tr>
                                    <?php endif; ?>
                                 <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                <?php else: ?>
                  <div class="alert alert-dark mt-5" role="alert">
                    No data found.
                  </div>
                <?php endif; ?>

                </div>
                <div class="tab-pane fade show active" id="second" role="tabpanel" aria-labelledby="second-tab">
                  <h4 class="card-title">Most Viewed Researches</h4>
                    <p class="card-text">List of top visited researches</p>
                    <div class="row">
                      <div class="card-body col-md-12">
                          <canvas id="visitedChart"></canvas>
                      </div>
                    </div>
                    <?php if($views): ?>
                    <div class="col-12">
                      <table class="table table-bordered table-striped" id="faculty-list">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Count</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $count = 0; ?>
                          <?php foreach ($views as $v): ?>
                            <?php if($v['research_status'] == 3): ?>

                            <tr>

                              <?php $count += 1; ?>
                                  <td><?php echo $count; ?> </td>
                                  <td>
                                    <a class="text-primary" href="<?=base_url()?>/research/viewResearchHome/<?= $v['id']?>">
                                      <?php echo $v['title']; ?>
                                    </a>
                                  </td>
                                  <td>
                                    <?php echo $v['views']; ?>
                                  </td>
                            </tr>
                          <?php endif;  ?>
                           <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>


                      <?php else: ?>
                        <div class="alert alert-dark mt-5" role="alert">
                          No data found.
                        </div>
                      <?php endif; ?>
                </div>

                <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab">
                  <h4 class="card-title">Top Research Categories</h4>
                  <p class="card-text">List of top research categories uploaded</p>

                  <div class="row">
                    <div class="card-body col-md-12">
                        <canvas id="categoryChart"></canvas>
                    </div>
                  </div>
                  <?php if(!empty($category)): ?>
                  <div class="col-12">
                    <table class="table table-bordered table-striped" id="faculty-list">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Category</th>
                          <th># of Research</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $count = 0; ?>
                        <?php foreach ($category as $v): ?>

                          <tr>
                            <?php $count += 1; ?>
                                <td><?php echo $count; ?> </td>
                                <td>
                                  <?php echo $v['category']; ?>
                                </td>
                                <td>
                                  <?php echo $v['number']; ?>

                                </td>
                          </tr>
                         <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>

                    <?php else: ?>
                      <div class="alert alert-dark" role="alert">
                        No data found.
                      </div>
                    <?php endif; ?>

                </div>

              </div>
            </div>

         </div>
        </div>



        </div>
      </div>
    </div>

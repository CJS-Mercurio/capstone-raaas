<!-- Page Content -->
<!-- Heading Starts Here -->
<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12 metrics-head">
         <img src="<?=base_url()?>/public/assets/images/logos/logo.png" width="200" height="200">
        <h1>Metrics</h1>
        <p><a href="<?=base_url()?>/login">Home</a> / <span>Metrics</span></p>
      </div>
    </div>
  </div>
</div>
<!-- Heading Ends Here -->

<div class="container-fluid">
  <div class="row">
    <div class="col-12">

    </div>
  </div>
</div>


<!-- About Us Starts Here -->
<div class="metrics">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="center-content">
          <div class="section-heading center-content">

            <div class="col-md-12 col-sm-6 col-xs-12">
              <div class="service-item">
<!-- top researches -->
                <img src="./public/assets/images/logos/top.png" width="100" height="100">

                <h3>Top Researches</h3>
                <div class="tabbable-responsive">
                  <div class="tabbable">
                    <ul class="nav nav-tabs" role="tablist" id="myTab">
                      <li class="nav-item">
                        <a class="nav-link " id="first-metrics" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="false">Top Cited Researches</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" id="second-metrics" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="true">Top Visited Researches</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="third-metrics" data-toggle="tab" href="#third" role="tab" aria-controls="third" aria-selected="false">Top Researches per Category</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="tab-pane fade" id="first" role="tabpanel" aria-labelledby="first-metrics">
                        <h3 class="card-title">Top cited Researches</h3>
                        <?php if(!empty($downloads)): ?>
                        <canvas id="citedChart"></canvas>
                        <table class="table mt-5" id="faculty-list">
                          <thead>
                            <tr>
                              <th>No.</th>
                              <th>Title</th>
                              <th>No. of Citation</th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php $count = 0; ?>
                              <?php foreach ($downloads as $v): ?>
                                  <?php if($v['research_status'] == 3): ?>

                                    <tr>
                                      <?php $count += 1; ?>
                                          <td><?php echo $count; ?></td>
                                          <td><a href="<?=base_url()?>/guest_view/<?= $v['id']?>"> <?php echo $v['title']; ?></a></td>
                                          <td><?php echo $v['downloads']; ?></td>
                                    </tr>
                                  <?php endif; ?>
                               <?php endforeach; ?>
                          </tbody>
                        </table>
                      <?php else: ?>
                        <div class="alert alert-dark mb-5" role="alert">
                          No data found.
                        </div>
                      <?php endif; ?>
                      </div>


                      <div class="tab-pane fade show active" id="second" role="tabpanel" aria-labelledby="second-metrics">
                        <h3 class="card-title">Top Visited Researches</h3>
                          <?php if (!empty($views)): ?>
                            <canvas id="visitedChart"></canvas>
                            <table class="table mt-5" id="faculty-list">
                              <thead>
                                <tr>
                                  <th>No.</th>
                                  <th>Title</th>
                                  <th>Views</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $count = 0; ?>
                                <?php foreach ($views as $v): ?>
                                    <?php if($v['research_status'] == 3): ?>
                                      <tr>
                                        <?php $count += 1; ?>
                                            <td><?php echo $count; ?> </td>
                                            <td><a href="<?=base_url()?>/guest_view/<?= $v['id']?>"> <?php echo $v['title']; ?></a></td>
                                            <td><?php echo $v['views']?></td>
                                      </tr>
                                  <?php endif; ?>
                                 <?php endforeach; ?>
                              </tbody>
                            </table>
                          <?php else: ?>
                            <div class="alert alert-dark mb-5" role="alert">
                              No data found.
                            </div>
                          <?php endif; ?>
                      </div>

                      <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-metrics">
                        <h3 class="card-title">Top Researches per Categories</h3>
                        <?php if (!empty($category)): ?>
                          <canvas id="categoryChart"></canvas>
                            <table class="table mt-5" id="faculty-list">
                              <thead>
                                <tr>
                                  <th>No.</th>
                                  <th>Title</th>
                                  <th>No. of Research</th>
                                </tr>
                              </thead>
                              <tbody>
                                  <?php $count = 0; ?>
                                  <?php foreach ($category as $c): ?>
                                    <tr>
                                      <?php $count += 1; ?>
                                          <td><?php echo $count; ?> </td>
                                          <td><?php echo $c['category']; ?></a></td>
                                          <td><?php echo $c['number']; ?></a></td>
                                    </tr>
                                   <?php endforeach; ?>
                              </tbody>
                            </table>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
<!-- About Us Ends Here -->

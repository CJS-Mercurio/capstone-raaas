<?php $validation = \Config\services::validation()?>
<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Report</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

    <div class="container-fluid form">
          <div class="row">
            <div class="col-lg-12 form-col">
                <h3>Generate Report</h3>
                <p><h6>Choose a report to generate</h6></p>
                <div class="row">
                <div class="col-sm-4">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"><a href="<?=base_url()?>/report/research">Research / Documents</a></h5>
                      <hr>
                      <p class="card-text">Generate report of uploaded researches and documents uploaded by students and professors.</p>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"><a href="<?=base_url()?>/report/seminar">Seminars, Conferences and Workshops</a></h5>
                      <hr>
                      <p class="card-text">Generate report about seminars, conferences and workshops attended by faculty.</p>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"><a href="<?=base_url()?>/report/pResearch">Completed / Published Researches</a></h5>
                      <hr>
                      <p class="card-text">Generate report about completed and published researches by faculty.</p>
                    </div>
                  </div>
                </div>
              </div>


    </div>
  </div>
</div>

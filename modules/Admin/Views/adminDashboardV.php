<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

          <div class="container-fluid">
            <div class="row">
                <button class="btn btn-success float-right std-researchV ml-auto mb-3" type="button" name="button" id="downloadPdf">
                   <i class="fa fa-download std-researchV-icon "></i>Download as PDF
                </button>
            </div>
          <div id="reportPage" class="graph-container">
            <div class="row row-form">
              <div class="col-md-5 graph1 mb-3">
                <div class="header">
                  <h3 class="graph1-header mb-3">Number of research per Adviser</h3>
                </div>
                <canvas id="perAdviserGraph"></canvas>
              </div>
              <div class="col-md-5 graph3 mb-3">
                <div class="header">
                  <h3 class="graph3-header mb-3">Number of research per SY</h3>
                </div>
                  <canvas id="perYearGraph"></canvas>
              </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 graph2 mb-3">
              <div class="header">
                <h3 class="graph2-header mb-3">Number of research per courses</h3>
              </div>
              <canvas id="perCourseGraph">perCourse</canvas>
            </div>
                  <!-- <div class="row">
                    <div id="resizable" style="height: 370px;border:1px solid gray;">
	                     <div id="chartContainer1" style="height: 100%; width: 100%;"></div>
                     </div>
                  </div> -->

            </div>
          </div>

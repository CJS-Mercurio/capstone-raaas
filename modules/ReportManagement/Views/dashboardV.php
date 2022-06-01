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

          <div class="container-fluid form">
            <div class="row">
              <div class="col-lg-12 form-col">
                  <h3>Dashboard</h3>
                <div id="reportPage" class="graph-container">

                    <form>
                      <div class="form-row">
                        <div class="form-group col-md-5">
                          <label for="inputCity">Course</label>
                          <select id="inputState" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputState">Document Type</label>
                          <select id="inputState" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                          </select>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputZip">Time Frame</label>
                          <select id="inputState" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                          </select>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary">Generate</button>
                      </form>
                </div>
              </div>
            </div>
          </div>


          <div class="container-fluid form">
            <div class="row">
              <div class="col-lg-12 form-col">
                <div id="reportPage" class="graph-container">
                      <div class="row">
                        <div class="col mb-5">
                            <button class="btn btn-success float-right std-researchV" type="button" name="button" id="downloadPdf">
                                <i class="fa fa-download std-researchV-icon"></i>Download as PDF
                            </button>
                        </div>
                      </div>

                  <div class="row mb-5">
                    <div class="col-md-6">
                      <h3 class="text-center">Number of research per Adviser</h3>
                      <canvas id="perAdviserGraph"></canvas>
                    </div>
                    <div class="col-md-6">
                      <h3 class="text-center">Number of research per courses</h3>
                      <canvas id="perCourseGraph">perCourse</canvas>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center">Number of research per SY</h3>
                        <canvas id="perYearGraph"></canvas>
                    </div>
                  </div>
                  <!-- <div class="row">
                    <div id="resizable" style="height: 370px;border:1px solid gray;">
	                     <div id="chartContainer1" style="height: 100%; width: 100%;"></div>
                     </div>
                  </div> -->
                </div>
              </div>
            </div>
          </div>

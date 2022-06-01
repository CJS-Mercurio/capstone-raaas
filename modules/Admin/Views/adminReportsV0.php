<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Report</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

    <div class="container-fluid form">

          <?php if(session()->getTempdata('wrongSY')): ?>
              <div class="alert alert-danger">
                <?= session()->getTempdata('wrongSY'); ?>
              </div>
           <?php endif; ?>
          <div class="row">
            <div class="col-lg-12 form-col">


                <h3>Generate List Reports</h3>
             <form action="<?=base_url()?>/admin/reportByCourse" method="post">
              <div class="form-row align-items-center">
                Year Start
                <div class="col-auto my-1">
                    <select class="custom-select mr-sm-2" id="year_start" name="year_start">
                      <option name="year_start" value="2018">2018</option>
                      <option name="year_start" value="2019">2019</option>
                      <option name="year_start" value="2020">2020</option>
                      <option name="year_start" value="2021">2021</option>
                      <option name="year_start" value="2022">2022</option>
                      <option name="year_start" value="2023">2023</option>
                      <option name="year_start" value="2024">2024</option>
                    </select>
                </div>
                <span class="text-danger"> <?= display_error($validation, 'year_start'); ?></span>

                Year End
                <div class="col-auto my-1 mr-2">
                    <select class="custom-select mr-sm-2" id="year_end" name="year_end">
                      <option name="year_end" value="2018">2018</option>
                      <option name="year_end" value="2019">2019</option>
                      <option name="year_end" value="2020">2020</option>
                      <option name="year_end" value="2021">2021</option>
                      <option name="year_end" value="2022">2022</option>
                      <option name="year_end" value="2023">2023</option>
                      <option name="year_end" value="2024">2024</option>

                  </select>
                </div>


                Course
                <div class="col-7">
                  <div class="custom-control custom-checkbox mr-1">
                    <select class="form-control" id="course" name="course">
                          <option value="All" name="course" value="0">All</option>
                          <?php if($course): ?>
                            <?php foreach ($course as $c): ?>
                              <option name="course" value="<?=$c['id']; ?>"><?php echo $c['course_name']; ?></option>
                            <?php endforeach; ?>
                          <?php endif; ?>
                      <span class="text-danger"> <?= display_error($validation, 'course'); ?></span>


                    </select>
                  </div>
                </div>
                <div class="col-auto my-1">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>
            <span class="text-danger"> <?= display_error($validation, 'year_end'); ?></span>

             </div>
            </div>

           </div>

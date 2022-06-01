<?php $validation = \Config\services::validation()?>
<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/report/reports">Report</a></li>
          <li class="breadcrumb-item active" aria-current="page">Research</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

    <div class="container-fluid form">
          <div class="row">
            <div class="col-lg-12 form-col">
                <h3>Generate List Reports</h3>
             <form class="form-report" action="<?=base_url()?>/report/reportByCourse" method="post">

             <div class="form-group row">
               <label for="inputEmail3" class="col-sm-2 col-form-label">Year start</label>
               <div class="col-sm-12">
                 <select class="custom-select mr-sm-2" id="year_start" name="year_start">
                   <?php
                   for ($year=2016; $year<=date('Y'); $year++): ?>
                     <option name="year_start" value="<?=$year;?>"><?=$year;?></option>
                   <?php endfor; ?>
                 </select>
                <?php if($validation->getError('year_start')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('year_start'); ?>
                    </div>
                <?php }?>
               </div>
             </div>

             <div class="form-group row">
               <label for="inputEmail3" class="col-sm-2 col-form-label">Year end</label>
               <div class="col-sm-12">
                 <select class="custom-select mr-sm-2" id="year_start" name="year_end">
                   <?php
                   $date = date('Y') + 1;
                   for ($year=2016; $year<=$date; $year++): ?>
                     <option name="year_end" value="<?=$year;?>"><?=$year;?></option>
                   <?php endfor; ?>
                 </select>
                <?php if($validation->getError('year_end')) {?>
                    <div class='text-danger'>
                      <?= $error = $validation->getError('year_end'); ?>
                    </div>
                <?php }?>
                 <?php if(session()->getTempdata('wrongSY')): ?>
                   <div class="text-danger">
                     <?= session()->getTempdata('wrongSY'); ?>
                   </div>
                 <?php endif; ?>
               </div>
             </div>
             <div class="form-group row">
               <label for="inputEmail3" class="col-sm-2 col-form-label">Course</label>
               <div class="col-sm-12">
                 <select class="custom-select mr-sm-2" id="course" name="course">
                    <option value="All" name="course" value="0">All</option>
                         <?php if($course): ?>
                           <?php foreach ($course as $c): ?>
                               <?php if($c['deleted_at'] == NULL): ?>
                                 <option name="course" value="<?=$c['id']; ?>"  <?= set_select('course', $c['id']) ?>><?php echo $c['course_name']; ?></option>
                            <?php endif; ?>
                           <?php endforeach; ?>
                         <?php endif; ?>
                  </select>
                  <?php if($validation->getError('course')) {?>
                      <div class='text-danger'>
                        <?= $error = $validation->getError('course'); ?>
                      </div>
                  <?php }?>
               </div>
             </div>

             <hr>
                 <button type="submit" class="btn btn-success mr-sm-4 float-right" >Generate</button>

           </form>
             </div>
            </div>

           </div>
          </div>
        </div>
    </div>
  </div>
</div>

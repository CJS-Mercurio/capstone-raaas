
<?php $validation = \Config\services::validation()?>
<div class="container mt-5">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-2">
          <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 form-col">
        <h3>Research Archive</h3>
      <?php if(session()->getTempdata('successAY')): ?>
        <div class="alert alert-success">
          <?= session()->getTempdata('successAY'); ?>
        </div>
      <?php endif; ?>

      <?php if($ad_config): ?>
        <?php foreach ($ad_config as $ac): ?>
             <span class="text-info">Available documents to preview: <b> <?php echo $ac['archive_year']; ?> </b> </span>
        <?php endforeach; ?>
      <?php endif; ?>
               <form action="<?=base_url()?>/superadmin/archive" method="post">
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label"> <i class="ml-1">Year start</i></label>
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
                  <label for="inputEmail3" class="col-sm-2 col-form-label"> <i class="ml-1">Year end</i></label>
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

                    <?php if(session()->getTempdata('wrongAY')): ?>
                      <div class="text-danger">
                        <?= session()->getTempdata('wrongAY'); ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>

                <hr>
                    <button type="submit" class="btn btn-success mr-sm-5" style="float: right;">Set year</button>

              </form>
             </div>
          </div>
         </div>


      </div>
  </div>
</div>

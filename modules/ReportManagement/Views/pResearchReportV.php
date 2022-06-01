<?php $validation = \Config\services::validation()?>
<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/report/reports">Report</a></li>
          <li class="breadcrumb-item active" aria-current="page">Faculty Research</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

    <div class="container-fluid form">
      <div class="row">
        <div class="col-lg-12 form-col">
          <h3>Completed Research</h3>
             <form class="form-report ml-5" action="<?=base_url()?>/report/pResearch" method="post">

             <div class="form-group row">
               <label for="inputEmail3" class="col-sm-2 col-form-label">Year start</label>
               <div class="col-sm-10">
                 <select class="custom-select mr-sm-2" id="year_start" name="year_start">
                   <?php
                   for ($year=2012; $year<=date('Y'); $year++): ?>
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
               <div class="col-sm-10">
                 <select class="custom-select mr-sm-2" id="year_end" name="year_end">
                   <?php
                   $date = date('Y') + 1;
                   for ($year=2012; $year<=$date; $year++): ?>
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
               <label for="inputEmail3" class="col-sm-2 col-form-label">Classification</label>
               <div class="col-sm-10">
                  <select class="form-control" id="classification" name="classification">
                     <option name="classification" value="1">Completed</option>
                     <option name="classification" value="2">Published</option>
                   </select>
                  <?php if($validation->getError('classification')) {?>
                      <div class='text-danger'>
                        <?= $error = $validation->getError('classification'); ?>
                      </div>
                  <?php }?>
               </div>
             </div>

             <div class="form-group row">
               <label for="inputEmail3" class="col-sm-2 col-form-label">Faculty</label>
               <div class="col-sm-10">
                 <select class="custom-select mr-sm-2" id="faculty" name="faculty">
                    <option name="faculty" value="0" selected>All</option>
                         <?php if($professors): ?>
                           <?php foreach ($professors as $p): ?>
                             <option name="faculty" value="<?=$p['user_id']; ?>"  <?= set_select('faculty', $p['user_id']) ?>> <?php echo ucwords($p['firstname']. " " . $p['lastname']); ?></option>
                           <?php endforeach; ?>
                         <?php endif; ?>
                  </select>
                  <?php if($validation->getError('faculty')) {?>
                      <div class='text-danger'>
                        <?= $error = $validation->getError('faculty'); ?>
                      </div>
                  <?php }?>
               </div>
             </div>
             <hr>
                 <button type="submit" class="btn btn-success mr-sm-5" style="float: right;">Generate</button>

           </form>
          
    </div>
  </div>
</div>

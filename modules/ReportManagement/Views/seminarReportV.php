<?php $validation = \Config\services::validation()?>
<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/report/reports">Report</a></li>
          <li class="breadcrumb-item active" aria-current="page">Seminar</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

    <div class="container-fluid form">
        <div class="row">
          <div class="col-lg-12 form-col">
            <h3>Seminar List</h3>
             <form class="form-report ml-5" action="<?=base_url()?>/report/seminar" method="post">

             <div class="form-group row">
               <label for="inputEmail3" class="col-sm-2 col-form-label">Faculty</label>
               <div class="col-sm-10">
                 <select class="custom-select mr-sm-2" id="faculty" name="faculty">
                    <option name="faculty" value="0" selected>All</option>
                         <?php if($user): ?>
                           <?php foreach ($user as $p): ?>
                             <?php if($p['role_id'] == 3 && $p['first_name'] != ''): ?>
                               <option name="faculty" value="<?=$p['id']; ?>"  <?= set_select('faculty', $p['id']) ?>> <?php echo ucwords($p['first_name']. " " . $p['last_name']); ?></option>
                             <?php endif ?>
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

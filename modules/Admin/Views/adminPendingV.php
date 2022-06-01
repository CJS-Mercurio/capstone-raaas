<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">List of Pending Researches</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 form-col">

        <h3>List of Pending Researches</h3>


           <?php if(session()->getTempdata('approved')): ?>
              <div class="alert alert-success">
                <?= session()->getTempdata('approved'); ?>
              </div>
           <?php endif; ?>

            <?php if(session()->getTempdata('disapproved')): ?>
              <div class="alert alert-success">
                <?= session()->getTempdata('disapproved'); ?>
              </div>
           <?php endif; ?>


           <?php if(session()->getTempdata('notDisapproved')): ?>
              <div class="alert alert-success">
                <?= session()->getTempdata('notDisapproved'); ?>
              </div>
           <?php endif; ?>
      <div class="mt-3">
         <table class="table table-bordered table-striped" id="pendingResearch-list">
           <thead>
              <tr>
                 <th>Id</th>
                 <th>Research Title</th>
                 <th>Keyword</th>
                 <th>School Year</th>
                 <th>Type of Final Paper</th>
                 <th>Status</th>
                 <th>Action</th>
              </tr>
           </thead>
           <tbody>

            <?php if($research): ?>
              <?php foreach($research as $r): ?>
                  <?php if($r['deleted_at'] == null && $r['research_status'] != 3 && $r['research_status'] == 0): ?>
                        <tr>
                           <td><?php echo $r['id']; ?></td>
                           <td><?php echo $r['title']; ?></td>
                           <td><?php echo $r['keywords']; ?></td>
                           <td><?php echo $r['school_year']; ?></td>
                           <td><?php echo $r['paper_type']; ?></td>
                             <td>Waiting for approval</td>
                             <td>
                               <form method="post" action="<?=base_url()?>/admin/viewResearch/<?= $r['id'] ?>">
                                 <button type="submit" class="btn btn-info">View</button>
                               </form>
                              </td>
                          </tr>
                    <?php endif; ?>
               <?php endforeach; ?>
             <?php endif; ?>

           </tbody>
         </table>
      </div>
    </div>
    </div>
  </div>
</div>

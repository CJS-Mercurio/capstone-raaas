<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Seminars and Completed Researches List</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid form">
  <div class="row">
    <div class="col-12 form-col">
      <?php if($allowed_task): ?>
        <?php foreach ($allowed_task as $at): ?>
          <?php if($at['tid'] == 23 && $at['deleted_at'] == NULL): ?>
            <button type="button" class="btn btn-info approve-btn float-right btn-sm" onclick="document.location = '<?=base_url()?>/profile/professors/seminar'">My Seminars/Researches</button>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>
        <?php if($current_user): ?>
                  <?php if($current_user['role_id'] == 1): ?>
                    
        <?php endif; ?>
        <h3>List of University Faculty</h3>
        <span class="text-secondary">
            Click a faculty member to view their Seminars Attended and Completed Researches
        </span>
        <div class="collapse" id="collapseExample">
          <div class="card card-body">
              <table class="table">
                <thead>
                  <tr>
                    <td></td>
                    <td>Download As</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">
                      <p>Faculty Seminars</p>
                      <p>Conferences</p>
                      <p>Workshops</p>
                    </th>
                    <td>
                      <a class="btn btn-success mr-3 mt-4" href="<?=base_url()?>/profile/seminarPDF"><i class="fas fa-file-pdf"></i> .PDF</a>
                      <a class="btn btn-success mt-4" href="<?=base_url()?>/profile/seminarCSV"><i class="fas fa-file-csv"></i> .CSV</a>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      <p>Faculty Completed Researches</p>
                    </th>
                    <td>
                      <a class="btn btn-success mr-3" href="<?=base_url()?>/profile/publicationPDF"><i class="fas fa-file-pdf"></i> .PDF</a>
                      <a class="btn btn-success" href="<?=base_url()?>/profile/publicationCSV"><i class="fas fa-file-csv"></i> .CSV</a>
                    </td>
                  </tr>
                </tbody>
              </table>
              <!-- <div class="col">
                <p>Faculty Seminars/Conferences/Workshops: <a href="<?=base_url()?>/profile/seminarPDF">.pdf <a href="<?=base_url()?>/profile/seminarCSV" style="color: blue; ">.csv</a></p>
              </div>
              <div class="col">
                <p>Faculty Completed Researches: <a href="<?=base_url()?>/profile/publicationPDF">.pdf</a> <a href="<?=base_url()?>/profile/publicationCSV" style="color: blue; ">.csv</a></p>
              </div> -->
          </div>
        </div>
      <div class="container-table mt-3">
        <div class="row">
          <table class = "table table-bordered table-striped" id = "forum-list">
            <thead>
              <tr>
                <th>Name</th>
                <th>Faculty Code</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if($faculty): ?>
                <?php foreach($faculty as $f): ?>
                    <tr>
                      <td><?php echo(ucwords($f['firstname']. " " . $f['lastname'])); ?></td>
                      <td><?php echo $f['facultycode'] ?></td>
                      <td>
                        <form method="post" action="<?=base_url()?>/profile/viewFaculty/<?= $f['user_id'] ?>">
                          <button type="submit" class="btn btn-info fa fa-eye"></button>
                        </form>

                      </td>
                    </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>


              <?php endif; ?>

    </div>
  </div>
</div>

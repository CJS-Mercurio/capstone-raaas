<div class="card mt-5 me-3">
  <div class="card-body">
    <div class="container-fluid p-1">
      <?php if (isset($_SESSION['success_message'])): ?>
        <div class="row mb-3">
          <div class="col-12">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <?=esc($_SESSION['success_message'])?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <div class="row mb-3">
        <div class="col-2">
          <span class="h2">Professors</span>
        </div>
        <div class="col-2">
          <a href="professors/add" class="float-end btn btn-success"> Add </a>
        </div>
      </div>
      <form action="professors/insert-spreadsheet" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-5">
            <input type="file" name="professors" class="form-control" required>
          </div>
          <div class="col-2">
            <button type="submit" class="btn btn-primary">Upload</button>
          </div>
        </div>
      </form>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Faculty Code</th>
                  <th>Name</th>
                  <th>Birthdate</th>
                  <th>Position</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($professors)): ?>
                  <?php foreach ($professors as $professor): ?>
                    <tr>
                      <td><?=esc($professor['id'])?></td>
                      <td><?=ucwords(esc($professor['facultycode']))?></td>
                      <td><?=ucwords(esc($professor['firstname']) . ' '. $professor['middlename'] . ' '. $professor['lastname'])?></td>
                      <td><?=esc($professor['birthdate'])?></td>
                      <td><?=esc($professor['position'])?></td>
                      <td><?=esc($professor['status'])?></td>
                      <td class="text-center">
                        #
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

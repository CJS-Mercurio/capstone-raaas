<?php $page_session = \Config\Services::session()?>
<div class="container mt-5">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-2">

        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container mt-3">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/superadmin">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/profile/activity">Audit Trail</a></li>
          <li class="breadcrumb-item active" aria-current="page">Audtit Trail Details</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 form-col">
        <h3>Activity Log Details</h3>
        <div class="card">
          <?php if($activity): ?>
            <div class="card-body">
              <table class="table-sm table-bordered table-striped activity-table">
                <tbody>
                  <tr>
                    <th scope="row">
                        <h6>
                          <b>
                            User ID:
                          </b>
                        </h6>
                    </th>
                    <td>
                      <h6>
                        <?php echo $activity['user_id']; ?>
                      </h6>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                        <h6>
                          <b>
                            User Name:
                          </b>
                        </h6>
                    </th>
                    <td>
                      <h6>
                        <?php echo ucwords($activity['first_name']. " ". $activity['last_name']); ?>
                      </h6>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                        <h6>
                          <b>
                            Activity:
                          </b>
                        </h6>
                    </th>
                    <td>
                      <h6>
                        <?php echo $activity['task_name']; ?>
                      </h6>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                        <h6>
                          <b>
                            Title:
                          </b>
                        </h6>
                    </th>
                    <td>
                      <h6>
                        <?php echo $activity['title']; ?>
                      </h6>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="card-footer text-muted">
              <b>Date: </b><?php echo $activity['created_at']; ?>
            </div>
          </div>
        <?php else: ?>
           <div class="alert alert-dark" role="alert">
              <b>Activity details not found.</b> 
            </div>
        <?php endif; ?>
    </div>
  </div>
</div>
    </div>
  </div>
</div>

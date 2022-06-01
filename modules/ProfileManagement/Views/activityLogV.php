<div class="container mt-5">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-2">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/superadmin">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Audit Trail</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 form-col">
        <h3>Activity Log</h3>
            <span class="mb-3 note"><i>*Activities within 30 days will automatically be deleted.</i></span>
            <table class = "table table-bordered table-striped mt-3" id = "faculty-list">
              <thead>
                <tr>
                  <th>User Name</th>
                  <th>Activity</th>
                  <th>Date:Time</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if($activity): ?>
                  <?php foreach($activity as $a): ?>
                    <?php
                    $d = new \DateTime($a['created_at']);
                    $now = new \DateTime();
                    ?>
                    <?php if($d->diff($now)->days < 30): ?>
                      <tr>
                        <td> <?php echo ucwords($a['first_name']. " " . $a['last_name']); ?> </td>
                        <td> <?php echo $a['task_name']; ?> </td>
                        <td> <?php echo $a['created_at']; ?> </td>

                        <td> <form method="post" action="<?=base_url()?>/profile/activityDetail/<?= $a['aid'] ?>">
                          <button type="submit" class="btn btn-sm btn-info" style="font-size:10px;">Details</button>
                        </form></td>
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

<script>
function deactivate_data(id)
{
    if(confirm("Are you sure you want to deactivate this user?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/deactUser/"+id;
    }
    return false;
}


function activate_data(id)
{

    if(confirm("Are you sure you want to activate this user?"))
    {
        window.location.href="<?php echo base_url(); ?>/superadmin/actUser/"+id;
    }
    return false;
}

</script>

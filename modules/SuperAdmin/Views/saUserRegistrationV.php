<div class="container mt-5">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-2">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/superadmin">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/superadmin/userAccount">Accounts</a></li>
          <li class="breadcrumb-item active" aria-current="page">Account Information</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 form-col">
      <?php if($user): ?>
      <h3>Account Information</h3>
      <?php endif ?>

      <div class="card mb-3">
          <div class="row no-gutters">
            <div class="col-md-7">
              <div class="card-body">
                <p><h6>First name:</h6> <?php echo $user['first_name']; ?><p><br>
                  <p><h6>Middle Name:</h6>
                    <?php if($user['middle_name']){
                      echo $user['middle_name'];
                    }else{
                      echo 'N/A';
                    }

                    ?><p><br>
                    <p><h6>Last name:</h6> <?php echo $user['last_name']; ?><p><br>
                      <p><h6>Birthdate:</h6> <?php echo $user['birthdate']; ?><p><br>
                        <p><h6>Email:</h6> <?php echo $user['email']; ?><p><br>



              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
	</div>
</div>

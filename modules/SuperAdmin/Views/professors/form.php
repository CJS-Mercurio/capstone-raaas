<div class="container" id="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">

          <h3>Add Professor</h3>

          <form class="" action="add" method="post">
        	<div class="row register-form">
						<div class="col-md-6">
								<div class="form-group mb-3">
									<label for="username" class="form-label">Faculty Code </label>
									<input type="text" name="facultycode" id="username" class="form-control" placeholder="Faculty Code" value="" />
									 <span class="text-danger"> <?= display_error($validation, 'facultycode'); ?></span>
								</div>
								<div class="form-group mb-3">
									<label for="email" class="form-label">Email *</label>
									<input type="text" name="email" id="email" class="form-control" placeholder="Email" value="" />
									 <span class="text-danger"> <?= display_error($validation, 'email'); ?></span>
								</div>


						</div>
						<div class="col-md-6">
								<div class="maxl">
									<label for="firstname" class="form-label">First Name *</label>
									<input type="text" name="firstname" class="form-control" value="">
									<span class="text-danger"> <?= display_error($validation, 'firstname'); ?></span>

								</div>
								<div class="form-group mb-3">
									<label for="lastname" class="form-label">Last Name *</label>
									<input type="text" class="form-control" name="lastname" value="">
									<span class="text-danger"> <?= display_error($validation, 'lastname'); ?></span>
								</div>

								<div class="form-group mb-3">
									<label for="middlename" class="form-label">Middle Name</label>
									<input type="text" class="form-control" name="middlename" value="">
								<span class="text-danger"> <?= display_error($validation, 'middlename'); ?></span>
								</div>

                <div class="form-group mb-3">
									<label for="position" class="form-label">Position</label>
									<input type="text" class="form-control" name="position" value="">
								<span class="text-danger"> <?= display_error($validation, 'position'); ?></span>
								</div>
                <div class="form-group mb-3">
									<label for="status" class="form-label">Status</label>
									<input type="text" class="form-control" name="status" value="">
								<span class="text-danger"> <?= display_error($validation, 'status'); ?></span>
								</div>


								<div class="form-group mb-3">
									<label for="birthdate" class="form-label">Birthdate</label>
									<input type="date" name="birthdate" class="form-control" value="">
									<span class="text-danger"> <?= display_error($validation, 'birthdate'); ?></span>
								</div>
								<input type="submit" class="btnRegister"  value="Register"/>
						</div>
        	</div>
				</form>
        </div>
    </div>
  </div>
</div>

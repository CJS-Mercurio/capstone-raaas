<div class="container" id="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">

          <h3>Add Student</h3>

          <form class="" action="add" method="post">
        	<div class="row register-form">
						<div class="col-md-6">
								<div class="form-group mb-3">
									<label for="username" class="form-label">Student Number* </label>
									<input type="text" name="student_number" id="username" class="form-control" placeholder="Student Number" value="" />
									 <span class="text-danger"> <?= display_error($validation, 'student_number'); ?></span>
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
									<label for="contact" class="form-label">Contact</label>
									<input type="text" class="form-control" name="contact" value="">
								<span class="text-danger"> <?= display_error($validation, 'contact'); ?></span>
								</div>

								<div class="form-group mb-3">
									<label for="course_id" class="form-label">Course*</label>
										<select class="form-control" name="course_id">
											<?php if (isset($courses)): ?>
												<?php foreach ($courses as $course): ?>
													<option value="<?=esc($course['id'])?>"><?=esc($course['course_name'])?></option>
												<?php endforeach; ?>
											<?php else: ?>
													<option value="" disabled selected>-- No Available Course --</option>
											<?php endif; ?>
										</select>
										<span class="text-danger"> <?= display_error($validation, 'course'); ?></span>
								</div>
								<div class="form-group mb-3">
									<label for="Academic Status" class="form-label">*Academic Status</label>
										<select class="form-control" name="academic_status">
											<?php if (isset($academic_status)): ?>
												<?php foreach ($academic_status as $academicstatus): ?>
													<option value="<?=esc($academicstatus['id'])?>"><?=esc($academicstatus['academic_status'])?></option>
												<?php endforeach; ?>
											<?php else: ?>
													<option value="" disabled selected>-- No Available Course --</option>
											<?php endif; ?>
										</select>
										<span class="text-danger"> <?= display_error($validation, 'academicstatus'); ?></span>
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

<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/student">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">List of Research</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

  <div class="container-fluid form">
    <div class="row">
      <div class="col-lg-12 form-col">
        <h3>List of Researches</h3>
        <button type="button" class="btn btn-outline-dark mb-4" onclick="document.location = '<?=base_url()?>/professor'">All Researches</button>
        <button type="button" class="btn btn-outline-dark mb-4" onclick="document.location = '<?=base_url()?>/professor/getStudentResearch'">Student Researches</button>
        <button type="button" class="btn btn-outline-dark mb-4" onclick="document.location = '<?=base_url()?>/professor/getProfResearch'">Professor Researches</button>

           <div class="mt-2 mb-3">
             <table class="table table-bordered table-striped" id="research-list">
               <thead>
                 <tr>
                   <th>Id</th>
                   <th>Research Title</th>
                   <th>Keyword</th>
                   <th>School Year</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>


              <?php if($research): ?>

		              <?php foreach($research as $r): ?>
              			<?php if($r['research_status'] != 0 && $r['research_status'] != 3 && $r['deleted_at'] == null): ?>
			              <tr>
			                 <td><?php echo $r['id']; ?></td>
			                 <td><?php echo $r['title']; ?></td>
			                 <td><?php echo $r['keywords']; ?></td>
			                 <td><?php echo $r['school_year']; ?></td>
			                 <td>
                         <form method="post" action="<?=base_url()?>/professor/view_research2/<?= $r['id'] ?>">
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

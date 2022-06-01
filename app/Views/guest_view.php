
 <div class="container-fluid ">
    <div class="row">
      <div class="col-lg-12">
          <h3>List of Researches</h3>
          <div class="table-content">


             <table class="table table-hover table-bordered table-striped" id="research-list">
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


              <?php if($document): ?>
		              <?php foreach($document as $r): ?>
              			<?php if($r['research_status'] == 3 && $r['deleted_at'] == null): ?>
			              <tr>
			                 <td><?php echo $r['did']; ?></td>
			                 <td><?php echo $r['title']; ?></td>
			                 <td><?php echo $r['keywords']; ?></td>
			                 <td><?php echo $r['school_year']; ?></td>
			                 <td>
                         <form method="post" action="<?=base_url()?>/guest_view/<?= $r['did']?>">
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

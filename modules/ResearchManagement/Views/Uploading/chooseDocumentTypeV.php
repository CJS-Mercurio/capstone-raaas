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
<center>

  <div class="container-fluid form">
    <div class="row">
          <div class="col-lg-6 std-form mb-3">
            <div class="header">
              <h3 class="std-header mb-3">Choose Document Type</h3>
            </div>

            <div class="card mb-5" style="width: 18rem;">
              <ul class="list-group list-group-flush">
                <?php if($type): ?>
                   <?php foreach($type as $t): ?>
                      <li class="list-group-item"><a href="<?= base_url() ?>/research/upload"><?php echo $t['type'] ?></a></li>
                   <?php endforeach; ?>
                <?php endif; ?>
              </ul>
            </div>

          </div>
        </div>

	</div>
</div>
</center>

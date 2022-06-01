<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">My Library</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

  <div class="container-fluid form">
    <div class="row">
      <div class="col-lg-12 form-col">
        <h3>My Library</h3>
            <table class="table" id="seminar-list">
              <thead>
                <tr>
                  <td>Favorites</td>
                </tr>
              </thead>
              <tbody>
                <?php if($library): ?>
                  <?php foreach ($library as $r): ?>
                <tr>
                  <td>
                    <div class="col-10 favorite-col">
                      <h5 class="text-primary research-title">
                        <a href="<?=base_url()?>/research/viewResearchHome/<?= $r['id'] ?>"><?php echo $r['title']; ?></a>
                      </h5>
                      <b>
                        <h6 class="text-success"><?php echo $r['course_name']; ?></h6>
                      </b>
                      <?php if(empty($r['abstract'])): ?>
                        <i>
                          <h6 class="text-secondary">No abstract available</h6>
                        </i>
                      <?php else: ?>
                        <p class="abstract"><?php echo mb_strimwidth($r['abstract'], 0, 150, "...") ?></p>
                      <?php endif; ?>
                      <p class="text-primary">
                          <?php if($r['category_id']): ?>
                            <?php echo $r['category_id']; ?>
                          <?php endif; ?>
                          <b> | </b>
                          <?php if(empty($r['downloads'])):?>
                            Not yet cited
                          <?php else:?>
                            Cited by: <?php echo $r['downloads'] ?>
                          <?php endif;?>
                          <b> | </b> S.Y. <?php echo $r['school_year'];?>
                    </div>
                    <hr>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              </tbody>
            </table>

            <div class="alert alert-dark" role="alert" style="width: 100%;">
             No data found
            </div>
          <?php endif; ?>


          </div>
        </div>
    	</div>
    </div>
  </div>
</div>

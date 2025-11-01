<title>Keterangan - DigNet 1.0</title>
<h2 class='text text-primary'>Keterangan</h2>
<hr>
<div class="row">

  <?php
  $hasil = mysqli_query($conn,"SELECT * FROM post ORDER BY kode_post");
  while ($r = mysqli_fetch_array($hasil)) {
      ?>

      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" data-aos="fade-right">
        <div class="card text-center">
          <img class="card-img-top img-bordered-sm" src="<?php echo 'gambar/' . $r['gambar']; ?>" alt="" width="100%" height="200">
          <div class="card-block">
            <h4 class="card-title"><h3 class="bg-keterangan"><?php echo $r['nama_post']; ?></h3>
              <a class="btn btn-danger btn-flat margin" href="#" data-bs-toggle="modal" data-bs-target="#modal<?php echo $r['kode_post']; ?>"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Detail</a>
              <a class="btn btn-success btn-flat margin" href="#" data-bs-toggle="modal" data-bs-target="#modaltindakan<?php echo $r['kode_post']; ?>"><i class="fa fa-quote-right" aria-hidden="true"></i> Saran</a>
          </div>
        </div>
        <hr>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="modal<?php echo $r['kode_post'];?>" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header detail-ket">
              <h4 class="modal-title text text-ket"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Detail Untuk <?php echo $r['nama_post']; ?></h4>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: justify;text-justify: inter-word;">
              <p><?php echo $r['det_post']; ?></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>
      
      <!-- Modal -->
      <div class="modal fade" id="modaltindakan<?php echo $r['kode_post'];?>" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header saran-ket">
              <h4 class="modal-title text text-ket"><i class="fa fa-quote-right" aria-hidden="true"></i> Saran Untuk <?php echo $r['nama_post']; ?></h4>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: justify;text-justify: inter-word;">
              <p><?php echo $r['srn_post']; ?></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>



  <?php } ?>



</div>
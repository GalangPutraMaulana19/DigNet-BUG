<title>Keterangan - DigNet 1.0</title>

<!-- Premium Page Header -->
<div class="mb-5">
    <h2 class="text text-primary">
        <i class="fa-solid fa-book-open me-3"></i>
        Keterangan Gangguan IndiHome
    </h2>
    <p class="text-muted" style="font-size: 1.1rem; margin-top: 1rem;">
        Informasi lengkap tentang berbagai jenis gangguan IndiHome beserta solusi penanganannya
    </p>
</div>

<div class="row">

  <?php
  $hasil = mysqli_query($conn,"SELECT * FROM post ORDER BY kode_post");
  while ($r = mysqli_fetch_array($hasil)) {
      ?>

      <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 mb-4 fade-in-up" data-aos="fade-right">
        <div class="card text-center h-100 premium-shadow hover-lift">
          <img class="card-img-top img-bordered-sm" src="<?php echo 'gambar/' . $r['gambar']; ?>" alt="<?php echo $r['nama_post']; ?>" style="width: 100%; height: 200px; object-fit: cover;">
          <div class="card-body d-flex flex-column">
            <h3 class="bg-keterangan"><?php echo $r['nama_post']; ?></h3>
            <div class="mt-auto">
              <a class="btn btn-danger btn-flat mb-2 me-2" href="#" data-bs-toggle="modal" data-bs-target="#modal<?php echo $r['kode_post']; ?>">
                <i class="fa-solid fa-puzzle-piece" aria-hidden="true"></i> Detail
              </a>
              <a class="btn btn-success btn-flat mb-2" href="#" data-bs-toggle="modal" data-bs-target="#modaltindakan<?php echo $r['kode_post']; ?>">
                <i class="fa-solid fa-quote-right" aria-hidden="true"></i> Saran
              </a>
            </div>
          </div>
        </div>
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
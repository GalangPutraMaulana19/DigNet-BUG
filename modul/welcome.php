<title>Beranda - DigNet 1.0</title>
<?php 
  $htincident=mysqli_query($conn,"SELECT count(*) as total from incident");
  $dtincident=mysqli_fetch_assoc($htincident); ?>
  <div class='row'>
        <div class='col-lg-3 col-6'>
          <!-- info box -->
          <div class='info-box bg-info'>
            <span class='info-box-icon'>
              <i class='fa-solid fa-temperature-half'></i>
            </span>
            <div class='info-box-content'>
              <span class='info-box-text'>Total Gejala</span>
              <span class='info-box-number'><?php echo $dtincident["total"]; ?></span>
            </div>
          </div>
        </div>
        <!-- ./col -->
<?php 
  $htrepair=mysqli_query($conn,"SELECT count(*) as total from repair");
  $dtrepair=mysqli_fetch_assoc($htrepair); ?>
        <div class="col-lg-3 col-6">
          <!-- info box -->
          <div class="info-box bg-success">
            <span class="info-box-icon">
              <i class="fa-solid fa-bug"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Total Gangguan</span>
              <span class="info-box-number"><?php echo $dtrepair["total"]; ?></span>
            </div>
          </div>
        </div>
        <!-- ./col -->
<?php 
  $htpengetahuan=mysqli_query($conn,"SELECT count(*) as total from basis_pengetahuan");
  $dtpengetahuan=mysqli_fetch_assoc($htpengetahuan); ?>
        <div class="col-lg-3 col-6">
          <!-- info box -->
          <div class="info-box bg-warning">
            <span class="info-box-icon">
              <i class="fa-solid fa-flask"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Total Aturan</span>
              <span class="info-box-number"><?php echo $dtpengetahuan["total"]; ?></span>
            </div>
          </div>
        </div>
        <!-- ./col -->
<?php 
  $htadmin=mysqli_query($conn,"SELECT count(*) as total from admin");
  $dtadmin=mysqli_fetch_assoc($htadmin); ?>
        <div class="col-lg-3 col-6">
          <!-- info box -->
          <div class="info-box bg-danger">
            <span class="info-box-icon">
              <i class="fa-solid fa-user-plus"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Total Admin Pakar</span>
              <span class="info-box-number"><?php echo $dtadmin["total"]; ?></span>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
<div id="carousel-example-generic" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-bs-target="#carousel-example-generic" data-bs-slide-to="0" class=""></li>
                  <li data-bs-target="#carousel-example-generic" data-bs-slide-to="1" class="active"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="aset/banner/dignet.jpg" class="d-block w-100" alt="First slide">
                    <div class="carousel-caption">
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="aset/banner/dignet3.jpg" class="d-block w-100" alt="Second slide">
                    <div class="carousel-caption">
                    </div>
                  </div>
                </div> 
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel-example-generic" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel-example-generic" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
        <br>
            <div class="row">
                <div class="col-sm-4 text-center padding fadeIn" data-wow-duration="1000ms" data-wow-delay="300ms">
                    <div class="card">
                        <div class="card-body">
                            <img src="aset/banner/logo_telkomsel.png" alt="" class="mb-3" style="max-width: 120px;">
                            <h5 class="card-title">Aplikasi Responsif</h5>
                            <p class="card-text">Aplikasi sistem pakar ini dapat menyesuaikan ukuran perangkat, sehingga dapat diakses dengan nyaman melalui desktop maupun perangkat mobile.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 text-center padding fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="card">
                        <div class="card-body">
                            <img src="aset/banner/logo_telkomsel.png" alt="" class="mb-3" style="max-width: 120px;">
                            <h5 class="card-title">Bantu Teknisi Provisioning</h5>
                            <p class="card-text">Sistem pakar untuk membantu teknisi provisioning dalam mendiagnosis gangguan IndiHome selama masa retensi 60 hari dengan metode Forward Chaining dan Certainty Factor.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 text-center padding fadeIn" data-wow-duration="1000ms" data-wow-delay="900ms">
                    <div class="card">
                        <div class="card-body">
                            <img src="aset/banner/logo_telkomsel.png" alt="" class="mb-3" style="max-width: 120px;">
                            <h5 class="card-title">Basis Pengetahuan Pakar</h5>
                            <p class="card-text">Fitur admin pakar untuk mengelola basis pengetahuan, mengatur aturan diagnosis, dan nilai Certainty Factor untuk setiap kombinasi gejala dan gangguan.</p>
                        </div>
                    </div>
                </div>
            </div>
        <div></div>
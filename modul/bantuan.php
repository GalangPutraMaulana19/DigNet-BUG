<title>Bantuan - DigNet 1.0</title>
<style>
/* ========================================
   BANTUAN PAGE - SaaS Modern Premium Style
   ======================================== */

.bantuan-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

/* Premium Header */
.bantuan-header {
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
    color: white;
    padding: 2.5rem;
    border-radius: 16px;
    margin-bottom: 2rem;
    box-shadow: 0 10px 40px rgba(99, 102, 241, 0.3);
    position: relative;
    overflow: hidden;
}

.bantuan-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    border-radius: 50%;
}

.bantuan-header h2 {
    margin: 0 0 0.5rem 0;
    font-size: 2rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    position: relative;
    z-index: 1;
}

.bantuan-header p {
    margin: 0;
    opacity: 0.9;
    font-size: 1.1rem;
    position: relative;
    z-index: 1;
}

/* Tab Navigation - Modern Style */
.bantuan-tabs {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
}

.bantuan-tabs .nav-tabs {
    border: none;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    padding: 1rem 1rem 0 1rem;
    display: flex;
    gap: 0.5rem;
}

.bantuan-tabs .nav-tabs li {
    flex: 1;
}

.bantuan-tabs .nav-tabs li a {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 1rem 1.5rem;
    border-radius: 12px 12px 0 0;
    font-weight: 600;
    font-size: 0.95rem;
    color: #64748b;
    background: transparent;
    border: none;
    transition: all 0.3s ease;
    text-decoration: none;
}

.bantuan-tabs .nav-tabs li a:hover {
    color: #6366f1;
    background: rgba(99, 102, 241, 0.1);
}

.bantuan-tabs .nav-tabs li a.active,
.bantuan-tabs .nav-tabs li.active a {
    background: white;
    color: #6366f1;
    box-shadow: 0 -4px 10px rgba(0,0,0,0.05);
}

.bantuan-tabs .tab-content {
    padding: 2rem;
}

/* Contact Admin Section */
.contact-admin-section {
    text-align: center;
    padding: 4rem 2rem;
    background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    border-radius: 12px;
    margin: 1rem;
}

.contact-admin-section h2 {
    color: #0369a1;
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
}

.contact-admin-section p {
    color: #475569;
    font-size: 1rem;
    line-height: 1.7;
    max-width: 600px;
    margin: 0 auto 2rem auto;
}

.btn-contact-admin {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem 2rem;
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
}

.btn-contact-admin:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
}

/* Accordion Cards - Premium Style */
.accordion-premium {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.accordion-card {
    background: white;
    border-radius: 12px;
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    overflow: hidden;
    transition: all 0.3s ease;
}

.accordion-card:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.accordion-card .card-header {
    background: white;
    border: none;
    padding: 0;
}

.accordion-card .card-title {
    margin: 0;
}

.accordion-card .card-title a {
    display: flex;
    align-items: center;
    padding: 1.25rem 1.5rem;
    color: #1e293b;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
}

.accordion-card .card-title a::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 4px;
    border-radius: 0 4px 4px 0;
    transition: all 0.3s ease;
}

.accordion-card.card-primary .card-title a::before {
    background: linear-gradient(180deg, #6366f1, #8b5cf6);
}

.accordion-card.card-danger .card-title a::before {
    background: linear-gradient(180deg, #ef4444, #f97316);
}

.accordion-card.card-success .card-title a::before {
    background: linear-gradient(180deg, #22c55e, #10b981);
}

.accordion-card .card-title a::after {
    content: '\f078';
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    margin-left: auto;
    font-size: 0.85rem;
    color: #94a3b8;
    transition: transform 0.3s ease;
}

.accordion-card .card-title a:not(.collapsed)::after {
    transform: rotate(180deg);
}

.accordion-card .card-title a:hover {
    background: #f8fafc;
}

.accordion-card .card-body {
    padding: 0 1.5rem 1.5rem 1.5rem;
}

.accordion-card .card-body img {
    width: 100%;
    max-width: 800px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    margin-bottom: 1.5rem;
}

.step-list {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-radius: 12px;
    padding: 1.5rem;
}

.step-item {
    display: flex;
    gap: 1rem;
    padding: 0.75rem 0;
    border-bottom: 1px solid #e2e8f0;
    font-size: 0.95rem;
    color: #475569;
    line-height: 1.6;
}

.step-item:last-child {
    border-bottom: none;
}

.step-number {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 28px;
    height: 28px;
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    color: white;
    border-radius: 50%;
    font-size: 0.8rem;
    font-weight: 700;
    flex-shrink: 0;
}

/* Responsive */
@media only screen and (max-width: 1220px) {
    img {
        width: 100%;
    }
}

@media (max-width: 768px) {
    .bantuan-header {
        padding: 1.5rem;
        border-radius: 12px;
    }
    
    .bantuan-header h2 {
        font-size: 1.5rem;
    }
    
    .bantuan-tabs .nav-tabs {
        flex-direction: column;
        gap: 0.25rem;
    }
    
    .bantuan-tabs .nav-tabs li a {
        border-radius: 8px;
        justify-content: flex-start;
    }
    
    .bantuan-tabs .tab-content {
        padding: 1rem;
    }
    
    .contact-admin-section {
        padding: 2rem 1rem;
    }
}
</style>

<div class="bantuan-container">
    <!-- Premium Header -->
    <div class="bantuan-header">
        <h2>
            <i class="fa-solid fa-circle-question"></i>
            Bantuan Penggunaan Sistem Pakar
        </h2>
        <p>Panduan lengkap menggunakan DigNet untuk diagnosis gangguan IndiHome</p>
    </div>

    <!-- Tab Navigation -->
    <div class="bantuan-tabs nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class=""><a href="#tab_1" data-bs-toggle="tab" aria-expanded="false"><i class="fa-solid fa-paper-plane"></i> Bantuan Pakar</a></li>
              <li class="active"><a href="#tab_2" data-bs-toggle="tab" aria-expanded="true"><i class="fa-solid fa-user"></i> Bantuan User</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="tab_1">
                <div class="contact-admin-section">
                    <h2><i class="fa-solid fa-phone"></i> Hubungi Admin</h2>
                    <p>
                        Silahkan hubungi admin dengan mengklik tombol kontak admin. 
                        Jika butuh bantuan silahkan kirim pesan apa yang menjadi kendala.<br>
                        Email yang terdaftar sebagai pakar akan di tindak lanjuti.
                    </p>
                    <button class="btn-contact-admin" data-bs-toggle="modal" data-bs-target="#modalForm">
                        <i class="fa-solid fa-envelope"></i> Kontak Admin
                    </button>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="tab_2">
            <!-- /.box-header -->
            <div class="card-body" style="padding: 0;">
              <div class="accordion-premium" id="accordion">
                <!-- 1. Cara mengakses Menu -->
                <div class="accordion-card card-primary">
                  <div class="card-header">
                    <h4 class="card-title">
                      <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">
                        1. Cara mengakses Menu
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse">
                    <div class="card-body">
                        <a href="animasi/bantuan/user/menu.gif" target="_blank">
                            <img src="animasi/bantuan/user/menu.gif" alt="Mengakses Menu" />
                        </a>
                        <div class="step-list">
                            <div class="step-item">
                                <span class="step-number">1</span>
                                <span>Langkah pertama adalah mengarahkan kursor atau tangan ke bagian menu di samping kiri</span>
                            </div>
                            <div class="step-item">
                                <span class="step-number">2</span>
                                <span>Selanjutnya silahkan klik atau tekan menu yang ingin anda masuki.</span>
                            </div>
                            <div class="step-item">
                                <span class="step-number">3</span>
                                <span>Menu yang anda kehendaki telah di tampilkan.</span>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                
                <!-- 2. Cara Melakukan Diagnosa -->
                <div class="accordion-card card-danger">
                  <div class="card-header">
                    <h4 class="card-title">
                      <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">
                        2. Cara Melakukan Diagnosa
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="card-body">
                        <a href="animasi/bantuan/user/diagnosahasil.gif" target="_blank">
                            <img src="animasi/bantuan/user/diagnosahasil.gif" alt="Mengakses Diagnosa" />
                        </a>
                        <div class="step-list">
                            <div class="step-item">
                                <span class="step-number">1</span>
                                <span>Langkah pertama adalah mengarahkan kursor atau tangan ke bagian menu diagnosa</span>
                            </div>
                            <div class="step-item">
                                <span class="step-number">2</span>
                                <span>Selanjutnya silahkan cari gejala yang ditemui di lapangan pada perangkat IndiHome (ODP, ONT, STB, Telepon), misalnya "Lampu PON berkedip merah" atau "Tidak ada koneksi internet".</span>
                            </div>
                            <div class="step-item">
                                <span class="step-number">3</span>
                                <span>Pilih tingkat keyakinan anda terhadap gejala tersebut.</span>
                            </div>
                            <div class="step-item">
                                <span class="step-number">4</span>
                                <span>Pilih salah satu tingkat keyakinan, misal hampir pasti ya.</span>
                            </div>
                            <div class="step-item">
                                <span class="step-number">5</span>
                                <span>Selanjutnya jika terdapat gejala lain anda dapat memilih kembali, dan mengisi seperti langkah 3 & 4.</span>
                            </div>
                            <div class="step-item">
                                <span class="step-number">6</span>
                                <span>Jika sudah tekan tombol proses (<i class="fa-solid fa-magnifying-glass-plus"></i>) di bawah untuk melihat hasil diagnosis.</span>
                            </div>
                            <div class="step-item">
                                <span class="step-number">7</span>
                                <span>Hasil diagnosis akan ditampilkan dan jenis gangguan dapat diketahui beserta tingkat keyakinannya.</span>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                
                <!-- 3. Cara Membaca di Menu keterangan -->
                <div class="accordion-card card-primary">
                  <div class="card-header">
                    <h4 class="card-title">
                      <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#collapseFour" aria-expanded="false" class="collapsed">
                        3. Cara Membaca di Menu keterangan
                      </a>
                    </h4>
                  </div>
                  <div id="collapseFour" class="panel-collapse collapse">
                    <div class="card-body">
                        <a href="animasi/bantuan/user/postme.gif" target="_blank">
                            <img src="animasi/bantuan/user/postme.gif" alt="Mengakses Menu" />
                        </a>
                        <div class="step-list">
                            <div class="step-item">
                                <span class="step-number">1</span>
                                <span>Langkah pertama adalah mengarahkan kursor atau tangan ke bagian menu keterangan</span>
                            </div>
                            <div class="step-item">
                                <span class="step-number">2</span>
                                <span>Selanjutnya silahkan cari jenis gangguan yang ingin dilihat, akan ada tombol detail dan saran di bawahnya</span>
                            </div>
                            <div class="step-item">
                                <span class="step-number">3</span>
                                <span>Tekan tombol detail untuk melihat detail gangguan dan langkah diagnosis, jika sudah anda dapat menutup dengan tanda(x) di atas, atau tombol Close di bawah</span>
                            </div>
                            <div class="step-item">
                                <span class="step-number">4</span>
                                <span>Tekan tombol saran untuk melihat saran penanganan gangguan, jika sudah anda dapat menutup dengan tanda(x) di atas, atau tombol Close di bawah</span>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                
                <!-- 4. Cara Melihat Fitur Harga Harian -->
                <div class="accordion-card card-danger">
                  <div class="card-header">
                    <h4 class="card-title">
                      <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#collapseFive" class="collapsed" aria-expanded="false">
                        4. Cara Melihat Fitur Harga Harian
                      </a>
                    </h4>
                  </div>
                  <div id="collapseFive" class="panel-collapse collapse">
                    <div class="card-body">
                        <a href="animasi/bantuan/user/harga.gif" target="_blank">
                            <img src="animasi/bantuan/user/harga.gif" alt="Mengakses Diagnosa" />
                        </a>
                        <div class="step-list">
                            <div class="step-item">
                                <span class="step-number">1</span>
                                <span>Langkah pertama adalah mengarahkan kursor atau tangan ke bagian menu harga</span>
                            </div>
                            <div class="step-item">
                                <span class="step-number">2</span>
                                <span>Pastikan internet anda berfungsi, Jika anda offline maka hasilnya akan kosong (blank).</span>
                            </div>
                            <div class="step-item">
                                <span class="step-number">3</span>
                                <span>Pilih salah satu menu tab dengan mengklik menu yang dikehendaki.</span>
                            </div>
                            <div class="step-item">
                                <span class="step-number">4</span>
                                <span>Data harga akan tampil sesuai menu yang anda pilih.</span>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                
                <!-- 5. Cara Melihat Riwayat Konsultasi -->
                <div class="accordion-card card-success">
                  <div class="card-header">
                    <h4 class="card-title">
                      <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#collapseThree" class="" aria-expanded="true">
                       5. Cara Melihat Riwayat Konsultasi
                      </a>
                    </h4>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse in" aria-expanded="true">
                    <div class="card-body">
                        <a href="animasi/bantuan/user/riwayat.gif" target="_blank">
                            <img src="animasi/bantuan/user/riwayat.gif" alt="Mengakses Diagnosa" />
                        </a>
                        <div class="step-list">
                            <div class="step-item">
                                <span class="step-number">1</span>
                                <span>Langkah pertama adalah mengarahkan kursor atau tangan ke bagian menu riwayat</span>
                            </div>
                            <div class="step-item">
                                <span class="step-number">2</span>
                                <span>Selanjutnya silahkan cari riwayat yang dilihat, anda dapat menentukan riwayat mana berdasarkan tanggal.</span>
                            </div>
                            <div class="step-item">
                                <span class="step-number">3</span>
                                <span>Tekan tombol detail untuk melihat riwayat.</span>
                            </div>
                            <div class="step-item">
                                <span class="step-number">4</span>
                                <span>Jika sudah akan di arahkan ke hasil diagnosis yang telah di lakukan.</span>
                            </div>
                            <div class="step-item">
                                <span class="step-number">5</span>
                                <span>Anda dapat mencetak hasil diagnosis dengan menekan tombol cetak</span>
                            </div>
                            <div class="step-item">
                                <span class="step-number">6</span>
                                <span>Jika ingin melihat riwayat yang lain anda dapat mengklik navigasi, berupa angka di bawah hasil riwayat.</span>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
</div>

<script>
var d = document.getElementById("dignet-indihome");
d.className += " sidebar-collapse";
</script>
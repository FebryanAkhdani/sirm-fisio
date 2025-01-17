<?php $this->extend('layouts/template') ?>

<?php $this->section('title') ?>
List Pasien
<?php $this->endSection() ?>

<?php $this->section('content') ?>

<?php if (empty($terapis)) : ?>
    <div class="bg-white p-6 rounded-lg shadow-lg my-5">
        <div class="text-center">
            <h1 class="text-xl font-semibold">Tidak Ada Data Rekam Medis</h1>
        </div>
    </div>
<?php else : ?>
    <?php foreach ($terapis as $terapi) : ?>
        <div class="bg-white hover:bg-[#F2F2F7] p-6 rounded-lg shadow-lg mb-5">
            <div>
                <h1 class="text-xl font-semibold"><?= $terapi['nama'] ?></h1>
            </div>
            <div class="flex justify-between">
                <p><?= $terapi['j_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></p>
                <p><?= $terapi['tanggal'] ?></p>
            </div>
            <div class="flex justify-between">
                <p><?= $terapi['alamat'] ?></p>
                <p><?= $terapi['no_pendaftaran'] ?></p>
            </div>
            <div>
                <p><?= $terapi['username'] ?></p>
            </div>
            <div class="text-center mt-2">
                <!-- Tombol untuk membuka modal -->
                <button class="bg-[#6C69FF] text-white text-lg w-full p-3 rounded-lg" onclick="openModal(<?= $terapi['id'] ?>)">Lihat Selengkapnya</button>
            </div>
        </div>
    <?php endforeach ?>
<?php endif ?>

<!-- Modal -->
<div id="modalDetail" class="fixed inset-0 items-center flex justify-center bg-gray-600 bg-opacity-50 hidden">
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg relative">
            <button class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none" onclick="closeModal()">
                &times;
            </button>
            
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-blue-600">SIRM Fisio</h1>
                <p class="text-gray-600">Sistem Informasi Rekam Medis Praktik Mandiri Fisioterapi</p>
            </div>
            
            <div class="overlay-auto">
                <div id="identitasPasien">
                    <!-- Konten modal akan dimuat di sini -->
                </div>
                
                <div id="keluhan">
                    <!-- Konten modal akan dimuat di sini -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script -->
<script>
    // Fungsi untuk membuka modal dan memuat data terapi berdasarkan ID
    function openModal(id) {
        console.log("id: ", id);
        // Memuat data terapi menggunakan AJAX atau bisa juga menggunakan fetch API
        fetch(`/detail/${id}`)
            .then(response => response.json())
            .then(data => {
                // Function untuk mendapatkan usia berdasarkan tanggal lahir
                let birthDate = new Date(data.tgl_lahir);
                let today = new Date();
                let usia = today.getFullYear() - birthDate.getFullYear();
                let monthDiff = today.getMonth() - birthDate.getMonth();

                // Jika bulan saat ini lebih kecil dari bulan lahir atau bulan sama tapi hari lebih kecil, usia dikurangi 1
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    usia--;
                }
                // Menampilkan data detail terapi di dalam modal
                // console.log(data)
                const identitasPasien = document.getElementById('identitasPasien');
                identitasPasien.innerHTML = `
                <div class="text-center text-xl font-bold mb-3">
                    Identitas Pasien
                </div>

                <div class="grid grid-cols-2 gap-4 text-sm text-gray-800">
                    <div class="">Nama</div>
                    <div class="font-semibold text-end"> ${data.nama}</div>
                    
                    <div class="">No Pendaftaran</div>
                    <div class="font-semibold text-end"> ${data.no_pendaftaran}</div>
                    
                    <div class="">Jenis Kelamin</div>
                    <div class="font-semibold text-end"> ${data.j_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'}</div>
                    
                    <div class="">Alamat</div>
                    <div class="font-semibold text-end"> ${data.alamat}</div>
                    
                    <div class="">Fisioterapis</div>
                    <div class="font-semibold text-end"> ${data.username}</div>
                    
                    <div class="">Nomor HP</div>
                    <div class="font-semibold text-end"> ${data.no_hp}</div>
                    
                    <div class="">Tanggal Lahir/Usia</div>
                    <div class="font-semibold text-end"> ${data.tgl_lahir.split(" ")[0]} / ${usia}</div>
                    
                    <div class="">Pekerjaan</div>
                    <div class="font-semibold text-end"> ${data.pekerjaan}</div>
                </div>
                `;

                const keluhan = document.getElementById('keluhan');
                keluhan.innerHTML = `
                <div class="text-center text-xl font-bold my-3">
                    Keluhan
                </div>

                <div class="grid grid-cols-2 gap-4 text-sm text-gray-800">
                    <div class="">Keluhan Utama</div>
                    <div class="font-semibold text-end"> ${data.keluhan_utama}</div>

                    <div class="">Riwayat Utama</div>
                    <div class="font-semibold text-end"> ${data.riwayat_utama}</div>

                    <div class="">Pemeriksaan</div>
                    <div class="font-semibold text-end"> ${data.pemeriksaan}</div>

                    <div class="">Treatment</div>
                    <div class="font-semibold text-end"> ${data.treatment}</div>

                    <div class="">Kesimpulan</div>
                    <div class="font-semibold text-end"> ${data.kesimpulan}</div>

                    <div class="">Latihan Rumah</div>
                    <div class="font-semibold text-end"> ${data.latihan_rumah}</div>

                    <div class="">Evaulasi</div>
                    <div class="font-semibold text-end"> ${data.evaluasi}</div>
                </div>
                `;
                // Menampilkan modal
                document.getElementById('modalDetail').classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    // Fungsi untuk menutup modal
    function closeModal() {
        document.getElementById('modalDetail').classList.add('hidden');
    }
</script>

<?php $this->endSection() ?>
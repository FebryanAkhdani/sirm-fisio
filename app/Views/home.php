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
            <div class="text-center">
                <!-- Tombol untuk membuka modal -->
                <button class="bg-[#6C69FF] text-white text-lg w-full p-3 rounded-lg" onclick="openModal(<?= $terapi['id'] ?>)">Lihat Selengkapnya</button>
            </div>
        </div>
    <?php endforeach ?>
<?php endif ?>

<!-- Modal -->
<div id="modalDetail" class="fixed inset-0 items-center flex justify-center bg-gray-600 bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
        <h2 class="text-2xl font-semibold mb-4">Detail Terapi</h2>
        <div id="modalContent">
            <!-- Konten modal akan dimuat di sini -->
        </div>
        <button onclick="closeModal()" class="bg-red-500 text-white px-4 py-2 rounded-lg mt-4">Tutup</button>
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
                // Menampilkan data detail terapi di dalam modal
                console.log(data)
                const modalContent = document.getElementById('modalContent');
                modalContent.innerHTML = `
                <div class="grid grid-cols-4 gap-2">
                    <div><strong>Nama Pasien</strong></div>
                    <div>: ${data.nama}</div>

                    <div><strong>Jenis Kelamin</strong></div>
                    <div>: ${data.j_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'}</div>

                    <div><strong>Alamat</strong></div>
                    <div>: ${data.alamat}</div>

                    <div><strong>Nomor Pendaftaran</strong></div>
                    <div>: ${data.no_pendaftaran}</div>

                    <div><strong>Username</strong></div>
                    <div>: ${data.username}</div>

                    <div><strong>Tanggal Terapi</strong></div>
                    <div>: ${data.tanggal}</div>
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
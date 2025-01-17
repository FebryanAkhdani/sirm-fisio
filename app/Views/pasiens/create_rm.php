<?= $this->extend('layouts/template') ?>

<?= $this->section('title') ?>
Rekam Medis
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<form action="/store" method="post">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="bg-transparent border-b-4 border-primary w-1/4">
            <h2 class="text-primary font-bold text-xl">Status Klinik Pasien</h2>
        </div>
        <div class="mt-5">
            <div class="mt-5">
                <label for="id_fisioterapis" class="block text-lg font-semibold text-gray-900">Fisioterapis</label>
                <div class="relative mt-1">
                    <select name="id_fisioterapis" id="id_fisioterapis" placeholder="Pilih fisioterapis" class="block w-1/2 px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
                        <?php foreach ($fisioterapis as $fisioterapi): ?>
                            <option value="<?= $fisioterapi['id'] ?>"><?= $fisioterapi['username'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="mt-5">
                <label for="tanggal" class="block text-lg font-semibold text-gray-900">Tanggal Periksa</label>
                <div class="relative mt-1">
                    <input type="date" name="tanggal" id="tanggal" placeholder="Pilih tanggal" class="block w-1/2 px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-lg mt-5 grid grid-cols-2 gap-6 w-full">
        <?= csrf_field(); ?>
        <!-- Kolom pertama -->
        <div class="col-span-1" id="first-column">
            <div class="mt-5">
                <label for="nama_pasien" class="block text-lg font-semibold text-gray-900">Nama Pasien atau Atlet</label>
                <div class="relative mt-1">
                    <input type="text" name="nama_pasien" id="nama_pasien" placeholder="Masukkan nama pasien atau atlet" class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
                </div>
            </div>

            <div class="mt-5">
                <label for="j_kelamin" class="block text-lg font-semibold text-gray-900">Jenis Kelamin</label>
                <div class="relative mt-1">
                    <select name="j_kelamin" id="j_kelamin" placeholder="Pilih Jenis Kelamin" class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
                        <option value="" selected>-- Pilih --</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="mt-5">
                <label for="tgl_lahir" class="block text-lg font-semibold text-gray-900">Tanggal Lahir</label>
                <div class="relative mt-1">
                    <input type="date" name="tgl_lahir" id="tgl_lahir" placeholder="Masukkan umur" class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
                </div>
            </div>

            <div class="mt-5">
                <label for="alamat" class="block text-lg font-semibold text-gray-900">Alamat</label>
                <div class="relative mt-1">
                    <input type="text" name="alamat" id="alamat" placeholder="Masukkan alamat" class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
                </div>
            </div>

            <div class="mt-5">
                <label for="no_hp" class="block text-lg font-semibold text-gray-900">Nomor HP</label>
                <div class="relative mt-1">
                    <input type="text" name="no_hp" id="no_hp" placeholder="Masukkan nomor HP" class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
                </div>
            </div>

            <div class="mt-5">
                <label for="pekerjaan" class="block text-lg font-semibold text-gray-900">Pekerjaan</label>
                <div class="relative mt-1">
                    <input type="text" name="pekerjaan" id="pekerjaan" placeholder="Masukkan pekerjaan" class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
                </div>
            </div>

            <div class="mt-5 flex justify-end">
                <button id="next" type="button" class="bg-primary text-white font-semibold p-3 rounded-lg">Selanjutnya</button>
                <button id="submit" type="submit" class="bg-primary text-white font-semibold p-3 rounded-lg hidden">Simpan</button>
            </div>
        </div>

        <!-- Kolom kedua -->
        <div class="col-span-1 hidden" id="second-column">
            <div class="mt-5">
                <label for="keluhan_utama" class="block text-lg font-semibold text-gray-900">Keluhan Utama</label>
                <div class="relative mt-1">
                    <input type="text" name="keluhan_utama" id="keluhan_utama" placeholder="Masukkan keluhan utama" class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
                </div>
            </div>

            <div class="mt-5">
                <label for="riwayat_keluhan" class="block text-lg font-semibold text-gray-900">Riwayat Keluhan</label>
                <div class="relative mt-1">
                    <input type="text" name="riwayat_keluhan" id="riwayat_keluhan" placeholder="Masukkan riwayat keluhan" class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
                </div>
            </div>

            <div class="mt-5">
                <label for="pemeriksaan" class="block text-lg font-semibold text-gray-900">Pemeriksaan</label>
                <div class="relative mt-1">
                    <input type="text" name="pemeriksaan" id="pemeriksaan" placeholder="Masukkan pemeriksaan" class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
                </div>
            </div>

            <div class="mt-5">
                <label for="treatment" class="block text-lg font-semibold text-gray-900">Treatment</label>
                <div class="relative mt-1">
                    <input type="text" name="treatment" id="treatment" placeholder="Masukkan treatment" class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
                </div>
            </div>

            <div class="mt-5">
                <label for="kesimpulan" class="block text-lg font-semibold text-gray-900">Kesimpulan</label>
                <div class="relative mt-1">
                    <input type="text" name="kesimpulan" id="kesimpulan" placeholder="Masukkan kesimpulan" class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
                </div>
            </div>

            <div class="mt-5">
                <label for="latihan_rumah" class="block text-lg font-semibold text-gray-900">Latihan Rumah</label>
                <div class="relative mt-1">
                    <input type="text" name="latihan_rumah" id="latihan_rumah" placeholder="Masukkan latihan rumah" class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
                </div>
            </div>

            <div class="mt-5">
                <label for="evaluasi" class="block text-lg font-semibold text-gray-900">Evaluasi</label>
                <div class="relative mt-1">
                    <input type="text" name="evaluasi" id="evaluasi" placeholder="Masukkan evaluasi" class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const nextButton = document.getElementById("next");
        const submitButton = document.getElementById("submit");
        const firstColumn = document.getElementById("first-column");
        const secondColumn = document.getElementById("second-column");
        const inputsFirstColumn = firstColumn.querySelectorAll("input, select");

        function checkFields() {
            let allFilled = true;
            inputsFirstColumn.forEach(function(input) {
                if (!input.value) {
                    allFilled = false;
                }
            });
            return allFilled;
        }

        nextButton.addEventListener("click", function() {
            if (checkFields()) {
                secondColumn.classList.remove("hidden");
                secondColumn.classList.add("animate-slide-in-from-left");
                nextButton.classList.add("hidden");
                submitButton.classList.remove("hidden");
            } else {
                alert("Harap isi semua field sebelum melanjutkan.");
            }
        });
    });
</script>

<style>
    @keyframes slideInFromLeft {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(0);
        }
    }

    .animate-slide-in-from-left {
        animation: slideInFromLeft 0.5s ease-out forwards;
    }
</style>
<?= $this->endSection() ?>
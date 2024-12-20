<?php

namespace App\Controllers;

use App\Models\PasienModel;
use App\Models\TerapiModel;
use CodeIgniter\Database\Exceptions\DataException;
use Carbon\Carbon;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\GroupModel;

class Home extends BaseController
{
    protected $pasiensModel;
    protected $terapiModel;

    public function __construct()
    {
        $this->pasiensModel = new PasienModel();
        $this->terapiModel = new TerapiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard'
        ];

        return view('home', $data);
    }

    public function create()
    {
        return view('pasiens/create');
    }

    public function store()
    {
        try {
            // Ambil data pasien dari request
            $pasien = [
                'nama' => $this->request->getPost('nama_pasien'),
                'tgl_lahir' => $this->request->getPost('tgl_lahir'),
                'alamat' => $this->request->getPost('alamat'),
                'no_hp' => $this->request->getPost('no_hp'),
                'pekerjaan' => $this->request->getPost('pekerjaan'),
                'j_kelamin' => $this->request->getPost('j_kelamin')
            ];

            // Format tanggal lahir pasien
            $pasien['tgl_lahir'] = Carbon::now()->format('Y-m-d H:i:s.u');

            // Cek apakah pasien sudah ada
            $pasienExist = $this->pasiensModel
                ->where('nama', $pasien['nama'])
                ->where('tgl_lahir', $pasien['tgl_lahir'])
                ->first();

            // Jika pasien tidak ada, lakukan insert
            if (!$pasienExist) {
                $this->pasiensModel->insert($pasien);
                $idPasien = $this->pasiensModel->getInsertID();
            } else {
                // Pasien sudah ada, gunakan ID yang ada
                $idPasien = $pasienExist['id'];
            }

            // Data terapi yang akan diinputkan
            $terapi = [
                'no_pendaftaran' => $this->request->getPost('no_pendaftaran'),
                'id_pasien' => $idPasien,
                'id_fisioterapis' => 1, // Contoh ID fisioterapis
                'tanggal' => $this->request->getPost('tanggal'),
                'keluhan_utama' => $this->request->getPost('keluhan_utama'),
                'riwayat_keluhan' => $this->request->getPost('riwayat_keluhan'),
                'pemeriksaan' => $this->request->getPost('pemeriksaan'),
                'treatment' => $this->request->getPost('treatment'),
                'kesimpulan' => $this->request->getPost('kesimpulan'),
                'latihan_rumah' => $this->request->getPost('latihan_rumah'),
                'evaluasi' => $this->request->getPost('evaluasi'),
            ];

            // Format tanggal terapi
            $terapi['tanggal'] = Carbon::now()->format('Y-m-d H:i:s.u');

            // Insert terapi ke database
            $this->terapiModel->insert($terapi);

            // Redirect ke halaman sebelumnya dengan pesan sukses
            return redirect()->back()->with('message', 'Data pasien dan terapi berhasil disimpan!');
        } catch (\Exception $e) {
            // Jika terjadi error, tangkap dan kembalikan dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit()
    {
        return view('pasiens/edit');
    }

    public function lists()
    {
        $allTerapi = $this->terapiModel->getAllTerapiWithPasienAndUsers();

        // Pastikan $pasiens dikirim sebagai array asosiatif
        return view('pasiens/lists', ['terapis' => $allTerapi]);
    }

    public function detail($id)
    {
        $getTerapi = $this->terapiModel->getTerapiWithPasienAndUsers($id);
        if ($getTerapi == null) {
            error_log("ID not found: " . $id);
            return $this->response->setStatusCode(404, "Data tidak ditemukan");
        }
        return $this->response->setJSON($getTerapi);
    }

    public function register()
    {
        // Validasi input
        $rules = [
            'email'            => 'required|valid_email|is_unique[auth_identities.secret]',
            'username'         => 'required|min_length[3]|is_unique[users.username]',
            'password'         => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', array_values($this->validator->getErrors()));
        }

        // Gunakan metode registrasi Shield
        $users = model(UserModel::class);

        try {
            $users = auth()->getProvider();

            $user = new User([
                'username' => $this->request->getPost('username'),
                'email'    => $this->request->getPost('email'),
                'password' => $this->request->getPost('password')
            ]);

            $users->save($user);

            // To get the complete user object with ID, we need to get from the database
            $user = $users->findById($users->getInsertID());

            // Add to default group
            // $users->addToDefaultGroup($user);
            $users->addToGroup($user, 'fisioterapis');

            // Aktifkan user
            $user->activate();

            return redirect()->back()->with('message', 'User berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}

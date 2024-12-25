<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?></title>
    <link rel="shortcut icon" type="image/png" href="/">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/sweetalert2.min.css') ?>" rel="stylesheet">
    <!-- Tailwind CSS CDN (Optional if using local) -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> -->
</head>

<body class="bg-gray-100 h-screen flex flex-col">
    <div class="flex flex-1">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar bg-primary text-white w-64 max-w-64 min-h-screen p-4 space-y-6 rounded-tr-2xl transition-all duration-300 ease-in-out divide-y flex flex-col">
            <div class="flex items-center">
                <button id="toggleSidebar" class="text-white text-xl font-semibold">☰</button>
                <div id="sidebarTitle" class="flex flex-col ml-4">
                    <span class="text-2xl font-semibold" id="sidebarTitle">SIRM Fisio</span>
                    <small class="text-xs">Sistem Rekam Medis Praktik Mandiri Fisioterapi</small>
                </div>
            </div>
            <nav class="flex-grow">
                <ul>
                    <li class="pb-2 mt-2">
                        <a href="/" class="hover:bg-hoverSidebar hover:rounded-lg px-2 py-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span class="ml-3 text-xl font-semibold sidebar-text">Beranda</span>
                        </a>
                    </li>
                    <?php if (auth()->user()->inGroup('admin')): ?>
                        <li class="pb-2 mt-2">
                            <a href="/create-rm" class="hover:bg-hoverSidebar hover:rounded-lg px-2 py-2 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                </svg>
                                <span class="ml-3 text-xl font-semibold sidebar-text">Rekam Medis</span>
                            </a>
                        </li>
                        <li class="pb-2 mt-2">
                            <a href="/create" class="hover:bg-hoverSidebar hover:rounded-lg px-2 py-2 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                </svg>
                                <span class="ml-3 text-xl font-semibold sidebar-text">Tambah Terapis</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>

            <!-- Tombol Logout -->
            <div class="pt-4">
                <a href="/logout" class="hover:bg-hoverSidebar hover:rounded-lg px-2 py-2 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-9A2.25 2.25 0 0 0 2.25 5.25v13.5A2.25 2.25 0 0 0 4.5 21h9a2.25 2.25 0 0 0 2.25-2.25V15M18 12h6m0 0-3-3m3 3-3 3" />
                    </svg>
                    <span class="ml-3 text-xl font-semibold sidebar-text">Logout</span>
                </a>
            </div>
        </aside>

        <!-- Content -->
        <main id="mainContent" class="flex-1 p-6 bg-white transition-all duration-300 ease-in-out shadow-xl">
            <?php $this->renderSection('content') ?>
        </main>
    </div>

    <!-- Toggle Sidebar Script -->
    <script>
        const toggleButton = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const sidebarTitle = document.getElementById('sidebarTitle');
        const sidebarText = document.querySelectorAll('.sidebar-text');
        const mainContent = document.getElementById('mainContent');

        toggleButton.addEventListener('click', () => {
            // Toggle the width of the sidebar
            sidebar.classList.toggle('w-64'); // Default size
            sidebar.classList.toggle('w-20'); // Collapsed size

            // Toggle the visibility of the sidebar title
            sidebarTitle.classList.toggle('hidden'); // Hide the sidebar title

            // Toggle the visibility of the text in the sidebar links
            sidebarText.forEach((text) => {
                text.classList.toggle('hidden');
            });
        });
    </script>

    <!-- Tambahkan file JavaScript SweetAlert2 -->
    <script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>

    <!-- Tambahkan file JavaScript custom (misal: script.js) -->
    <script src="<?= base_url('assets/js/script.js') ?>"></script>

    <!-- SweetAlert2 Implementation -->
    <script>
        window.addEventListener('load', function() {
            <?php if (session()->getFlashdata('message')): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '<?= session()->getFlashdata('message'); ?>',
                    confirmButtonText: 'OK'
                });
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '<?= session()->getFlashdata('error'); ?>',
                    confirmButtonText: 'OK'
                });
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: `<?php
                            $errors = session()->getFlashdata('errors');
                            if (is_array($errors)) {
                                echo implode('<br>', $errors);
                            } else {
                                echo $errors;
                            }
                            ?>`,
                    confirmButtonText: 'OK'
                });
            <?php endif; ?>
        });
    </script>
</body>

</html>
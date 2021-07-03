<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= site_url('Dashboard') ?>">Dashboard</a></div>
                <div class="breadcrumb-item">Pengaturan</div>
                <div class="breadcrumb-item"><?= $title ?></div>
            </div>
        </div>

        <div class="section-body">
            <button class="btn btn-primary" id="btn-tambah"><i class="fas fa-plus"></i> Pengguna Baru</button>

            <div class="row mt-4">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class='table table-sm table-hover table-striped' id="table-menu">
                                <thead style="background-color: #4361ee; color: #fff">
                                    <tr>
                                        <th class='text-center' style="width: 5%;">No</th>
                                        <th style="width: 10%;">ID Pengguna</th>
                                        <th style="width: 20%;">Nama</th>
                                        <th style="width: 20%;">Username</th>
                                        <th style="width: 5%;">Role</th>
                                        <th class='text-center' style="width: 10%;">Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-label"></h5>
            </div>
            <form method="POST" id="form-tambah" form-type='' class="needs-validation" novalidate>
                <div class="modal-body">
                    <input type="hidden" name="user_id" id="user_id" readonly>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" value="" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" value="" id="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" value="" id="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="">-pilih-</option>
                            <?php foreach ($roles as $row) : ?>
                                <option value="<?= $row['role_id'] ?>"><?= $row['role_id'] . ' - ' . $row['role_name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btn-close">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->load->view('_partials/footer'); ?>
<?php $this->load->view('setting/users/script'); ?>
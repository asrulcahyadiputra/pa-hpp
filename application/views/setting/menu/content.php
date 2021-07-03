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
                <div class="breadcrumb-item">Data Master</div>
                <div class="breadcrumb-item"><?= $title ?></div>
            </div>
        </div>

        <div class="section-body">
            <button class="btn btn-primary" id="btn-tambah"><i class="fas fa-plus"></i> Menu Baru</button>

            <div class="row mt-4">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Menu Item</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Menu Akses</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <table class='table table-sm table-hover table-striped' id="table-menu">
                                        <thead style="background-color: #4361ee; color: #fff">
                                            <tr>

                                                <th class='text-center' style="width: 10%;">Tcode</th>
                                                <th style="width: 20%;">Nama</th>
                                                <th style="width: 20%;">Url</th>
                                                <th style="width: 5%;">Icon</th>
                                                <th style="width: 5%;">NU</th>
                                                <th style="width: 10%;">Kode Header</th>
                                                <th class='text-center' style="width: 10%;">Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <form class="form-inline mt-4" id="form-akses">
                                        <label class="my-1 mr-2" for="role_id">Role User</label>
                                        <select class="custom-select my-1 mr-sm-4" name="role_id" id="role_id">
                                            <option value="">Pilih Role User</option>
                                            <?php foreach ($roles as $row) : ?>
                                                <option value="<?= $row['role_id'] ?>"><?= $row['role_id'] . ' - ' . $row['role_name'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <button type="button" class="btn btn-light my-1" id="btn-load-akses"><i class="fa fa-sync"></i></button>

                                        <div class="col-12 mt-4" id="load-akses-here"></div>
                                    </form>
                                </div>
                            </div>
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
                    <div class="form-group">
                        <label for="tcode">Tcode</label>
                        <input type="text" name="tcode" value="" id="tcode" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="menu_name">Nama Menu</label>
                        <input type="text" name="menu_name" value="" id="menu_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="url">Url</label>
                        <input type="text" name="url" value="" id="url" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="menu_icon">Icon</label>
                        <input type="text" name="menu_icon" value="" id="menu_icon" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nu">NU</label>
                        <input type="text" name="nu" value="" id="nu" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="head_id">Menu Header</label>
                        <select name="head_id" id="head_id" class="form-control" required>
                            <option value="">-pilih-</option>
                            <?php foreach ($head as $rowData) : ?>
                                <option value="<?= $rowData['head_id'] ?>"><?= $rowData['head_id'] . ' - ' . $rowData['head_name'] ?></option>
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
<?php $this->load->view('setting/menu/script'); ?>
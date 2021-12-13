<div class="main-content">
<section class="section">
    <div class="section-header">
        <h1>Data Ibu Hamil</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Data Posyandu</a></div>
            <div class="breadcrumb-item"><a href="#">Ibu Hamil</a></div>
            <div class="breadcrumb-item">Detail</div>
        </div>
    </div>

    <div class="section-body">
        <div class="text-left pb-4">
            <a class="btn btn-primary tombolfull" href="<?= base_url('bumil'); ?>">
                <i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Info Data Bumil</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10 col-sm-12">

                        <div class="table-responsive-md">
                            <table class="table table-sm table-borderless" cellspacing="0"  width="100%">
                                <tr>
                                    <th>Desa</th>
                                    <th width="2%">:</th>
                                    <td width="72%"><?= $data_bml->desa_name; ?></td>
                                </tr>
                                <tr>
                                    <th>Posyandu</th>
                                    <th>:</th>
                                    <td><?= $data_bml->pos_name; ?></td>
                                </tr>
                                <tr>
                                    <th>Nomor KMS</th>
                                    <th>:</th>
                                    <td><?= $data_bml->nik; ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Ibu</th>
                                    <th>:</th>
                                    <td><?= $data_bml->nama_ibu; ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Bapak</th>
                                    <th>:</th>
                                    <td><?= $data_bml->nama_bapak; ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Bayi</th>
                                    <th>:</th>
                                    <td><?= $data_bml->nama_bayi; ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir Bayi</th>
                                    <th>:</th>
                                    <td><?= $data_bml->tgl_lahir_bayi; ?></td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin Bayi</th>
                                    <th>:</th>
                                    <td><?= ( $data_bml->jk_bayi == "L" ? "Laki-laki" : "Perempuan"); ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Meninggal Bayi</th>
                                    <th>:</th>
                                    <td><?= ( !empty($data_bml->tgl_meninggal_bayi) ? $data_bml->tgl_meninggal_bayi : "-") ; ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Meninggal Ibu</th>
                                    <th>:</th>
                                    <td><?= ( !empty($data_bml->tgl_meninggal_ibu) ? $data_bml->tgl_meninggal_ibu : "-") ; ?></td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <th>:</th>
                                    <td><?= ( !empty($data_bml->keterangan) ? $data_bml->keterangan : "-") ; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-right">
                    Di data oleh <strong><?= $data_bml->nama_pic; ?></strong> sejak <strong><?= $data_bml->created_on; ?></strong>.
                </div>
            </div>
        </div>
    </div>
</section>
</div>
<script type="text/javascript">


</script>
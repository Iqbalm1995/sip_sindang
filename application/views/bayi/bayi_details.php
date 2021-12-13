<div class="main-content">
<section class="section">
    <div class="section-header">
        <h1>Data Bayi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Data Posyandu</a></div>
            <div class="breadcrumb-item"><a href="#">Bayi</a></div>
            <div class="breadcrumb-item">Detail</div>
        </div>
    </div>

    <div class="section-body">
        <div class="text-left pb-4">
            <a class="btn btn-primary tombolfull" href="<?= base_url('bayi'); ?>">
                <i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="offset-md-2 col-md-8 offset-md-2 col-sm-12">
                        <h2 class="section-title pb-2">Data Bayi</h2>
                        <div class="table-responsive-md">
                            <table class="table table-sm table-borderless table-striped" cellspacing="0"  width="100%">
                                <tr>
                                    <th>Desa</th>
                                    <th width="2%">:</th>
                                    <td width="70%"><?= $data_bayi->desa_name; ?></td>
                                </tr>
                                <tr>
                                    <th>Posyandu</th>
                                    <th>:</th>
                                    <td><?= $data_bayi->pos_name; ?></td>
                                </tr>
                                <tr>
                                    <th>Nomor KMS</th>
                                    <th>:</th>
                                    <td><?= $data_bayi->kms; ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Bayi</th>
                                    <th>:</th>
                                    <td><?= $data_bayi->nama_bayi; ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir Bayi</th>
                                    <th>:</th>
                                    <td><?= $data_bayi->tgl_lahir_bayi; ?></td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin Bayi</th>
                                    <th>:</th>
                                    <td><?= ( $data_bayi->jk_bayi == "L" ? "Laki-laki" : "Perempuan"); ?></td>
                                </tr>
                                <tr>
                                    <th>Bayi Baru Lahir (BBL)</th>
                                    <th>:</th>
                                    <td><?= ( $data_bayi->bbl == "1" ? "Ya"  : "Tidak") ; ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Ibu</th>
                                    <th>:</th>
                                    <td><?= $data_bayi->nama_ibu; ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Bapak</th>
                                    <th>:</th>
                                    <td><?= $data_bayi->nama_bapak; ?></td>
                                </tr>
                                <tr>
                                    <th>Kel. Dawis</th>
                                    <th>:</th>
                                    <td><?= ( $data_bayi->kel_dawis > 0 ? $data_bayi->kel_dawis : "-") ; ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Meninggal Bayi</th>
                                    <th>:</th>
                                    <td><?= ( !empty($data_bayi->tgl_meninggal_bayi) ? $data_bayi->tgl_meninggal_bayi : "-") ; ?></td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <th>:</th>
                                    <td><?= ( !empty($data_bayi->keterangan) ? $data_bayi->keterangan : "-") ; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="offset-md-2 col-md-8 offset-md-2 col-sm-12">
                        <h2 class="section-title pb-2">Data Penimbangan Bayi</h2>
                        <div class="table-responsive-md">
                            <table border="0" class="table table-sm table-borderless table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col"><strong>Bulan</strong></th>
                                        <th scope="col"><strong>Tinggi (cm)</strong></th>
                                        <th scope="col"><strong>Berat (kg)</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (count($data_penimbangan) > 0) {
                                            foreach ($data_penimbangan as $key => $value) { $arrayNum=0; ?>
                                            <tr>
                                                <th scope="row"><?= ARRAY_BULAN[$value->bulan]; ?></th>
                                                <td><?= $value->tinggi_sekarang; ?> cm</td>
                                                <td><?= $value->berat_sekarang; ?> kg</td>
                                            </tr>
                                        <?php } ?>
                                    <?php }else{ ?>
                                        <?php foreach (ARRAY_BULAN as $key => $value) {  $arrayNum=0; ?>
                                            <tr>
                                                <th scope="row"><?= $value; ?></th>
                                                <td>0 cm</td>
                                                <td>0 kg</td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="offset-md-2 col-md-8 offset-md-2 col-sm-12">
                        <h2 class="section-title pb-2">Data Pelayanan</h2>
                        <div class="table-responsive-md">
                            <table border="0" class="table table-sm table-borderless table-striped" style="width:100%">
                                <tr>
                                    <th colspan="3"><strong>Sirup Besi (Tahun-Bulan-Tanggal)</strong></th>
                                </tr>
                                <tr>
                                    <th>&nbsp; FE I BLN</th>
                                    <th width="2%">:</th>
                                    <td width="70%"><?= ( !empty($data_bayi->pyd_syrp_besi_fe1) ? $data_bayi->pyd_syrp_besi_fe1 : "-"); ?></td>
                                </tr>
                                <tr>
                                    <th>&nbsp; FE II BLN</th>
                                    <th>:</th>
                                    <td><?= ( !empty($data_bayi->pyd_syrp_besi_fe2) ? $data_bayi->pyd_syrp_besi_fe2 : "-"); ?></td>
                                </tr>

                                <tr>
                                    <th colspan="3"><strong>Vitamin A (Tahun-Bulan-Tanggal)</strong></th>
                                </tr>
                                <tr>
                                    <th>&nbsp; BLN 1</th>
                                    <th>:</th>
                                    <td><?= ( !empty($data_bayi->pyd_vit_a_bln1) ? $data_bayi->pyd_vit_a_bln1 : "-"); ?></td>
                                </tr>
                                <tr>
                                    <th>&nbsp; BLN 2</th>
                                    <th>:</th>
                                    <td><?= ( !empty($data_bayi->pyd_vit_a_bln2) ? $data_bayi->pyd_vit_a_bln2 : "-"); ?></td>
                                </tr>

                                <tr>
                                    <th><strong>Oralit</strong></th>
                                    <th>:</th>
                                    <td><?= ( $data_bayi->pyd_oralit == '1' ? '<i class="fas fa-check"></i> (Sudah)' : '<i class="fas fa-times"></i> (Belum)'); ?></td>
                                </tr>

                                <tr>
                                    <th><strong>BCG</strong></th>
                                    <th>:</th>
                                    <td><?= ( $data_bayi->pyd_bcg == '1' ? '<i class="fas fa-check"></i> (Sudah)' : '<i class="fas fa-times"></i> (Belum)'); ?></td>
                                </tr>

                                <tr>
                                    <th colspan="3"><strong>DPT</strong></th>
                                </tr>
                                <tr>
                                    <th>&nbsp; DPT 1</th>
                                    <th>:</th>
                                    <td><?= ( $data_bayi->pyd_dpt1 == '1' ? '<i class="fas fa-check"></i> (Sudah)' : '<i class="fas fa-times"></i> (Belum)'); ?></td>
                                </tr>
                                <tr>
                                    <th>&nbsp; DPT 2</th>
                                    <th>:</th>
                                    <td><?= ( $data_bayi->pyd_dpt2 == '1' ? '<i class="fas fa-check"></i> (Sudah)' : '<i class="fas fa-times"></i> (Belum)'); ?></td>
                                </tr>
                                <tr>
                                    <th>&nbsp; DPT 3</th>
                                    <th>:</th>
                                    <td><?= ( $data_bayi->pyd_dpt3 == '1' ? '<i class="fas fa-check"></i> (Sudah)' : '<i class="fas fa-times"></i> (Belum)'); ?></td>
                                </tr>

                                <tr>
                                    <th colspan="3"><strong>POLIO</strong></th>
                                </tr>
                                <tr>
                                    <th>&nbsp; POLIO 1</th>
                                    <th>:</th>
                                    <td><?= ( $data_bayi->pyd_polio1 == '1' ? '<i class="fas fa-check"></i> (Sudah)' : '<i class="fas fa-times"></i> (Belum)'); ?></td>
                                </tr>
                                <tr>
                                    <th>&nbsp; POLIO 2</th>
                                    <th>:</th>
                                    <td><?= ( $data_bayi->pyd_polio2 == '1' ? '<i class="fas fa-check"></i> (Sudah)' : '<i class="fas fa-times"></i> (Belum)'); ?></td>
                                </tr>
                                <tr>
                                    <th>&nbsp; POLIO 3</th>
                                    <th>:</th>
                                    <td><?= ( $data_bayi->pyd_polio3 == '1' ? '<i class="fas fa-check"></i> (Sudah)' : '<i class="fas fa-times"></i> (Belum)'); ?></td>
                                </tr>
                                <tr>
                                    <th>&nbsp; POLIO 4</th>
                                    <th>:</th>
                                    <td><?= ( $data_bayi->pyd_polio4 == '1' ? '<i class="fas fa-check"></i> (Sudah)' : '<i class="fas fa-times"></i> (Belum)'); ?></td>
                                </tr>

                                <tr>
                                    <th><strong>CAMPAK</strong></th>
                                    <th>:</th>
                                    <td><?= ( $data_bayi->pyd_campak == '1' ? '<i class="fas fa-check"></i> (Sudah)' : '<i class="fas fa-times"></i> (Belum)'); ?></td>
                                </tr>

                                <tr>
                                    <th colspan="3"><strong>HEPATITIS</strong></th>
                                </tr>
                                <tr>
                                    <th>&nbsp; HEPATITIS I</th>
                                    <th>:</th>
                                    <td><?= ( $data_bayi->pyd_hepatitis1 == '1' ? '<i class="fas fa-check"></i> (Sudah)' : '<i class="fas fa-times"></i> (Belum)'); ?></td>
                                </tr>
                                <tr>
                                    <th>&nbsp; HEPATITIS II</th>
                                    <th>:</th>
                                    <td><?= ( $data_bayi->pyd_hepatitis2 == '1' ? '<i class="fas fa-check"></i> (Sudah)' : '<i class="fas fa-times"></i> (Belum)'); ?></td>
                                </tr>
                                <tr>
                                    <th>&nbsp; HEPATITIS III</th>
                                    <th>:</th>
                                    <td><?= ( $data_bayi->pyd_hepatitis3 == '1' ? '<i class="fas fa-check"></i> (Sudah)' : '<i class="fas fa-times"></i> (Belum)'); ?></td>
                                </tr>
                                
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <div class="text-right">
                    Di data oleh <strong><?= $data_bayi->nama_pic; ?></strong> sejak <strong><?= $data_bayi->created_on; ?></strong>.
                </div>
            </div>
        </div>
    </div>
</section>
</div>
<script type="text/javascript">


</script>
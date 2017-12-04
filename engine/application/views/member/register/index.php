<div class="row">
    <div class="col-sm-12">
        <table id="myDataTable" class="table table-bordered small" role="grid" style="width: 100%;">
            <thead>
                <tr role="row">
                    <th style="width: 30px;"></th>
                    <th style="width: 70px;" class="text-center">REGID</th>
                    <th>Nama</th>
                    <th class="text-center">L/P</th>
                    <th class="text-center hidden-xs">Tgl.Lahir</th>
                    <th class="text-center hidden-xs">No.HP</th>
                    <th>Perusahaan</th>
                    <th class="hidden-xs">Jabatan</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div class="modal fade in" id="myModalUpdate" role="dialog" aria-labelledby="myModalUpdateLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title" id="myModalUpdateLabel">UPDATE DATABASE PESERTA</h4>
            </div>
            <div class="modal-body">
                <form id="MyFormUpdate" class="form-validation">
                    <input type="hidden" name="id" class="form-control" value="0">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#basic" role="tab" data-toggle="tab" aria-expanded="true">Basic</a></li>
                        <li class=""><a href="#professional" role="tab" data-toggle="tab" aria-expanded="false">Profesional / Network</a></li>
                        <li class=""><a href="#education" role="tab" data-toggle="tab" aria-expanded="false">Education</a></li>
                        <li class=""><a href="#training" role="tab" data-toggle="tab" aria-expanded="false">Training</a></li>
                        <li class=""><a href="#event" role="tab" data-toggle="tab" aria-expanded="false">Event</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="basic">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>NOMOR REGISTRASI PESERTA</label>
                                        <input type="text" name="nomor_registrasi" class="form-control" value="" readonly="readonly">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Nama peserta</label>
                                        <input type="text" name="nama" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Tempat lahir</label>
                                        <input type="text" name="tempat_lahir" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control datepicker" name="tanggal_lahir" autocomplete="off" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Telpon</label>
                                        <input type="text" name="telepon_rumah" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>No. HP</label>
                                        <input type="text" name="no_hp" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Jenis kelamin</label>
                                        <select name="jenis_kelamin" class="form-control">
                                            <option value="L">LAKI - LAKI</option>
                                            <option value="P">PEREMPUAN</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Agama</label>
                                        <select name="agama" class="form-control">
                                            <?php foreach ($religion as $reli): ?>
                                                <option value="<?php echo $reli->id; ?>"><?php echo $reli->agama; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <label>Alamat rumah</label>
                                        <input type="text" name="alamat_rumah" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Kode pos</label>
                                        <input type="text" name="kode_pos" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="professional">
                            <h5>Pekerjaan</h5>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>Nama perusahaan</label>
                                        <input type="text" name="nama_perusahaan" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <input type="text" name="jabatan" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Nomor telepon</label>
                                        <input type="text" name="telepon_kantor" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Nomor Fax</label>
                                        <input type="text" name="fax_kantor" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Website</label>
                                        <input type="url" name="website_kantor" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Alamat perusahaan</label>
                                        <input type="text" name="alamat_kantor" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <h5>Networking / Social Media</h5>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Alamat email</label>
                                        <input type="email" name="email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Alamat Facebook</label>
                                        <input type="text" name="soc_facebook" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Alamat Twitter</label>
                                        <input type="text" name="soc_twitter" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Alamat Instagram</label>
                                        <input type="text" name="soc_instagram" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Alamat Youtube</label>
                                        <input type="text" name="soc_youtube" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Alamat Linkedin</label>
                                        <input type="text" name="soc_linkedin" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="education">
                            <h5>Data Pendidikan Formal</h5>
                            <p class="help-block">Data pendidikan dari tingkat yang terendah hingga tertinggi</p>
                            <div class="row education">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Tingkat</label>
                                        <select class="form-control" name="edu_pendidikan[]">
                                            <?php foreach ($educations as $edu): ?>
                                            <option value="<?php echo $edu->id; ?>"><?php echo $edu->pendidikan; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label>Nama institusi</label>
                                        <input type="text" name="edu_nama_institusi[]" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Tahun</label>
                                        <input type="number" min="1945" max="2030" name="edu_tahun_mulai[]" maxlength="4" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>S/d</label>
                                        <div class="input-group">
                                            <input type="number" min="1945" max="2030" name="edu_tahun_selesai[]" maxlength="4" class="form-control">
                                            <div class="input-group-btn">
                                                <button class="btn btn-primary btn-add" type="button"><span class="fa fa-plus"></span></button>
                                                <button class="btn btn-danger btn-del" type="button"><span class="fa fa-minus"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="training"></div>
                        <div class="tab-pane fade" id="event"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Submit</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal" aria-hidden="true"><span class="fa fa-close"></span> Close</button>
                        <div class="pull-right">
                            <button type="button" class="btn btn-default btn-event" data-member-id=""><span class="fa fa-tag"></span> Update Event</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade in" id="myModalUpdateEvent" role="dialog" aria-labelledby="myModalUpdateEventLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title" id="myModalUpdateEventLabel">UPDATE DATABASE EVENT PESERTA</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-condensed small">
                    <thead>
                        <tr>
                            <th>NAMA KEGIATAN</th><th class="text-center hidden-xs">HADIR</th><th class="text-center hidden-xs">KURSI</th><th class="text-center">#</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <form id="MyFormUpdateEvent" class="form-validation">
                    <input type="hidden" name="anggota" class="form-control">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label>Nama Kegiatan</label>
                                <select name="event" class="form-control">
                                    <?php foreach ($events as $event): ?>
                                        <option value="<?php echo $event->id; ?>"><?php echo $event->nama_kegiatan; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Hadir</label>
                                <select name="present" class="form-control">
                                    <option value="0">TIDAK</option>
                                    <option value="1">YA</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Kursi</label>
                                <input type="number" name="seat" class="form-control" step="1" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Submit</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal" aria-hidden="true"><span class="fa fa-close"></span> Close</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

<div class="modal fade in" id="myModalDetail" role="dialog" aria-labelledby="myModalDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title" id="myModalDetailLabel">DETAIL DATA PESERTA</h4>
            </div>
            <div class="modal-body">
                <div class="widget">
                    <div class="widget-header">
                        <h3>DATA MEMBER</h3>
                    </div>
                    <div class="widget-content">
                        <table class="table table-bordered table-condensed small" id="tb-detail">
                            <tbody>
                                <tr>
                                    <th scope="row" class="active" style="width: 150px;">NOMOR REG.</th>
                                    <td class="nomor_registrasi"></td>
                                    <th scope="row" class="active">NAMA PESERTA</th>
                                    <td class="nama"></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="active">JENIS KELAMIN</th>
                                    <td class="jenis_kelamin"></td>
                                    <th scope="row" class="active">AGAMA</th>
                                    <td class="agama"></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="active">TEMPAT LAHIR</th>
                                    <td class="tempat_lahir"></td>
                                    <th scope="row" class="active">TGL.LAHIR</th>
                                    <td class="tgl_lahir"></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="active">NOMOR HP.</th>
                                    <td class="no_hp"></td>
                                    <th scope="row" class="active">EMAIL ADDRESS</th>
                                    <td class="email"></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="active">PERUSAHAAN.</th>
                                    <td class="nama_perusahaan"></td>
                                    <th scope="row" class="active">JABATAN</th>
                                    <td class="jabatan"></td>
                                </tr>
                                <tr>
                                    
                                    <th scope="row" class="active">TELPON</th>
                                    <td class="telpon_kantor"></td>
                                    <th scope="row" class="active">FAX</th>
                                    <td class="fax_kantor"></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="active">ALAMAT KANTOR</th>
                                    <td colspan="3" class="alamat_kantor"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="widget">
                    <div class="widget-header">
                        <h3>DAFTAR EVENT YANG DIIKUTI</h3>
                    </div>
                    <div class="widget-content">
                        <table class="table table-bordered table-striped small" id="tb-events">
                            <thead>
                                <tr>
                                    <th>NAMA EVENT</th><th class="text-center hidden-xs">TANGGAL</th><th class="text-center hidden-xs">KEHADIRAN</th><th class="text-center">KURSI</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-print" data-member-id=""><span class="fa fa-print"></span> Print</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><span class="fa fa-close"></span> Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var Manager_JS = {
        init: function () {
            var _this = this;
            var table = $('#myDataTable').DataTable({
                searching: true,
                ordering: true,
                order: [1, "desc"],
                rowId: 'id',
                processing: true,
                serverSide: true,
                sDom: "<'row'<'col-sm-2'l><'col-sm-7'B><'col-sm-3'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                buttons: {
                    buttons: [
                        {
                            text: '<i class="fa fa-plus"></i> Add',
                            className: 'dt-btn-add btn-sm',
                            enabled: true,
                            action: function (e, dt, btn, config) {
                                var $form = $('#MyFormUpdate');
                                var $dlg = $('#myModalUpdate');
                                $dlg.find('.modal-title').html('TAMBAH DATABASE PESERTA');
                                $form.find('[name="id"]').val(0);
                                $form.find('[name="nomor_registrasi"]').val('');
                                $form.find('[name="nama"]').val('');
                                $form.find('[name="tanggal_lahir"]').val();
                                $form.find('[name="tempat_lahir"]').val('');
                                $form.find('[name="jenis_kelamin"]').val('L');
                                $form.find('[name="agama"]').val('01');
                                $form.find('[name="no_hp"]').val('');
                                $form.find('[name="alamat_rumah"]').val('');
                                $form.find('[name="kode_pos"]').val('');
                                $form.find('[name="telepon_rumah"]').val('');
                                $form.find('[name="alamat_email"]').val('');
                                $form.find('[name="soc_facebook"]').val('');
                                $form.find('[name="soc_twitter"]').val('');
                                $form.find('[name="soc_instagram"]').val('');
                                $form.find('[name="soc_youtube"]').val('');
                                $form.find('[name="soc_linkedin"]').val('');
                                $form.find('[name="nama_perusahaan"]').val('');
                                $form.find('[name="jabatan"]').val('');
                                $form.find('[name="telepon_kantor"]').val('');
                                $form.find('[name="alamat_kantor"]').val('');
                                $form.find('[name="fax_kantor"]').val('');
                                $form.find('[name="website_kantor"]').val('');
                                $dlg.modal();

                                $dlg.find('.btn-event').prop('disabled', true);
                            }
                        },
                        {
                            text: '<i class="fa fa-pencil"></i> Edit',
                            className: 'dt-btn-edit btn-sm',
                            enabled: false,
                            action: function (e, dt, btn, config) {
                                var item = dt.row({selected: true}).data();
                                if (item) {
                                    var btnIcon = $(btn).find('i');
                                    btnIcon.removeClass('fa-edit').addClass('fa-spin fa-spinner');

                                    var $form = $('#MyFormUpdate');
                                    var $dlg = $('#myModalUpdate');
                                    $dlg.find('.modal-title').html('UPDATE DATABASE PESERTA');

                                    $.ajax({
                                        url: "<?php echo get_action_url('services/member/get'); ?>",
                                        type: "GET",
                                        data: {id: item.id}
                                    }).then(function (data) {
                                        if (data.status) {
                                            $form.find('[name="id"]').val(data.item.id);
                                            $form.find('[name="nomor_registrasi"]').val(data.item.nomor_registrasi);
                                            $form.find('[name="nama"]').val(data.item.nama);
                                            $form.find('[name="tanggal_lahir"]').val(data.item.tanggal_lahir);
                                            $form.find('[name="tempat_lahir"]').val(data.item.tempat_lahir);
                                            $form.find('[name="jenis_kelamin"]').val(data.item.jenis_kelamin);
                                            $form.find('[name="agama"]').val(data.item.agama);
                                            $form.find('[name="no_hp"]').val(data.item.no_hp);
                                            $form.find('[name="alamat_rumah"]').val(data.item.alamat_rumah);
                                            $form.find('[name="kode_pos"]').val(data.item.kode_pos);
                                            $form.find('[name="telepon_rumah"]').val(data.item.telepon_rumah);
                                            $form.find('[name="alamat_email"]').val(data.item.alamat_email);
                                            $form.find('[name="soc_facebook"]').val(data.item.soc_facebook);
                                            $form.find('[name="soc_twitter"]').val(data.item.soc_twitter);
                                            $form.find('[name="soc_instagram"]').val(data.item.soc_instagram);
                                            $form.find('[name="soc_youtube"]').val(data.item.soc_youtube);
                                            $form.find('[name="soc_linkedin"]').val(data.item.soc_linkedin);
                                            $form.find('[name="nama_perusahaan"]').val(data.item.nama_perusahaan);
                                            $form.find('[name="jabatan"]').val(data.item.jabatan);
                                            $form.find('[name="telepon_kantor"]').val(data.item.telepon_kantor);
                                            $form.find('[name="alamat_kantor"]').val(data.item.alamat_kantor);
                                            $form.find('[name="fax_kantor"]').val(data.item.fax_kantor);
                                            $form.find('[name="website_kantor"]').val(data.item.website_kantor);
                                            $dlg.modal();
                                            
                                            _this.cleanUpEducation();
                                            
                                            $dlg.find('.btn-event').prop('disabled', false).data('memberId', data.item.id);
                                        } else {
                                            alert(data.message);
                                        }
                                    }).always(function () {
                                        btnIcon.removeClass('fa-spin fa-spinner').addClass('fa-edit');
                                    });


                                } else {
                                    alert('Anda belum memilih baris data atau data yang anda pilih tidak dapat diubah');
                                }
                            }
                        },
                        {
                            text: '<i class="fa fa-remove"></i> Delete',
                            className: 'dt-btn-delete btn-sm',
                            enabled: false,
                            action: function (e, dt, btn, config) {
                                var item = dt.row({selected: true}).data();
                                if (item) {
                                    if (confirm('Hapus data peserta terpilih berikut data atribut lainnya?')){
                                        var btnIcon = $(btn).find('i');
                                        btnIcon.removeClass('fa-remove').addClass('fa-spin fa-spinner');
                                        
                                        $.ajax({
                                            url: "<?php echo get_action_url('services/member/index'); ?>",
                                            type: "DELETE",
                                            data: {id: item.id}
                                        }).then(function (data) {
                                            if (data.status) {
                                                dt.ajax.reload(null, false); // user paging is not reset on reload
                                            } else {
                                                alert(data.message);
                                            }
                                        }).always(function () {
                                            btnIcon.removeClass('fa-spin fa-spinner').addClass('fa-remove');
                                        });
                                    }
                                } else {
                                    alert('Anda belum memilih baris data atau data yang anda pilih tidak dapat diubah');
                                }
                            }
                        },
                        {
                            text: '<i class="fa fa-tag"></i> Events',
                            className: 'dt-btn-event btn-sm',
                            enabled: false,
                            action: function (e, dt, btn, config) {
                                var item = dt.row({selected: true}).data();
                                if (item) {
                                    var btnIcon = $(btn).find('i');
                                    btnIcon.removeClass('fa-tag').addClass('fa-spin fa-spinner');

                                    var $form = $('#MyFormUpdateEvent');
                                    var $dlg = $('#myModalUpdateEvent');
                                    $dlg.find('.modal-title').html('UPDATE DATABASE EVENT PESERTA');

                                    $form.find('[name="anggota"]').val(item.id);
                                    $form.find('[name="event"]').val(0);
                                    $form.find('[name="present"]').val(0);
                                    $form.find('[name="seat"]').val(0);

                                    $dlg.modal();

                                    $.ajax({
                                        url: "<?php echo get_action_url('services/member/events'); ?>",
                                        type: "GET",
                                        data: {member_id: item.id}
                                    }).then(function (data) {
                                        _this.loadEvents(item.id, $dlg.find('table tbody'));
                                    }).always(function () {
                                        btnIcon.removeClass('fa-spin fa-spinner').addClass('fa-tag');
                                    });


                                } else {
                                    alert('Anda belum memilih baris data atau data yang anda pilih tidak dapat diubah');
                                }
                            }
                        },
                        {
                            text: '<i class="fa fa-eye"></i> Detail',
                            className: 'dt-btn-detail btn-sm',
                            enabled: false,
                            action: function (e, dt, btn, config) {
                                var item = dt.row({selected: true}).data();
                                if (item) {
                                    var btnIcon = $(btn).find('i');
                                    btnIcon.removeClass('fa-eye').addClass('fa-spin fa-spinner');

                                    var $dlg = $('#myModalDetail');
                                    $dlg.find('.modal-title').html('DETAIL DATA PESERTA');
                                    $dlg.find('.btn-print').data('memberId', item.id);
                                    $.ajax({
                                        url: "<?php echo get_action_url('services/member/detail'); ?>/" + item.id,
                                        type: "GET",
                                        data: {id: item.id}
                                    }).then(function (data) {
                                        if (data.status) {
                                            var table = $dlg.find('table#tb-detail');
                                            var tb_events = $dlg.find('table#tb-events tbody');

                                            table.find('.nomor_registrasi').html(data.item.nomor_registrasi);
                                            table.find('.nama').html(data.item.nama);
                                            table.find('.jenis_kelamin').html(data.item.jenis_kelamin);
                                            table.find('.tempat_lahir').html(data.item.tempat_lahir);
                                            table.find('.tgl_lahir').html(data.item.tanggal_lahir);
                                            table.find('.agama').html(data.item.agama.agama);
                                            table.find('.no_hp').html(data.item.no_hp);
                                            table.find('.email').html(data.item.alamat_email);
                                            table.find('.nama_perusahaan').html(data.item.nama_perusahaan);
                                            table.find('.jabatan').html(data.item.jabatan);
                                            table.find('.alamat_kantor').html(data.item.alamat_kantor);
                                            table.find('.telpon_kantor').html(data.item.telepon_kantor);
                                            table.find('.fax_kantor').html(data.item.fax_kantor);

                                            tb_events.empty();
                                            if (data.item.events.length > 0) {
                                                for (var e in data.item.events) {
                                                    var event = data.item.events[e];
                                                    var s = '<tr>';
                                                    s += '<td>' + event.nama_kegiatan + '</td>';
                                                    s += '<td class="text-center hidden-xs">' + event.tanggal + '</td>';
                                                    s += '<td class="text-center hidden-xs">' + (event.present == 1 ? '<span class="fa fa-check"></span>' : '<span class="fa fa-ellipsis-h"></span>') + '</td>';
                                                    s += '<td class="text-center">' + event.seat + '</td>';
                                                    s += '</tr>';

                                                    tb_events.append(s);
                                                }
                                            } else {
                                                var s = '<tr><td colspan="4">Tidak ada data event yang diikuti peserta ini</td></tr>';
                                                tb_events.append(s);
                                            }

                                            $dlg.modal();
                                        } else {
                                            alert(data.message);
                                        }
                                    }).always(function () {
                                        btnIcon.removeClass('fa-spin fa-spinner').addClass('fa-eye');
                                    });


                                } else {
                                    alert('Anda belum memilih baris data atau data yang anda pilih tidak dapat diubah');
                                }
                            }
                        },
                        {
                            text: '<i class="fa fa-recycle"></i> Reload',
                            className: 'dt-btn-reload btn-sm hidden-xs',
                            action: function (e, dt, btn, config) {
                                dt.ajax.reload(null, false); // user paging is not reset on reload
                            }
                        }
                    ]
                },
                ajax: {
                    url: "<?php echo get_action_url('services/member/index'); ?>",
                    dataSrc: "items"
                },
                select: true,
                columns: [
                    {data: null, class: "select-checkbox text-center", orderable: false, defaultContent: ""},
                    {data: "nomor_registrasi", class: "text-center"},
                    {data: "nama", render: $.fn.dataTable.render.ellipsis(20)},
                    {data: "jenis_kelamin", class: "text-center hidden-xs"},
                    {data: "tanggal_lahir", class: "text-center hidden-xs"},
                    {data: "no_hp", class:"text-center hidden-xs"},
                    {data: "nama_perusahaan", class:"hidden-xs", render: $.fn.dataTable.render.ellipsis(16)},
                    {data: "jabatan", class:"hidden-xs", render: $.fn.dataTable.render.ellipsis(16)}
                ]
            });
            table.on('select', function (e, dt, type, indexes) {
                var selectedRows = table.rows({selected: true}).count();
                dt.buttons([".dt-btn-event", ".dt-btn-detail", ".dt-btn-delete", ".dt-btn-edit"]).enable(selectedRows > 0);
            });
            table.on('deselect', function (e, dt, type, indexes) {
                var selectedRows = table.rows({selected: true}).count();
                dt.buttons([".dt-btn-event", ".dt-btn-detail", ".dt-btn-delete", ".dt-btn-edit"]).enable(selectedRows > 0);
            });

            $('#MyFormUpdate').validate({
                ignore: [],
                rules: {
                    nama: "required",
                },
                submitHandler: function (form) {
                    var $btn = $(form).find('[type="submit"]');
                    var $btnIcon = $btn.find('span');
                    $btnIcon.removeClass('fa-save').addClass('fa-spin fa-spinner');

                    $(form).ajaxSubmit({
                        url: "<?php echo get_action_url('services/member/index'); ?>",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            if (data.status) {
                                $('#myModalUpdate').modal('hide');
                                table.ajax.reload(null, false);
                            } else {
                                alert(data.message);
                            }
                        },
                        complete: function () {
                            $btnIcon.addClass('fa-save').removeClass('fa-spin fa-spinner');
                        }
                    });

                }
            });
            
            $('#education').on('click', '.btn-add', function(){
                var $row = $(this).parents('.education');
                var $clone = $row.clone(true);
                $clone.find('[name="edu_pendidikan[]"]').val(1);
                $clone.find('[name="edu_nama_institusi[]"]').val('');
                $clone.find('[name="edu_tahun_mulai[]"]').val('');
                $clone.find('[name="edu_tahun_selesai[]"]').val('');

                $clone.insertAfter($row);
            });
            
            $('#education').on('click', '.btn-del', function(){
                var $row = $(this).parents('.education');
                if ($('#education').find('.education').length > 1){
                    $row.remove();
                }
            });

            $('#MyFormUpdateEvent').validate({
                ignore: [],
                rules: {
                    anggota: "required",
                    event: "required",
                },
                submitHandler: function (form) {
                    var $btn = $(form).find('[type="submit"]');
                    var $btnIcon = $btn.find('span');
                    $btnIcon.removeClass('fa-save').addClass('fa-spin fa-spinner');

                    $(form).ajaxSubmit({
                        url: "<?php echo get_action_url('services/member/event'); ?>",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            if (data.status) {
                                _this.loadEvents(data.item.anggota, $('#myModalUpdateEvent').find('table tbody'));
                            } else {
                                alert(data.message);
                            }
                        },
                        complete: function () {
                            $btnIcon.addClass('fa-save').removeClass('fa-spin fa-spinner');
                        }
                    });

                }
            });

            $('#myModalUpdateEvent').on('click', '.btn-del-event', function () {
                var event_participant_id = $(this).data('eventId');
                if (event_participant_id) {
                    $.ajax({
                        url: "<?php echo get_action_url('services/member/event'); ?>",
                        type: "DELETE",
                        data: {event: event_participant_id}
                    }).then(function (data) {
                        if (data.status) {
                            _this.loadEvents(data.item.anggota, $('#myModalUpdateEvent').find('tbody'));
                        }
                    });
                } else {
                    alert('Data ID tidak terdefinisi');
                }
            });

            $('#myModalUpdate').on('click', '.btn-event', function () {
                var memberId = $(this).data('memberId');
                var btnIcon = $(this).find('i');
                btnIcon.removeClass('fa-tag').addClass('fa-spin fa-spinner');

                var $form = $('#MyFormUpdateEvent');
                var $dlg = $('#myModalUpdateEvent');
                $dlg.find('.modal-title').html('UPDATE DATABASE EVENT PESERTA');

                $form.find('[name="anggota"]').val(memberId);
                $form.find('[name="event"]').val(0);
                $form.find('[name="present"]').val(0);
                $form.find('[name="seat"]').val(0);

                $dlg.modal();

                $.ajax({
                    url: "<?php echo get_action_url('services/member/events'); ?>",
                    type: "GET",
                    data: {member_id: memberId}
                }).then(function (data) {
                    _this.loadEvents(memberId, $dlg.find('table tbody'));
                }).always(function () {
                    btnIcon.removeClass('fa-spin fa-spinner').addClass('fa-tag');
                });
            });
            
            $('#myModalDetail').on('click', '.btn-print', function(){
                $('#myModalDetail').find('.modal-body').printThis();
            });
        },
        loadEvents: function (member, targetTable) {
            $.ajax({
                url: "<?php echo get_action_url('services/member/events'); ?>",
                type: "GET",
                data: {member_id: member}
            }).then(function (data) {
                var tbl_events = targetTable;
                tbl_events.empty();

                if (data.events.length > 0) {
                    for (var i in data.events) {
                        var event = data.events[i];
                        var s = '<tr>';
                        s += '<td>' + event.nama_kegiatan + '</td>';
                        s += '<td class="text-center hidden-xs">' + (event.present == 1 ? '<span class="fa fa-check"></span>' : '<span class="fa fa-ellipsis-h"></span>') + '</td>';
                        s += '<td class="text-center hidden-xs">' + event.seat + '</td>';
                        s += '<td class="text-center"><button class="btn btn-xs btn-danger btn-del-event" data-event-id="' + event.event_participant_id + '"><span class="fa fa-remove"></span></button></td>';
                        s += '</tr>';
                        tbl_events.append(s);
                    }
                } else {
                    var s = '<tr><td colspan="4">Tidak ada event yang diikuti</td></tr>';
                    tbl_events.append(s);
                }
            });
        },
        cleanUpEducation: function(){
            var $ctn = $('#education');
            if ($ctn.find('.education').length>1){
                $ctn.find('.education').each(function(index){
                    if (index > 0){
                        $(this).remove();
                    }else{
                        //empty the field
                        $(this).find('[name="edu_pendidkan"]').val(1);
                        $(this).find('[name="edu_nama_institusi"]').val('');
                        $(this).find('[name="edu_tahun_mulai"]').val('');
                        $(this).find('[name="edu_tahun_selesai"]').val('');
                    }
                });
            }
        },
        insertEducation: function(items,rowBase){
            var $edu = $('#education').find('.education');
            for (var i in items){
                var $clone = rowBase.clone(true);
                $clone.find('[name="edu_pendidikan[]"]').val(items[i].pendidikan);
                $clone.find('[name="edu_nama_institusi[]"]').val(items[i].nama_institusi);
                $clone.find('[name="edu_tahun_mulai[]"]').val(items[i].tahun_mulai);
                $clone.find('[name="edu_tahun_selesai[]"]').val(items[i].tahun_selesai);

                $clone.insertAfter(rowBase);
            }
        }
    };
    $(document).ready(function () {
        Manager_JS.init();
    });
</script>
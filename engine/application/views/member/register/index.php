<div class="row">
    <div class="col-lg-12">
        <table id="myDataTable" class="table table-bordered" role="grid" style="width: 100%;">
            <thead>
                <tr role="row">
                    <th style="width: 30px;"></th>
                    <th class="text-center">ID</th>
                    <th>Nama</th>
                    <th class="text-center">L/P</th>
                    <th class="text-center">Tgl.Lahir</th>
                    <th>No.HP</th>
                    <th>Perusahaan</th>
                    <th>Jabatan</th>
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
                    <input type="hidden" name="id" value="0">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nama peserta</label>
                                <input type="text" name="nama" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Jenis kelamin</label>
                                <select name="jenis_kelamin" class="form-control">
                                    <option value="1">LAKI - LAKI</option>
                                    <option value="0">PEREMPUAN</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tempat lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
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
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Agama</label>
                                <select name="agama" class="form-control">
                                    <?php foreach ($religion as $reli): ?>
                                    <option value="<?php echo $reli->id; ?>"><?php echo $reli->agama; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>No. HP</label>
                                <input type="text" name="no_hp" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Alamat email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Alamat facebook</label>
                                <input type="text" name="soc_facebook" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Alamat twitter</label>
                                <input type="text" name="soc_twitter" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Alamat Instagram</label>
                                <input type="text" name="soc_instagram" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Alamat Youtube</label>
                                <input type="text" name="soc_youtube" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Alamat Linkedin</label>
                                <input type="text" name="soc_linkedin" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Alamat rumah</label>
                                <input type="text" name="alamat_rumah" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nama perusahaan</label>
                                <input type="text" name="nama_perusahaan" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text" name="jabatan" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Alamat perusahaan</label>
                                <input type="text" name="alamat_kantor" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Telp. kantor</label>
                                <input type="text" name="telepon_kantor" class="form-control">
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
<script type="text/javascript">
    var Manager_JS = {
        init: function(){
            var _this = this;
            var table = $('#myDataTable').DataTable({
                searching: true,
                ordering: true,
                order: [2,"desc"],
                rowId: 'id',
                processing: true,
                serverSide: true,
                sDom: "<'row'<'col-sm-2'l><'col-sm-7'B><'col-sm-3'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                buttons:{
                    buttons: [
                        { 
                            text: '<i class="fa fa-plus"></i> Add', 
                            className:'dt-btn-add', 
                            enabled: true,
                            action: function( e, dt, btn, config ){
                                var $form = $('#MyFormUpdate');
                                var $dlg = $('#myModalUpdate');
                                $dlg.find('.modal-title').html('TAMBAH DATABASE PESERTA');
                                $form.find('[name="id"]').val(0);
                                $form.find('[name="nama"]').val('');
                                $form.find('[name="tanggal_lahir"]').val();
                                $form.find('[name="tempat_lahir"]').val();
                                $dlg.modal();
                                
                            }
                        },
                        { 
                            text: '<i class="fa fa-pencil"></i> Edit', 
                            className:'dt-btn-edit', 
                            enabled: false,
                            action: function( e, dt, btn, config ){
                                var item = dt.row({selected: true}).data();
                                if (item){
                                    var btnIcon = $(btn).find('i');
                                    btnIcon.removeClass('fa-edit').addClass('fa-spin fa-spinner');

                                    var $form = $('#MyFormUpdate');
                                    var $dlg = $('#myModalUpdate');
                                    $dlg.find('.modal-title').html('UPDATE DATA PESERTA PENUTUPAN ASURANSI');
                                    
                                    $.ajax({
                                        url:"<?php echo get_action_url('services/penutupan/detail'); ?>/"+item.id,
                                    }).then(function(data){
                                        if (data.status){
                                            $form.find('[name="batch"]').val(data.item.batch);
                                            $form.find('[name="id"]').val(item.id);
                                            $form.find('[name="nama_peserta"]').val(data.item.nama_peserta);
                                            $form.find('[name="tanggal_lahir"]').val(data.item.tanggal_lahir);
                                            $form.find('[name="nip_peserta"]').val(data.item.nip_peserta);
                                            $form.find('[name="no_ktp"]').val(data.item.no_ktp);
                                            $form.find('[name="alamat"]').val(data.item.alamat);
                                            $form.find('[name="pendapatan_bulanan"]').val(data.item.pendapatan_bulanan);
                                            $form.find('[name="plafon_kredit"]').val(data.item.plafon_kredit);
                                            $form.find('[name="waktu_mulai"]').val(data.item.waktu_mulai);
                                            $form.find('[name="waktu_akhir"]').val(data.item.waktu_akhir);
                                            $dlg.modal();
                                        }else{
                                            alert(data.message);
                                        }
                                    }).always(function(){
                                        btnIcon.removeClass('fa-spin fa-spinner').addClass('fa-edit');
                                    });

                                    
                                }else{
                                    alert('Anda belum memilih baris data atau data yang anda pilih tidak dapat diubah');
                                }
                            }
                        },
                        { 
                            text: '<i class="fa fa-eye"></i> Lihat Detail', 
                            className:'dt-btn-detail', 
                            enabled: false,
                            action: function( e, dt, btn, config ){
                                var item = dt.row({selected: true}).data();
                                if (item){
                                    window.location.href = "<?php echo get_action_url('tertanggung/penutupan/detail'); ?>/"+item.id;
                                }else{
                                    alert('Anda belum memilih baris data');
                                }
                            }
                        },
                        { 
                            text: '<i class="fa fa-recycle"></i> Reload', 
                            className:'dt-btn-reload', 
                            action: function(e, dt, btn, config){
                                dt.ajax.reload( null, false ); // user paging is not reset on reload
                            }
                        }
                    ]
                },
                ajax: {
                    url: "<?php echo get_action_url('services/member/all'); ?>",
                    dataSrc: "items"
                },
                select: true,
                columns:[
                    {data: null, class:"select-checkbox text-center", orderable: false, defaultContent:""},
                    {data: "id", class:"text-center"},
                    {data: "nama"},
                    {data: "jenis_kelamin", class: "text-center"},
                    {data: "tanggal_lahir", class: "text-center"},
                    {data: "no_hp"},
                    {data: "nama_perusahaan"},
                    {data: "jabatan"}
                ]
            });
            table.on( 'select', function ( e, dt, type, indexes ) {
                var selectedRows = table.rows( { selected: true } ).count();
                dt.buttons([".dt-btn-approve",".dt-btn-detail",".dt-btn-delete",".dt-btn-edit"]).enable(selectedRows > 0);
            });
            table.on( 'deselect', function ( e, dt, type, indexes ) {
                var selectedRows = table.rows( { selected: true } ).count();
                dt.buttons([".dt-btn-approve",".dt-btn-detail",".dt-btn-delete",".dt-btn-edit"]).enable(selectedRows > 0);
            });
			
            $('#MyFormUpdate').validate({
                ignore: [],
                rules: {
                    file: "required",
                },
                submitHandler: function(form){
                    var $btn = $(form).find('[type="submit"]');
                    var $btnIcon = $btn.find('span');
                    $btnIcon.removeClass('fa-save').addClass('fa-spin fa-spinner');
                    
                    $(form).ajaxSubmit({
                        url: "<?php echo get_action_url('services/detail_bacth/pembayaran_premi'); ?>",
                        type: "POST",
                        dataType: 'json',
                        success: function(data){
                            if (data.status){
                                $('#myModalUpdate').modal('hide');
                                table.ajax.reload( null, false );
                            }else{
                                alert(data.message);
                            }
                        },
                        complete: function(){
                            $btnIcon.addClass('fa-save').removeClass('fa-spin fa-spinner');
                        }
                    });
                    
                }
            });
        }
    };
    $(document).ready(function(){
        Manager_JS.init();
    });
</script>
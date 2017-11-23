<div class="row">
    <div class="col-sm-12">
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
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>ID PESERTA</label>
                                <input type="text" name="id" class="form-control" value="0" readonly="readonly">
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
                                <label>Jenis kelamin</label>
                                <select name="jenis_kelamin" class="form-control">
                                    <option value="L">LAKI - LAKI</option>
                                    <option value="P">PEREMPUAN</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Agama</label>
                                <select name="agama" class="form-control">
                                    <?php foreach ($religion as $reli): ?>
                                    <option value="<?php echo $reli->id; ?>"><?php echo $reli->agama; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>No. HP</label>
                                <input type="text" name="no_hp" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Alamat rumah</label>
                                <input type="text" name="alamat_rumah" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Alamat email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Alamat facebook</label>
                                <input type="text" name="soc_facebook" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Alamat twitter</label>
                                <input type="text" name="soc_twitter" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
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
                    <div class="row">
                        <div class="col-sm-4">
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
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Telp. kantor</label>
                                <input type="text" name="telepon_kantor" class="form-control">
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
                <table class="table table-bordered" id="tb-detail">
                    <tbody>
                        <tr>
                            <th scope="row" class="active" style="width: 150px;">NAMA PESERTA</th>
                            <td class="nama"></td>
                        </tr>
                        <tr>
                            <th scope="row" class="active">JENIS KELAMIN</th>
                            <td class="jenis_kelamin"></td>
                        </tr>
                        <tr>
                            <th scope="row" class="active">TEMPAT/TGL.LAHIR</th>
                            <td class="tempat_tgl_lahir"></td>
                        </tr>
                        <tr>
                            <th scope="row" class="active">AGAMA</th>
                            <td class="agama"></td>
                        </tr>
                        <tr>
                            <th scope="row" class="active">NOMOR HP.</th>
                            <td class="no_hp"></td>
                        </tr>
                    </tbody>
                </table>
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
                                $form.find('[name="tempat_lahir"]').val('');
                                $form.find('[name="jenis_kelamin"]').val('L');
                                $form.find('[name="agama"]').val('01');
                                $form.find('[name="no_hp"]').val('');
                                $form.find('[name="alamat_rumah"]').val('');
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
                                    $dlg.find('.modal-title').html('UPDATE DATABASE PESERTA');
                                    
                                    $.ajax({
                                        url:"<?php echo get_action_url('services/member/detail'); ?>",
                                        type: "GET",
                                        data: {id: item.id}
                                    }).then(function(data){
                                        if (data.status){
                                            $form.find('[name="id"]').val(data.item.id);
                                            $form.find('[name="nama"]').val(data.item.nama);
                                            $form.find('[name="tanggal_lahir"]').val(data.item.tanggal_lahir);
                                            $form.find('[name="tempat_lahir"]').val(data.item.tempat_lahir);
                                            $form.find('[name="jenis_kelamin"]').val(data.item.jenis_kelamin);
                                            $form.find('[name="agama"]').val(data.item.agama.id);
                                            $form.find('[name="no_hp"]').val(data.item.no_hp);
                                            $form.find('[name="alamat_rumah"]').val(data.item.alamat_rumah);
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
                                    var btnIcon = $(btn).find('i');
                                    btnIcon.removeClass('fa-eye').addClass('fa-spin fa-spinner');

                                    var $dlg = $('#myModalDetail');
                                    $dlg.find('.modal-title').html('DETAIL DATA PESERTA');
                                    $dlg.find('.btn-print').data('memberId', item.id);
                                    $.ajax({
                                        url:"<?php echo get_action_url('services/member/detail'); ?>/"+item.id,
                                        type: "GET",
                                        data: {id: item.id}
                                    }).then(function(data){
                                        if (data.status){
                                            var table = $dlg.find('table');
                                            
                                            table.find('.nama').html(data.item.nama);
                                            table.find('.jenis_kelamin').html(data.item.jenis_kelamin);
                                            table.find('.tempat_tgl_lahir').html(data.item.tempat_lahir + ', '+data.item.tanggal_lahir);
                                            table.find('.agama').html(data.item.agama.agama);
                                            table.find('.no_hp').html(data.item.no_hp);
                                            $dlg.modal();
                                        }else{
                                            alert(data.message);
                                        }
                                    }).always(function(){
                                        btnIcon.removeClass('fa-spin fa-spinner').addClass('fa-eye');
                                    });

                                    
                                }else{
                                    alert('Anda belum memilih baris data atau data yang anda pilih tidak dapat diubah');
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
                    url: "<?php echo get_action_url('services/member/index'); ?>",
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
                    nama: "required",
                },
                submitHandler: function(form){
                    var $btn = $(form).find('[type="submit"]');
                    var $btnIcon = $btn.find('span');
                    $btnIcon.removeClass('fa-save').addClass('fa-spin fa-spinner');
                    
                    $(form).ajaxSubmit({
                        url: "<?php echo get_action_url('services/member/index'); ?>",
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
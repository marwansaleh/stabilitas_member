<style type="text/css">
    .blue {
        border: solid 1px #0084b0;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
    }
</style>
<div class="row">
    <div class="col-sm-12">
        <table id="myDataTable" class="table table-bordered small" role="grid" style="width: 100%;">
            <thead>
                <tr role="row">
                    <th style="width: 30px;"></th>
                    <th>Nama Pelatihan</th>
                    <th class="hidden-xs" style="width: 100px;">Penyelenggara</th>
                    <th class="text-center hidden-xs" style="width: 70px;">Tahun</th>
                    <th class="text-right hidden-xs" style="width: 70px;">#Peserta</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<div class="modal fade in" id="myModalUpdate" role="dialog" aria-labelledby="myModalUpdateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title" id="myModalUpdateLabel">TAMBAH PELATIHAN</h4>
            </div>
            <div class="modal-body">
                <form id="MyFormUpdate" class="form-validation">
                    <input type="hidden" name="id" class="form-control" value="0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Nama kegiatan</label>
                                <input type="text" name="training" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="form-group">
                                <label>Nama Penyelenggara</label>
                                <input type="text" name="penyelenggara" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Tahun</label>
                                <input type="number" step="1" min="0" name="tahun" class="form-control" value="<?php echo date('Y'); ?>">
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
                <h4 class="modal-title" id="myModalDetailLabel">DETAIL DATA TRAINING</h4>
            </div>
            <div class="modal-body">
                <div class="widget">
                    <div class="widget-header"><h3>SUMMARY DATA PELATIHAN</h3></div>
                    <div class="widget-content">
                        <table class="table table-bordered table-condensed small" id="tb-detail">
                            <tbody>
                                <tr>
                                    <th colspan="2" scope="row" class="active">NAMA PELATIHAN</th>
                                <tr>
                                    <td colspan="2" class="training"></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="active">PENYELENGGARA</th>
                                    <th scope="row" class="active text-center">TAHUN</th>

                                </tr>
                                <tr>
                                    <td class="penyelenggara"></td>
                                    <td class="tahun text-center"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="widget">
                    <div class="widget-header"><h3>DAFTAR PESERTA TERDAFTAR DI PELATIHAN</h3></div>
                    <div class="widget-content" style="max-height:250px; overflow-y:auto;">
                        <table class="table table-bordered table-striped table-condensed small" id="tb-participants">
                            <thead>
                                <tr>
                                    <th>NAMA PESERTA</th>
                                    <th class="hidden-xs">PERUSAHAAN</th>
                                    <th class="hidden-xs">JABATAN</th>
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
        init: function(){
            var _this = this;
            var table = $('#myDataTable').DataTable({
                searching: true,
                ordering: true,
                order: [0,"desc"],
                rowId: 'id',
                processing: true,
                serverSide: true,
                sDom: "<'row'<'col-sm-2'l><'col-sm-7'B><'col-sm-3'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                buttons:{
                    buttons: [
                        { 
                            text: '<i class="fa fa-plus"></i><span class="hidden-xs hidden-sm"> Add</span>', 
                            className:'dt-btn-add btn-sm', 
                            enabled: true,
                            action: function( e, dt, btn, config ){
                                var $form = $('#MyFormUpdate');
                                var $dlg = $('#myModalUpdate');
                                $dlg.find('.modal-title').html('TAMBAH TRAINING');
                                $form.find('[name="id"]').val(0);
                                $form.find('[name="training"]').val('');
                                $form.find('[name="penyelenggara"]').val();
                                //$form.find('[name="tahun"]').val();
                                $dlg.modal();
                                
                            }
                        },
                        { 
                            text: '<i class="fa fa-pencil"></i><span class="hidden-xs hidden-sm"> Edit</span>', 
                            className:'dt-btn-edit btn-sm', 
                            enabled: false,
                            action: function( e, dt, btn, config ){
                                var item = dt.row({selected: true}).data();
                                if (item){
                                    var btnIcon = $(btn).find('i');
                                    btnIcon.removeClass('fa-edit').addClass('fa-spin fa-spinner');

                                    var $form = $('#MyFormUpdate');
                                    var $dlg = $('#myModalUpdate');
                                    $dlg.find('.modal-title').html('UPDATE TRAINING');
                                    
                                    $.ajax({
                                        url:"<?php echo get_action_url('services/training/get'); ?>",
                                        type: "GET",
                                        data: {id: item.id}
                                    }).then(function(data){
                                        if (data.status){
                                            $form.find('[name="id"]').val(data.item.id);
                                            $form.find('[name="training"]').val(data.item.training);
                                            $form.find('[name="penyelenggara"]').val(data.item.penyelenggara);
                                            $form.find('[name="tahun"]').val(data.item.tahun);
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
                            text: '<i class="fa fa-eye"></i><span class="hidden-xs hidden-sm"> Detail</span>', 
                            className:'dt-btn-detail btn-sm', 
                            enabled: false,
                            action: function( e, dt, btn, config ){
                                var item = dt.row({selected: true}).data();
                                if (item){
                                    var btnIcon = $(btn).find('i');
                                    btnIcon.removeClass('fa-eye').addClass('fa-spin fa-spinner');

                                    var $dlg = $('#myModalDetail');
                                    $dlg.find('.modal-title').html('DETAIL DATA TRAINING');
                                    $dlg.find('.btn-print').data('memberId', item.id);
                                    $.ajax({
                                        url:"<?php echo get_action_url('services/training/detail'); ?>/"+item.id,
                                        type: "GET",
                                        data: {id: item.id}
                                    }).then(function(data){
                                        if (data.status){
                                            var table = $dlg.find('#tb-detail');
                                            var tb_participant = $dlg.find('#tb-participants tbody');
                                            
                                            table.find('.training').html(data.item.training);
                                            table.find('.penyelenggara').html(data.item.penyelenggara);
                                            table.find('.tahun').html(data.item.tahun);
                                            
                                            tb_participant.empty();
                                            if (data.item.participants.length > 0){
                                                
                                                for (var p in data.item.participants){
                                                    var participant = data.item.participants[p];
                                                    var s = '<tr>';
                                                    s+='<td>'+participant.nama+'</td>';
                                                    s+='<td class="hidden-xs">'+participant.nama_perusahaan+'</td>';
                                                    s+='<td class="hidden-xs">'+participant.jabatan+'</td>';
                                                    
                                                    tb_participant.append(s);
                                                }
                                            }else{
                                                var s ='<tr><td colspan="3">Tidak ada data peserta di pelatihan ini</td></tr>';
                                                tb_participant.append(s);
                                            }
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
                            text: '<i class="fa fa-recycle"></i><span class="hidden-xs hidden-sm"> Reload</span>', 
                            className:'dt-btn-reload btn-sm', 
                            action: function(e, dt, btn, config){
                                dt.ajax.reload( null, false ); // user paging is not reset on reload
                            }
                        }
                    ]
                },
                ajax: {
                    url: "<?php echo get_action_url('services/training/index'); ?>",
                    dataSrc: "items"
                },
                select: true,
                columns:[
                    {data: null, class:"select-checkbox text-center", orderable: false, defaultContent:""},
                    {data: "training", render: $.fn.dataTable.render.ellipsis(55)},
                    {data: "penyelenggara", class: "hidden-xs"},
                    {data: "tahun", class: "text-center hidden-xs"},
                    {data: "jumlah_peserta", orderable:false, class: "text-right hidden-xs"}
                ]
            });
            table.on( 'select', function ( e, dt, type, indexes ) {
                var selectedRows = table.rows( { selected: true } ).count();
                dt.buttons([".dt-btn-approve",".dt-btn-detail",".dt-btn-delete",".dt-btn-edit",".dt-btn-participant"]).enable(selectedRows > 0);
            });
            table.on( 'deselect', function ( e, dt, type, indexes ) {
                var selectedRows = table.rows( { selected: true } ).count();
                dt.buttons([".dt-btn-approve",".dt-btn-detail",".dt-btn-delete",".dt-btn-edit",".dt-btn-participant"]).enable(selectedRows > 0);
            });
			
            $('#MyFormUpdate').validate({
                ignore: [],
                rules: {
                    nama_kegiatan: "required",
                },
                submitHandler: function(form){
                    var $btn = $(form).find('[type="submit"]');
                    var $btnIcon = $btn.find('span');
                    $btnIcon.removeClass('fa-save').addClass('fa-spin fa-spinner');
                    
                    $(form).ajaxSubmit({
                        url: "<?php echo get_action_url('services/event/index'); ?>",
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
            
            $('#MyFormParticipant').validate({
                ignore: [],
                rules: {
                    event_id: "required",
                    anggota: "required"
                },
                submitHandler: function(form){
                    var $btn = $(form).find('[type="submit"]');
                    var $btnIcon = $btn.find('span');
                    $btnIcon.removeClass('fa-plus').addClass('fa-spin fa-spinner');
                    
                    $(form).ajaxSubmit({
                        url: "<?php echo get_action_url('services/event/participant'); ?>",
                        type: "POST",
                        dataType: 'json',
                        success: function(data){
                            if (data.status){
                                var $tbl = $('#myModalParticipant').find('table.tbl-participants tbody');
                                var s= '<tr class="par-'+data.item.id+' blue">';
                                s+='<td>'+data.item.ref.nama+'</td>';
                                s+='<td class="hidden-xs">'+data.item.ref.nama_perusahaan+'</td>';
                                s+='<td class="hidden-xs">'+data.item.ref.jabatan+'</td>';
                                s+='<td class="text-center"><button type="button" class="btn btn-danger btn-xs btn-del" data-participant-id="'+data.item.id+'"><span class="fa fa-remove"></span></button></td>';
                                s+='</tr>';
                                $tbl.prepend(s);
                            }else{
                                alert(data.message);
                            }
                        },
                        complete: function(){
                            $btnIcon.addClass('fa-plus').removeClass('fa-spin fa-spinner');
                        }
                    });
                    
                }
            });
            
            $('#select-anggota').select2({
                placeholder: 'Pilih peserta',
                //width: 'element',
                theme: 'bootstrap',
                allowClear: true
            });
            
            $('#myModalParticipant').on('click', '.btn-del', function(){
                var participantId = $(this).data('participantId');
                var $row = $(this).parents('tr');
                
                if (confirm('Hapus peserta terpilih dari event ini ?')){
                    $.ajax({
                        url: "<?php echo get_action_url('services/event/participant'); ?>",
                        type: "DELETE",
                        data: {participant_id: participantId}
                    }).then(function (data) {
                        if (data.status) {
                            $row.remove();
                        }else{
                            alert(data.message);
                        }
                    });
                }
            });
            
            $('#myModalDetail').on('click', '.btn-print', function(){
                $('#myModalDetail').find('.modal-body').printThis();
            });
            
        }
    };
    $(document).ready(function(){
        Manager_JS.init();
    });
</script>
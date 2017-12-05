<div class="row">
    <div class="col-sm-12">
        <table id="myDataTable" class="table table-bordered small" role="grid" style="width: 100%;">
            <thead>
                <tr role="row">
                    <th style="width: 30px;"></th>
                    <th class="text-center">Nama Event</th>
                    <th class="text-center hidden-xs" style="width: 100px;">Tanggal</th>
                    <th class="text-center hidden-xs" style="width: 70px;">#Hari</th>
                    <th class="text-right hidden-xs" style="width: 50px;">#Seat</th>
                    <th class="text-right" style="width: 100px;">#Peserta</th>
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
                <h4 class="modal-title" id="myModalUpdateLabel">TAMBAH EVENT</h4>
            </div>
            <div class="modal-body">
                <form id="MyFormUpdate" class="form-validation">
                    <input type="hidden" name="id" class="form-control" value="0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Nama kegiatan</label>
                                <input type="text" name="nama_kegiatan" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Tanggal kegiatan</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control datepicker" name="tanggal" autocomplete="off" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Jumlah hari</label>
                                <input type="number" step="1" min="1" name="jumlah_hari" class="form-control" value="1">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Maks. seat</label>
                                <input type="number" step="1" min="0" name="seat" class="form-control" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Lokasi kegiatan</label>
                                <input type="text" name="lokasi" class="form-control">
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

<div class="modal fade in" id="myModalParticipant" role="dialog" aria-labelledby="myModalParticipantLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title" id="myModalParticipantLabel">UPDATE EVENT PARTICIPANT</h4>
            </div>
            <div class="modal-body">
                <form id="MyFormParticipant" class="form-validation">
                    <input type="hidden" name="event_id" class="form-control" value="0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <select id="select-anggota" name="anggota" class="form-control" style="width: 100%;">
                                        <?php foreach ($members as $member): ?>
                                        <option value="<?php echo $member->id; ?>"><?php echo $member->nama; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-primary"><span class="fa fa-plus"></span> Add to event</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="widget">
                    <div class="widget-header">
                        <h3>DAFTAR PESERTA EVENT: <span class="event-name"></span></h3>
                    </div>
                    <div class="widget-content">
                        <table class="table table-bordered table-condensed table-striped tbl-participants">
                            <thead>
                                <tr><th>NAMA PESERTA</th><th>PERUSAHAAN</th><th>JABATAN</th><th class="text-center">#</th></tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                        <button type="button" class="btn btn-success" data-dismiss="modal" aria-hidden="true"><span class="fa fa-close"></span> Close</button>
                    </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade in" id="myModalDetail" role="dialog" aria-labelledby="myModalDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title" id="myModalDetailLabel">DETAIL DATA EVENT</h4>
            </div>
            <div class="modal-body">
                <div class="widget">
                    <div class="widget-header"><h3>SUMMARY DATA EVENT</h3></div>
                    <div class="widget-content">
                        <table class="table table-bordered table-condensed small" id="tb-detail">
                            <tbody>
                                <tr>
                                    <th scope="row" class="active" style="width: 40%;">NAMA EVENT</th>
                                    <th scope="row" class="active text-center" style="width: 30%;">TANGGAL KEGIATAN</th>
                                    <th scope="row" class="active text-center" style="width: 30%;">JUMLAH HARI</th>

                                </tr>
                                <tr>
                                    <td class="nama_kegiatan"></td>
                                    <td class="tanggal text-center"></td>
                                    <td class="jumlah_hari text-center"></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="active">MAX SEAT</th>
                                    <th scope="row" class="active text-center">PESERTA</th>
                                    <th scope="row" class="active text-center">KEHADIRAN</th>

                                </tr>
                                <tr>
                                    <td class="seat"></td>
                                    <td class="participants text-center"></td>
                                    <td class="presents text-center"></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="active" colspan="3">LOKASI</th>
                                </tr>
                                <tr>
                                    <td class="lokasi" colspan="3"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="widget">
                    <div class="widget-header"><h3>DAFTAR PESERTA TERDAFTAR DI EVENT</h3></div>
                    <div class="widget-content">
                        <table class="table table-bordered table-striped table-condensed small" id="tb-participants">
                            <thead>
                                <tr>
                                    <th>NAMA PESERTA</th>
                                    <th class="hidden-xs">PERUSAHAAN</th>
                                    <th class="hidden-xs">JABATAN</th>
                                    <th class="text-center">HADIR</th>
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
                            text: '<i class="fa fa-plus"></i> Add', 
                            className:'dt-btn-add btn-sm', 
                            enabled: true,
                            action: function( e, dt, btn, config ){
                                var $form = $('#MyFormUpdate');
                                var $dlg = $('#myModalUpdate');
                                $dlg.find('.modal-title').html('TAMBAH EVENT');
                                $form.find('[name="id"]').val(0);
                                $form.find('[name="nama_kegiatan"]').val('');
                                $form.find('[name="tanggal"]').val();
                                $form.find('[name="jumlah_hari"]').val(1);
                                $form.find('[name="seat"]').val(0);
                                $form.find('[name="lokasi"]').val('');
                                $dlg.modal();
                                
                            }
                        },
                        { 
                            text: '<i class="fa fa-pencil"></i> Edit', 
                            className:'dt-btn-edit btn-sm', 
                            enabled: false,
                            action: function( e, dt, btn, config ){
                                var item = dt.row({selected: true}).data();
                                if (item){
                                    var btnIcon = $(btn).find('i');
                                    btnIcon.removeClass('fa-edit').addClass('fa-spin fa-spinner');

                                    var $form = $('#MyFormUpdate');
                                    var $dlg = $('#myModalUpdate');
                                    $dlg.find('.modal-title').html('UPDATE EVENT');
                                    
                                    $.ajax({
                                        url:"<?php echo get_action_url('services/event/get'); ?>",
                                        type: "GET",
                                        data: {id: item.id}
                                    }).then(function(data){
                                        if (data.status){
                                            $form.find('[name="id"]').val(data.item.id);
                                            $form.find('[name="nama_kegiatan"]').val(data.item.nama_kegiatan);
                                            $form.find('[name="jumlah_hari"]').val(data.item.jumlah_hari);
                                            $form.find('[name="tangal"]').val(data.item.tanggal);
                                            $form.find('[name="seat"]').val(data.item.seat);
                                            $form.find('[name="lokasi"]').val(data.item.lokasi);
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
                            text: '<i class="fa fa-person"></i> Participants', 
                            className:'dt-btn-participant btn-sm', 
                            enabled: false,
                            action: function( e, dt, btn, config ){
                                var item = dt.row({selected: true}).data();
                                if (item){
                                    var btnIcon = $(btn).find('i');
                                    btnIcon.removeClass('fa-person').addClass('fa-spin fa-spinner');

                                    var $form = $('#MyFormParticipant');
                                    var $dlg = $('#myModalParticipant');
                                    var $tbl = $dlg.find('table.tbl-participants tbody');
                                    
                                    $dlg.find('[name="event_id"]').val(item.id);
                                    $dlg.find('.modal-title').html('UPDATE EVENT PARTICIPANT');
                                    
                                    $.ajax({
                                        url:"<?php echo get_action_url('services/event/participants'); ?>",
                                        type: "GET",
                                        data: {id: item.id}
                                    }).then(function(data){
                                        if (data.status){
                                            //update widget title
                                            $dlg.find('span.event-name').html(data.event.nama_kegiatan);
                                            $tbl.empty();
                                            for (var i in data.items){
                                                var s = '<tr class="par-'+data.items[i].id+'">';
                                                s+='<td>'+data.items[i].ref.nama+'</td>';
                                                s+='<td>'+data.items[i].ref.nama_perusahaan+'</td>';
                                                s+='<td>'+data.items[i].ref.jabatan+'</td>';
                                                s+='<td class="text-center"><button type="button" class="btn btn-danger btn-xs btn-del" data-participant-id="'+data.items[i].id+'"><span class="fa fa-remove"></span></button></td>';
                                                s+='</tr>';
                                                
                                                $tbl.append(s);
                                            }
                                            
                                            $dlg.modal();
                                        }else{
                                            alert(data.message);
                                        }
                                    }).always(function(){
                                        btnIcon.removeClass('fa-spin fa-spinner').addClass('fa-person');
                                    });

                                    
                                }else{
                                    alert('Anda belum memilih baris data atau data yang anda pilih tidak dapat diubah');
                                }
                            }
                        },
                        { 
                            text: '<i class="fa fa-eye"></i> Detail', 
                            className:'dt-btn-detail btn-sm', 
                            enabled: false,
                            action: function( e, dt, btn, config ){
                                var item = dt.row({selected: true}).data();
                                if (item){
                                    var btnIcon = $(btn).find('i');
                                    btnIcon.removeClass('fa-eye').addClass('fa-spin fa-spinner');

                                    var $dlg = $('#myModalDetail');
                                    $dlg.find('.modal-title').html('DETAIL DATA EVENT');
                                    $dlg.find('.btn-print').data('memberId', item.id);
                                    $.ajax({
                                        url:"<?php echo get_action_url('services/event/detail'); ?>/"+item.id,
                                        type: "GET",
                                        data: {id: item.id}
                                    }).then(function(data){
                                        if (data.status){
                                            var table = $dlg.find('#tb-detail');
                                            var tb_participant = $dlg.find('#tb-participants tbody');
                                            
                                            table.find('.nama_kegiatan').html(data.item.nama_kegiatan);
                                            table.find('.jumlah_hari').html(data.item.jumlah_hari);
                                            table.find('.tanggal').html(data.item.tanggal);
                                            table.find('.lokasi').html(data.item.lokasi);
                                            table.find('.seat').html(data.item.seat);
                                            table.find('.participants').html(data.item.participants.length);
                                            table.find('.presents').html(data.item.presents);
                                            
                                            tb_participant.empty();
                                            if (data.item.participants.length > 0){
                                                
                                                for (var p in data.item.participants){
                                                    var participant = data.item.participants[p];
                                                    var s = '<tr>';
                                                    s+='<td>'+participant.nama+'</td>';
                                                    s+='<td class="hidden-xs">'+participant.nama_perusahaan+'</td>';
                                                    s+='<td class="hidden-xs">'+participant.jabatan+'</td>';
                                                    s+='<td class="text-center">'+(participant.present==1?'<span class="fa fa-check"></span>':'<span class="fa fa-ellipsis-h"></span>')+'</td>';
                                                    
                                                    tb_participant.append(s);
                                                }
                                            }else{
                                                var s ='<tr><td colspan="4">Tidak ada data peserta event ini</td></tr>';
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
                            text: '<i class="fa fa-recycle"></i> Reload', 
                            className:'dt-btn-reload btn-sm hidden-xs', 
                            action: function(e, dt, btn, config){
                                dt.ajax.reload( null, false ); // user paging is not reset on reload
                            }
                        }
                    ]
                },
                ajax: {
                    url: "<?php echo get_action_url('services/event/index'); ?>",
                    dataSrc: "items"
                },
                select: true,
                columns:[
                    {data: null, class:"select-checkbox text-center", orderable: false, defaultContent:""},
                    {data: "nama_kegiatan", render: $.fn.dataTable.render.ellipsis(35)},
                    {data: "tanggal", class: "text-center hidden-xs"},
                    {data: "jumlah_hari", class: "text-right hidden-xs"},
                    {data: "seat", class: "text-right hidden-xs"},
                    {data: "jumlah_peserta", orderable:false, class: "text-right"}
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
                                var s= '<tr class="par-'+data.item.id+'">';
                                s+='<td>'+data.item.ref.nama+'</td>';
                                s+='<td>'+data.item.ref.nama_perusahaan+'</td>';
                                s+='<td>'+data.item.ref.jabatan+'</td>';
                                s+='<td class="text-center"><button type="button" class="btn btn-danger btn-xs btn-del" data-participant-id="'+data.item.id+'"><span class="fa fa-remove"></span></button></td>';
                                s+='</tr>';
                                $tbl.append(s);
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
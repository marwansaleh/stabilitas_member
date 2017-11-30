<style type="text/css">
    .seat-box {width: 45px; height: 45px;}
</style>
<div class="well well-sm">
    <form id="MyFormUpdate" class="form-validation">
        <div class="row">
            <div class="col-sm-12">
                <div class="input-group input-group-lg">
                    <input type="search" name="nomor_registrasi" placeholder="Masukkan nomor registrasi" class="form-control">
                    <span class="input-group-btn"><button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Search</button></span>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="widget">
    <div class="widget-header">
        <h3>DETAIL PARTICIPANT</h3>
    </div>
    <div class="widget-content">
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered" id="tb-detail">
                    <tbody>
                        <tr>
                            <th scope="row" class="active" style="width: 150px;">NOMOR REG.</th>
                            <td class="nomor_registrasi"></td>
                        </tr>
                        <tr>
                            <th scope="row" class="active">NAMA PESERTA</th>
                            <td class="nama"></td>
                        </tr>
                        <tr>
                            <th scope="row" class="active">JENIS KELAMIN</th>
                            <td class="jenis_kelamin"></td>
                        </tr>
                        <tr>
                            <th scope="row" class="active">PERUSAHAAN</th>
                            <td class="nama_perusahaan"></td>
                        </tr>
                        <tr>
                            <th scope="row" class="active">JABATAN</th>
                            <td class="jabatan"></td>
                        </tr>
                        <tr>
                            <th scope="row" class="active">NOMOR HP.</th>
                            <td class="no_hp"></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered table-striped" id="tb-events">
                    <thead>
                        <tr>
                            <th>NAMA EVENT</th><th class="text-center">TANGGAL</th><th class="text-center">KEHADIRAN</th>
                            <th class="text-center">KURSI</th><th class="text-center">#</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade in" id="myModalUpdate" role="dialog" aria-labelledby="myModalUpdateLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalUpdateLabel">PILIH KURSI</h4>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-save-seat" data-member-id="" data-event-id="" data-seat-number=""><span class="fa fa-save"></span> Save</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" aria-hidden="true"><span class="fa fa-close"></span> Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var Manager_JS = {
        init: function(){
            var _this = this;
            
			
            $('#MyFormUpdate').validate({
                ignore: [],
                rules: {
                    nomor_registrasi: "required",
                },
                submitHandler: function(form){
                    var $btn = $(form).find('[type="submit"]');
                    var $btnIcon = $btn.find('i');
                    $btnIcon.removeClass('fa-search').addClass('fa-spin fa-spinner');
                    
                    $(form).ajaxSubmit({
                        url: "<?php echo get_action_url('services/member/noreg'); ?>",
                        type: "POST",
                        dataType: 'json',
                        success: function(data){
                            if (data.status){
                                var table = $('table#tb-detail');
                                var tb_events = $('table#tb-events tbody');

                                table.find('.nomor_registrasi').html(data.item.nomor_registrasi);
                                table.find('.nama').html(data.item.nama);
                                table.find('.jenis_kelamin').html(data.item.jenis_kelamin);
                                table.find('.nama_perusahaan').html(data.item.nama_perusahaan);
                                table.find('.jabatan').html(data.item.jabatan);
                                table.find('.no_hp').html(data.item.no_hp);

                                tb_events.empty();
                                if (data.item.events.length>0){
                                    for (var e in data.item.events){
                                        var event = data.item.events[e];
                                        var disabled_set_btn = event.seat > 0 ? 'disabled="disabled"':'';
                                        var s = '<tr>';
                                        s+='<td>'+event.nama_kegiatan+'</td>';
                                        s+='<td class="text-center">'+event.tanggal+'</td>';
                                        s+='<td class="text-center">'+(event.present==1?'<span class="fa fa-check"></span>':'<span class="fa fa-ellipsis-h"></span>')+'</td>';
                                        s+='<td class="text-center">'+event.seat+'</td>';
                                        s+='<td class="text-center">';
                                            s+='<button type="button" class="btn btn-primary btn-xs btn-set-present" data-member-id="'+data.item.id+'" data-event-id="'+event.id+'" '+disabled_set_btn+'><span class="fa fa-pencil"></span> KEHADIRAN</button>';
                                            s+='<button type="button" class="btn btn-default btn-xs btn-print-tag" data-member-id="'+data.item.id+'" data-event-id="'+event.id+'"><span class="fa fa-tag"></span> NAME TAG</button>';
                                        s+='</td>';
                                        s+='</tr>';

                                        tb_events.append(s);
                                    }
                                }else{
                                    var s= '<tr><td colspan="5">Tidak ada data event yang diikuti peserta ini</td></tr>';
                                    tb_events.append(s);
                                }
                            }else{
                                alert(data.message);
                            }
                        },
                        complete: function(){
                            $btnIcon.addClass('fa-search').removeClass('fa-spin fa-spinner');
                        }
                    });
                    
                }
            });
            
            $('table#tb-events').on('click','.btn-set-present', function(){
                var $dlg = $('#myModalUpdate');
                var $btnSaveSeat = $dlg.find('.btn-save-seat'); 
                var memberId = $(this).data('memberId');
                var eventId = $(this).data('eventId');
                
                $dlg.find('.modal-title').html('SET KEHADIRAN DAN NOMOR KURSI');
                $btnSaveSeat.data('memberId', memberId);
                $btnSaveSeat.data('eventId', eventId);
                
                $dlg.modal();
                
                var $btnIcon = $(this).find('span');
                $btnIcon.removeClass('fa-pencil').addClass('fa-spin fa-spinner');
                
                $.ajax({
                    url:"<?php echo get_action_url('services/event/seats'); ?>",
                    type: "GET",
                    data: {event_id: eventId, member_id: memberId}
                }).then(function(data){
                    var $dlgBody = $dlg.find('.modal-body');
                    $dlgBody.empty();
                    if (data.status){
                        for (var i in data.seats){
                            var btnClass = data.seats[i].participant ? 'btn-danger':'btn-success';
                            var enabled = data.seats[i].participant ? 'disabled="disabled"':'';
                            var s = '<button type="button" class="btn btn-set-seat seat-box '+btnClass+'" data-seat-id="'+data.seats[i].seat_number+'" '+enabled+'>'+data.seats[i].seat_number+'</button>';
                            
                            $dlgBody.append(s);
                        }
                    }else{
                        alert(data.message);
                    }
                }).always(function(){
                    $btnIcon.removeClass('fa-spin fa-spinner').addClass('fa-pencil');
                });
            });
            
            $('#myModalUpdate').on('click','.btn-set-seat', function(){
                var $btnSaveSeat = $('#myModalUpdate').find('.btn-save-seat');
                $btnSaveSeat.data('seatNumber', $(this).data('seatId'));
            });
            
            $('#myModalUpdate').on('click','.btn-save-seat', function(){
                var $dlg = $('#myModalUpdate');
                var memberId = $(this).data('memberId');
                var eventId = $(this).data('eventId');
                var seatNumber = $(this).data('seatNumber');
                
                var $btnIcon = $(this).find('span');
                $btnIcon.removeClass('fa-save').addClass('fa-spin fa-spinner');
                
                $.ajax({
                    url:"<?php echo get_action_url('services/event/seat'); ?>",
                    type: "POST",
                    data: {event_id: eventId, member_id: memberId, seat: seatNumber}
                }).then(function(data){
                    if (data.status){
                        if (confirm('Cetak name tag peserta ini ?')){
                            _this.printNameTag(memberId, eventId);
                        }
                        $dlg.modal('hide');
                    }else{
                        alert(data.message);
                    }
                }).always(function(){
                    $btnIcon.removeClass('fa-spin fa-spinner').addClass('fa-save');
                });
            });
            
            $('table#tb-events').on('click','.btn-print-tag', function(){
                var memberId = $(this).data('memberId');
                var eventId = $(this).data('eventId');
                
                _this.printNameTag(memberId, eventId,);
            });
        },
        printNameTag: function(memberId, eventId){
            $.ajax({
                url:"<?php echo get_action_url('services/mypdf/nametag'); ?>",
                type: "POST",
                data: {event_id: eventId, member_id: memberId}
            }).then(function(data){
                if (data.status){
                    var wnd = window.open(data.download_url);
                    wnd.focus();
                }else{
                    alert(data.message);
                }
            });
        }
    };
    $(document).ready(function(){
        Manager_JS.init();
    });
</script>
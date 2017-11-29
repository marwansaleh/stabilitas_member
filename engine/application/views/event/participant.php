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
                <table class="table table-bordered table-striped" id="tb-events">
                    <thead>
                        <tr>
                            <th>NAMA EVENT</th><th class="text-center">TANGGAL</th><th class="text-center">KEHADIRAN</th>
                            <th class="text-center">KURSI</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade in" id="myModalUpdate" role="dialog" aria-labelledby="myModalUpdateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title" id="myModalUpdateLabel">PILIH KURSI</h4>
            </div>
            <div class="modal-body">
                
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
                                table.find('.tempat_tgl_lahir').html(data.item.tempat_lahir + ', '+data.item.tanggal_lahir);
                                table.find('.agama').html(data.item.agama.agama);
                                table.find('.no_hp').html(data.item.no_hp);

                                tb_events.empty();
                                if (data.item.events.length>0){
                                    for (var e in data.item.events){
                                        var event = data.item.events[e];
                                        var s = '<tr>';
                                        s+='<td>'+event.nama_kegiatan+'</td>';
                                        s+='<td class="text-center">'+event.tanggal+'</td>';
                                        s+='<td class="text-center">'+(event.present==1?'<span class="fa fa-check"></span>':'<span class="fa fa-ellipsis-h"></span>')+'</td>';
                                        s+='<td class="text-center">'+event.seat+'</td>';
                                        s+='</tr>';

                                        tb_events.append(s);
                                    }
                                }else{
                                    var s= '<tr><td colspan="4">Tidak ada data event yang diikuti peserta ini</td></tr>';
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
        }
    };
    $(document).ready(function(){
        Manager_JS.init();
    });
</script>
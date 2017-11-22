<div id="container-search-form" class="row">
    <div class="col-lg-12">
        <form id="frmQuery">
            <div class="form-group form-group-lg">
                <select id="query" name="client_id" class="form-control" style="width:100%;"></select>
            </div>
        </form>
    </div>
</div>
<div id="container-search-result" class="row">
    <div class="text-center indicator hidden"><span class="fa fa-spinner fa-spin fa-5x"></span></div>
    <div class="col-sm-12 data-view hidden">
        <div class="widget">
            <div class="widget-header">
                <h3 class="widget-title">Daftar Agenda</h3>
                <div class="btn-group widget-header-toolbar">
                    <button type="button" class="btn btn-default btn-sm print-btn"><i class="fa fa-print"></i> <span>Print List</span></button>
                </div>
            </div>
            <div class="widget-content">
                <div id="print-area">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Tanggal Visit</th>
                                <th>Nama Broker</th>
                                <th>Keterangan Visit</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <p><em><sup>*</sup>Click the data row to view detail agenda</em></p>
            </div>
        </div>
    </div>
</div>

<!-- Detail agenda-->
<div class="modal fade in" id="myModalDetail" role="dialog" aria-labelledby="myModalLabelDetail" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title" id="myModalLabelDetail">Detail Agenda</h4>
            </div>
            <div class="modal-body print-area">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-print-detail" ><span class="fa fa-print"></span> Print</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true"><span class="fa fa-close"></span> Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var Query_JS = {
        init: function(){
            var _this = this;
            var $select2 = $('#query');
            $select2.select2({
                ajax: {
                    url: "<?php echo get_action_url('services/client/select2'); ?>",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                      return {
                        q: params.term || '', // search term
                        page: params.page || 1
                      };
                    },
                    cache: true
                },
                placeholder: 'Masukkan nama Client',
                //width: 'element',
                theme: 'bootstrap',
                allowClear: true,
                minimumInputLength: 1
            }).on("select2:select", function (e) {
                var selected = e.params.data;
                if (typeof selected !== "undefined") {
                   _this.loadAgenda(selected.id, selected.fullname);
                }
            });
            
            $('#container-search-result').on('click', '.print-btn', function(){
                $('#print-area').printArea();
            });
            
            /** agenda list */
            $('#container-search-result').on('click', 'tr.row-agenda', function(){
                var itemId = $(this).data('agendaId');
                var itemDesc = $(this).data('agendaReason');
                if (itemId){
                    var $modal = $('#myModalDetail');

                    $modal.find('.modal-title').html('Detail Agenda:'+itemDesc.toString().ellipsis(25));
                    $modal.find('.modal-body').html('<p class="text-center"><span class="fa fa-spin fa-spinner fa-4x"></span></p>');
                    $modal.modal();

                    //load detail information
                    $.ajax({
                        url:"<?php echo get_action_url('services/agenda/info'); ?>/"+itemId,
                        type: "GET",
                        dataType:"json",
                        data: {id: itemId}
                    }).then(function(data){
                        if (data.status){
                            $modal.find('.modal-body').html(data.info);
                        }else{
                            alert(data.message);
                        }
                    });
                }
            });
            /* Download uploaded document on detail modal window */
            $('#myModalDetail').on('click','.btn-file-download', function(){
                var $btnIcon = $(this).find('span');
                var uploadId = $(this).data('fileId');
                $btnIcon.removeClass('fa-download').addClass('fa-spin fa-spinner');
                $.ajax({
                    url:"<?php echo get_action_url('services/agenda/upload'); ?>/"+uploadId,
                    type: "GET",
                    dataType: "json"
                }).then(function(data){
                    if (data.status){
                        var wnd = window.open("<?php echo get_action_url('attachment/download'); ?>/"+data.item.file_url_encoded);
                        wnd.focus();
                    }else{
                        alert(data.message);
                    }
                }).always(function(){
                    $btnIcon.removeClass('fa-spin fa-spinner').addClass('fa-download');
                });
            });
            $('#myModalDetail').on('click','.btn-file-open', function(){
                var $btnIcon = $(this).find('span');
                var uploadId = $(this).data('fileId');
                $btnIcon.removeClass('fa-eye').addClass('fa-spin fa-spinner');
                $.ajax({
                    url:"<?php echo get_action_url('services/agenda/upload'); ?>/"+uploadId,
                    type: "GET",
                    dataType: "json"
                }).then(function(data){
                    if (data.status){
                        var wnd = window.open("<?php echo get_action_url('attachment/open'); ?>/"+data.item.file_url_encoded);
                        wnd.focus();
                    }else{
                        alert(data.message);
                    }
                }).always(function(){
                    $btnIcon.removeClass('fa-spin fa-spinner').addClass('fa-eye');
                });
            });
            $('#myModalDetail').on('click', '.btn-print-detail', function(){
                $('#myModalDetail').find('.print-area').printArea();
            });
        },
        loadAgenda: function(id, clientFullname){
            var $container = $('#container-search-result');
            var $indicator = $container.find('.indicator');
            var $view_container = $container.find('.data-view');
            
            $.ajax({
                url: "<?php echo get_action_url('services/agenda/client'); ?>",
                type: "POST",
                dataType: "json",
                data: {client_id: id}
            }).then(function(result){
                $indicator.addClass('hidden');
                if (result.status){
                    $view_container.find('.widget-title').html('<h3>Daftar Agenda :: '+clientFullname+'</h3>');
                    $view_container.removeClass('hidden');
                    
                    for (var i in result.items){
                        var agenda = result.items[i];
                        var s = '<tr class="row-agenda" data-agenda-id="'+agenda.id+'" data-agenda-reason="'+agenda.visit_reason+'">';
                        s+='<td class="text-center">'+agenda.plan_visit+'</td>';
                        s+='<td>'+(agenda.broker ? agenda.broker.fullname : '') +'</td>';
                        s+='<td>'+agenda.visit_reason+'</td>';
                        s+='<td class="text-center">'+agenda.agenda_status_label+'</td>';
                        s+='</tr>';
                        
                        $view_container.find('table tbody').append(s);
                    };
                }else{
                    $view_container.addClass('hidden');
                    alert(result.message);
                }
            });
        }
    };
    $(document).ready(function(){
        Query_JS.init();
    });
</script>
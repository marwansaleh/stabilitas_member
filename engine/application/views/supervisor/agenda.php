<div class="row">
    <div class="col-lg-12">
        <table id="myDataTable" class="table table-bordered" role="grid">
            <thead>
                <tr role="row">
                    <th style="width: 30px;"></th>
                    <th class="text-center">Visit Agenda</th>
                    <th>Client</th>
                    <th>Broker / AO</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">#Doc</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade in" id="myModalUpdate" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Rencana Kunjungan AO BSM</h4>
            </div>
            <div class="modal-body">
                <form id="MyFormUpdate" class="form-validation">
                    <input type="hidden" name="created_by" value="<?php echo $me->id; ?>">
                    <input type="hidden" name="userid" value="<?php echo $me->id; ?>">
                    <input type="hidden" name="id">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="form-group">
                                <label>Nama client</label>
                                <input type="text" name="client_name" class="form-control typeahead">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Captive</label>
                                <select name="captive" class="form-control">
                                    <option value="1">YA</option>
                                    <option value="0">TIDAK</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Tanggal kunjungan</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control datepicker" name="plan_visit" autocomplete="off" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Keterangan kunjungan</label>
                                <textarea class="form-control" name="visit_reason" maxlength="254"></textarea>
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
    var JS_Manager = {
        init: function(){
            var _this = this;
            var table = $('#myDataTable').DataTable({
                searching: true,
                ordering: true,
                order: [1,"asc"],
                rowId: 'id',
                processing: true,
                serverSide: true,
                sDom: "<'row'<'col-sm-2'l><'col-sm-7'B><'col-sm-3'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                buttons:{
                    buttons: [
                        { 
                            text: '<i class="fa fa-plus"></i> Add', 
                            className:'dt-btn-add', 
                            action: function( e, dt, btn, config ){
                                var $form = $('#MyFormUpdate');
                                var $dlg = $('#myModalUpdate');

                                $form.find('[name="id"]').val(0);

                                $dlg.modal();
                            }
                        },
                        { 
                            text: '<i class="fa fa-edit"></i> Edit', 
                            className:'dt-btn-edit', 
                            enabled: false,
                            action: function( e, dt, btn, config ){
                                var item = dt.row({selected: true}).data();
                                if (item && item.editable){
                                    var btnIcon = $(btn).find('i');
                                    btnIcon.removeClass('fa-edit').addClass('fa-spin fa-spinner');
                                    
                                    var $form = $('#MyFormUpdate');
                                    var $dlg = $('#myModalUpdate');
                                    $.ajax({
                                        url:"<?php echo get_action_url('services/agenda/get'); ?>/"+item.id,
                                    }).then(function(data){
                                        if (data.status){
                                            $form.find('[name="id"]').val(item.id);
                                            $form.find('[name="client_name"]').val(data.item.client_name);
                                            $form.find('[name="captive"]').val(data.item.captive);
                                            $form.find('[name="plan_visit"]').val(data.item.plan_visit);
                                            $form.find('[name="visit_reason"]').val(data.item.visit_reason);
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
                            text: '<i class="fa fa-remove"></i> Delete', 
                            className:'dt-btn-delete', 
                            enabled: false,
                            action: function( e, dt, btn, config ){
                                var itemIds = dt.rows({selected: true}).ids().toArray();
                                if (itemIds && confirm('Hapus data terpilih ?')){
                                    _this.deleteMultipleData(itemIds, btn);
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
                    url: "<?php echo get_action_url('services/agenda/datatable'); ?>?userid=<?php echo $me->id; ?>",
                    dataSrc: "items"
                },
                select: true,
                columns:[
                    {data: null, class:"select-checkbox text-center", orderable: false, defaultContent:""},
                    {data: "plan_visit", class:"text-center"},
                    {data: "client_name"},
                    {data: "userid", render: function(data,row,type){
                            if (row.broker){
                                return row.broker.fullname;
                            }else{
                                return data;
                            }
                    }},
                    {data: "visit_reason", render: function(data,row,type){
                            return '<span title="'+data+'">'+data.toString().ellipsis(40)+'</span>';
                    }},
                    {data: "doc_count", class:"text-center", render: $.fn.dataTable.render.number(',', '.', 0, '')},
                    {data: "status_label"}
                ]
            });
            table.on( 'select', function ( e, dt, type, indexes ) {
                var selectedRows = table.rows( { selected: true } ).count();
                dt.buttons([".dt-btn-edit",".dt-btn-delete"]).enable(selectedRows > 0);
            });
            table.on( 'deselect', function ( e, dt, type, indexes ) {
                var selectedRows = table.rows( { selected: true } ).count();
                dt.buttons([".dt-btn-edit",".dt-btn-delete"]).enable(selectedRows > 0);
            });
            $('#MyFormUpdate').validate({
                ignore: [],
                rules: {
                    client_name: { required: true }
                },
                submitHandler: function(form){
                    var btn = $(form).find('[type="submit"]').find('span');
                    btn.removeClass('fa-save').addClass('fa-spin fa-spinner');
                    
                    $(form).ajaxSubmit({
                        url: "<?php echo get_action_url('services/agenda/save'); ?>",
                        type: "POST",
                        dataType: 'json',
                        resetForm: true,
                        success: function(data){
                            if (data.status){
                                $('#myModalUpdate').modal('hide');
                                table.ajax.reload(null,false);
                            }else{
                                alert(data.message);
                            }
                        },
                        complete: function(){
                            btn.removeClass('fa-spin fa-spinner').addClass('fa-save');
                        }
                    });
                    
                }
            });
            
            $('#myModalUpdate .typeahead').typeahead({
                ajax: {
                    url: "<?php echo get_action_url('services/client/clientnames'); ?>",
                    timeout: 500,
                    displayField: "client_name",
                    valueField: "id",
                    triggerLength: 1,
                    method: "get",
                    loadingClass: "loading-circle",
                    preDispatch: function (query) {
                        //showLoadingMask(true);
                        return {
                            search: query
                        }
                    },
                    preProcess: function (data) {
                        //showLoadingMask(false);
                        if (data.success === false) {
                            // Hide the list, there was some error
                            return false;
                        }
                        // We good!
                        return data;
                    }
                },
                onSelect: function(item){
                    console.log(item);
                }
            });
            
        },
        loadUploadedDocuments: function(agendaId){
            var $uploadedCtn = $('#uploaded-docs');
            
            //load uploaded documents
            $uploadedCtn.html('<p class="text-center">Wait loading...<br><span class="fa fa-spin fa-spinner fa-4x"></span></p>');
            $.ajax({
                url: "<?php echo get_action_url('services/agenda/uploads'); ?>/"+agendaId,
                type: "GET",
                dataType: "json"
            }).then(function(data){
                var s = '';
                if (data.item_count>0){
                    s = '<table class="table table-bordered table-striped table-hover">';
                    s+='<thead>';
                        s+='<tr><th>File Description</th><th>File Name</th><th class="text-center">Date</th><th class="text-center" style="width:30px;">#</th></tr>'
                    s+='</thead>';
                    for (var i in data.items){
                        s+='<tr>';
                            s+= '<td>'+data.items[i].file_title+'</td>';
                            s+= '<td>'+data.items[i].file_name+'</td>';
                            s+= '<td class="text-center">'+data.items[i].created+'</td>';
                            s+= '<td class="text-center"><button type="button" class="btn btn-danger btn-xs btn-delete" data-doc-id="'+data.items[i].id+'"><span class="fa fa-remove"></span></button></td>';
                        s+='</tr>';
                    }
                    s+= '</table>';
                }else{
                    s= '<p>Tidak ada dokumen yang diupload untuk agenda ini</p>';
                }
        
                $uploadedCtn.html(s);
            });
        }

    };
    $(document).ready(function(){
        JS_Manager.init();
    });
    
</script>
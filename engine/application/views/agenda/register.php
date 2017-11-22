<div class="row">
    <div class="col-lg-12">
        <table id="myDataTable" class="table table-bordered" role="grid">
            <thead>
                <tr role="row">
                    <th style="width: 30px;"></th>
                    <th style="width: 30px;">ID</th>
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
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title" id="myModalLabel">Rencana Kunjungan AO BSM</h4>
            </div>
            <div class="modal-body">
                <form id="MyFormUpdate" class="form-validation">
                    <input type="hidden" name="created_by" value="<?php echo $me->id; ?>">
                    <input type="hidden" name="userid" value="<?php echo $me->id; ?>">
                    <input type="hidden" name="id">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="form-group">
                                <label>Nama client</label>
                                <input type="hidden" name="client_name">
                                <select name="client_id" class="form-control" style="width: 100%;"></select>
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

<!-- Upload dokumen agenda-->
<div class="modal fade in" id="myModalUploadDoc" role="dialog" aria-labelledby="myModalLabelUploadDoc" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title" id="myModalLabelUploadDoc">Upload Files</h4>
            </div>
            <div class="modal-body">
                <form id="MyFormUpload" class="form-validation" enctype="multipart/form-data">
                    <input type="hidden" name="created_by" value="<?php echo $me->id; ?>">
                    <input type="hidden" name="agenda">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Document description</label>
                                <input type="text" name="file_title" class="form-control" placeholder="Insert document description">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Select file <em>( jpg | png | doc | docx | xls | xlsx | ppt | pptx | pdf )</em></label>
                                <input type="file" name="userfile" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Upload</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal" aria-hidden="true"><span class="fa fa-close"></span> Close</button>
                    </div>
                </form>
                <div class="well well-sm" id="uploaded-docs">
                    
                </div>
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
    var JS_Manager = {
        init: function(){
            var _this = this;
            var table = $('#myDataTable').DataTable({
                searching: true,
                ordering: true,
                order: [2,"asc"],
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
                                if (item){
                                    if (item.editable){
                                        var btnIcon = $(btn).find('i');
                                        btnIcon.removeClass('fa-edit').addClass('fa-spin fa-spinner');

                                        var $form = $('#MyFormUpdate');
                                        var $dlg = $('#myModalUpdate');
                                        $.ajax({
                                            url:"<?php echo get_action_url('services/agenda/get'); ?>/"+item.id,
                                        }).then(function(data){
                                            if (data.status){
                                                $form.find('[name="id"]').val(item.id);
                                                $select2.setSelected(data.item.client_id);
                                                $form.find('[name="client_name"]').val(data.item.client_name);
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
                                        alert('Agenda yang dipilih tidak dapat diubah');
                                    }

                                    
                                }else{
                                    alert('Anda belum memilih baris data atau data yang anda pilih tidak dapat diubah');
                                }
                            }
                        },
                        { 
                            text: '<i class="fa fa-files-o"></i> Upload Files', 
                            className:'dt-btn-upload', 
                            enabled: false,
                            action: function( e, dt, btn, config ){
                                var item = dt.row({selected: true}).data();
                                if (item.id){
                                    var $form = $('#MyFormUpload');
                                    var $dlg = $('#myModalUploadDoc');
                                    
                                    $form.find('[name="agenda"]').val(item.id);
                                    $dlg.find('.modal-title').html('Upload Files for Agenda: '+(item.visit_reason.ellipsis(30)));
                                    
                                    $dlg.modal();
                                    
                                    //load existing uploaded documents
                                    _this.loadUploadedDocuments(item.id);
                                }
                            }
                        },
                        { 
                            text: '<i class="fa fa-eye"></i> Detail', 
                            className:'dt-btn-detail', 
                            enabled: false,
                            action: function( e, dt, btn, config ){
                                var item = dt.row({selected: true}).data();
                                if (item && item.id){
                                    var $modal = $('#myModalDetail');
                                    var $btnIcon = $(btn).find('i');
                                    $btnIcon.removeClass('fa-eye').addClass('fa-spin fa-spinner');
                                    
                                    $modal.find('.modal-title').html('Detail Agenda:'+item.visit_reason.toString().ellipsis(25));
                                    $modal.find('.modal-body').html('<p class="text-center"><span class="fa fa-spin fa-spinner fa-4x"></span></p>');
                                    $modal.modal();
                                    
                                    //load detail information
                                    $.ajax({
                                        url:"<?php echo get_action_url('services/agenda/info'); ?>/"+item.id,
                                        type: "GET",
                                        dataType:"json",
                                        data: {id: item.id}
                                    }).then(function(data){
                                        if (data.status){
                                            $modal.find('.modal-body').html(data.info);
                                        }else{
                                            alert(data.message);
                                        }
                                    }).always(function(){
                                        $btnIcon.removeClass('fa-spin fa-spinner').addClass('fa-eye');
                                    });
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
                    {data: "id", class:"text-center"},
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
                dt.buttons([".dt-btn-edit",".dt-btn-delete",".dt-btn-upload",".dt-btn-detail"]).enable(selectedRows > 0);
            });
            table.on( 'deselect', function ( e, dt, type, indexes ) {
                var selectedRows = table.rows( { selected: true } ).count();
                dt.buttons([".dt-btn-edit",".dt-btn-delete",".dt-btn-upload",".dt-btn-detail"]).enable(selectedRows > 0);
            });
            
            /* Setup select2 Client */
            var $select2 = $('#MyFormUpdate').find('[name="client_id"]');
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
                placeholder: 'Pilih client',
                //width: 'element',
                theme: 'bootstrap',
                allowClear: true,
                minimumInputLength: 1
            }).on("select2:select", function (e) {
                var selected = e.params.data;
                if (typeof selected !== "undefined") {
                    $('#MyFormUpdate').find('[name="client_name"]').val(selected.fullname);
                }
            });
            $select2.setSelected = function(selected){
                var $this = $(this);
                var $option = null;

                if (parseInt(selected) == 0){
                    $option = $('<option selected></option>').val(0);
                    $this.append($option).trigger('change');
                    $option.removeData();

                    return;
                }else{
                    $option = $('<option selected>Loading...</option>').val(selected);
                }

                $this.append($option).trigger('change');

                $.ajax({ // make the request for the selected data object
                    type: 'GET',
                    url: '<?php echo get_action_url('services/client/get'); ?>/' + selected,
                    dataType: 'json'
                }).then(function (data) {
                    if (data.status){
                        // Here we should have the data object
                        $option.text(data.item.fullname).val(data.item.id); // update the text that is displayed (and maybe even the value)
                    }else{
                        $option.text('').val(0);
                    }
                    $option.removeData(); // remove any caching data that might be associated
                    $this.trigger('change'); // notify JavaScript components of possible changes
                });
            };
            
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
            $('#MyFormUpload').validate({
                ignore: [],
                rules: {
                    created_by: { required: true },
                    file_title: { required: true },
                    userfile: { required: true }
                },
                submitHandler: function(form){
                    var btn = $(form).find('[type="submit"]').find('span');
                    btn.removeClass('fa-save').addClass('fa-spin fa-spinner');
                    
                    $(form).ajaxSubmit({
                        url: "<?php echo get_action_url('services/agenda/upload'); ?>",
                        type: "POST",
                        dataType: 'json',
                        resetForm: true,
                        success: function(data){
                            if (data.status){
                                _this.loadUploadedDocuments(data.agendaId);
                                table.ajax.reload( null, false );
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
            /* Hapus file yang sudah diupload sebelumnya*/
            $('#uploaded-docs').on('click','.btn-delete', function(){
                var docId = $(this).data('docId');
                var $btnIcon = $(this).find('span');
                var $row = $(this).parents('tr');
                
                if (confirm('Hapus dokumen terpilih?')){
                    $btnIcon.removeClass('fa-remove').addClass('fa-spin fa-spinner');
                    $.ajax({
                        url: "<?php echo get_action_url('services/agenda/upload'); ?>/"+docId,
                        type: "DELETE",
                        dataType: "json"
                    }).then(function(data){
                        if (data.status){
                            $row.remove();
                        }else{
                            alert(data.message);
                        }
                    }).always(function(){
                        $btnIcon.removeClass('fa-spin fa-spinner').addClass('fa-remove');
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
        deleteMultipleData: function(itemIds, button){
            $.ajax({
                url: '<?php echo get_action_url('service/dt/mtr_ao_group/deletemulti'); ?>',
                type: 'DELETE',
                dataType: 'json',
                data: {itemIds: itemIds}
            }).then(function(result){
                if (result.status){
                    $('#myDataTable').DataTable().ajax.reload(null,false);
                }else{
                    alert(result.message);
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
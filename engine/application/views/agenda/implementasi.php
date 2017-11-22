<!-- custom vertical tab -->
<ul class="nav nav-tabs nav-tabs-custom-colored" role="tablist">
    <li class="active"><a href="#to-execute" data-toggle="tab"><i class="fa fa-list-alt"></i> To Execute</a></li>
    <li><a href="#done" data-toggle="tab"><i class="fa fa-check-square-o"></i> Done</a></li>
    <li><a href="#missed" data-toggle="tab"><i class="fa fa-warning"></i> Missed Agenda</a></li>
</ul>
<div id="tab-container" class="tab-content">
    <div class="tab-pane fade in active" id="to-execute">
        <table id="DT_Execute" class="table table-bordered" role="grid" style="width: 100%;">
            <thead>
                <tr role="row">
                    <th style="width: 30px;"></th>
                    <th class="text-center" style="width: 120px;">Visit Agenda</th>
                    <th>Client</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-right">#Docs</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="done">
        <table id="DT_Done" class="table table-bordered" role="grid" style="width: 100%;">
            <thead>
                <tr role="row">
                    <th style="width: 30px;"></th>
                    <th class="text-center" style="width: 120px;">Date Visited</th>
                    <th>Client</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-right">#Docs</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="missed">
        <table id="DT_Missed" class="table table-bordered" role="grid" style="width: 100%;">
            <thead>
                <tr role="row">
                    <th style="width: 30px;"></th>
                    <th class="text-center" style="width: 120px;">Visit Agenda</th>
                    <th>Client</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-right">#Docs</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<!--modal untuk form eksekusi -->
<div class="modal fade in" id="myModalUpdate" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title" id="myModalLabel">Eksekusi Agenda</h4>
            </div>
            <div class="modal-body">
                <form id="MyFormUpdate" class="form-validation">
                    <input type="hidden" name="userid" value="<?php echo $me->id; ?>">
                    <input type="hidden" name="id">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Tanggal kunjungan</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control datepicker" name="date_visited" autocomplete="off" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" id="container-pic">
                            <p class="help-block"><strong>Orang-orang yang ditemui</strong></p>
                            <div class="row" style="z-index: 1000;">
                                <div class="col-sm-4">
                                    <div class="form-group form-group-sm">
                                        <label>Nama Lengkap</label><br>
                                        <input type="hidden" class="form-control" name="agenda_id">
                                        <input type="hidden" class="form-control" name="client_id">
                                        <input type="text" class="form-control pic-visit" name="fullname" style="width: 100% !important;">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-group-sm">
                                        <label>Jabatan</label>
                                        <input type="text" class="form-control pic-visit" name="position">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-group-sm">
                                        <label>Telepon</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control pic-visit" name="phone">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-primary btn-save"><span class="fa fa-save"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Laporan kunjungan</label>
                                <textarea class="form-control" name="report"></textarea>
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
    var Manager_JS = {
        init: function(){
            var _this = this;
            
            var tb_execute = $('#DT_Execute').DataTable({
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
                            text: '<i class="fa fa-bolt"></i> Execute Agenda', 
                            className:'dt-btn-exec', 
                            enabled: false,
                            action: function( e, dt, btn, config ){
                                var item = dt.row({selected: true}).data();
                                if (item){
                                    if (confirm('Tandai agenda ini sebagai agenda yang sudah dieksekusi ? Anda akan diminta menulis laporan kunjungan untuk menandai agenda telah dieksekusi')){
                                        //show form to update report
                                        var $form = $('#MyFormUpdate');
                                        var $dlg = $('#myModalUpdate');
                                        $dlg.find('.modal-title').html('[ '+ item.client_name+' ] ' +item.visit_reason.toString().ellipsis(45));
                                        $form.find('[name="id"]').val(item.id);
                                        
                                        $form.find('[name="agenda_id"]').val(item.id);
                                        $form.find('[name="client_id"]').val(item.client_id);
                                        $form.find('[name="visit_id"]').val('');
                                        $form.find('[name="report"]').val(item.report);
                                        $dlg.modal();
                                        
                                        //load visited pic
                                        var $table_pic = $('#container-pic').find('tbody');
                                        _this.loadVisitedPIC(item.id, $table_pic);
                                        
                                        //set textarea report menjadi texteditor
                                        $form.find('[name="report"]').summernote({
                                            height: 150,
                                            airMode: true,
                                            focus: true,
                                            onpaste: function() {
                                                alert('You have pasted something to the editor');
                                            }
                                        });
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
                            text: '<i class="fa fa-recycle"></i> Reload', 
                            className:'dt-btn-reload', 
                            action: function(e, dt, btn, config){
                                dt.ajax.reload( null, false ); // user paging is not reset on reload
                            }
                        }
                    ]
                },
                ajax: {
                    url: "<?php echo get_action_url('services/agenda/datatable_toexec'); ?>?userid=<?php echo $me->id; ?>",
                    dataSrc: "items"
                },
                select: true,
                columns:[
                    {data: null, class:"select-checkbox text-center", orderable: false, defaultContent:""},
                    {data: "plan_visit", class:"text-center"},
                    {data: "client_name"},
                    {data: "visit_reason", render: function(data,row,type){
                            return '<span title="'+data+'">'+data.toString().ellipsis(40)+'</span>';
                    }},
                    {data: "doc_count", class:"text-right", render: $.fn.dataTable.render.number()},
                    {data: "status_label"}
                ]
            });
            tb_execute.on( 'select', function ( e, dt, type, indexes ) {
                var selectedRows = dt.rows( { selected: true } ).count();
                dt.buttons([".dt-btn-exec",".dt-btn-upload",".dt-btn-detail"]).enable(selectedRows > 0);
            });
            tb_execute.on( 'deselect', function ( e, dt, type, indexes ) {
                var selectedRows = dt.rows( { selected: true } ).count();
                dt.buttons([".dt-btn-exec",".dt-btn-upload",".dt-btn-detail"]).enable(selectedRows > 0);
            });
            
            /* VISITED */
            var tb_done = $('#DT_Done').DataTable({
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
                            text: '<i class="fa fa-recycle"></i> Reload', 
                            className:'dt-btn-reload', 
                            action: function(e, dt, btn, config){
                                dt.ajax.reload( null, false ); // user paging is not reset on reload
                            }
                        }
                    ]
                },
                ajax: {
                    url: "<?php echo get_action_url('services/agenda/datatable_done'); ?>?userid=<?php echo $me->id; ?>",
                    dataSrc: "items"
                },
                select: true,
                columns:[
                    {data: null, class:"select-checkbox text-center", orderable: false, defaultContent:""},
                    {data: "date_visited", class:"text-center"},
                    {data: "client_name"},
                    {data: "visit_reason", render: function(data,row,type){
                            return '<span title="'+data+'">'+data.toString().ellipsis(40)+'</span>';
                    }},
                    {data: "doc_count", class:"text-right", render: $.fn.dataTable.render.number()},
                    {data: "status_label"}
                ]
            });
            tb_done.on( 'select', function ( e, dt, type, indexes ) {
                var selectedRows = dt.rows( { selected: true } ).count();
                dt.buttons([".dt-btn-detail"]).enable(selectedRows > 0);
            });
            tb_done.on( 'deselect', function ( e, dt, type, indexes ) {
                var selectedRows = dt.rows( { selected: true } ).count();
                dt.buttons([".dt-btn-detail"]).enable(selectedRows > 0);
            });
            
            /* MISSED */
            var tb_missed = $('#DT_Missed').DataTable({
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
                            text: '<i class="fa fa-recycle"></i> Reload', 
                            className:'dt-btn-reload', 
                            action: function(e, dt, btn, config){
                                dt.ajax.reload( null, false ); // user paging is not reset on reload
                            }
                        }
                    ]
                },
                ajax: {
                    url: "<?php echo get_action_url('services/agenda/datatable_missed'); ?>?userid=<?php echo $me->id; ?>",
                    dataSrc: "items"
                },
                select: true,
                columns:[
                    {data: null, class:"select-checkbox text-center", orderable: false, defaultContent:""},
                    {data: "plan_visit", class:"text-center"},
                    {data: "client_name"},
                    {data: "visit_reason", render: function(data,row,type){
                            return '<span title="'+data+'">'+data.toString().ellipsis(40)+'</span>';
                    }},
                    {data: "doc_count", class:"text-right", render: $.fn.dataTable.render.number()},
                    {data: "status_label"}
                ]
            });
            tb_missed.on( 'select', function ( e, dt, type, indexes ) {
                var selectedRows = dt.rows( { selected: true } ).count();
                dt.buttons([".dt-btn-detail"]).enable(selectedRows > 0);
            });
            tb_missed.on( 'deselect', function ( e, dt, type, indexes ) {
                var selectedRows = dt.rows( { selected: true } ).count();
                dt.buttons([".dt-btn-detail"]).enable(selectedRows > 0);
            });
            
            /* execute agenda */
            $('#MyFormUpdate').validate({
                ignore: [],
                rules: {
                    date_visited: { required: true }
                },
                submitHandler: function(form){
                    var btn = $(form).find('[type="submit"]').find('span');
                    btn.removeClass('fa-save').addClass('fa-spin fa-spinner');
                    
                    //get laporan content summernote
                    var report = $(form).find('[name="report"]');
                    report.val(report.code());
                    
                    $(form).ajaxSubmit({
                        url: "<?php echo get_action_url('services/agenda/execute'); ?>",
                        type: "POST",
                        dataType: 'json',
                        //resetForm: true,
                        success: function(data){
                            if (data.status){
                                $(form).find('[name="report"]').summernote('destroy');
                                $('#myModalUpdate').modal('hide');
                                
                                tb_execute.ajax.reload(null,false);
                                tb_done.ajax.reload(null,false);
                                
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
            $('#container-pic').on('click', '.btn-pic-delete', function(){
                var $row = $(this).parents('.pic-row');
                var visit_pic_id = $(this).data('visitedId');
                $.ajax({
                    url: "<?php echo get_action_url('services/person/delete'); ?>/"+visit_pic_id,
                    type: "DELETE",
                    dataType: "json"
                }).then(function(data){
                    if (data.status){
                        $row.remove();
                    }else{
                        alert(data.message);
                    }
                });
            });
            $('#container-pic').on('click', '.btn-save', function(){
                var $container = $('#container-pic');
                
                $.ajax({
                    url: "<?php echo get_action_url('services/person/save'); ?>",
                    type: "POST",
                    dataType: "json",
                    data: {
                        agenda_id: $container.find('[name="agenda_id"]').val(),
                        client_id: $container.find('[name="client_id"]').val(),
                        fullname: $container.find('[name="fullname"]').val(),
                        position: $container.find('[name="position"]').val(),
                        phone: $container.find('[name="phone"]').val()
                    }
                }).then(function(data){
                    if (data.status){
                        _this.loadVisitedPIC(data.item.agenda, $container.find('tbody'));
                        
                        $container.find('[name="fullname"]').val('');
                        $container.find('[name="position"]').val('');
                        $container.find('[name="phone"]').val('');
                        
                    }else{
                        alert(data.message);
                    }
                });
            });
            
            // Instantiate the Bloodhound suggestion engine
            var filterPersons = [];
            var persons = new Bloodhound({
                datumTokenizer: function (datum) {
                    return Bloodhound.tokenizers.whitespace(datum.value);
                },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    url: '<?php echo get_action_url('services/pic/query?q=%QUERY&client=1'); ?>',
                    wildcard: '%QUERY',
                    filter: function (items) {
                        // Map the remote source JSON array to a JavaScript object array
                        return $.map(items, function (item) {
                            filterPersons.push(item);
                            return {
                                text: item.fullname
                            };
                        });
                    }
                }
            });

            // Initialize the Bloodhound suggestion engine
            persons.initialize();

            // Instantiate the Typeahead UI
            $('#container-pic').find('[name="fullname"]').typeahead(null, {
                displayKey: 'text',
                source: persons.ttAdapter()
            }).on('typeahead:selected', function (e, datum) {
                //console.log(datum);
                
                $.map(filterPersons, function (item) {
                    if (datum.text == item.fullname){
                        $('#container-pic').find('[name="position"]').val(item.position);
                        $('#container-pic').find('[name="phone"]').val(item.phone);
                    }
                });
                return false;
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
            
            /* upload ocument pendukung */
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
                                _this.loadUploadedDocuments(data.agendaId, '#uploaded-docs');
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
        },
        loadUploadedDocuments: function(agendaId, target){
            var $uploadedCtn = $(target);
            
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
        },
        loadVisitedPIC: function(agendaId, table){
            table.empty();
                                        
            $.ajax({
                url: "<?php echo get_action_url('services/person/agenda'); ?>/"+agendaId,
                type: "GET",
                dataType: "json"
            }).then(function(data){
                if (data.status){
                    for (var i in data.items){
                        var visited = data.items[i];
                        var s = '<tr class="pic-row">';
                        s+='<td>'+visited.person.fullname+'</td>';
                        s+='<td>'+visited.person.position+'</td>';
                        s+='<td>'+visited.person.phone+'</td>';
                        s+='<td style="width:30px;"><button type="button" class="btn btn-warning btn-xs btn-pic-delete" data-visited-id="'+visited.id+'"><span class="fa fa-minus-square"></span></button></td>';
                        s+='</tr>';

                        table.append(s);
                    }
                }
            });
        }
    };
    $(document).ready(function(){
        Manager_JS.init();
    });
</script>
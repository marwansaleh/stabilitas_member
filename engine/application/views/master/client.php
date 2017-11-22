<div class="row">
    <div class="col-lg-12">
        <table id="myDataTable" class="table table-bordered" role="grid">
            <thead>
                <tr role="row">
                    <th style="width: 30px;"></th>
                    <th class="text-center" style="width: 50px;">ID</th>
                    <th>Nama Client</th>
                    <th class="text-center" style="width: 50px;">Captive</th>
                    <th class="text-center" style="width: 140px;">Created</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade in" id="myModalUpdate" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Data Client</h4>
            </div>
            <div class="modal-body">
                <form id="MyFormUpdate" class="form-validation">
                    <input type="hidden" name="id">
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group">
                                <label>Nama client</label>
                                <input type="text" name="fullname" class="form-control">
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
                                $form.find('[name="fullname"]').val('');
                                $form.find('[name="captive"]').val(1);

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
                                        url:"<?php echo get_action_url('services/client/get'); ?>/"+item.id,
                                    }).then(function(data){
                                        if (data.status){
                                            $form.find('[name="id"]').val(item.id);
                                            $form.find('[name="fullname"]').val(data.item.fullname);
                                            $form.find('[name="captive"]').val(data.item.captive);
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
                                var btnIcon = $(btn).find('i');
                                var itemIds = dt.rows({selected: true}).ids().toArray();
                                if (itemIds && confirm('Hapus data terpilih ?')){
                                    var btnIcon = $(btn).find('i');
                                    btnIcon.removeClass('fa-delete').addClass('fa-spin fa-spinner');
                                    
                                    $.ajax({
                                        url:"<?php echo get_action_url('services/client/deletes'); ?>",
                                        type: "DELETE",
                                        data: {ids: itemIds}
                                    }).then(function(data){
                                        if (data.status){
                                            dt.ajax.reload(null,false);
                                        }else{
                                            alert(data.message);
                                        }
                                    }).always(function(){
                                        btnIcon.removeClass('fa-spin fa-spinner').addClass('fa-delete');
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
                    url: "<?php echo get_action_url('services/client/datatable'); ?>?userid=<?php echo $me->id; ?>",
                    dataSrc: "items"
                },
                select: true,
                columns:[
                    {data: null, class:"select-checkbox text-center", orderable: false, defaultContent:""},
                    {data: "id", class:"text-center"},
                    {data: "fullname"},
                    {data: "captive", class:"text-center", render: function(data,row,type){
                            if (data==1){
                                return '<span class="fa fa-check"></span>';
                            }else{
                                return '<span class="fa fa-ellipsis-h"></span>';
                            }
                    }},
                    {data: "created", class:"text-center"},
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
                    fullname: { required: true }
                },
                submitHandler: function(form){
                    var btn = $(form).find('[type="submit"]').find('span');
                    btn.removeClass('fa-save').addClass('fa-spin fa-spinner');
                    
                    $(form).ajaxSubmit({
                        url: "<?php echo get_action_url('services/client/save'); ?>",
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
            
        }

    };
    $(document).ready(function(){
        JS_Manager.init();
    });
    
</script>
<div class="row">
    <div class="col-lg-8">
        <div class="well well-sm">
            <div id="tree-menu"></div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="well well-sm">
            <form id="MyFormUpdate" class="form-validation">
                <input type="hidden" name="id" value="0">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group form-group-sm">
                            <label>Caption</label>
                            <input type="text" class="form-control" name="caption">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group form-group-sm">
                            <label>Parent</label>
                            <select class="form-control select2" name="parent"></select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group form-group-sm">
                            <label>Link</label>
                            <input type="text" class="form-control" name="link">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group form-group-sm">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group form-group-sm">
                            <label>Icon</label>
                            <input type="text" class="form-control" name="icon">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group form-group-sm">
                            <label>Sort</label>
                            <input type="number" step="1" min="0" class="form-control" name="sort">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group form-group-sm">
                            <label>Hide</label>
                            <select class="form-control" name="hidden">
                                <option value="0">NO</option>
                                <option value="1">YES</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group form-group-sm">
                            <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-save"></span> Save</button>
                            <button type="button" class="btn btn-success btn-sm" ><span class="fa fa-close"></span> Close</button>
                            <div class="pull-right">
                                <button type="button" class="btn btn-primary btn-sm btn-new"><span class="fa fa-edit"></span> New</button>
                                <button type="button" class="btn btn-danger btn-sm btn-delete"><span class="fa fa-remove"></span> Del</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    var JS_Manager = {
        activeItem: null,
        init: function(){
            var _this = this;
            var tree = $('#tree-menu').jstree({
                "plugins": ["themes", "dnd"],
                themes: {theme:"default-dark"},
                core: {
                    data :{
                        url : "<?php echo get_action_url('services/mainmenu/lazy'); ?>",
                        data: function (node){
                            return {parent:node.id}
                        }
                    },
                    "check_callback" : true
                }

            });
            tree.on("select_node.jstree", function (e, data) {
                _this.selectMenuItem(data.node);
            }).on("move_node.jstree", function(e, data){
                _this.moveMenuItem(data.node.id, data.parent, data.position);
            });
            $('#MyFormUpdate').on('click','.btn-new', function(){
                _this.resetForm('#MyFormUpdate');
            });
            $('#MyFormUpdate').on('click','.btn-delete', function(){
                if (_this.activeItem && confirm('Delete selected menu item?')){
                    $.ajax({
                        url: "<?php echo get_action_url('services/mainmenu/delete'); ?>/"+_this.activeItem.id,
                        type: "DELETE"
                    }).then(function(data){
                        if (data.status){
                            _this.resetForm('#MyFormUpdate');
                            
                            if (data.item.parent==0){
                                $('#tree-menu').jstree(true).refresh();
                            }else{
                                $('#tree-menu').jstree(true).refresh_node(data.item.parent);
                            }
                        }
                    });
                }
            });
            $('#MyFormUpdate').validate({
                ignore: [],
                rules: {
                    caption: { required: true }
                },
                submitHandler: function(form){
                    var btn = $(form).find('[type="submit"]').find('span');
                    btn.removeClass('fa-save').addClass('fa-spin fa-spinner');
                    
                    $(form).ajaxSubmit({
                        url: "<?php echo get_action_url('services/mainmenu/save'); ?>",
                        type: "POST",
                        dataType: 'json',
                        success: function(data){
                            if (data.status){
                                _this.resetForm(form);
                                
                                if (data.item.parent==0){
                                    $('#tree-menu').jstree(true).refresh();
                                }else{
                                    $('#tree-menu').jstree(true).refresh_node(data.item.parent);
                                }
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
            var $select2 = $('#MyFormUpdate').find('[name="parent"]');
            $select2.select2({
                ajax: {
                    url: "<?php echo get_action_url('services/mainmenu/select2'); ?>",
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
                placeholder: 'No parent',
                //width: 'element',
                theme: 'bootstrap',
                allowClear: true,
                minimumInputLength: 1
            });
            
        },
        resetForm: function (form){
            var _this = this;
            
            $(form).resetForm();
            $(form).find('[name="id"]').val(0);
            _this.select2ParentSelected(0);

            _this.activeItem = null;
        },
        select2ParentSelected: function(selected){
            var $select2 = $('#MyFormUpdate').find('[name="parent"]');
            var $option = null;
            
            if (parseInt(selected) == 0){
                $option = $('<option selected></option>').val(0);
                $select2.append($option).trigger('change');
                $option.removeData();
                
                return;
            }else{
                $option = $('<option selected>Loading...</option>').val(selected);
            }
            
            $select2.append($option).trigger('change');
            
            $.ajax({ // make the request for the selected data object
                type: 'GET',
                url: '<?php echo get_action_url('services/mainmenu/get'); ?>/' + selected,
                dataType: 'json'
            }).then(function (data) {
                if (data.status){
                    // Here we should have the data object
                    $option.text(data.item.caption).val(data.item.id); // update the text that is displayed (and maybe even the value)
                }else{
                    $option.text('').val(0);
                }
                $option.removeData(); // remove any caching data that might be associated
                $select2.trigger('change'); // notify JavaScript components of possible changes
            });
        },
        selectMenuItem: function (node){
            var _this = this;
            var $form = $('#MyFormUpdate');
            
            if (node.id > 0){
                
                $.ajax({
                    url: '<?php echo get_action_url('services/mainmenu/get'); ?>/'+node.id,
                    type: 'GET',
                    dataType: 'json'
                }).then(function(data){
                    if (data.status){
                        //set active item
                        _this.activeItem = data.item;
                        
                        $form.find('[name="id"]').val(data.item.id);
                        $form.find('[name="caption"]').val(data.item.caption);
                        $form.find('[name="link"]').val(data.item.link);
                        $form.find('[name="icon"]').val(data.item.icon);
                        _this.select2ParentSelected(data.item.parent);
                        $form.find('[name="sort"]').val(data.item.sort);
                        $form.find('[name="hidden"]').val(data.item.hidden);
                    }else{
                        _this.activeItem = null;
                        alert(data.message);
                    }

                });
            }else{
                _this.activeItem = null;
            }
        },
        moveMenuItem: function (id,new_parent, new_position){
            $.ajax({
                url: '<?php echo get_action_url('services/mainmenu/move'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {id:id,parent:new_parent,position:new_position}
            }).then (function(data){
                if (!data.status){
                    alert(data.message);
                }
            });
        },

    };
    $(document).ready(function(){
        JS_Manager.init();
    });
    
</script>
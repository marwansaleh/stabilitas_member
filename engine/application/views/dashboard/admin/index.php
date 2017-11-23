<style type="text/css">
    .agenda-list li {
        border-bottom: solid 1px #CCC;
    }
    .agenda-list li:last-child {
        border-bottom: none;
    }
</style>
<div class="row">
    <div class="col-sm-6">
        <div class="widget" id="agenda-container">
            <div class="widget-header">
                <h3 class="widget-title">Rencana Kunjungan</h3>
            </div>
            <div class="widget-content">
                <div class="row">
                    <div class="col-sm-12 slimscroll">
                        <ul class="media-list agenda-list"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="widget">
            <div class="widget-header">
                <h3>Notifikasi</h3>
            </div>
            <div class="widget-content">
                <div class="row">
                    <div class="col-sm-12 slimscroll">
                        <ul class="media-list notification-list"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="widget">
            <div class="widget-header">
                <h3>Kalendar Agenda Broker</h3>
            </div>
            <div class="widget-content">
                <div id="calendar"></div>
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
            $('.slimscroll').slimscroll({height: '150px'});
            $('#calendar').fullCalendar({
                events: function (start, end, callback) {
                    $.ajax({
                        type: "GET",
                        url: "<?php echo get_action_url('services/agenda/calendar'); ?>",
                        contentType: "application/json; charset=utf-8",
                        dataType: "json",
                        data: {
                            userid: "<?php echo $me->id; ?>", 
                            start_date:Math.round(start.getTime() / 1000), 
                            end_date: Math.round(end.getTime() / 1000)
                        }
                    }).then(function(data){
                        var events = [];
                        if (data.status){
                            
                            
                            for(var i in data.events){
                                var event = data.events[i];
                                var color = '#bbf984';
                                switch (event.category){
                                    case 'done':
                                        color= '#5f9ee2'; break;
                                    case 'missed':
                                        color= '#e84c6b'; break;
                                    default: color = '#5adb46';
                                }
                                events.push({
                                    id: event.id,
                                    title: event.client_name+' => '+event.visit_reason,
                                    start: event.plan_visit,
                                    color: color,
                                    
                                });

                                //addCalendarEvent(event.id,event.plan_visit,event.plan_visit,event.visit_reason);
                            }
                        }
                        callback(events);
                    });
                },
                eventClick: function(calEvent, jsEvent, view) {
                    var itemId = calEvent.id;
                    var itemDesc = calEvent.title;
                    if (itemId){
                        var $modal = $('#myModalDetail');

                        $modal.find('.modal-title').html('Detail Agenda:'+itemDesc.toString().ellipsis(45));
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
            
            //load agenda to visit
            _this.loadAgendaToExecute(1,10)
        },
        loadAgendaToExecute: function(){
            var $container = $('#agenda-container');
            var $list = $container.find('.agenda-list');
            var widgetTitleOriginal = $container.find('.widget-title').text();
            if (length === 'undefined'){
                length = 5;
            }
            
            $container.find('.widget-title').text(widgetTitleOriginal +' (loading...)');
            //load media
            $.ajax({
                url: "<?php echo get_action_url('services/dashboard/agendas'); ?>",
                type: "GET",
                dataType: "json"
            }).then(function(data){
                //empty the list
                $list.empty();
                
                //drawing agenda new list
                if (data.status){
                    for (var i in data.items){
                        var agenda = data.items[i];
                        var s = '<li class="media">';
                            s+= '<div class="media-body">';
                            s+= '<h4 class="media-heading">'+agenda.client_name+'</h4>';
                            s+= '<p><strong><code>[ '+agenda.plan_visit+' ]</code></strong> '+agenda.visit_reason+'</p>';
                            s+= '</div>'
                        s+= '</li>';
                        
                        $list.append(s);
                    }
                }
            }).always(function(){
                $container.find('.widget-title').text(widgetTitleOriginal);
            });
        }
    };
    $(document).ready(function(){
        Manager_JS.init();
    });
</script>
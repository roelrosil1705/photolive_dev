/**
 * Created by Laiza-PC on 29/02/2016.
 */

//$('#btn_update_calendar').on('click', function(){
    $('#form_creatives_tasks').ajaxForm({
        type: 'post',
        url: MyNameSpace.config.base_url+'jo/submit_date_calendar',
        beforeSubmit:function(){
            $('#btn_update_calendar').prop('disabled',true);
        },
        success:  function(response){
            if(response != 'exist'){
                $('#sel_creatives_emp').val(0);
                $('#creative_start').val('');
                $('#creative_deadline').val('');
                $('#creative_description').val('');

                $('#creatives_box').hide();
                $('tbody#creatives_tbd').append(response);
                $('#modal_creatives_tasks').foundation( 'reveal', 'close' );
                $('#btn_update_calendar').prop('disabled',false);
                reload_task_cmd();
            }else{
                $('#creatives_box').show();
            }
        }
    });

//});
$('#form_prod_tasks').ajaxForm({
    type: 'post',
    url: MyNameSpace.config.base_url+'jo/submit_date_calendar_prod',
    beforeSubmit:function(){
        $('#btn_update_calendar_prod').prop('disabled',true);
    },
    success:  function(response){
        //console.log(response);
        //return false;
        if(response != 'exist'){
            $('#sel_prod_emp').val(0);
            $('#prod_deadline').val('');
            $('#prod_description').val('');
            $('#prod_file').val('');
            $('#prod_size').val('');
            $('#prod_qty').val('');
            $('#prod_other_details').val('');

            $('#prod_box').hide();
            $('tbody#tbd_prod').append(response);
            $('#modal_prod_tasks').foundation( 'reveal', 'close' );
            $('#btn_update_calendar_prod').prop('disabled',false);
            reload_task_cmd();
        }else{
            $('#prod_box').show();
        }
    }
});

function reload_task_cmd(){

    $('#btn_update_calendar_u').on('click',function(){
        $('#form_creatives_tasks_u').ajaxForm({
            type: 'post',
            url: MyNameSpace.config.base_url+'jo/submit_date_calendar_u',
            beforeSubmit:function(){
                $('#btn_update_client_u').prop('disabled',true);
            },
            success:  function(response){
                if( response != 'failed'){
                    var json = $.parseJSON(response);
                    $('tr#' + json['table_id']).replaceWith( json['table_task']  );
                    $('#modal_creatives_tasks_u').foundation( 'reveal', 'close' );
                    $('#btn_update_client_u').prop('disabled',false);
                }
            }
        });
    });

    $('.task_change').on('click',function(e){
        e.preventDefault();
        var cld = $(this).attr('alt');
        var cval = $(this).attr('value');

        $.ajax({
            url: MyNameSpace.config.base_url+'jo/update_pending',
            type:'post',
            data: {
                'cal_id' : cld,
                'cval' : cval
            },
            success: function(data) {
                console.log(data);
                if( data != 'failed' ){
                    $('tbody#creatives_tbd tr#' + cld).replaceWith(data);
                    reload_task_cmd();
                }
            }
        });
    });
    $('.edit-btn-task').on('click',function(e){
        e.preventDefault();
        var cld = $(this).attr('alt');
        $.ajax({
            url: MyNameSpace.config.base_url+'jo/update_cal_task_getinfo',
            type:'post',
            data: {
                'cal_id' : cld
            },
            success: function(data) {
                var json = $.parseJSON(data);
                $('#task_id_u').val( json['cal_id'] );
                $('#sel_creatives_emp_u').val( json['eid'] );
                $('#creative_deadline_u').val( json['edate'] );
                $('#creative_description_u').val( json['desc'] );

                $('#creatives_box_u').hide();
                //$('tbody#creatives_tbd_u').append(response);
                $('#modal_creatives_tasks_u').foundation( 'reveal', 'close' );
                $('#btn_update_client_u').prop('disabled',false);

                $('#modal_creatives_tasks_u').foundation('reveal', 'open');
            }
        });
    });

    $('.del-btn-task').on('click',function(e){
        e.preventDefault();
        var cld = $(this).attr('alt');
        $.ajax({
            url: MyNameSpace.config.base_url+'jo/creatives_del',
            type:'post',
            data: {
                'cal_id' : cld
            },
            success: function(data) {
                $( 'tbody#creatives_tbd tr#' + data ).remove();
            }
        });
    });

    $('.task_change_u').on('click',function(e){
        e.preventDefault();
        var cld = $(this).attr('alt');
        var cval = $(this).attr('value');

        $.ajax({
            url: MyNameSpace.config.base_url+'jo/update_pending_u',
            type:'post',
            data: {
                'cal_id' : cld,
                'cval' : cval
            },
            success: function(data) {
                console.log(data);
                if( data != 'failed' ){
                    $('tbody#tbd_prod tr#' + cld).replaceWith(data);
                    reload_task_cmd();
                }
            }
        });
    });

    $('.del-btn-task-prod').on('click',function(e){
        e.preventDefault();
        var cld = $(this).attr('alt');
        $.ajax({
            url: MyNameSpace.config.base_url+'jo/creatives_del',
            type:'post',
            data: {
                'cal_id' : cld
            },
            success: function(data) {
                $( 'tbody#tbd_prod tr#prod' + data ).remove();
            }
        });
    });

    $('.edit-btn-task-prod').on('click',function(e){
        e.preventDefault();
        var cld = $(this).attr('alt');
        $.ajax({
            url: MyNameSpace.config.base_url+'jo/update_cal_task_getinfo_prod',
            type:'post',
            data: {
                'cal_id' : cld
            },
            success: function(data) {
                var json = $.parseJSON(data);
                $('#task_id_u_prod').val( json['cal_id'] );
                $('#sel_prod_emp_u').val( json['eid'] );
                $('#prod_deadline_u').val( json['edate'] );
                $('#prod_description_u').val( json['desc'] );
                $('#prod_size_u').val( json['size'] );
                $('a#prod_dl_link').text( json['flname'] );
                //$('#prod_dl_link').attr( 'href', json['peg'] );
                $("a#prod_dl_link").attr('href', json['peg'])
                $('#prod_qty_u').val( json['quant'] );
                $('#prod_other_details_u').val( json['od'] );

                $('#prod_box_u').hide();
                //$('tbody#creatives_tbd_u').append(response);
                //$('#modal_prod_tasks_u').foundation( 'reveal', 'close' );
                $('#btn_update_calendar_prod_u').prop('disabled',false);

                $('#modal_prod_tasks_u').foundation('reveal', 'open');
            }
        });
    });

}

reload_task_cmd();

$('#btn_update_calendar_prod_u').on('click',function(){
    $('#form_prod_tasks_u').ajaxForm({
        type: 'post',
        url: MyNameSpace.config.base_url+'jo/submit_date_calendar_prod_u',
        beforeSubmit:function(){
            $('#btn_update_calendar_prod_u').prop('disabled',true);
        },
        success:  function(response){
            //console.log(response);
            if( response != 'failed'){
                var json = $.parseJSON(response);
                //console.log(json['table_task']);
                $('tr#prod' + json['table_id']).replaceWith( json['table_task']  );
                $('#modal_prod_tasks_u').foundation( 'reveal', 'close' );
                $('#btn_update_calendar_prod_u').prop('disabled',false);

                reload_task_cmd();
            }
        }
    });
});
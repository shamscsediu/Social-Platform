$(document.body).on('click', '.add_f_btn', function(){
       var id = $(this).attr("data-id");
       $('#add_f-'+id).html('<img src="{{url('public/images/loader/486.gif')}} "alt="...." width="30px" height="16px">');
       $.ajax({
          url: "{{ route('send_req') }}",
          method: 'get',
          data: {uid: id},
          success: function(res){
            $('#add_f-'+id).html('<button del_data_id="'+id+'" type="submit" class="btn btn-primary del_req">Cancel request</button>');
          }});
       });
    $(document.body).on('click', '.del_req', function(e){
       var del_id = $(this).attr('del_data_id');
       $('#add_f-'+del_id).html('<img src="{{url('public/images/loader/486.gif')}} "alt="...." width="30px" height="16px">');        
        $.ajax({
          url: "{{ route('cancel_req') }}",
          method: 'get',
          data: {uid: del_id},
          error: function(xhr, status, error) {                                                     
                console.log(xhr.responseText);
            },
          success: function(query){
            $('#add_f-'+del_id).html('<button data-id="'+del_id+'" type="submit" class="btn btn-primary add_f_btn">Add friend</button>');
          }});
       });
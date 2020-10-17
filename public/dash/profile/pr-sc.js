 $(function() {
         $(document).ready(function()
         {
            var bar = $('.bar');
            var percent = $('.percent');           
      $('form').ajaxForm({        
        beforeSend: function() {
            $('#prosubmit').prop('disabled',true);
            $('.progress').css("display", "block");
            var percentVal = '0%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        complete: function(xhr) {
            $('#prosubmit').prop('disabled',false);
            $('.success').css('display','block');
            //alert('File Uploaded Successfully');
            //window.location.href = "/fileupload";
             $('#proform').resetForm();
            window.location.reload(true)
        }       
      });
   }); 
 });
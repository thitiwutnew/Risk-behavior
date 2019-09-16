
$(document).ready(function(){  
     $('#add').click(function(){  
          $('#insert').val("Insert");  
          $('#insert_form')[0].reset();  
     }) 
$(document).on('click', '.view_data', function(){  
          var dtd_id = $(this).attr("id");  
          $.ajax({  
               url:"ajaxdetilerisk.php",  
               method:"POST",  
               data:{dtd_id:dtd_id},  
               dataType:"json",  
               success:function(data){  
                    $('#dm_idcard').val(data.dm_idcard);  
                    $('#dm_name').val(data.dm_prefix+' '+data.dm_name);  
                    $('#dm_age').val(data.dm_age);  
                    $('#dtd_id').val(data.dtd_id);  
                    $('#dm_gender').val(data.dm_gender);
                    $('#imagepp').html('<img src=image/'+ data.dm_image + ' class="riskimage"/>');
                   $('#dtd_date').val(data.dtd_date);  
                    $('#dtd_type').val(data.dtd_type);
                    $('#dtd_location').val(data.dtd_location);
                    $('#dtd_status').val(data.dtd_status);
                    $('#dtd_image').val('image/'+data.dtd_image);
                    $('#imagerisk').html('<img src=image/'+ data.dtd_image + ' class="riskimages"/>');
                    $('#riskModal').modal('show');  
               }  
          });  
     });  
     $('#insert_form').on("submit", function(event){  
       event.preventDefault();  
               $.ajax({  
                    url:"editrisk.php",  
                    method:"POST",  
                    data:$('#insert_form').serialize(),  
                    beforeSend:function(){  
                         $('#insert').val("กำลังอัพเดตข้อมูล");  
                    },  
                    success:function(data){  
                         $('#insert_form')[0].reset();  
                         $('#riskModal').modal('hide');  
                         $('#showmessage').html(data);    
                    }  
               });  
     }); 
   });  
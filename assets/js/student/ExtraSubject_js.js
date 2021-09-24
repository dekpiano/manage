
 function AlertOnoff(){
  Swal.fire(
    'แจ้งเตือน!',
    'ขณะนี้ระบบปิดให้ลงทะเบียน!',
    'warning'
  )
 }

 $(document).on("click", ".SubRegister", function() { 
    var extra_id = $(this).attr("extra_id");
    Swal.fire({
        title: 'แจ้งเตือน!',
        html: "นักเรียนต้องการลงทะเบียนวิชา "+ $(this).attr("na") +" ใช่หรือไม่? <br> หากคลิกปุ่ม ยืนยัน แล้ว นักเรียนจะไม่สามารถแก้ไขได้ <br> กรุณาตรวสอบข้อมูลให้ถูกต้องก่อนยืนยัน",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ยืนยัน'
      }).then((result) => {
        if (result.isConfirmed) {

          $.ajax({
            type: 'POST',
            url: "../../student/ConStudentExtraSubject/RegisterExtra",
            data: { ExtraID:extra_id },
            beforeSend: function() {

            },
            success: function(data) {     
              if(data == 1){
               
                Swal.fire({
                  title: 'แจ้งเตือน!',
                  html: "ลงทะเบียนเรียบร้อยแล้ว <br> นักเรียนสามารถตรวจข้อมูลการลงทะเบียนได้ <br> โดยคลิกที่เมนู ตรวจสอบการลงทะเบียน ทางด้านขวามือ",
                  icon: 'success'
                }).then((result) => {
                  if (result.isConfirmed) {
                    location.reload();
                  }
                })

              }           
              
            },
            error: function(xhr) {
                alert("Error occured.please try again");
                console.log(xhr.statusText + xhr.responseText);
            }
        });

          
        }
      })
    });


    $(document).on("click", ".CheckStudentRegisterSubject", function() { 
      $(".ShowStudentRegister tbody tr").remove();
      $.post("../../student/ConStudentExtraSubject/CheckStudentRegisterSubject", {ExtraId: $(this).attr('ExtraIdSubject')}, function(data, status){
      
        $.each(data, function(key,value){
          console.log("<td>"+ value.fk_std_id+"</td>");
          var markup = "<tr><td>"+(key+1)+"</td><td>" + value.fk_std_id + "</td><td>" + value.StudentPrefix+value.StudentFirstName+' '+value.StudentLastName + "</td><td>" + value.StudentClass + "</td></tr>";
          $(".ShowStudentRegister tbody").append(markup);
        });
      },"json");
    });


    


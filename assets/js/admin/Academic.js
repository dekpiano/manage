$(document).ready(function() {
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';

        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');

            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    var ta = $('#tb-classroom').DataTable({
        "order": [
            [0, "desc"],
            [1, "asc"]
        ],

    });

    $('#ModalAddClassRoom').on('click', function() {
        $('#myModal').modal('show');
    });

    $('#AddClassRoom').on('submit', function(e) {
        e.preventDefault();
        var formadd = $('#AddClassRoom').serialize();
        $.ajax({
            type: 'post',
            url: "ConAdminClassRoom/AddClassRoom",
            data: formadd,
            beforeSend: function() {
                console.log("กำลังโหลด");
            },
            complete: function() {
                //console.log("คือไรว่ะ");
            },
            success: function(result) {
                $('#myModal').modal('hide');
                location.reload();
            }
        });

    });


// Submit form data via Ajax
$(document).on('submit','#form_insert_plan', function(e){
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: '../../teacher/ConTeacherCourse/insert_plan',
        data: new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        beforeSend: function(){
            $('.submitBtn').attr("disabled","disabled");
        },
        success: function(response){ //console.log(response);
            if(response == 1){
                //$('#form_insert_plan')[0].reset();
                Swal.fire({
                    title: 'แจ้งเตือน',
                    text: "คุณส่งงานเรียบร้อยแล้ว",
                    icon: 'success',
                    confirmButtonText: 'ตกลง'
                  }).then((result) => {
                    if (result.isConfirmed) {                      
                      window.location.href = "../../Teacher/Course";
                    }
                  })
                 
                
            }else{
                console.log(response);
            }
        },
        error: function ( jqXHR, textStatus, errorThrown ) {
          console.log(textStatus);
      }
    });
});

// File type validation
// $("#seplan_file").change(function() {
//     var file = this.files[0];
//     var fileType = file.type;
//     var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg'];
//     if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))){
//         alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
//         $("#file").val('');
//         return false;
//     }
// });



$(document).on("change",".seplan_status1",function(){
    
    // console.log($(this).val());
    // console.log($(this).attr('data-planId'));
    var status1 = $(this).val();
    var planId = $(this).attr('data-planId');
    

    $.ajax({
        type: 'POST',
        url: "../../../teacher/ConTeacherCourse/UpdateStatus1",
        data: {status1:status1,planId:planId},
        dataType:'json',
        beforeSend: function() {
           
        },
        success: function(data) {
            console.log(data[0].seplan_status1);

            if(data[0].seplan_status2 == data[0].seplan_status1){
                $("#bgC"+planId).addClass('table-success');
              }else{
                $("#bgC"+planId).removeClass('table-success');
              }
            Swal.fire(
                'แจ้งเตือน',
                'คุณเปลี่ยนสถานะเรียบร้อย',
                'success'
              )
            
        },
        error: function(xhr) { 
            alert("Error occured.please try again");
            console.log(xhr.statusText + xhr.responseText);           
        }
    });
});

$(document).on("change",".seplan_status2",function(){
    // console.log($(this).val());
    // console.log($(this).attr('data-planId'));
    var status2 = $(this).val();
    var planId = $(this).attr('data-planId');

    $.ajax({
        type: 'POST',
        url: "../../../teacher/ConTeacherCourse/UpdateStatus2",
        data: {status2:status2,planId:planId},
        dataType:'json',
        beforeSend: function() {
           
        },
        success: function(data) {
            
            if(data[0].seplan_status2 == data[0].seplan_status1){
                $("#bgC"+planId).addClass('table-success');
              }else{
                $("#bgC"+planId).removeClass('table-success');
              }
            Swal.fire(
                'แจ้งเตือน',
                'คุณเปลี่ยนสถานะเรียบร้อย',
                'success'
              )
              
        },
        error: function(xhr) { 
            alert("Error occured.please try again");
            console.log(xhr.statusText + xhr.responseText);           
        }
    });
});


});
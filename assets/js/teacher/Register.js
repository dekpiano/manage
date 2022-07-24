$(".score").each(function() {
    $(this).keyup(function() {
        calculateSum();
    });
});

function calculateSum() {

    var sum = 0;

    //iterate through each textboxes and add the values
    $(".score").each(function() {

        //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
            sum += parseFloat(this.value);
        }

    });
    //.toFixed() method will roundoff the final sum to 2 decimal places
    $("#sum").val(sum.toFixed(2));
    if (sum == 100) {
        $("#sum").last().addClass("is-valid");
        $("#sum").removeClass("is-invalid")
    } else {
        $("#sum").addClass("is-invalid")
        $("#sum").removeClass("is-valid")
    }
}



$(document).on('keyup', '.check_score', function() {
    var num = parseInt($(this).val());
    var key = parseInt($(this).attr('check-score-key'));
    // console.log($(this).val());
    //   console.log($(this).attr('check-score-key'));

      if(num > key){
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'คุณกรอกคะแนนเกินคะแนนเก็บ<br>กรุณากรอกคะแนนใหม่',
            showConfirmButton: false,
            timer: 3000
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
                //window.location.reload();
                $(this).val("0");
            }
        })
      }
});


$(document).on('submit', '.form_set_score', function(e) {
    e.preventDefault();
    $.ajax({
        url: '../../../../../teacher/ConTeacherRegister/setting_score/' + $(this).attr('id'),
        type: "post",
        data: $(this).serialize(), //this is formData
        success: function(data) {
            console.log(data);
            if (data > 0) {
                $('#editteacher').modal('hide');
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกคะแนนสำเร็จ',
                    showConfirmButton: false,
                    timer: 2000
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.reload();
                    }
                })
            } else {
                window.location.reload();
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
        }
    });
});


$(document).on('click', '#chcek_score', function() {

    //console.log($(this).attr('subject-id'));

    $.post("../../../../../teacher/ConTeacherRegister/edit_score", {
        subid: $(this).attr('subject-id')
    }, function(data, status) {
        if (data == 0) {
            console.log(555);
            $(".form_set_score").attr('id', "form_insert_score");
        } else {
            $(".form_set_score").attr('id', "form_update_score");

            $('#before_middle_score').val(data[0].regscore_score);
            $('#test_midterm_score').val(data[1].regscore_score);
            $('#after_midterm_score').val(data[2].regscore_score);
            $('#final_exam_score').val(data[3].regscore_score);
            $('#sum').val(Number(data[0].regscore_score) + Number(data[1].regscore_score) + Number(data[2].regscore_score) + Number(data[3].regscore_score));
        }
    }, 'json');
});

$(document).on('submit', '.form_score', function(e) {
    e.preventDefault();
   
    $.ajax({
        url: '../../../../../teacher/ConTeacherRegister/insert_score',
        type: "post",
        data: $(this).serialize(), //this is formData
        success: function(data) {
            console.log(data);
            if (data > 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกคะแนนสำเร็จ',
                    showConfirmButton: false,
                    timer: 2000
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        //window.location.reload();
                    }
                })
            } else {
                window.location.reload();
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
        }
    });
});
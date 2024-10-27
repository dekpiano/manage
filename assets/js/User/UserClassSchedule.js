 // โหลดข้อมูลรูปภาพจากฐานข้อมูล
 $.ajax({
    url: 'ClassSchedule/Search',
    method: 'GET',
    success: function(data) {
        console.log(data);
        
        $.each(data, function(index, image) {
            $('#SearchClassSchedule').append('<option value="' + image.schestu_filename + '"> ม.' + image.schestu_classname +' '+image.schestu_name +'</option>');
        });
    },
    error: function() {
        alert('เกิดข้อผิดพลาดในการดึงข้อมูล');
    }
});

// แสดงรูปภาพเมื่อมีการเปลี่ยนแปลงการเลือก
$('#SearchClassSchedule').change(function() {
    var selectedImage = 'uploads/academic/class_schedule/'+$(this).val();
    if (selectedImage) {
        $('#image').attr('src', selectedImage).show();
    } else {
        $('#image').hide();
    }
});

new SlimSelect({
    select: '#SearchClassSchedule'
  })
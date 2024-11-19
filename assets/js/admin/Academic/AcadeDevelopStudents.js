
let faculty = new SlimSelect({
    select: '#club_faculty_advisor',
    showSearch: true // เปิดให้สามารถค้นหาได้
});

$('#TbClubs').DataTable({
    "ajax": {
        "url": "../../../admin/academic/ConAdminDevelopStudents/ClubsShow", // URL ที่จะดึงข้อมูล
        "type": "GET",
        "dataSrc": "data" // บอก DataTable ว่าจะใช้ข้อมูลจากคีย์ 'data'
    },
    "columns": [
        { "data": "club_id" },
        { "data": null, "render": function (data, type, row, meta) {
                return row.club_trem+'/'+row.club_year; // แสดงเลขลำดับ
            }
        },
        { "data": "club_name" },
        { "data": "club_description" },
        { "data": "club_faculty_advisor" },
        { "data": "club_max_participants" },
        { "data": "club_status" }
    ]
});



$(document).on('submit','#FormAddClubs',function (e) {
    e.preventDefault(); // Prevent default form submission
    
    $.ajax({
      url: '../../../admin/academic/ConAdminDevelopStudents/ClubsInsert', // Controller method for saving data
      type: 'POST',
      data: $(this).serialize(), // Serialize form data
      success: function (response) {
        console.log(response);

        if (response > 0) {
          // Close modal
          $('#ModalAddClubs').modal('hide');
          $('.modal-backdrop').remove(); 
        
          // Reset form
          $('#FormAddClubs')[0].reset();
          faculty.set('');
        } else {
            console.log('ผิดพลาด');
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus);
      }
    });
  });
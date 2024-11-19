
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
        { 
          "data": null, "render": function (data, type, row, meta) {
                return row.pers_prefix+row.pers_firstname+' '+row.pers_lastname; // แสดงเลขลำดับ
            }
         },
        { "data": "club_max_participants" },
        { "data": null, "render": function (data, type, row) {
          return `
              <div class="text-center d-flex">
                  <button class="btn-sm btn-primary edit-btn" data-id="${row.club_id}" title="แก้ไข">
                      <i class="fas fa-edit"></i>
                  </button>
                  <button class="btn-sm btn-danger delete-btn" data-id="${row.club_id}" title="ลบ">
                      <i class="fas fa-trash"></i>
                  </button>
              </div>
          `;
      }}
    ]
});

$(document).on('click', '.BtnAddClub', function() {
   $('#ModalAddClubs').modal('show');
   $('#FormAddClubs')[0].reset();
   faculty.set('');
   $('#clubModalLabel').text('เพิ่มชุมนุม');
});

$(document).on('submit','#FormAddClubs',function (e) {
    e.preventDefault(); // Prevent default form submission

    const url = $('#club_id').val() 
    ? "../../../admin/academic/ConAdminDevelopStudents/ClubsUpdate" // แก้ไข
    : "../../../admin/academic/ConAdminDevelopStudents/ClubsInsert"; // เพิ่มใหม่

    $.ajax({
      url: url, // Controller method for saving data
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

          $('#TbClubs').DataTable().ajax.reload(); // รีเฟรช DataTable
        } else {
            console.log('ผิดพลาด');
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus);
      }
    });
  });

   // เปิด Modal เพื่อแก้ไขข้อมูล
   $(document).on('click', '.edit-btn', function() {
    
    const clubId = $(this).data('id');
   
    $.ajax({
        url: "../../../admin/academic/ConAdminDevelopStudents/ClubsEdit/" + clubId,
        type: "GET",
        dataType: "json",
        success: function(data) {
            $('#clubModalLabel').text('แก้ไขชุมนุม'); // เปลี่ยน Title
            $('#club_id').val(data.club_id); 
            $('#club_year').val(data.club_year); 
            $('#club_trem').val(data.club_trem); 
            $('#club_name').val(data.club_name); 
            $('#club_description').val(data.club_description); 
            $('#club_max_participants').val(data.club_max_participants);            
            faculty.set(data.club_faculty_advisor);

            $('#ModalAddClubs').modal('show'); // เปิด Modal
        },
        error: function() {
            alert('Error fetching data.');
        }
    });
});
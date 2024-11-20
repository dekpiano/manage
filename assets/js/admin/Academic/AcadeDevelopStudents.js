
let faculty = new SlimSelect({
    select: '#club_faculty_advisor',
    showSearch: true // เปิดให้สามารถค้นหาได้
});


$('#academicYearFilter').change(function () {   
   table.ajax.reload();
});

const table = $('#TbClubs').DataTable({
  processing: true,
    "ajax": {
        "url": "../../../admin/academic/ConAdminDevelopStudents/ClubsShow", // URL ที่จะดึงข้อมูล
        "type": "GET",
        "dataSrc": "data",
        data: function(d) {
          
          console.log('Selected Year:', $('#academicYearFilter').val());
          d.year = decodeURIComponent($('#academicYearFilter').val());  // ส่ง year ไปใน ajax data
      }
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
        { 
          "data": null, "render": function (data, type, row, meta) {
                return `
                 <button class="btn-sm btn-warning BtnAddStudents" data-id="${row.club_id}" title="แก้ไข">
                      ลงเรียน
                  </button>
                `
            }
         },
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
    ],
    error: function (settings, helpPage, message) {
       console.error('DataTable Error:', message);
    }
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

        if (response > 0) {
          // Close modal
          $('#ModalAddClubs').modal('hide');
          $('.modal-backdrop').remove(); 
        
          // Reset form
          $('#FormAddClubs')[0].reset();
          faculty.set('');

          $('#TbClubs').DataTable().ajax.reload(); // รีเฟรช DataTable
          Swal.fire({
            icon: 'success', // ไอคอน
            title: 'แจ้งเตือน!',
            text: 'บันทึกข้อมูลสำเร็จ',
            showConfirmButton: false,
            timer: 2000 
        });

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

$(document).on('click', '.delete-btn', function () {
  const clubId = $(this).data('id'); // ดึง ID ชุมนุม

  // ใช้ SweetAlert2 สำหรับยืนยัน
  Swal.fire({
      title: 'คุณต้องการลบข้อมูลหรือไม่?',
      text: "ถ้าคุณเลือกลบข้อมูล ข้อมูลทั้งชุมนุมจะหายหมด พร้อมด้วยเวลาทั้งหมด!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
      if (result.isConfirmed) {
          // ส่งคำขอลบข้อมูลไปที่เซิร์ฟเวอร์
          $.ajax({
              url: "../../../admin/academic/ConAdminDevelopStudents/ClubsDelete/" + clubId,
              type: "POST",
              success: function (response) {
                  // แจ้งเตือนสำเร็จ
                  Swal.fire({
                      icon: 'success',
                      title: 'แจ้งเตือน!',
                      text: 'ข้อมูลชุมนุมได้ถูกลบทั้งหมดแล้ว!',
                      showConfirmButton: false,
                      timer: 2000
                  });

                  // รีเฟรช DataTable
                  $('#TbClubs').DataTable().ajax.reload();
              },
              error: function (jqXHR, textStatus, errorThrown) {
                  // แจ้งเตือนข้อผิดพลาด
                  Swal.fire({
                      icon: 'error',
                      title: 'Error!',
                      text: textStatus,
                      confirmButtonText: 'OK'
                  });
              }
          });
      }
  });
});

let slimSelectInstance;
$(document).on('click', '.BtnAddStudents', function () {
    $('#AddStudentsTitle').val("จัดการนักเรียน")
    $('#ModalAddStudents').modal('show');

    // ตรวจสอบและทำลาย SlimSelect เดิม หากมี
    if (slimSelectInstance) {
        slimSelectInstance.destroy();
    }

    // กำหนด SlimSelect ใหม่
    slimSelectInstance = new SlimSelect({
      select: '#studentSelect',
      placeholder: 'ค้นหาและเลือกนักเรียน',
      closeOnSelect: false, // ให้เลือกได้หลายรายการ
      allowDeselect: true, // อนุญาตให้ยกเลิกการเลือก
      searchPlaceholder: 'พิมพ์เพื่อค้นหา...',
    });

    // โหลดข้อมูลนักเรียนผ่าน AJAX
    $.ajax({
      url: "../../../admin/academic/ConAdminDevelopStudents/ClubsStudentList",
      type: "GET",
      dataType: "json",
      success: function (data) {
          const options = data.map(student => ({
              text: student.FullName,
              value: student.StudentID,
          }));
          slimSelectInstance.setData(options);
      },
      error: function (xhr, status, error) {
          console.error("Error fetching student list:", error);
      }
  });

 
});


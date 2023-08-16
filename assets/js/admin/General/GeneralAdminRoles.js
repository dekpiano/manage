  // บทบาทในบรืหารทั่วไป
  $(document).on("change", "#set_General_executive", function() {

      $.post("../../../admin/General/ConAdminSettingAdminRoles/GeneralSettingManager", { TeachID: $(this).val() }, function(data, status) {
          if (data == 1) {
              alertify.success('เลือก ผอ.โรงเรียน สำเร็จ');
          } else {
              alertify.error('เปลี่ยนแปลงข้อมูลไม่สำเร็จ');
          }
      });
  });
  $(document).on("change", "#set_General_deputy", function() {
      $.post("../../../admin/General/ConAdminSettingAdminRoles/GeneralSettingDeputy", { TeachID: $(this).val() }, function(data, status) {
          if (data == 1) {
              alertify.success('เลือก รองฯ วิชการ สำเร็จ');
          } else {
              alertify.error('เปลี่ยนแปลงข้อมูลไม่สำเร็จ');
          }
      });
  });

  $(document).on("change", "#set_General_leader", function() {
      $.post("../../../admin/General/ConAdminSettingAdminRoles/GeneralSettingLeader", { TeachID: $(this).val() }, function(data, status) {
          if (data == 1) {
              alertify.success('เลือกหัวหน้างานสำเร็จ');
          } else {
              alertify.error('เปลี่ยนแปลงข้อมูลไม่สำเร็จ');
          }
      });
  });

  $(document).on("change", ".set_General_admin", function() {
      //alert($(this).attr('admin-id'));
      $.post("../../../admin/General/ConAdminSettingAdminRoles/GeneralSettingAdmin", {
          TeachID: $(this).val(),
          AdminID: $(this).attr('admin-id')
      }, function(data, status) {
          if (data == 1) {
              alertify.success('เลือก เจ้าหน้าที่วิชาการ สำเร็จ');
          } else {
              alertify.error('เปลี่ยนแปลงข้อมูลไม่สำเร็จ');
          }
      });
  });

  new SlimSelect({
      select: '#set_General_executive'
  })
  new SlimSelect({
      select: '#set_General_deputy'
  })
  new SlimSelect({
      select: '#set_General_leader'
  })
  new SlimSelect({
      select: '#set_General_adminone'
  })
  new SlimSelect({
      select: '#set_General_admintwo'
  })
  new SlimSelect({
      select: '#set_General_admintheer'
  })
  new SlimSelect({
      select: '#set_General_adminfour'
  })
  new SlimSelect({
      select: '#set_General_adminfive'
  })
  new SlimSelect({
      select: '#set_General_adminsix'
  })
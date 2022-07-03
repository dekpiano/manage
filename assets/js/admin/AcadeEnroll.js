new SlimSelect({
    select: '#teacherregis'
})

new SlimSelect({
    select: '#subjectregis'
})

new SlimSelect({
    select: '#Room'
})

$(document).on("change", "#Room", function() {

   $('#multiselect option').remove();
   
    $.post("../../../admin/academic/ConAdminEnroll/AdminEnrollSelect", { KeyRoom: $(this).val() }, function(data, status) {
        
        $.each(data, function (index, value){
            console.log(value);
            // trHTML = '<tr><td></td><td>' + value.StudentCode + '</td><td>' + value.StudentPrefix+value.StudentFirstName+' '+value.StudentLastName + '</td></tr>';
            trHTML = '<option value="'+value.StudentID+'">' + value.StudentCode+' '+ value.StudentNumber+' '+ value.StudentPrefix+value.StudentFirstName+' '+value.StudentLastName + '</option>';
            $('#multiselect').append(trHTML);
        });
       
      
    },'json');
    
});
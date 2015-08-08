$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
    
    $('#upload').hide();
    
    $('#btnEnable').on('click',function(){
       toastr["success"]("Editing is enabled.");
      $('#btnSaveEdit').toggleClass('disabled');
      $('#btnEnable').toggleClass('disabled');
       $('#upload').show();

      $("input").prop('disabled', false);
      $("select").prop('disabled', false);
  });

});

// Delete Alert Box
function deleteEmployee(id,base_url){
    swal({   
        title: "Are you sure?",   
        text: "You want to delete this employee record?",   
        type: "warning",   
        showCancelButton: true,  
        confirmButtonColor: "#DD6B55",  
        confirmButtonText: "Delete Record",   
        closeOnConfirm: false,
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {  
                location.assign(base_url+'delete_employee?emp_id='+id);
            } else {     
                swal("Cancelled", "Employee record not deleted", "error");   
            } 
        })
}
function deleteAsset(id,base_url){
    swal({   
        title: "Are you sure?",   
        text: "You want to delete this asset?",   
        type: "warning",   
        showCancelButton: true,  
        confirmButtonColor: "#DD6B55",  
        confirmButtonText: "Delete Asset",   
        closeOnConfirm: false,
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {  
                location.assign(base_url+'delete_asset?asset_id='+id);
            } else {     
                swal("Cancelled", "Asset record not deleted", "error");   
            } 
        })
}
function deleteAttendance(id,date,base_url){
    swal({   
        title: "Are you sure?",   
        text: "You want to delete this attendance record?",   
        type: "warning",   
        showCancelButton: true,  
        confirmButtonColor: "#DD6B55",  
        confirmButtonText: "Delete Record",   
        closeOnConfirm: false,
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {  
                location.assign(base_url+'attendance/remove?empid='+id+'&date='+date);
            } else {     
                swal("Cancelled", "Attendance record not deleted", "error");   
            } 
        })
}
function deletePayslip(id, base_url){
    swal({   
        title: "Are you sure?",   
        text: "You want to delete this Payslip?",   
        type: "warning",   
        showCancelButton: true,  
        confirmButtonColor: "#DD6B55",  
        confirmButtonText: "Delete Payslip",   
        closeOnConfirm: false,
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {  
                location.assign(base_url+'delete_payslip?id='+id);
            } else {     
                swal("Cancelled", "Payslip record not deleted", "error");   
            } 
        })
}

toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-center",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "500",
  "hideDuration": "1000",
  "timeOut": "3000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};


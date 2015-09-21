$(document).ready(function(){ 
  // $(".dropdown").hover(            
  //     function() {
  //         $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideDown("fast");
  //         $(this).toggleClass('open');        
  //     },
  //     function() {
  //         $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideUp("fast");
  //         $(this).toggleClass('open');       
  //     }
  // );
  $('.input-daterange input').each(function (){
    $(this).datepicker("clearDates");
  });
  $('.datepicker').datepicker({
    
    });
  $('.leaveDate').datepicker({
    daysOfWeekDisabled: '0,6',
    startDate: '0d'
    });
  $('[data-toggle="tooltip"]').tooltip()
  
  $('#upload').hide();
  
  $('#btnEnable').on('click',function(){
     toastr["success"]("Editing is enabled.");
    $('#btnSaveEdit').toggleClass('disabled');
    $('#btnEnable').toggleClass('disabled');
     
    $("input").prop('disabled', false);
    $("select").prop('disabled', false);
  });
  $('#dynamicTable').dataTable();

  $('#display_image').click(function(){
    $('#upload').show();
  });
   
  $('#overrideEndDate').click(function(){
  state = $("#overrideEndDate").is(":checked");
  $('#enddate').attr('readonly', !state);
  }); 
  
  $('#startdate').change(function(){
  dateafter = new Date($('#startdate').val());
  dateaftah = new Date(dateafter);
  if(dateafter.getDate()==16 || dateafter.getDate()==17){
    dateaftah = new Date(dateafter.getFullYear(), dateafter.getMonth()+1, 0);
  }else{
    dateaftah.setDate(dateaftah.getDate() + 14);
  }
  year = dateaftah.getFullYear().toString();
  month = (dateaftah.getMonth()+1).toString();
  day = dateaftah.getDate().toString();
  if(month.length==1){
    month = '0' + month;
  }
  if(day.length==1){
    day = '0' + day;
  }
  $('#enddate').val(year + '-' + month + '-' + day);
  });
});


function updateAllowance(emp_ctr, ctr){
  state = $("input[name=chkAllowance"+emp_ctr+"-"+ctr+"]").is(":checked");
  $("input[name=txtAllowanceTotal"+emp_ctr+"-"+ctr+"]").prop('disabled', !state);
  updateAllowanceTotal(emp_ctr, ctr);
}

function updateTax(emp_ctr, ctr){
  state = $("input[name=chkTax"+emp_ctr+"-"+ctr+"]").is(":checked");
  $("input[name=txtTaxTotal"+emp_ctr+"-"+ctr+"]").prop('disabled', !state);
  updateTaxTotal(emp_ctr, ctr);
}

function updateAllowanceTotal(emp_ctr, ctr){
  totalAllowance = $("input[name=hidTotalAllowance"+emp_ctr+"]").val();
  allowanceAmount = $("input[name=txtAllowanceTotal"+emp_ctr+"-"+ctr+"]").val();
  state = $("input[name=chkAllowance"+emp_ctr+"-"+ctr+"]").is(":checked");
  if(state){
    totalAllowance = Number(totalAllowance.replace(',','')) + Number(allowanceAmount.replace(',',''));
  }else{
    totalAllowance = Number(totalAllowance.replace(',','')) - Number(allowanceAmount.replace(',',''));
  }
  gross_income = $("input[name=hidGrossIncome"+emp_ctr+"]").val();
  totalTax = $("input[name=hidTotalTax"+emp_ctr+"]").val();
  net_income = Number(gross_income) + totalAllowance - Number(totalTax);
  strnet = net_income.toFixed(2).replace(/./g, function(c, i, a) {
    return i && c !== "." && ((a.length - i) % 3 === 0) ? ',' + c : c;
  });
  strallowance = totalAllowance.toFixed(2).replace(/./g, function(c, i, a) {
    return i && c !== "." && ((a.length - i) % 3 === 0) ? ',' + c : c;
  });
  $("input[name=hidTotalAllowance"+emp_ctr+"]").val(strallowance);
  $("p[name=pAllowance"+emp_ctr+"]").text(strallowance);
  $("input[name=hidNetIncome"+emp_ctr+"]").val(strnet);
  $("p[name=pNetIncome"+emp_ctr+"]").text(strnet);
}

function updateTaxTotal(emp_ctr, ctr){
  totalTax = $("input[name=hidTotalTax"+emp_ctr+"]").val();
  taxAmount = $("input[name=txtTaxTotal"+emp_ctr+"-"+ctr+"]").val();
  state = $("input[name=chkTax"+emp_ctr+"-"+ctr+"]").is(":checked");
  if(state){
    totalTax = Number(totalTax.replace(',','')) + Number(taxAmount.replace(',',''));
  }else{
    totalTax = Number(totalTax.replace(',','')) - Number(taxAmount.replace(',',''));
  }
  gross_income = $("input[name=hidGrossIncome"+emp_ctr+"]").val();
  totalAllowance = $("input[name=hidTotalAllowance"+emp_ctr+"]").val();
  net_income = Number(gross_income) + Number(totalAllowance) - totalTax;
  strnet = net_income.toFixed(2).replace(/./g, function(c, i, a) {
    return i && c !== "." && ((a.length - i) % 3 === 0) ? ',' + c : c;
  });
  strtax = totalTax.toFixed(2).replace(/./g, function(c, i, a) {
    return i && c !== "." && ((a.length - i) % 3 === 0) ? ',' + c : c;
  });
  $("input[name=hidTotalTax"+emp_ctr+"]").val(strtax);
  $("p[name=pTax"+emp_ctr+"]").text(strtax);
  $("input[name=hidNetIncome"+emp_ctr+"]").val(strnet);
  $("p[name=pNetIncome"+emp_ctr+"]").text(strnet);
}

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
  "progressBar": false,
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
var ajax_req;

$(document).ready(function() {
    
});


function unassign_employee(assign_id, emp_id)
{
    if(confirm("Are you sure want to remove this employee from this service?")){

        $.post(base_url+'admin/service/unassign_employee', {"emp_id":emp_id,"assign_id":assign_id}, function(htmls){
            
            $("#modal_employee_popup .modal-body").html(htmls);
            $('#modal_employee_popup').modal('show');
        });
    }
    
    service_detail_list(); 
}


function unassign_vehicle(assign_id, vh_id)
{
    if(confirm("Are you sure want to remove this vehicle from this service?")) {

        $.post(base_url+'admin/service/unassign_vehicle', {"vh_id":vh_id, "assign_id":assign_id}, function(htmls){
            
            $("#modal_vehicle_popup .modal-body").html(htmls);
            $('#modal_vehicle_popup').modal('show');
        });
        
    }
    
   service_detail_list(); 

  
}


function notallowedalert()
{
    alert("Sorry, You are not allowed!");
}

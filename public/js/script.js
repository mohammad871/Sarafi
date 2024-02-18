
function dataTable() { 
    if(!$.fn.DataTable.isDataTable('.data-table')){
        $('.data-table').DataTable({
            lengthMenu: [100,150,200,400,500,1000,2000,2500,5000],
            "pageLength": 100,
            order: [2, "desc"],
            language: {
                searchPlaceholder: "\u062C\u0633\u062A\u062C\u0648 \u06A9\u0631\u062F\u0646.... ",
                search: "",
                lengthMenu: "\u0646\u0634\u0627\u0646 \u062F\u0627\u062F\u0646 _MENU_ \u0631\u06CC\u06A9\u0627\u0631\u062F \u062F\u0631\u06CC\u06A9 \u0635\u0641\u062D\u0647",
                zeroRecords: "\u0631\u06CC\u06A9\u0627\u0631\u062F \u06CC\u0627\u0641\u062A \u0646\u0634\u062F!",
                info: "",
                infoEmpty: "\u0631\u06CC\u06A9\u0627\u0631\u062F \u0628\u0631\u0627\u06CC \u0646\u0634\u0627\u0646 \u062F\u0627\u062F\u0646 \u06CC\u0627\u0641\u062A \u0646\u0634\u062F!",
                infoFiltered: "(\u0646\u0634\u0627\u0646 \u062F\u0627\u062F\u0646 _MAX_ \u0627\u0632)",
                paginate: {previous: " << \u0642\u0628\u0644\u06CC", next: "  \u0628\u0639\u062F\u06CC >> "},
                retrieve: true,
                processing: true,
                deferRender: true,
                destroy: true,
            }
        })
    }
}

function initHiriDate(id) { 
    kamaDatepicker(id, {
        closeAfterSelect:true,
        markToday: true,
        nextButtonIcon: false,
    }); 
}
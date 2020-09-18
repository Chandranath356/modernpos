window.angularApp.controller("SubCategoryController", [
    "$scope",
    "API_URL",
    "window",
    "jQuery",
    "$compile",
    "$uibModal",
    "$http",
    "$sce",
    
function (
    $scope,
    API_URL,
    window,
    $,
    $compile,
    $uibModal,
    $http,
    $sce,
   
) {

  "use strict";
  var dt = $("#category-subcategory-list");

    var subcategoryId;
    var i;

    var hideColums = dt.data("hide-colums").split(",");

    var hideColumsArray = [];
    
    if (hideColums.length) {
        for (i = 0; i < hideColums.length; i+=1) {     
           hideColumsArray.push(parseInt(hideColums[i]));
        }
    }
  
    var $from = window.getParameterByName("from");
    var $to = window.getParameterByName("to");

     //================
    // Start datatable
    //================

    dt.dataTable({
        "oLanguage": {sProcessing: "<img src='../assets/GITLanka/img/loading2.gif'>"},
        "processing": true,
        "dom": "lfBrtip",
        "serverSide": true,
        "ajax": API_URL + "/_inc/subcategory.php?from=" + $from + "&to=" + $to,
        "order": [[ 0, "desc"]],
        "aLengthMenu": [
            [10, 25, 50, 100, 200, -1],
            [10, 25, 50, 100, 200, "All"]
        ],
        "columnDefs": [
           {"targets": [4, 5], "orderable": false},
           { 
                "targets": [0],
                'createdCell':  function (td, cellData, rowData, row, col) {
                   $(td).attr('data-title', $("#subcategory-category-list thead tr th:eq(0)").html());
                }
            },
            { 
                "targets": [1],
                'createdCell':  function (td, cellData, rowData, row, col) {
                   $(td).attr('data-title', $("#subcategory-category-list thead tr th:eq(1)").html());
                }
            },
            { 
                "targets": [2],
                'createdCell':  function (td, cellData, rowData, row, col) {
                   $(td).attr('data-title', $("#subcategory-category-list thead tr th:eq(2)").html());
                }
            },
            { 
                "targets": [3],
                'createdCell':  function (td, cellData, rowData, row, col) {
                   $(td).attr('data-title', $("#subcategory-category-list thead tr th:eq(3)").html());
                }
            },
            { 
                "targets": [4],
                'createdCell':  function (td, cellData, rowData, row, col) {
                   $(td).attr('data-title', $("#subcategory-category-list thead tr th:eq(4)").html());
                }
            },
            { 
                "targets": [5],
                'createdCell':  function (td, cellData, rowData, row, col) {
                   $(td).attr('data-title', $("#subcategory-category-list thead tr th:eq(5)").html());
                }
            },
        ],
        "aoColumns": [
            {data : "subcategory_id"},
            {data : "subcategory_name"},
            {data : "category_name"},
            {data : "created_at"},
            {data : "btn_edit"},
            {data : "btn_delete"},
        ],
       "buttons": [
            {
                extend:    "print",footer: 'true',
                text:      "<i class=\"fa fa-print\"></i>",
                titleAttr: "Print",
                title: window.store.name + " >Sub Categorys",
                exportOptions: {
                    columns: [ 0, 1, 2, 3, ]
                }
            },
            {
                extend:    "copyHtml5",
                text:      "<i class=\"fa fa-files-o\"></i>",
                titleAttr: "Copy",
                title: window.store.name + " >Sub Category List",
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            },
            {
                extend:    "excelHtml5",
                text:      "<i class=\"fa fa-file-excel-o\"></i>",
                titleAttr: "Excel",
                title: window.store.name + " >Sub Category List",
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            },
            {
                extend:    "csvHtml5",
                text:      "<i class=\"fa fa-file-text-o\"></i>",
                titleAttr: "CSV",
                title: window.store.name + " > Sub Category List",
                exportOptions: {
                    columns: [ 0, 1, 2, 3]
                }
            },
            {
                extend:    "pdfHtml5",
                text:      "<i class=\"fa fa-file-pdf-o\"></i>",
                titleAttr: "PDF",
                download: "open",
                title: window.store.name + " >Sub Category List",
                exportOptions: {
                    columns: [ 0, 1, 2, 3]
                },
                customize: function (doc) {
                    doc.content[1].table.widths =  Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    doc.pageMargins = [10,10,10,10];
                    doc.defaultStyle.fontSize = 8;
                    doc.styles.tableHeader.fontSize = 8;doc.styles.tableHeader.alignment = "left";
                    doc.styles.title.fontSize = 10;
                    // Remove spaces around page title
                    doc.content[0].text = doc.content[0].text.trim();
                    // Header
                    doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'center',
                        fontSize: 8,
                        text: 'Printed on: '+window.formatDate(new Date()),
                    });
                    // Create a footer
                    doc['footer']=(function(page, pages) {
                        return {
                            columns: [
                                'Powered by GITLanka.COM',
                                {
                                    // This is the right column
                                    alignment: 'right',
                                    text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
                                }
                            ],
                            margin: [10, 0]
                        };
                    });
                    // Styling the table: create style object
                    var objLayout = {};
                    // Horizontal line thickness
                    objLayout['hLineWidth'] = function(i) { return 0.5; };
                    // Vertikal line thickness
                    objLayout['vLineWidth'] = function(i) { return 0.5; };
                    // Horizontal line color
                    objLayout['hLineColor'] = function(i) { return '#aaa'; };
                    // Vertical line color
                    objLayout['vLineColor'] = function(i) { return '#aaa'; };
                    // Left padding of the cell
                    objLayout['paddingLeft'] = function(i) { return 4; };
                    // Right padding of the cell
                    objLayout['paddingRight'] = function(i) { return 4; };
                    // Inject the object in the document
                    doc.content[1].layout = objLayout;
                }
            }
        ],

    });

  $(document).delegate("#create-subcategory-submit", "click", function(e) {

   e.preventDefault();
   var $tag = $(this);
   var form = $($tag.data("form"));
   var $btn = $tag.button("loading");
   var actionUrl = form.attr("action");
     
      $http({
            url: window.baseUrl + "/_inc/" + actionUrl,
            method: "POST",
            data: form.serialize(),
            cache: false,
            processData: false,
            contentType: false,
            dataType: "json"
        }).
        then(function(response) {
        
        $btn.button("reset");
        $(":input[type=\"button\"]").prop("disabled", false);
        var alertMsg = response.data.msg;
        window.toastr.success(alertMsg, "Success!");
        
        var subcategoryId = response.data.id;
          
            dt.DataTable().ajax.reload(function(json) {
                if ($("#row_"+subcategoryId).length) {
                    $("#row_"+subcategoryId).flash("yellow", 5000);
                }
            }, false);

            // Reset form
            $("#reset").trigger("click");
             $("#category_sex").val(null).trigger("change");

        }, function(response) {
          $btn.button("reset");
          $(":input[type=\"button\"]").prop("disabled", false);
           var alertMsg = "<div>";
            window.angular.forEach(response.data, function(value) {
                alertMsg += "<p>" + value + ".</p>";
            });
            alertMsg += "</div>";
            window.toastr.warning(alertMsg, "Warning!");
        });

  });

  $(document).delegate("#edit-subcategory", "click", function(e) {
        
        e.stopPropagation();
        e.preventDefault();

        var d = dt.DataTable().row( $(this).closest("tr") ).data();
        console.log(d);
        // subcategoryEditModal(d);
        
    });

}]);


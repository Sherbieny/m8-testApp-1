$.noConflict();

$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

$(document).on("submit", "#add-item-form", function(e){
    e.preventDefault();
    return  false;
});

$(document).ready(function () {
    $( function() {
        var dialog, form,

            // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
            itemDetail1 = $( "#itemDetail1" ),
            itemDetail2 = $( "#itemDetail2" ),
            itemDetail3 = $( "#itemDetail3" ),
            allFields = $( [] ).add( itemDetail1 ).add( itemDetail2 ).add( itemDetail3 );



        function addUser() {
            var data;
            var url = Routing.generate('new_item');
            allFields.removeClass( "ui-state-error" );

            // var values = {};
            // $.each( JSON.parse($('form[name=app_bundle_item_form_type]')), function(i, field) {
            //     values[field.name] = field.value;
            // });
            // $.ajax({
            //     type        : $form.attr( 'method' ),
            //     url         : $form.attr( 'action' ),
            //     data        : values,
            //     success     : function(data) {
            //         callback( data );
            //     }
            //    this.preventDefault();
           // var data = $('#add-item-form').serialize();
            //var formData = $('form[name=app_bundle_item_form_type]').serialize();

            data = $("#add-item-form").serializeObject();

            $.ajax({
               url: url,
               method: 'POST',
               dataType: 'json',
               data:  data,
               mimeType:"multipart/form-data",
               contentType: false,
               cache: false,
               processData:false,
               success: function(data)
               {
                    alert('a7aaaa');
                    console.log(data);
                   if(data.status == 'saved'){
                       console.log("entity saved ! ");
                   }
                   if(data.status == 'invalid'){
                       console.log("entity submitted was invalid, use try catch and getMessage of eventual errors in you controller action, you can pass all that to the returning array you can receive and parse here ! ");
                   }
               },
               error: function(jqXHR, textStatus, errorThrown)
               {
               }
            });





                $( "#table-row" ).append( "<div class='table-fields'>" +
                    "<span class='td'>" +
                    "<input readonly class='item-detail' value="+itemDetail1.val()+" />" +
                    "</span>" +
                    "<span class='td'>" +
                    "<input readonly class='item-detail' value=" + itemDetail2.val() + "/>" +
                    "</span>" +
                    "<span class='td'>" +
                    "<input readonly class='item-detail' value=" + itemDetail3.val() + "/>" +
                    "</span>" +
                    "</div>" +
                    "<div class='table-buttons'>" +
                    "<div class='table-btn-edit'>" +
                    "<button class='btn-edit-item'></button> " +
                    "</div> " +
                    "<div class='table-btn-delete'>" +
                    "<button class='btn-delete-item'></button> " +
                    "</div> " +
                    "</div> ");
                dialog.dialog( "close" );

        }

        var forms = [
            '[ name="{{ itemForm.vars.full_name }}"]'
        ];

        $( forms.join(',') ).submit( function( e ){
            e.preventDefault();

            form( $(this), function( response ){
            });

            return false;
        });

        dialog = $( "#dialog-form" ).dialog({
            autoOpen: false,
            height: 400,
            width: 350,
            modal: true,
            buttons:
            {
             'Add Item': function () {
                 addUser();
                 dialog.dialog("close");
                },
            'Cancel': function () {
                 dialog.dialog("close");
                }
            },
            close: function() {
                form[ 0 ].reset();
                allFields.removeClass( "ui-state-error" );
            }
        });

        form = dialog.find( "form" ).on( "submit", function( event ) {
            event.preventDefault();
            //addUser();
            console.log("a7a men form");
        });

        $( "#create-user" ).button().on( "click", function() {
            dialog.dialog( "open" );
        });
    } );
});


$.noConflict();
$(document).ready(function () {
    $( function() {
        var dialog, form,

            // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
            itemDetail1 = $( "#itemDetail1" ),
            itemDetail2 = $( "#itemDetail2" ),
            itemDetail3 = $( "#itemDetail3" ),
            allFields = $( [] ).add( itemDetail1 ).add( itemDetail2 ).add( itemDetail3 );



        function addUser() {
            var valid = true;
            var url = Routing.generate('new_item');
            allFields.removeClass( "ui-state-error" );

            // var values = {};
            // $.each( $form.serializeArray(), function(i, field) {
            //     values[field.name] = field.value;
            // });
            // $.ajax({
            //     type        : $form.attr( 'method' ),
            //     url         : $form.attr( 'action' ),
            //     data        : values,
            //     success     : function(data) {
            //         callback( data );
            //     }
            $('#add-item-form').submit(function (e) {
                e.preventDefault();
                var data = $('#add-item-form').serialize();

                console.log(data);
                $.ajax({
                    url: url,
                    method: 'POST',
                    dataType: 'json',
                    data:  data,
                    mimeType:"multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data, textStatus, jqXHR)
                    {

                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                    }
                });

            });




            if ( valid ) {
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
            return valid;
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
            buttons: {
                "Create an account": addUser,
                Cancel: function() {
                    dialog.dialog( "close" );
                }
            },
            close: function() {
                form[ 0 ].reset();
                allFields.removeClass( "ui-state-error" );
            }
        });

        form = dialog.find( "form" ).on( "submit", function( event ) {
            event.preventDefault();
            addUser();
        });

        $( "#create-user" ).button().on( "click", function() {
            dialog.dialog( "open" );
        });
    } );
});


buttons: {
    'Confirm': function() {
        //do something
        $(this).dialog('close');
    },
    'Cancel': function() {
        $(this).dialog('close');
    }
}
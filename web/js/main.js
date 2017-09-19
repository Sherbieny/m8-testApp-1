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

    $.ajax({
        url: '/items',
        method: 'GET',
        dataType: 'json',
        cache: false,
        processData:false,
        success: function(data, textStatus, xhr)
        {
            if (xhr.status == 200){
                console.log("Items queried!");
                console.log(data);
                $.each(data, function (key, value) {
                    if (jQuery.isEmptyObject(data)){
                        console.log('object is empty a7a');
                    }else{
                        console.log('object is full a7a');
                    }
                });
                console.log(textStatus);
            }else {
                console.log("Error!");
            }


        },
        error: function(jqXHR, textStatus, errorThrown)
        {

            console.log("TextStatus:----------");
            console.log(textStatus);
            console.log("ErrorThrown:----------");
            console.log(errorThrown);
            console.log("JqXHR:----------");
            console.log(jqXHR);
        }
    });
});

$(document).ready(function () {
    $( function() {
        var dialog, form;

            // itemDetail1 = $( "#itemDetail1" ).val(),
            // itemDetail2 = $( "#itemDetail2" ).val(),
            // itemDetail3 = $( "#itemDetail3" ).val(),
            // allFields = $( [] ).add( itemDetail1 ).add( itemDetail2 ).add( itemDetail3 );


        function addUser() {
            var data;
            var url = '/item/new/';
            // allFields.removeClass( "ui-state-error" );

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

            data = JSON.stringify($('form').serializeArray());

            $.ajax({
               url: url,
               method: 'POST',
               dataType: 'json',
               data:  data,
               mimeType:"multipart/form-data",
               contentType: 'application/x-www-form-urlencoded',
               cache: false,
               processData:false,
               success: function(data, textStatus, xhr)
               {
                    if (xhr.status == 200){
                        console.log("Item Saved!");
                    }else {
                        console.log("Error!");
                    }


               },
               error: function(jqXHR, textStatus, errorThrown)
               {
                   console.log(data);
                   console.log(errorThrown);
                   console.log(jqXHR);
               }
            });





                $( "#table-row" ).append( "<div class='table-fields'>" +
                    "<span class='td'>" +
                    "<input readonly class='item-detail'/>" +
                    "</span>" +
                    "<span class='td'>" +
                    "<input readonly class='item-detail'/>" +
                    "</span>" +
                    "<span class='td'>" +
                    "<input readonly class='item-detail'/>" +
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


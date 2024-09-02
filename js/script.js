$(document).ready(function() {

    $('#addCategory').submit(function(ev) {
        ev.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "requestHandler.php?action=addCategory",
            data: formData,
            success: function(response) {
                if (response.success) {
                    window.location.href = '/';
                } else {
                    alert('There was an error!');
                }
            },
            error: function() {
                $("#response").html("<p>An error occured.</p>");
            } 
        });
    });
    // $('#updateCategory').submit(function(ev) {
    //     ev.preventDefault();

    //     var formData = $(this).serialize();

    //     $.ajax({
    //         type: "POST",
    //         url: "requestHandler.php?action=addCategory",
    //         data: formData,
    //         success: function(response) {
    //             if (response.success) {
    //                 window.location.href = '/';
    //             } else {
    //                 alert('There was an error!');
    //             }
    //         },
    //         error: function() {
    //             $("#response").html("<p>An error occured.</p>");
    //         } 
    //     });
    // });
    // $('#deleteCategory').submit(function(ev) {
    //     ev.preventDefault();

    //     var formData = $(this).serialize();

    //     $.ajax({
    //         type: "POST",
    //         url: "requestHandler.php?action=addCategory",
    //         data: formData,
    //         success: function(response) {
    //             if (response.success) {
    //                 window.location.href = '/';
    //             } else {
    //                 alert('There was an error!');
    //             }
    //         },
    //         error: function() {
    //             $("#response").html("<p>An error occured.</p>");
    //         } 
    //     });
    // });
    // $(categoryView.php).onload(function(){
        // $.ajax({
        //     url: 'requestHandler.php?action=getCategory',
        //     method: 'GET',
        //     dataType: 'json',
        //     success: function(data) {
        //         // Populate the table with data
        //         var tableBody = $('#category-list tbody');
        //         tableBody.empty(); // Clear existing data
    
        //         $.each(data, function(index, item) {
        //             var row = $('<tr></tr>');
    
        //             $('<td></td>').text(item.id).appendTo(row);
        //             $('<td></td>').text(item.name).appendTo(row);
        //             $('<td></td>').text("edit/delete").appendTo(row);
    
        //             row.appendTo(tableBody);
        //         });
        //     },
        //     error: function(jqXHR, textStatus, errorThrown) {
        //         console.error('Failed to fetch data:', textStatus, errorThrown);
        //     }
        // });
    // })
});
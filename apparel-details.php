<?php 
    include 'template/header.php';
?>

<div class="container-fluid">
    <h1 class="title-text">Edit Apparel</h1>

    <div class="col-lg-6 bg-dark text-light rounded-5 mx-auto p-4">
        <form id="editApparel" class="text-center" enctype="multipart/form-data">
            <div hidden="true">
                <label for="id">Id: </label><br>
                <input id="id" name="id" type="number" readonly /><br>
            </div>    
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select id="type" name="type" class="form-select">
                    <option value=1>HEAD</option>
                    <option value=2>TOP</option>
                    <option value=3>BOTTOM</option>
                    <option value=4>ARM</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="purchased_date" class="form-label">Purchased Date</label>
                <input id="purchased_date" type="date" name="purchased_date" value="" required class="form-control"/>
            </div>
            <div class="mb-3">
                <label for="note" class="form-label">Note</label>
                <input class="form-control" id="note" name="note" type="text" minlength="2" maxlength="20">
            </div>
            <div class="mb-3">
                <label for="color" class="form-label">Color</label>
                <input class="form-control" id="color" name="color" type="text" minlength="2" maxlength="20">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">$</span>
                    <input type="number" class="form-control" id="price" name="price" required min="0" step="0.01" value="0.00">
                </div>
            </div>
            <div class="mb-3">
                <label for="qty" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="qty" name="qty" required min="1" value="1">
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Description</label>
                <textarea class="form-control" id="desc" name="desc" type="text" minlength="2" maxlength="255" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="brand" class="form-label">Brand</label>
                <select id="brand" name="brand" class="form-select"></select>    
            </div>
            <div class="mb-3">
                <label for="style" class="form-label">Style</label>
                <select id="style" name="style" class="form-select"></select>   
            </div>
            <div class="mb-3">
                <label for="budget" class="form-label">Budget</label>
                <select id="budget" name="budget" class="form-select"></select>   
            </div>
            <div class="mb-3">
                <label for="attachment" class="form-label">Attachment</label>
                <input class="form-control" type="file" id="attachment" name="attachment">
            </div>
            <div id=imgDiv class="mb-3">
                <img id="attachmentPhoto" class="rounded" style="width: 400px;">
            </div>
            <button id="submitEditApparel" class="btn btn-primary">Edit</button>
            <button id="deleteApparel" class="btn btn-danger">Delete</button>
        </form>
    </div>    
</div>
<div id="response"></div>

<script>
    $(document).ready(function() {
        
        //get brand
        $.ajax({
            url: 'requestHandler.php?action=getName&className=brand',
            method: 'GET',
            dataType: 'json',
            success: function(data)  {
                var $select = $('#brand');
                $select.empty(); // Clear previous options
                if (data.error) {
                    console.error('Error:', data.error);
                } else {
                    $select.append('<option value="">Select a brand</option>');
                    $.each(data, function(index, option) {
                        $select.append('<option value="' + option.id + '">' + option.name + '</option>');
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Failed to fetch data:', textStatus, errorThrown);
            }
        });

        //get style
        $.ajax({
            url: 'requestHandler.php?action=getName&className=style',
            method: 'GET',
            dataType: 'json',
            success: function(data)  {
                var $select = $('#style');
                $select.empty(); // Clear previous options
                if (data.error) {
                    console.error('Error:', data.error);
                } else {
                    $select.append('<option value="">Select a style</option>');
                    $.each(data, function(index, option) {
                        $select.append('<option value="' + option.id + '">' + option.name + '</option>');
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Failed to fetch data:', textStatus, errorThrown);
            }
        });

        //get budget
        $.ajax({
            url: 'requestHandler.php?action=getBudget',
            method: 'GET',
            dataType: 'json',
            success: function(data)  {
                var $select = $('#budget');
                $select.empty(); // Clear previous options
                if (data.error) {
                    console.error('Error:', data.error);
                } else {
                    $select.append('<option value="">Select a budget</option>');
                    $.each(data, function(index, option) {
                        $select.append('<option value="' + option.id + '">' + option.note + '</option>');
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Failed to fetch data:', textStatus, errorThrown);
            }
        });

        //set current date
        // var now = new Date();
        // var year = now.getFullYear();
        // var month = String(now.getMonth() + 1).padStart(2, '0'); // Months are 0-based
        // var day = String(now.getDate()).padStart(2, '0');
        // var formattedDateTime = year + '-' + month + '-' + day;
        // $('#purchased_date').val(formattedDateTime);

        var urlParams = new URLSearchParams(window.location.search);
        var paramId = urlParams.get('id');

        function fetchData() {
            $.ajax({
                url: 'requestHandler.php?action=getOneApparel&id=' + paramId,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                    } else {
                        var dateTime = new Date(response.purchased_date);
                        var formattedDateTime = dateTime.toISOString().slice(0, 10);
                        // Populate the form fields
                        $('#id').val(response.id);
                        $('#type').val(response.type_id);
                        $('#purchased_date').val(formattedDateTime);
                        $('#note').val(response.note);
                        $('#color').val(response.color);
                        $('#price').val(response.price);
                        $('#qty').val(response.qty);
                        $('#desc').val(response.description);
                        $('#brand').val(response.brand_id);
                        $('#style').val(response.style_id);
                        $('#budget').val(response.budget_id);
                        if (response.attachment) {
                            $('#attachmentPhoto').attr({
                                'src': response.attachment,
                                'alt': response.note,
                            });
                            $('#imgDiv').append('<a id="removeAttachment" class="btn btn-warning">Delete Image</a>');
                            $('#removeAttachment').click(function(ev) {
                                ev.preventDefault();
                                $.ajax({
                                    type: "POST",
                                    url: "requestHandler.php?action=removeApparelAttachment&id=" + paramId,
                                    data: paramId,
                                    success: function(response) {
                                        if (response.success) {
                                            window.location.href = '/apparel-details.php?id=' + paramId;
                                            alert('Attachment removed successfully')
                                        } else {
                                            alert('There was an error!');
                                        }
                                    },
                                    error: function() {
                                        $("#response").html("<p>An error occured.</p>");
                                    } 
                                });
                            })   
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Request failed:', error);
                }
            });
        }
        // Fetch data when the page loads
        fetchData();
        
        $('#submitEditApparel').click(function(ev) {
            ev.preventDefault;
            var formData = new FormData($('#editApparel')[0]);
            $.ajax({
                type: "POST",
                url: "requestHandler.php?action=editApparel&id=" + paramId,
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        window.location.href = '/apparel-details.php?id=' + paramId;
                        alert('Apparel updated successfully');
                    } else {
                        // alert('There was an error!');
                        alert(response.error);
                    }
                    // alert(JSON.stringify(response));
                },
                error: function() {
                    alert('An error occured.');
                    // $("#response").html("<p>An error occured.</p>");
                } 
            });
        });

        $('#deleteApparel').click(function(ev) {
            ev.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                type: "POST",
                url: "requestHandler.php?action=deleteApparel&id=" + paramId,
                data: formData,
                success: function(response) {
                    if (response.success) {
                        window.location.href = '/apparel-page.php';
                        alert('Apparel deleted successfully')
                    } else {
                        alert('There was an error!');
                    }
                },
                error: function() {
                    $("#response").html("<p>An error occured.</p>");
                } 
            });
        });
    })
</script>

<?php
    include 'template/footer.php';
?>
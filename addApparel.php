<?php 
    include 'template/header.php';
?>

<div class="container-fluid">
    <h1 class="title-text">Add Apparel</h1>

    <div class="col-lg-6 bg-dark text-light rounded-5 mx-auto p-4">
        <form id="addBudget" class="text-center" enctype="multipart/form-data">
            <?php include 'template/budgetForm.php'; ?>
            <button id="submitAddBudget" type="button">Add Budget</button>
        </form>
    </div>
        
</div>
<div id="response"></div>

<script>
    $(document).ready(function() {

        $('#in_out').change(function() {
            var selectedInOut = $(this).val();
        
            if (selectedInOut == "1") {
                $('#category').empty();
                //get categories in
                $.ajax({
                    url: 'requestHandler.php?action=getCategoryIn',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data)  {
                        var $select = $('#category');
                        $select.empty(); // Clear previous options
                        if (data.error) {
                            console.error('Error:', data.error);
                        } else {
                            $select.append('<option value="">Select a category</option>');
                            $.each(data, function(index, option) {
                                $select.append('<option value="' + option.id + '">' + option.name + '</option>');
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Failed to fetch data:', textStatus, errorThrown);
                    }
                });
            } else {
                $('#category').empty();
                //get categories out
                $.ajax({
                    url: 'requestHandler.php?action=getCategoryOut',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data)  {
                        var $select = $('#category');
                        $select.empty(); // Clear previous options
                        if (data.error) {
                            console.error('Error:', data.error);
                        } else {
                            $select.append('<option value="">Select a category</option>');
                            $.each(data, function(index, option) {
                                $select.append('<option value="' + option.id + '">' + option.name + '</option>');
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Failed to fetch data:', textStatus, errorThrown);
                    }
                });
            }
        });

        //set default in_out to expense
        const defaultInOut = "0";
        $('#in_out').val(defaultInOut).change();

        //set current date
        var now = new Date();
        var year = now.getFullYear();
        var month = String(now.getMonth() + 1).padStart(2, '0'); // Months are 0-based
        var day = String(now.getDate()).padStart(2, '0');
        var hours = String(now.getHours()).padStart(2, '0');
        var minutes = String(now.getMinutes()).padStart(2, '0');
        var formattedDateTime = year + '-' + month + '-' + day + 'T' + hours + ':' + minutes;
        $('#datetime').val(formattedDateTime);
        
        $('#submitAddBudget').click(function(ev) {
            ev.preventDefault;
            var formData = new FormData($('#addBudget')[0]);
            $.ajax({
                type: "POST",
                url: "requestHandler.php?action=addBudget",
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                    } else {
                        window.location.href = '/budget-page.php';
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
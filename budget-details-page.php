<?php 
    include 'template/header.php';
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
?>

<div class="container-fluid">
    <h1 class="title-text">Edit Budget</h1>

    <div class="col-lg-6 bg-dark text-light rounded-5 mx-auto p-4">
        <form id="editBudget" class="text-center">
            <label for="id">Id: </label><br>
            <input id="id" name="id" type="number" readonly /><br>
            <?php include 'template/budgetForm.php'; ?>
            <button type="submit" class="btn btn-primary">Edit</button>
            <button id="deleteBudget" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<div id="response"></div>

<script>
    $(document).ready(function() {

        var urlParams = new URLSearchParams(window.location.search);
        var paramId = urlParams.get('id');

        function fetchData() {
            $.ajax({
                url: 'requestHandler.php?action=getOneBudget&id=' + paramId,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                    } else {
                        var dateTime = new Date(response.date);
                        var formattedDateTime = dateTime.toISOString().slice(0, 16);
                        // Populate the form fields
                        $('#id').val(response.id);
                        $('#in_out').val(response.in_out).change();
                        $('#datetime').val(formattedDateTime);
                        $('#account').val(response.account_id);
                        $('#category').val(response.category_id);
                        $('#amount').val(response.amount);
                        $('#note').val(response.note);
                        $('#desc').val(response.description);
                        $('#attachment').val(response.attachment);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Request failed:', error);
                }
            });
        }

            // Fetch data when the page loads
            fetchData();
     

        $('#editBudget').submit(function(ev) {
            ev.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                type: "POST",
                url: "requestHandler.php?action=editBudget&id=" + paramId,
                data: formData,
                success: function(response) {
                    if (response.success) {
                        window.location.href = '/budget-details-page.php?id=' + paramId;
                        alert('Budget updated successfully')
                    } else {
                        alert('There was an error!');
                    }
                },
                error: function() {
                    $("#response").html("<p>An error occured.</p>");
                } 
            });
        });

        $('#deleteBudget').click(function(ev) {
            ev.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                type: "POST",
                url: "requestHandler.php?action=deleteBudget&id=" + paramId,
                data: formData,
                success: function(response) {
                    if (response.success) {
                        window.location.href = '/budget-page.php';
                        alert('Budget deleted successfully')
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
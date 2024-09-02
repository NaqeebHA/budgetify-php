<?php 
    include 'template/header.php';
?>

<div class="container-fluid">
    <h1 class="title-text">Add a Budget</h1>

    <div class="col-lg-6 bg-dark text-light rounded-5 mx-auto p-4">
        <form id="addBudget" class="text-center">
            <?php include 'template/budgetForm.php'; ?>
            <button type="submit">Add Budget</button>
        </form>
    </div>
        
</div>
<div id="response"></div>

<script>
    $(document).ready(function() {

        const defaultInOut = "0";
        $('#in_out').val(defaultInOut).change();
        
        $('#addBudget').submit(function(ev) {
            ev.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                type: "POST",
                url: "requestHandler.php?action=addBudget",
                data: formData,
                success: function(response) {
                    if (response.success) {
                        window.location.href = '/budget-page.php';
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
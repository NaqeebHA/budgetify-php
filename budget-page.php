<?php 
    include 'template/header.php';
?>

<!-- <a id="addBudgetBtn" class="btn rounded-circle position-absolute top-0 end-0" href="addBudget.php">+</a> -->

<div class="container-fluid">
    <h1 class="title-text">Budget List</h1>
    <table class="table table-bordered table-dark text-center" id="budget-list">
        <thead>    
            <tr>
                <th>Date</th>
                <th>Account</th>
                <th>Category</th>
                <th>Note</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr> 
        </thead>   
        <tbody>
        </tbody>
    </table>
</div>

<!-- <template>
    <div class="container_fluid">
        <div class="row budget-date-row">
            <div class="col budget-date" data-date></div>
            <div class="col budget-income" data-income></div>
            <div class="col budget-expense" data-expense></div>
        </div>
        <div class="row budget-content-row">
            <div class="col budget-category" data-category></div>
            <div class="col note-account">
                <div class="row">
                    <div class="col budget-note" data-note></div>
                    <div class="col budget-acct" data-acct></div>
                </div>
            </div>
            <div class="col budget-amount" data-amount></div>
        </div>
    </div>  
</template> -->

<div id="response"></div>

<script>
    $(document).ready(function() {
            // Function to fetch data and populate the table
            function fetchData() {
                var accounts = [];
                var categories = [];
                //get accounts
                $.ajax({
                    url: 'requestHandler.php?action=getAccount',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data)  {
                        if (data.error) {
                            console.error('Error:', data.error);
                        } else {
                            $.each(data, function(index, option) {
                                accounts[option.id] = option.name;
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Failed to fetch data:', textStatus, errorThrown);
                    }
                });
                //get categories
                $.ajax({
                    url: 'requestHandler.php?action=getCategoryOut',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data)  {
                        if (data.error) {
                            console.error('Error:', data.error);
                        } else {
                            $.each(data, function(index, option) {
                                categories[option.id] = option.name;
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Failed to fetch data:', textStatus, errorThrown);
                    }
                });
                $.ajax({
                    url: 'requestHandler.php?action=getCategoryIn',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data)  {
                        if (data.error) {
                            console.error('Error:', data.error);
                        } else {
                            $.each(data, function(index, option) {
                                categories[option.id] = option.name;
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Failed to fetch data:', textStatus, errorThrown);
                    }
                });
                // get budget list
                $.ajax({
                    url: 'requestHandler.php?action=getBudget',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var $tableBody = $('#budget-list tbody');
                        $tableBody.empty(); // Clear previous data

                        if (data.error) {
                            console.error('Error:', data.error);
                        } else {
                            $.each(data, function(index, budget) {
                                var amount_color = (budget.in_out == 0) ? '<td class="text-danger">' : '<td class="text-primary">';
                                var row = (budget.in_out == 0) ? 
                                (
                                    '<tr>' +
                                    '<td>' + budget.date + '</td>' +
                                    '<td>' + accounts[budget.account_id] + '</td>' +
                                    '<td>' + categories[budget.category_id] + '</td>' +
                                    '<td>' + budget.note + '</td>' + 
                                    '<td class="text-danger">' + budget.amount + '</td>' +
                                    '<td>' +
                                        "<a href=\'budget-details-page.php?id="+ budget.id +"\'><i class=\"bi bi-eye\"></i></a>" +
                                    '</td>' +
                                    '</tr>'
                                )
                                : 
                                (
                                    '<tr>' +
                                    '<td>' + budget.date + '</td>' +
                                    '<td>' + accounts[budget.account_id] + '</td>' +
                                    '<td>' + categories[budget.category_id] + '</td>' +
                                    '<td>' + budget.note + '</td>' + 
                                    '<td class="text-primary">' + budget.amount + '</td>' +
                                    '<td>' +
                                        "<a href=\'budget-details-page.php?id="+ budget.id +"\'><i class=\"bi bi-eye\"></i></a>" +
                                    '</td>' +
                                    '</tr>'
                                );
                                $tableBody.append(row);
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Request failed:', error);
                    }
                });
            }

            // Fetch data when the page loads
            fetchData();
        });
</script>

<?php
    include 'template/footer.php';
?>
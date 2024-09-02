<?php 
    include 'template/header.php';
?>

<div class="container-fluid">
    <h1 class="title-text">Add a Category</h1>

    <div class="col-lg-6 bg-dark text-light rounded-5 mx-auto p-4">
        <form id="addCategory" class="text-center">            
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input class="form-control" id="name" name="name" type="text" minlength="2" maxlength="20">
            </div>
            <div class="mb-3">
                <label for="in_out" class="form-label">Income/Expense</label>
                <select id="in_out" name="in_out" class="form-select">
                    <option value=1>Income</option>
                    <option selected value=0>Expense</option>
                </select>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</div>
<div id="response"></div>

<?php
    include 'template/footer.php';
?>
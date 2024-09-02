<?php 
    include 'template/header.php';
?>

<div class="container-fluid">
    <h1 class="title-text">Add a Category</h1>
    <form id="addCategory">
<?php
    include 'template/nameForm.php';
?>
<<label for="name">Name: </label>
<select id="in_out" name="in_out">
    <option value="0" selected>Expense</option>
    <option value="1">Income</option>
</select>
<button type="submit">Submit</button>
    </form>
</div>
<div id="response"></div>

<?php
    include 'template/footer.php';
?>
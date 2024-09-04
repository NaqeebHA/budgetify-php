<?php
// Include the controller file
require 'config/functions.php';

// Get the action parameter from the URL (e.g., ?action=submitForm)
$action = isset($_GET['action']) ? $_GET['action'] : '';

$id = isset($_GET['id']) ? intval($_GET['id']) : '';

$in_out = isset($_GET['in_out']) ? intval($_GET['in_out']) : '';
$date_from = isset($_GET['from']) ? $_GET['from'] : '';
$date_to = isset($_GET['to']) ? $_GET['to'] : '';

//category
if ($action === 'addCategory') {
    $controller = new CategoryController();
    $controller->createCategory();
} else if ($action === 'getCategory') {
    $controller = new CategoryController();
    $controller->getAll();
} else if ($action === 'getCategoryOut') {
    $controller = new CategoryController();
    $controller->getOut();
} else if ($action === 'getCategoryIn') {
    $controller = new CategoryController();
    $controller->getIn();

//budget
} else if ($action === 'getBudget') {
    $controller = new BudgetController();
    $controller->getAll();
} else if ($action === 'getOneBudget') {
    $controller = new BudgetController();
    $controller->getOne($id);
} else if ($action === 'addBudget') {
    $controller = new BudgetController();
    $controller->addBudget();
} else if ($action === 'editBudget') {
    $controller = new BudgetController();
    $controller->editBudget($id);
} else if ($action === 'removeBudgetAttachment') {
    $controller = new BudgetController();
    $controller->removeAttachment($id);    
} else if ($action === 'deleteBudget') {
    $controller = new BudgetController();
    $controller->deleteBudget($id);
} else if ($action === 'analyticsBudget') {
    $controller = new BudgetController();
    $controller->getStatsTimeframe($in_out, $date_from, $date_to);
} else if ($action === 'accountRange') {
    $controller = new BudgetController();
    $controller->getAccTimeframe($in_out, $date_from, $date_to);
//account
} else if ($action === 'getAccount') {
    $controller = new AccountController();
    $controller->getAll();
//apparel
} else if ($action === 'getByType') {
    $controller = new ApparelController();
    $controller->getAllByType($id);
} else {
    echo 'Invalid action.';
}
?>
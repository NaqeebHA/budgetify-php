<?php
// Include the controller file
require 'config/functions.php';

// Get the action parameter from the URL (e.g., ?action=submitForm)
$action = isset($_GET['action']) ? $_GET['action'] : '';

$id = isset($_GET['id']) ? intval($_GET['id']) : '';

$in_out = isset($_GET['in_out']) ? intval($_GET['in_out']) : '';
$date_from = isset($_GET['from']) ? $_GET['from'] : '';
$date_to = isset($_GET['to']) ? $_GET['to'] : '';
$type_id = isset($_GET['type']) ? intval($_GET['type']) : '';
$className = isset($_GET['className']) ? intval($_GET['className']) : '';

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
    $controller->getStatsTimeframe($type_id, $date_from, $date_to);
} else if ($action === 'accountRange') {
    $controller = new BudgetController();
    $controller->getAccTimeframe($in_out, $date_from, $date_to);

//account, brand, style
} else if ($action === 'getName') {
    $controller = new NameController();
    $controller->getAll($className);
} else if ($action === 'addName') {
    $controller = new NameController();
    $controller->add($className);
} else if ($action === 'updateName') {
    $controller = new NameController();
    $controller->update($className, $id);
} else if ($action === 'deleteName') {
    $controller = new NameController();
    $controller->delete($className, $id);
    

//apparel
} else if ($action === 'getByType') {
    $controller = new ApparelController();
    $controller->getAllByType($id);
} else if ($action === 'getApparel') {
    $controller = new ApparelController();
    $controller->getAll();
} else if ($action === 'getOneApparel') {
    $controller = new ApparelController();
    $controller->getOne($id);
} else if ($action === 'addApparel') {
    $controller = new ApparelController();
    $controller->addApparel();
} else if ($action === 'editApparel') {
    $controller = new ApparelController();
    $controller->editApparel($id);
} else if ($action === 'removeApparelAttachment') {
    $controller = new ApparelController();
    $controller->removeAttachment($id);    
} else if ($action === 'deleteApparel') {
    $controller = new ApparelController();
    $controller->deleteApparel($id);
} else if ($action === 'analyticsApparel') {
    $controller = new ApparelController();
    $controller->getTypeStatsTimeframe($in_out, $date_from, $date_to);

// else
} else {
    echo 'Invalid action.';
}
?>
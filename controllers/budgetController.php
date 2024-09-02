<?php

class BudgetController extends Budget {
    public function getAll() {
        header('Content-Type: application/json');
        $item = $this->all();
        if ($item) {
           echo json_encode($item);
        } else {
            echo json_encode(["error" => "No budget found"]);
        }
    }

    public function getOne($id) {
        header('Content-Type: application/json');
        $item = $this->one($id);
        if ($item) {
           echo json_encode($item);
        } else {
            echo json_encode(["error" => "No budget with id=$id found"]);
        }    
    }

    public function addBudget() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sanitizer = new Sanitize();
            $arr = [];
            foreach($_POST as $key => $value) {
                if (is_string($value)) {
                    $value = $sanitizer->sanitize_input($value);
                }
                $arr[$key] = $value;
            }
            try {
                $arr['attachment'] = "";
                $this->add($arr['account'], $arr['in_out'], $arr['category'], $arr['amount'], $arr['datetime'], $arr['note'], $arr['desc'], $arr['attachment']);
                $acc = new Account();
                $response = ['success' => true];
            } catch (Exception $e) {
                echo $e->getMessage();
                $response = ['success' => false, 'error' => 'Failed to add budget'];
            } finally {
                header('Content-Type: application/json');
                echo json_encode($response);
            }
        } else {
            echo 'Invalid request method.';
        } 
    }

    public function editBudget($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sanitizer = new Sanitize();
            $arr = [];
            foreach($_POST as $key => $value) {
                if (is_string($value)) {
                    $value = $sanitizer->sanitize_input($value);
                }
                $arr[$key] = $value;
            }
            try {
                $arr['attachment'] = "";
                $this->update($id, $arr['account'], $arr['in_out'], $arr['category'], $arr['amount'], $arr['datetime'], $arr['note'], $arr['desc'], $arr['attachment']);
                $response = ['success' => true];
            } catch (Exception $e) {
                echo $e->getMessage();
                $response = ['success' => false];
            } finally {
                header('Content-Type: application/json');
                echo json_encode($response);
            }
        } else {
            echo 'Invalid request method.';
        } 
    }

    public function deleteBudget($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->delete($id);
                $response = ['success' => true];
            } catch (Exception $e) {
                echo $e->getMessage();
                $response = ['success' => false];
            } finally {
                header('Content-Type: application/json');
                echo json_encode($response);
            }
        } else {
            echo 'Invalid request method.';
        } 
    }

    public function getStatsTimeframe($in_out, $from, $to) {
        header('Content-Type: application/json');
        $item = $this->statsTimeframe($in_out, $from, $to);
        if ($item) {
           echo json_encode($item);
        } else {
            echo json_encode(["error" => "No budget found"]);
        }
    }
}
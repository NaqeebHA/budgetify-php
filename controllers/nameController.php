<?php

class NameController {
    private function determineTable($table) {
        switch($table) {
            case 'account' :
                return new Account();
                break;
            case 'brand' :
                return new Brand();
                break;
            case 'style' :
                return new Style();
                break;
            default:
                 json_encode(['error' => 'Invalid entity!']);
                exit;
        }
    }

    public function getAll($table) {
        $entity = $this->determineTable($table);

        try {
            $result = $entity->all();
            header('Content-Type: application/json');
            echo json_encode($result);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
        
    }

    public function add($table) {
        $entity = $this->determineTable($table);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize and validate input
            $sanitized_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $sanitizer = new Sanitize();
            $name = $sanitizer->sanitize_input($sanitized_name);
            $name = strtoupper($name);
            // Example validation
            if (empty($name)) {
                echo json_encode(['error' => 'Please fill in all fields.']);
            } else {
                // Process the data (e.g., save to database, send email, etc.)
                $entity->add($name);
                $response = ['success' => true];
                header('Content-Type: application/json');
                echo json_encode($response);
            }
        } else {
            echo json_encode(['error' => 'Invalid request method.']);
        } 
    }

    public function update($table, $id) {
        $entity = $this->determineTable($table);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['name'])) {
                try {
                    $entity->update($id, $_POST['name']);
                    $response = ['success' => true];
                } catch (Exception $e) {
                    $response = ['error' => $e->getMessage()];
                } finally {
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
            } else {
                echo json_encode(['error' => "No $table name set"]);
            }
        } else {
            echo json_encode(['error' => 'Invalid request method.']);
        } 
    }

    public function delete($table, $id) {
        $entity = $this->determineTable($table);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $entity->delete($id);
                $response = ['success' => true];
            } catch (Exception $e) {
                $response = ['error' => $e->getMessage()];
            } finally {
                header('Content-Type: application/json');
                echo json_encode($response);
            }
        } else {
            echo json_encode(['error' => 'Invalid request method.']);
        } 
    }
}
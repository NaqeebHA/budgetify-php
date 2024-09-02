<?php

class CategoryController extends Category {

    public function getAll() {
        try {
            $result = $this->all();
        header('Content-Type: application/json');
        echo json_encode($result);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }  
    }

    public function getOut() {
        try {
            $result = $this->out();
        header('Content-Type: application/json');
        echo json_encode($result);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }  
    }

    public function getIn() {
        try {
            $result = $this->in();
        header('Content-Type: application/json');
        echo json_encode($result);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }  
    }

    public function createCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize and validate input
            $sanitized_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $sanitizer = new Sanitize();
            $name = $sanitizer->sanitize_input($sanitized_name);
            $name = strtoupper($name);
            $in_out = $_POST['in_out'];
            // Example validation
            if (empty($name)) {
                echo 'Please fill in all fields.';
            } else {
                // Process the data (e.g., save to database, send email, etc.)
                $this->add($name, $in_out);
                $response = ['success' => true];
                header('Content-Type: application/json');
                echo json_encode($response);
            }
        } else {
            echo 'Invalid request method.';
        } 
    }
}
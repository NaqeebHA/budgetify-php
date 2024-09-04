<?php

class ApparelController extends Apparel {
    public function getAll() {
        header('Content-Type: application/json');
        $item = $this->all();
        if ($item) {
           echo json_encode($item);
        } else {
            echo json_encode(["error" => "No apparel found"]);
        }
    }

    public function getAllByType($id) {
        header('Content-Type: application/json');
        $item = $this->byType($id);
        if ($item) {
           echo json_encode($item);
        } else {
            echo json_encode(["error" => "No apparel found for this type"]);
        }
    }

    public function getOne($id) {
        header('Content-Type: application/json');
        $item = $this->one($id);
        if ($item) {
           echo json_encode($item);
        } else {
            echo json_encode(["error" => "No apparel with id=$id found"]);
        }    
    }

    public function deleteApparel($id) {
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

    public function getTypeStatsTimeframe($type_id, $from, $to) {
        header('Content-Type: application/json');
        $item = $this->byTypeStatsTimeframe($type_id, $from, $to);
        if ($item) {
           echo json_encode($item);
        } else {
            echo json_encode(["error" => "No apparel found"]);
        }
    }

    public function addApparel() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $attachment = NULL;
            //process attachment
            if(isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
                $target_dir = "./uploads/";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $fileName = basename($_FILES["attachment"]["name"]);
                $target_file = $target_dir . $fileName;
                $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
                $allowedTypes = array('jpg', 'jpeg', 'png', 'gif', 'jfif');
                if(in_array(strtolower($fileType), $allowedTypes)) {
                    if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
                        $attachment = './uploads/' . $fileName;
                    } else {
                        echo json_encode(['error' => 'Failed to upload attachment']);
                        exit;
                    }
                } else {
                    echo json_encode(['error' => 'Invalid attachment type']);
                    exit;
                }
            }

            $sanitizer = new Sanitize();
            $arr = [];
            foreach($_POST as $key => $value) {
                if (is_string($value)) {
                    $value = $sanitizer->sanitize_input($value);
                }
                $arr[$key] = $value;
            }
            try {
                $this->add($arr['name'], $arr['type'], $arr['color'], $arr['date'], $arr['qty'], $arr['price'], $arr['brand'], $arr['style'], $arr['desc'], $attachment, $arr['budget']);
                $response = ['success' => true];
            } catch (Exception $e) {
                echo $e->getMessage();
                $response = ['error' => 'Failed to add Apparel'];
            } finally {
                header('Content-Type: application/json');
                echo json_encode($response);
            }
        } else {
            echo 'Invalid request method.';
        } 
    } 

    public function editApparel($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $attachment = NULL;
            //process attachment
            if(isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
                $target_dir = "./uploads/";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $fileName = basename($_FILES["attachment"]["name"]);
                $target_file = $target_dir . $fileName;
                $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
                $allowedTypes = array('jpg', 'jpeg', 'png', 'gif', 'jfif');
                if(in_array(strtolower($fileType), $allowedTypes)) {
                    if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
                        $attachment = './uploads/' . $fileName;
                    } else {
                        echo json_encode(['error' => 'Failed to upload attachment']);
                        exit;
                    }
                } else {
                    echo json_encode(['error' => 'Invalid attachment type']);
                    exit;
                }
            }

            $sanitizer = new Sanitize();
            $arr = [];
            foreach($_POST as $key => $value) {
                if (is_string($value)) {
                    $value = $sanitizer->sanitize_input($value);
                }
                $arr[$key] = $value;
            }
            try {
                if ($attachment != NULL) {
                    $this->update($id, $arr['name'], $arr['type'], $arr['color'], $arr['date'], $arr['qty'], $arr['price'], $arr['brand'], $arr['style'], $arr['desc'], $attachment, $arr['budget']);
                } else {
                    $this->updateWithoutAttachment($id, $arr['name'], $arr['type'], $arr['color'], $arr['date'], $arr['qty'], $arr['price'], $arr['brand'], $arr['style'], $arr['desc'], $arr['budget']);
                }
                $response = ['success' => true];
            } catch (Exception $e) {
                echo $e->getMessage();
                $response = ['error' => 'Failed to add Apparel'];
            } finally {
                header('Content-Type: application/json');
                echo json_encode($response);
            }
        } else {
            echo 'Invalid request method.';
        } 
    }

    public function removeAttachment($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->deleteAttachment($id);
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
}
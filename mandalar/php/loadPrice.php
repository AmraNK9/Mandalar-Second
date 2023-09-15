<?php
include_once __DIR__ . "/../model/post.php";
$Post_model = new Post();
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    if ($_POST['type'] == 'cat') {
        $result = $Post_model->load_min_max_Price_with_category($id);
        echo json_encode($result);
    } else if ($_POST['type'] == 'sub') {
        $result = $Post_model->load_min_max_price($id);
        echo json_encode($result);
    } else if($_POST['type'] == 'all'){
        $result = $Post_model->load_max_price();
        echo json_encode($result);
    }

}
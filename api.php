<?php
header('Content-Type: application/json');
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header('Content-Type: application/json'); // Указываем JSON
    
    $name = $_POST["name"] ?? null;
    $phone = $_POST["phone"] ?? null;
    $aff_click_id = $_POST["aff_click_id"] ?? null;
    $sub_id1 = $_POST["sub_id1"] ?? "default_traffic";
    $sub_id2 = $_POST["sub_id2"] ?? null;
    $custom1 = $_POST["custom1"] ?? null;

    if (!$name || !$phone || !$aff_click_id) {
        echo json_encode(["error" => "Заповніть всі обов'язкові поля"]);
        http_response_code(400);
        exit;
    }

    $postData = array_filter([
        "goal_id" => 83,
        "sub_id1" => $sub_id1,
        "sub_id2" => $sub_id2,
        "aff_click_id" => $aff_click_id,
        "firstname" => $name,
        "phone" => $phone,
        "custom1" => $custom1,
    ]);

    $url = "https://tracking.affscalecpa.com/api/v2/affiliate/leads?api-key=adsbdb45dhnjcbd4567ghjdd";
    $options = [
        "http" => [
            "header" => "Content-Type: application/json\r\n",
            "method" => "POST",
            "content" => json_encode($postData),
        ],
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if ($response === FALSE) {
        echo json_encode(["error" => "Помилка відправки"]);
        http_response_code(500);
    } else {
        echo json_encode(["success" => "Дані успішно відправлені!", "response" => json_decode($response)]);
    }
}
?>

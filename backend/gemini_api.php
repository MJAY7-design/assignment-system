<?php

// 🔹 Call Gemini API safely
function callGemini($text, $model, $apiKey){

    $url = "https://generativelanguage.googleapis.com/v1beta/models/$model:generateContent?key=" . $apiKey;

    $data = [
        "contents" => [
            [
                "parts" => [
                    [
                        "text" => "You are a lecturer. Give short constructive feedback for this student work:\n" . $text
                    ]
                ]
            ]
        ]
    ];

    $options = [
        "http" => [
            "header"  => "Content-Type: application/json\r\n",
            "method"  => "POST",
            "content" => json_encode($data),
            "ignore_errors" => true,
            "timeout" => 3   // 🔥 prevents slow loading
        ]
    ];

    $context = stream_context_create($options);
    $result = @file_get_contents($url, false, $context);

    // ❌ Connection issue
    if ($result === FALSE) {
        return null;
    }

    $response = json_decode($result, true);

    // ❌ API error
    if (isset($response['error'])) {
        return null;
    }

    // ✅ Success
    if (isset($response['candidates'][0]['content']['parts'][0]['text'])) {
        return trim($response['candidates'][0]['content']['parts'][0]['text']);
    }

    return null;
}


// 🔹 Main feedback generator
function generateFeedback($text) {

    // 🔑 PUT YOUR REAL API KEY HERE

    $apiKey =  "AIzaSyDOe2NIh9CYzekuL62d7Q71WjNEIdzme78";
    

    // 🔥 STABLE WORKING MODEL
    $model = "gemini-1.5-flash";

    $result = callGemini($text, $model, $apiKey);

    // ✅ If API worked → return AI feedback
    if ($result !== null) {
        return $result;
    }

    // 🔥 ALWAYS fallback (NO "AI disabled")
    return fallbackFeedback($text);
}


// 🔹 Backup feedback system (ALWAYS WORKS)
function fallbackFeedback($text){

    $length = strlen(trim($text));

    if ($length < 50) {
        return "Your submission is too brief. Please add more explanation and detail.";
    } elseif ($length < 150) {
        return "Good attempt. Try to expand your explanation and include examples.";
    } else {
        return "Well explained. Consider improving structure and adding deeper insights.";
    }
}

?>
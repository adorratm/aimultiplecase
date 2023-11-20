<?php

/**
 * Here is my XSS Clean function to prevent XSS attacks, I use this function in my projects. But I don't use this function in this project.
 * My github account is here: https://github.com/adorratm
 * */

function clean($data)
{
    // Fix &entity\n;
    if (!empty($data)) :
        $data = str_replace(['&amp;', '&lt;', '&gt;'], ['&amp;amp;', '&amp;lt;', '&amp;gt;'], $data);

        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

        // Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

        // Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

        // Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

        do {
            // Remove really unwanted tags
            $old_data = $data;
            $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        } while ($old_data !== $data);
        $data = htmlspecialchars(addslashes(strip_tags(trim($data))), ENT_QUOTES, 'UTF-8');
        return $data;
    endif;
    // we are done...
    return null;
}

function simple_clean($data)
{
    $data = htmlspecialchars(addslashes(strip_tags(trim($data))), ENT_QUOTES, 'UTF-8');
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $number1 = floatval(simple_clean($_POST["number1"])); // simple_clean() is used to prevent XSS attacks
    $number2 = floatval(simple_clean($_POST["number2"])); // simple_clean() is used to prevent XSS attacks
    $operator = simple_clean($_POST["operator"]); // simple_clean() is used to prevent XSS attacks

    switch ($operator) {
        case "add":
            $result = bcadd($number1, $number2); // bcadd() is used to prevent integer overflow
            break;
        case "subtract":
            $result = bcsub($number1, $number2); // bcsub() is used to prevent integer overflow
            break;
        case "multiply":
            $result = bcmul($number1, $number2); // bcmul() is used to prevent integer overflow
            break;
        case "divide" && $number2 != 0:
            $result = bcdiv($number1, $number2); // bcdiv() is used to prevent integer overflow
            break;
        case "percentage" && $number2 != 0:
            $result = bcmod($number1, $number2); // bcmod() is used to prevent integer overflow
            break;
        default:
            $result = "Invalid operator";
            break;
    }

    echo $result;
}

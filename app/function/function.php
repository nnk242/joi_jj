<?php
// Mở composer.json
// Thêm vào trong "autoload" chuỗi sau
// "files": [
//         "app/function/function.php"
// ]
// Chạy cmd : composer  dumpautoload
function stripUnicode($str)
{
    if (!$str) return '';
    //$str = str_replace($a, $b, $str);
    $unicode = array(
        'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|å|ä|æ|ā|ą|ǻ|ǎ',
        'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|Å|Ä|Æ|Ā|Ą|Ǻ|Ǎ',
        'ae' => 'ǽ',
        'AE' => 'Ǽ',
        'c' => 'ć|ç|ĉ|ċ|č',
        'C' => 'Ć|Ĉ|Ĉ|Ċ|Č',
        'd' => 'đ|ď',
        'D' => 'Đ|Ď',
        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|ë|ē|ĕ|ę|ė',
        'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ë|Ē|Ĕ|Ę|Ė',
        'f' => 'ƒ',
        'F' => '',
        'g' => 'ĝ|ğ|ġ|ģ',
        'G' => 'Ĝ|Ğ|Ġ|Ģ',
        'h' => 'ĥ|ħ',
        'H' => 'Ĥ|Ħ',
        'i' => 'í|ì|ỉ|ĩ|ị|î|ï|ī|ĭ|ǐ|į|ı',
        'I' => 'Í|Ì|Ỉ|Ĩ|Ị|Î|Ï|Ī|Ĭ|Ǐ|Į|İ',
        'ij' => 'ĳ',
        'IJ' => 'Ĳ',
        'j' => 'ĵ',
        'J' => 'Ĵ',
        'k' => 'ķ',
        'K' => 'Ķ',
        'l' => 'ĺ|ļ|ľ|ŀ|ł',
        'L' => 'Ĺ|Ļ|Ľ|Ŀ|Ł',
        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|ö|ø|ǿ|ǒ|ō|ŏ|ő',
        'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|Ö|Ø|Ǿ|Ǒ|Ō|Ŏ|Ő',
        'Oe' => 'œ',
        'OE' => 'Œ',
        'n' => 'ñ|ń|ņ|ň|ŉ',
        'N' => 'Ñ|Ń|Ņ|Ň',
        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|û|ū|ŭ|ü|ů|ű|ų|ǔ|ǖ|ǘ|ǚ|ǜ',
        'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|Û|Ū|Ŭ|Ü|Ů|Ű|Ų|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ',
        's' => 'ŕ|ŗ|ř',
        'R' => 'Ŕ|Ŗ|Ř',
        's' => 'ß|ſ|ś|ŝ|ş|š',
        'S' => 'Ś|Ŝ|Ş|Š',
        't' => 'ţ|ť|ŧ',
        'T' => 'Ţ|Ť|Ŧ',
        'w' => 'ŵ',
        'W' => 'Ŵ',
        'y' => 'ý|ỳ|ỷ|ỹ|ỵ|ÿ|ŷ',
        'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ|Ÿ|Ŷ',
        'z' => 'ź|ż|ž',
        'Z' => 'Ź|Ż|Ž'
    );
    foreach ($unicode as $khongdau => $codau) {
        $arr = explode("|", $codau);
        $str = str_replace($arr, $khongdau, $str);
    }
    return $str;
}

//chang title
function changeTitle($str, $strSymbol = '-', $case = MB_CASE_LOWER)
{// MB_CASE_UPPER / MB_CASE_TITLE / MB_CASE_LOWER
    $str = trim($str);
    if ($str == "") return "";
    $str = str_replace('"', '', $str);
    $str = str_replace("'", '', $str);
    $str = stripUnicode($str);
    $str = mb_convert_case($str, $case, 'utf-8');
    $str = preg_replace('/[\W|_]+/', $strSymbol, $str);
    $last_str = substr($str, -1);
    rtrim($str, "-");
    if ($last_str === "-") {
        $string = rtrim($str, "-");
    } else $string = $str;
    return $string . '.html';
}

//category story
function str_seo_m($str, $strSymbol = '-', $case = MB_CASE_LOWER)
{// MB_CASE_UPPER / MB_CASE_TITLE / MB_CASE_LOWER
    $str = trim($str);
    if ($str == "") return "";
    $str = str_replace('"', '', $str);
    $str = str_replace("'", '', $str);
    $str = stripUnicode($str);
    $str = mb_convert_case($str, $case, 'utf-8');
    $str = preg_replace('/[\W|_]+/', $strSymbol, $str);
    $last_str = substr($str, -1);
    rtrim($str, "-");
    if ($last_str === "-") {
        $string = rtrim($str, "-");
    } else $string = $str;
    return $string;
}

//config time
function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    $string = array(
        'y' => 'Năm',
        'm' => 'Tháng',
        'w' => 'Tuần',
        'd' => 'Ngày',
        'h' => 'Giờ',
        'i' => 'Phút',
        's' => 'giây',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' trước' : 'Bây giờ';
}

function post_views($view)
{
    if ($view < 1000) {
        return $view;
    } elseif ($view >= 1000) {
        $k = round((floor($view / 10) * 10) / 1000, 2) . ' k';
        return $k;
    } elseif ($view >= 1000000) {
        $m = round((floor($view / 10000) * 10) / 1000, 2) . ' m';
        return $m;
    } elseif ($view >= 1000000000) {
        $b = round((floor($view / 10000000) * 10) / 1000, 2) . ' b';
        return $b;
    } else {
        return 0;
    }
}

function dayofweed($number)
{
    switch ($number) {
        case 0:
            return "Chủ nhật";
            break;
        case 1:
            return "Thứ hai";
            break;
        case 2:
            return "Thứ ba";
            break;
        case 3:
            return "Thứ tư";
            break;
        case 4:
            return "Thứ năm";
            break;
        case 5:
            return "Thứ sáu";
            break;
        case 6:
            return "Thứ bảy";
            break;
        default: return null;
    }
}

function randomGen($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}


function compress($source, $destination, $quality)
{

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
}
?>
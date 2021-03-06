<?php
namespace wapmorgan\PhpCodeFixer;

function preg_replace_e_modifier(array $usage_tokens) {
    $tree = PhpCodeFixer::makeFunctionCallTree($usage_tokens);
    $data = PhpCodeFixer::delimByComma($tree[0]);
    $data = PhpCodeFixer::trimSpaces($data[0]);

    // getting delimiter
    if ($data[0][0] == T_CONSTANT_ENCAPSED_STRING) {
        $string = trim($data[0][1], '\'"');
        $delimiter = $string{0};
        if ($data[count($data)-1][0] == T_CONSTANT_ENCAPSED_STRING) {
            $string = trim($data[count($data)-1][1], '\'"');
            if (($modificator = strrchr($string, $delimiter)) !== false) {
                if (strpos($modificator, 'e') !== false) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }

    return false;
}
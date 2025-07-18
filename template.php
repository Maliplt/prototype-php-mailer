<?php

function replaceTemplateKeys($templateContent, $customerData) {
    $replacements = [
        '<f_yetkili>' => $customerData['f_yetkili'],
        '<f_ad>' => $customerData['f_ad'],
        // ekle
    ];

    foreach ($replacements as $key => $value) {
        $templateContent = str_replace($key, $value, $templateContent);
    }

    return $templateContent;
}

?>

<?php
// app/Helpers/DateHelper.php

if (!function_exists('thaiDate')) {
    function thaiDate($date) {
        $strMonth = [
            "01" => "มกราคม",
            "02" => "กุมภาพันธ์",
            "03" => "มีนาคม",
            "04" => "เมษายน",
            "05" => "พฤษภาคม",
            "06" => "มิถุนายน",
            "07" => "กรกฎาคม",
            "08" => "สิงหาคม",
            "09" => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม"
        ];

        $strDay = date("j", strtotime($date));
        $strMonthThai = $strMonth[date("m", strtotime($date))];
        $strYear = date("Y", strtotime($date)) + 543;

        return "$strDay $strMonthThai $strYear";
    }
}
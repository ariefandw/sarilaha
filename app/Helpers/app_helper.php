<?php
use CodeIgniter\I18n\Time;
use Google\Client;

function createPagination($pager)
{
    $str = $pager->links();
    $str = str_replace('<li class="active">', '<li class="page-item active">', $str);
    $str = str_replace('<li >', '<li class="page-item">', $str);
    $str = str_replace('<a ', '<a class="page-link" ', $str);
    return $str;
}

function activeMenu($route)
{
    return site_url($route) == current_url() ? 'active' : '';
}

function format_date($dateString, $format = 'j F Y, H:i')
{
    if (!empty($dateString)) {
        $time = Time::createFromFormat('Y-m-d H:i:s', $dateString, 'UTC');
        $time->setTimezone('Asia/Jakarta');

        $formattedDate = $time->format($format);

        $indonesianMonths = [
            1  => 'Januari',
            2  => 'Februari',
            3  => 'Maret',
            4  => 'April',
            5  => 'Mei',
            6  => 'Juni',
            7  => 'Juli',
            8  => 'Agustus',
            9  => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $formattedDate = str_replace(
            date('F'),
            $indonesianMonths[TIme::createFromFormat('F', date('F'))->format('n')],
            $formattedDate
        );

        return $formattedDate;
    }
    return null;
}

function now($format = 'Y-m-d h:i:s')
{
    $db               = \Config\Database::connect();
    $current_datetime = $db->query("SELECT NOW() AS current_datetime")->getRow()->current_datetime;
    $datetime         = new DateTime($current_datetime);
    $formattedDate    = $datetime->format($format);
    return $formattedDate;
}

function calculateGrade($score)
{
    if ($score <= 25) {
        return 'E';
    } elseif ($score <= 30) {
        return 'D';
    } elseif ($score <= 35) {
        return 'D+';
    } elseif ($score <= 45) {
        return 'C/D';
    } elseif ($score <= 50) {
        return 'C-';
    } elseif ($score <= 55) {
        return 'C+';
    } elseif ($score <= 60) {
        return 'B/C';
    } elseif ($score <= 65) {
        return 'B-';
    } elseif ($score <= 70) {
        return 'B';
    } elseif ($score <= 75) {
        return 'B+';
    } elseif ($score <= 80) {
        return 'A/B';
    } elseif ($score <= 85) {
        return 'A-';
    } else {
        return 'A';
    }
}
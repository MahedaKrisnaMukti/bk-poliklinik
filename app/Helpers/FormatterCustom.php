<?php

namespace App\Helpers;

class FormatterCustom
{
    /**
     * Format date helper.
     *
     * @param  $date
     * @return String
     */
    public static function formatDate($date)
    {
        if ($date != null) {
            $date = date('d F Y', strtotime($date));
            $date = self::changeMonthIndo($date);

            return $date;
        }

        return null;
    }

    /**
     * Change month helper.
     *
     * @param  $date
     * @return String
     */
    public static function changeMonthIndo($date)
    {
        $date = str_replace('January', 'Januari', $date);
        $date = str_replace('February', 'Februari', $date);
        $date = str_replace('March', 'Maret', $date);
        $date = str_replace('April', 'April', $date);
        $date = str_replace('May', 'Mei', $date);
        $date = str_replace('June', 'Juni', $date);
        $date = str_replace('July', 'Juli', $date);
        $date = str_replace('August', 'Agustus', $date);
        $date = str_replace('September', 'September', $date);
        $date = str_replace('October', 'Oktober', $date);
        $date = str_replace('November', 'November', $date);
        $date = str_replace('December', 'Desember', $date);

        return $date;
    }

    /**
     * Format number helper.
     *
     * @param  $number
     * @param  $prefix
     * @return String
     */
    public static function formatNumber($number, $prefix = false)
    {

        if ($number == 0) {
            if ($prefix) {
                return 'Rp. ' . number_format($number, 0, ",", ".");
            } else {
                return number_format($number, 0, ",", ".");
            }
        } else if ($number != null) {
            if ($prefix) {
                return 'Rp. ' . number_format($number, 0, ",", ".");
            } else {
                return number_format($number, 0, ",", ".");
            }
        } else {
            return null;
        }
    }

    /**
     * Format float helper.
     *
     * @param  $number
     * @param  $prefix
     * @return String
     */
    public static function formatFloat($number, $prefix = false)
    {
        if ($number == 0) {
            if ($prefix) {
                return 'Rp. ' . number_format($number, 2, ",", ".");
            } else {
                return number_format($number, 2, ",", ".");
            }
        } else if ($number != null) {
            if ($prefix) {
                return 'Rp. ' . number_format($number, 2, ",", ".");
            } else {
                return number_format($number, 2, ",", ".");
            }
        } else {
            return null;
        }
    }

    /**
     * Format number helper.
     *
     * @param  $number
     * @return String
     */
    public static function parseInteger($number)
    {
        $number = str_replace('.', '', $number);

        return $number;
    }
}

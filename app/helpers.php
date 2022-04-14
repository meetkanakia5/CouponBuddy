<?php
    
    if (!function_exists('img_upload')) {
        function img_upload($file, $path, $file_prefix = null) {
            $name = img_unique_name($file_prefix) . '.' . $file->getClientOriginalExtension();
            $file->move($path, $name);
            return $path . '/' . $name;
        }
    }

    if (!function_exists('img_unique_name')) {
        function img_unique_name($file_prefix) {
            if (!isset($file_prefix)) {
                $file_prefix = env('APP_NAME');
                $file_prefix .= '-';
            }
            
            $unique_string = uniqid($file_prefix, true);
            $str = "1234567890abcdefghijklmnopqrstuvwxyz()$";
            $rand_string = substr(str_shuffle($str), 0, 8);
            $unique_string .= $rand_string;
            return $unique_string;
        }
    }

    if (!function_exists('img_image')) {
        function img_image($value) {
            if (isset($value))
                return asset($value);
            else
                return asset('backend/img/no-image.png');
        }
    }

    if (!function_exists('pdf_upload')) {
        function pdf_upload($file, $path, $file_prefix = null) {
            $name = $file_prefix.'.pdf';
            $file->move($path, $name);
            return $path . '/' . $name;
        }
    }
?>
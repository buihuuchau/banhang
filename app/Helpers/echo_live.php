<?php
    if (!function_exists('tuoi')) {
        function tuoi($old)
        {
            return 'So tuoi la ' . $old . '.';
        }
    }
    if (!function_exists('live')) {
        function live($live)
        {
            return $live . ' year old.';
        }
    }

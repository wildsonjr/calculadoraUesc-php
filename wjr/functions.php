<?php

if (!function_exists('array_get'))
{
    /**
     * 
     * @param type $array
     * @param type $key
     * @return null 
     */
    function array_get($array, $key)
    {
        if ((is_array($array) || (is_string($array) && is_int($key))) && isset($array[$key]))
        {
            return $array[$key];
        }
        return null;
    }
}

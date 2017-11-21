<?php  

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('css_url'))
{
    function css_url($name)
    {
        return base_url() . 'assets/css/' . $name . '.css';
    }
}

if ( ! function_exists('css_url_lib'))
{
    function css_url_lib($name)
    {
        return base_url() . 'assets/css/lib/' . $name . '.css';
    }
}

if ( ! function_exists('js_url'))
{
    function js_url($name)
    {
        return base_url() . 'assets/js/' . $name . '.js';
    }
}

if ( ! function_exists('js_url_lib'))
{
    function js_url_lib($name)
    {
        return base_url() . 'assets/js/lib/' . $name . '.js';
    }
}

if ( ! function_exists('img_url'))
{
    function img_url($name)
    {
        echo base_url() . 'assets/img/' . $name;
    }
}

if ( ! function_exists('img'))
{
    function img($name, $alt = '')
    {
        return '<img src="' . img_url($name) . '" alt="' . $alt . '" />';
    }
}
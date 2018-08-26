<?php

class Allocator
{
    public static function allocate_model($_model)
    {
        if ($_model !== '' && $_model !== null){
            allocate(MODEL, $_model);
            return new $_model();
        }
        return null;
    }
    public static function allocate_phpbehind($_phpbehind)
    {
        if ($_phpbehind !== '' && $_phpbehind !== null){
            allocate(PHPBEHIND, $_phpbehind);
            return new $_phpbehind();
        }
        return null;
    }
    public static function allocate_jsbehind($jsbehind)
    {
        allocate(JSBEHIND, $jsbehind);
    }
    public static function allocate_layout($_layout, $viewbag)
    {
        $input = file_get_contents(string_for_allocate_file(LAYOUT, $_layout));
        $input = trim(str_replace("\r\n", "", $input));
        if (!empty($input)){
            self::allocate_helper('HtmlParserHelper');
            HtmlParserHelper::LoadHtmlFromString($input);
            HtmlParserHelper::Binding($viewbag);
            HtmlParserHelper::RunHtml();
        }else{
            allocate(LAYOUT, $_layout, $viewbag::getBag());
        }
    }
    public static function allocate_helper($helper)
    {
        if ($helper !== '' && $helper !== null){
            allocate(HELPERS, $helper);
            if (class_exists($helper))
                return new $helper();
        }
        return null;
    }
    public static function allocate_library($library)
    {
        if ($library !== '' && $library !== null){
            allocate(LIBRARIES, $library);
            if (class_exists($library))
                return new $library();
        }
        return null;
    }
    public static function allocate_css($css)
    {
        if ($css !== '' && $css !== null)
            if (filter_var($css, FILTER_VALIDATE_URL))
                return '<link rel="stylesheet" type="text/css" href="'.$css.'" >';
            else
                if (can_allocate(CSS, $css))
                    return '<link rel="stylesheet" type="text/css" href="'.string_for_allocate_file(CSS, $css).'" />';
        return '';
    }
    public static function allocate_js($js)
    {
        if ($js !== '' && $js !== null)
            if (filter_var($js, FILTER_VALIDATE_URL))
                return '<script src="'.$js.'" ></script>';
            else
                if (can_allocate(JS, $js))
                    return '<script src="'.string_for_allocate_file(JS, $js).'" ></script>';

        return '';
    }
    public static function allocate_jquery()
    {
        global $jquery_url;
        return Allocator::allocate_js($jquery_url);
    }
}
<?php
if (!function_exists('_hash_')){
    function _hash_($subject){
        return hash('md5', config_item('encryption_key') . $subject);
    }
}
if (!function_exists('breadcumb')){
    function breadcrumb($pages, $showServerTime=FALSE){
        $str = '<ol class="breadcrumb">';
        
        if (is_array($pages)){
            if ($showServerTime){
                $new_bc = array (array('title'=> date('D, dMY H:i:s')));
                array_splice($pages, 0,0, $new_bc);
            }
            foreach ($pages as $page){
                $active = (isset($page['active'])&&$page['active']==TRUE);
                $str.= '<li';
                if ($active)
                    $str.= ' class="active"';
                        
                $str.= '>';
                if (isset($page['link']))
                    $str.= '<a href="'.$page['link'].'">'. $page['title'].'</a>';
                else
                    $str.= $page['title'];
                
                
                $str.= '</li>';
            }
        }
        else
        {
            $str.= '<li>'.$page.'</li>';
        }
        $str.= '</ol>';
        return $str;
    }
}
if (!function_exists('breadcumb_add')){
    function breadcumb_add(&$breadcumb,$title,$link=NULL,$active=FALSE){
        if (is_array($breadcumb)){
            $item = array('title'=>$title, 'active'=>$active);
            if ($link){
                $item['link'] = $link;
            }
            $breadcumb [] = $item;
        }
    }
}
if (!function_exists('create_alert_box')){
    function create_alert_box($alert_text, $alert_type=NULL, $alert_title=NULL, $autohide=TRUE, $secs=6000){
        $type_labels = array(
            'default' => 'Information', 'info'=>'Information', 'success'=>'Successfull', 
            'warning'=>'Warning', 'danger'=>'Danger', 'error'=>'Error'
        );
        $type_alerts = array(
            'default'=>'alert-info', 'info'=>'alert-info', 'success'=>'alert-success', 
            'warning'=>'alert-warning', 'danger'=>'alert-danger', 'error'=>'alert-danger'
        );
        $s = '<div class="alert '.(isset($type_alerts[$alert_type])?$type_alerts[$alert_type]:$type_alerts['default']).' alert-dismissible" role="alert">';
        //button dismiss
        $s.= '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
        //Label in bold
        $s.= '<strong>'. ($alert_title?$alert_title:(isset($type_labels[$alert_type])?$type_labels[$alert_type]:$type_labels['default']).'!').'</strong> ';
        //Alert text
        $s.= $alert_text;
        $s.= '</div>';
        
        //add js to hide automatically
        if ($autohide){
            $s.= PHP_EOL . '<script>setTimeout(function(){$(".alert-dismissible").fadeOut("slow");},'.$secs.');</script>';
        }
        
        return $s;
    }
}
if (!function_exists('get_list_month')){
    function get_list_month($tipe='long'){
        $short = array(1=>'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nop', 'Des');
        $long = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember');
        
        if ($tipe == 'long'){
            return $long;
        }else{
            return $short;
        }
    }
}
if (!function_exists('get_month_name')){
    function get_month_name($bulan,$tipe='long'){
        $short = array(1=>'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nop', 'Des');
        $long = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember');
        
        if ($tipe == 'long'){
            return $long[$bulan];
        }else{
            return $short[$bulan];
        }
    }
}
if (!function_exists('get_list_year')){
    function get_list_year(){
        $range_years = range(2004, date('Y'), 1);
        //sort from highest to lowest
        rsort($range_years);
        
        return $range_years;
    }
}
if (!function_exists('get_asset_url')){
    function get_asset_url($filename=NULL){
        $base_assets = config_item('assets_path');
        if (!$filename){
            return site_url($base_assets) . '/';
        }else{
            return site_url($base_assets . $filename);
        }
    }
}
if (!function_exists('get_plugin_url')){
    function get_plugin_url($filename=NULL){
        $base_assets = config_item('plugins_path');
        if (!$filename){
            return site_url($base_assets) . '/';
        }else{
            return site_url($base_assets . $filename);
        }
    }
}
if (!function_exists('get_action_url')){
    function get_action_url($filename=NULL){
        if (!$filename){
            return site_url() ;
        }else{
            return site_url($filename);
        }
    }
}
if (!function_exists('array_submits')){
    function array_submits($keys, $posts){
        $data = array();
        foreach (explode(',', $keys) as $key){
            $data[$key] = isset($posts[$key])?$posts[$key] : NULL;
        }
        
        return $data;
    }
}
if (!function_exists('variable_type_cast')){
    function variable_type_cast($value, $type='string', $list=FALSE){
        if ($list){
            $value = explode(',', $value);
            $result = array();
            foreach ($value as $val){
                switch ($type){
                    case 'integer': $result[] = intval($val); break; 
                    case 'numeric': $result [] = floatval($val); break;
                    case 'boolean': $result[] = boolval($val); break;
                    default : $result[] = strval($val);
                }
            }
            
            return $result;
        }else{
            switch ($type){
                case 'integer': return intval($value); 
                case 'numeric': return floatval($value);
                case 'boolean': return boolval($value);
                default : return strval($value);
            }
        }
    }
}
if (!function_exists('draw_menus')){
    function draw_menus($mainmenus, $active_menu=NULL, $level=0){
        if (!$mainmenus || !is_array($mainmenus)){
            return '';
        }
        $str = '';
        foreach ($mainmenus as $menu){
            $caption = $level==0 ? strtoupper($menu->caption) : ($level==1 ? ucfirst($menu->caption) : $menu->caption);
            $str.= '<li data-id="'.$menu->id.'" data-menu-active="'.$active_menu->id.'" data-level="'.$level.'" '.($active_menu ? ($menu->id==$active_menu->id||$menu->id==$active_menu->parent?'class="active"':''):'').'>';
            if (isset($menu->children) && $menu->children){
                $str.= '<a href="#" class="js-sub-menu-toggle" '.($menu->title?' title="'.$menu->title.'"':'').'>';
                $str.= ($menu->icon ? '<i class="fa '.$menu->icon.' fa-fw"></i>':'').'<span class="text">'.$caption.'</span>';
                $str.= '<i class="toggle-icon fa '.($active_menu?($menu->id==$active_menu->id||$menu->id==$active_menu->parent?'fa-angle-down':'fa-angle-left'):'fa-angle-left').'"></i>';
                $str.= '</a>';
                $str.= '<ul class="sub-menu '.($active_menu ? ($menu->id==$active_menu->id||$menu->id==$active_menu->parent?'open':''):'').'">';
                $str.= draw_menus($menu->children, $active_menu, $level+1);
                $str.= '</ul>';
            }else{
                $str.= '<a href="'.($menu->link ? get_action_url($menu->link):'#').'"'.($menu->title?' title="'.$menu->title.'"':'').'>'.($menu->icon ? '<i class="fa '.$menu->icon.' fa-fw"></i>':'').'<span class="text">'.$caption.'</span></a>';
            }
            $str.= '</li>';
        }
        
        return $str;
    }
}
if (!function_exists('number_parse')){
    function number_parse($value_string){
        if (strpos($value_string, '(')!==FALSE){
            $value_string = '-'. str_replace(array('(',')'), '', $value_string);
        }
        return preg_replace("/([^0-9\\.-])/i", "", $value_string);
    }
}
if (!function_exists('set_url_back')){
    function set_url_back($url){
        $url_string = urlencode(base64_encode($url));
        
        return $url_string;
    }
}
if (!function_exists('get_url_back')){
    function get_url_back($url){
        $url_back = base64_decode(urldecode($url));
        
        return $url_back;
    }
}
if (!function_exists('currency_format')){
    function currency_format($amount, $prefix=NULL, $dec=2){
        $formatted = '';
        if ($amount < 0){
            $formatted = '(' .($prefix?$prefix:'').number_format($amount*(-1), $dec) .')';
        }else{
            $formatted = ($prefix?$prefix:''). number_format($amount, $dec);
        }
        return $formatted;
    }
}
if (!function_exists('indonesia_date_format')){
    /**
     * 
     * @param type $format
     * @param type $time
     */
    function indonesia_date_format($format='%d-%m-%Y', $time=NULL){
        
        //create date object
        if (!$time) { $time = time(); }
        $date_obj  =  getdate($time);
        
        //set Indonesian month name
        $bulan = array(
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );
        
        $bulan_short = array(
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
        );
        
        $hari = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
        
        $format_search = array('%d','%D','%m','%M','%S','%y','%Y','%H','%i','%s');
        $format_replace = array( 
            $date_obj['mday'], $hari[$date_obj['wday']],  $date_obj['mon'], $bulan[$date_obj['mon']-1],  
            $bulan_short[$date_obj['mon']-1], $date_obj['year'], $date_obj['year'], $date_obj['hours'], 
            $date_obj['minutes'], $date_obj['seconds']  
        );
        $str = str_replace($format_search, $format_replace, $format);
        
        return $str;
    }
}

if (!function_exists('format_noreg')){
    function format_noreg($tahun,$bulan,$userid) {
        $format = "%d%'.02d-%'.05d";
        $noreg = sprintf($format,$tahun,$bulan,$userid);

        return $noreg;
    }
}
/*
 * Filename: general_helper.php
 * Location: application/helpers/general_helper.php
 */
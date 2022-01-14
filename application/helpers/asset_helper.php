<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// application/helpers/asset_helper.php
if (!function_exists('assetUrl'))
{
    function assetUrl()
    {
        // the helper function doesn't have access to $this, so we need to get a reference to the
        // CodeIgniter instance.  We'll store that reference as $CI and use it instead of $this
        // =& is a bitwise and operator. It was noted that Stephen didn't know why Kevin is using this.
        // =& is also a referencing operator. Assign it as a reference, don't make a copy.
        $CI =& get_instance();

        // return the asset_url
        //I've added the config item assetsPath
        // in a custom config file which is autoloaded
        return base_url() . $CI->config->item('assetsPath');
    }


}

?>
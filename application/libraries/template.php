<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class template
{
    var $data = array();

    function layout($pages, $data, $return = false)
    {
        $this->CI = &get_instance();

        $comp = array(
            'header'        => $this->CI->load->view('template/head'),
            'sidebar'       => $this->CI->load->view('template/sidebar', $data),
            'navbar'        => $this->CI->load->view('template/navbar', $data),
            'breadcrumb'    => $this->CI->load->view('template/breadcrumb', $data),
            'content'       => $this->CI->load->view($pages),
            'footer'        => $this->CI->load->view('template/footer'),
            'js'            => $this->CI->load->view('template/js')
        );

        return $this->CI->load->view('pages/index', $comp, true);
    }

    function alert($icon, $condition, $message, $alertClasses)
    {
        $this->CI = &get_instance();

        $alert = '<div class="alert alert-' . $alertClasses . ' alert-dismissable fade-show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4>
						<i class="icon fa fa-' . $icon . '"></i> ' . $condition . '!
					</h4> 
					' . $message . '
				</div>';

        return $alert;
    }
}

/* End of file Main_generic.php */
/* Location: ./system/application/libraries/Main_generic.php */

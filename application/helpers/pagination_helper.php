<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('create_pagination')) {
    /**
     * The Pagination helper cuts out some of the bumf of normal pagination
     *
     * @param string $uri The current URI.
     * @param int $total_rows The total of the items to paginate.
     * @param int|null $limit How many to show at a time.
     * @param int $uri_segment The current page.
     * @param boolean $full_tag_wrap Option for the Pagination::create_links()
     * @return array The pagination array. 
     * @see Pagination::create_links()
     */
    function create_pagination($uri, $total_rows, $limit = null, $uri_segment = 3, $full_tag_wrap = true) {
        $ci = & get_instance();
        $ci->load->library('pagination');
        $current_page = $ci->uri->segment($uri_segment, 0);
        $suffix = $ci->config->item('url_suffix');
        $limit = $limit === null ? 10 : $limit;

        // Initialize pagination
        $ci->pagination->initialize(array(
            'suffix'            => $suffix,
            'base_url'          => (!$suffix) ? rtrim(site_url($uri), $suffix) : site_url($uri),
            'total_rows'        => $total_rows,
            'per_page'          => $limit,
            'uri_segment'       => $uri_segment,
            // 'num_links'         => $total_rows,
            // 'use_page_numbers'  => true,
            'reuse_query_string'=> true,
            'full_tag_open'     => '<ul class="pagination pagination-xs nomargin pagination-custom">',
            'full_tag_close'    => '</ul>',
            'first_tag_open'    => '<li>',
            'first_tag_close'   => '</li>',
            'last_tag_open'     => '<li>',
            'last_tag_close'    => '</li>',
            'first_link'        => '<i class="fa fa-angle-double-left"></i>',
            'prev_link'         => '<i class="fa fa-angle-left"></i>',
            'next_link'         => '<i class="fa fa-angle-right"></i>',
            'last_link'         => '<i class="fa fa-angle-double-right"></i>',
            'prev_tag_open'     => '<li>',
            'prev_tag_close'    => '</li>',
            'next_tag_open'     => '<li>',
            'next_tag_close'    => '</li>',
            'cur_tag_open'      => '<li class="active"><a href="#">',
            'cur_tag_close'     => '</a></li>',
            'num_tag_open'      => '<li>',
            'num_tag_close'     => '</li>',
        ));

       $offset = $limit * ($current_page - 1);

        //avoid having a negative offset
        if ($offset < 0)
            $offset = 0;

        return array(
            'current_page'  => $current_page,
            'per_page'      => $limit,
            'limit'         => $limit,
            'offset'        => $offset,
            'links'         => $ci->pagination->create_links($full_tag_wrap)
        );
    }

}

if (!function_exists('create_pagination_site')) {
    /**
     * The Pagination helper cuts out some of the bumf of normal pagination
     *
     * @param string $uri The current URI.
     * @param int $total_rows The total of the items to paginate.
     * @param int|null $limit How many to show at a time.
     * @param int $uri_segment The current page.
     * @param boolean $full_tag_wrap Option for the Pagination::create_links()
     * @return array The pagination array. 
     * @see Pagination::create_links()
     */
    function create_pagination_site($uri, $total_rows, $limit = null, $uri_segment = 3, $full_tag_wrap = true) {
        $ci = & get_instance();
        $ci->load->library('pagination');
        $current_page = $ci->uri->segment($uri_segment, 0);
        $suffix = $ci->config->item('url_suffix');
        $limit = $limit === null ? 10 : $limit;

        // Initialize pagination
        $ci->pagination->initialize(array(
            'suffix'            => $suffix,
            'base_url'          => (!$suffix) ? rtrim(site_url($uri), $suffix) : site_url($uri),
            'total_rows'        => $total_rows,
            'per_page'          => $limit,
            'uri_segment'       => $uri_segment,
            // 'num_links'         => $total_rows,
            // 'use_page_numbers'  => true,
            'reuse_query_string'=> true,
            'full_tag_open'     => '<ul class="pagination">',
            'full_tag_close'    => '</ul>',
            'first_tag_open'    => '<li class="page-item">',
            'first_tag_close'   => '</li>',
            'last_tag_open'     => '<li class="page-item">',
            'last_tag_close'    => '</li>',
            'first_link'        => '<i class="fa fa-angle-double-left"></i>',
            'prev_link'         => '<i class="fa fa-angle-left"></i>',
            'next_link'         => '<i class="fa fa-angle-right"></i>',
            'last_link'         => '<i class="fa fa-angle-double-right"></i>',
            'prev_tag_open'     => '<li class="page-item">',
            'prev_tag_close'    => '</li>',
            'next_tag_open'     => '<li class="page-item">',
            'next_tag_close'    => '</li>',
            'cur_tag_open'      => '<li class="page-item active"><a href="#">',
            'cur_tag_close'     => '</a></li>',
            'num_tag_open'      => '<li class="page-item">',
            'num_tag_close'     => '</li>',
        ));

       $offset = $limit * ($current_page - 1);

        //avoid having a negative offset
        if ($offset < 0)
            $offset = 0;

        return array(
            'current_page'  => $current_page,
            'per_page'      => $limit,
            'limit'         => $limit,
            'offset'        => $offset,
            'links'         => $ci->pagination->create_links($full_tag_wrap)
        );
    }

}

// static pagination

// $config['base_url'] = site_url('/manage_users/manage_list/');
// $config['total_rows'] = $this->manage_user_model->count_all();
// $config['per_page'] = $limit;
// $config['uri_segment'] = 3;

// $config['num_links'] = $config['total_rows'];
// $config['use_page_numbers'] = TRUE;
// $config['full_tag_open'] = '<ul class="pagination pagination-xs nomargin pagination-custom">';
// $config['full_tag_close'] = '</ul>';
// $config['prev_link'] = '<i class="fa fa-angle-double-left"></i>';
// $config['prev_tag_open'] = '<li>';
// $config['prev_tag_close'] = '</li>';
// $config['next_tag_open'] = '<li>';
// $config['next_tag_close'] = '</li>';
// $config['cur_tag_open'] = '<li class="active"><a href="">';
// $config['cur_tag_close'] = '</a></li>';
// $config['num_tag_open'] = '<li>';
// $config['num_tag_close'] = '</li>';
// $config['next_link'] = '<i class="fa fa-angle-double-right"></i>';

// $this->pagination->initialize($config);
// $this->data['pagination'] = $this->pagination->create_links();

// $offset = ($this->uri->segment(3) > 0) ? $offset = ($this->uri->segment(3) + 0)*$config['per_page'] - $config['per_page'] : $this->uri->segment(3);
// query
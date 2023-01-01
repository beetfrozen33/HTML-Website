<?php

namespace SHORTCODES;

class SelectCompany
{

    public function __construct()
    {
        $this->register_shortcode();
        // Adding scripts
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('rest_api_init', [$this, 'register_rest_endpoints']);
    }

    private function register_shortcode()
    {
        add_shortcode('mp-select-company', [$this, 'select_company']);
    }

    public function select_company()
    {
        ob_start();
        require('views/select-company.view.php');
        return ob_get_clean();
    }

    public function enqueue_scripts()
    {
        wp_enqueue_script(
            'fsi_styles',
            MP_PLUG_DIR . 'includes/shortcodes/scripts/select-company.js',
            [],
            time()
        );
    }

    public function register_rest_endpoints()
    {
        register_rest_route('select-company', 'search-company', [
            'methods'  => 'GET',
            'callback' => [$this, 'search_company']
        ]);
    }

    public function search_company($request)
    {
        $companyName = $request->get_param('company-name');
        if ($companyName != '') {
            $companyArgs = [
                "post_type" => 'company',
                "s" => $companyName
            ];
            $searchResults = get_posts($companyArgs);
            $companies = [];

            foreach ($searchResults as $company) {
                $companies[] = [
                    'id'   => $company->ID,
                    'name' => $company->post_title
                ];
            }

            echo json_encode($companies);
        }
    }
}

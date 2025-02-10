<?php
/*
# Welcome to WHYSPICE OS 0.0.1 (GNU/Linux 3.13.0.129-generic x86_64)

root@localhost:~ bash ./whyspice-work.sh
> Executing...

         _       ____  ____  _______ ____  ________________
        | |     / / / / /\ \/ / ___// __ \/  _/ ____/ ____/
        | | /| / / /_/ /  \  /\__ \/ /_/ // // /   / __/
        | |/ |/ / __  /   / /___/ / ____// // /___/ /___
        |__/|__/_/ /_/   /_//____/_/   /___/\____/_____/

                            Web Dev.
                WHYSPICE © 2024 # whyspice.su

> Disconnecting.

# Connection closed by remote host.
*/
class Paginator {
    private $beanType;
    private $per_page;
    private $total_items;
    private $total_pages;
    private $custom_query = null;
    private $custom_query_bindings = null;

    public function __construct($beanType, $per_page = 10) {
        $this->beanType = $beanType;
        $this->per_page = $per_page;
        $this->total_items = R::count($beanType);
        $this->total_pages = ceil($this->total_items / $this->per_page);
    }

    public function get_page($page_number) {
        $start_index = ($page_number - 1) * $this->per_page;
        if ($this->custom_query) {
            return R::findAll($this->beanType, "{$this->custom_query} ORDER BY id DESC LIMIT ?, ?", array_merge($this->custom_query_bindings, [$start_index, $this->per_page]));
        } else {
            return R::findAll($this->beanType, 'ORDER BY id DESC LIMIT ?, ?', array($start_index, $this->per_page));
        }
    }

    public function get_page_count() {
        return $this->total_pages;
    }

    public function get_items_count() {
        return $this->total_items;
    }

    public function query($query, $bindings = []) {
        $this->custom_query = $query;
        $this->custom_query_bindings = $bindings;
        $this->total_items = count(R::find($this->beanType, $query, $bindings));
        $this->total_pages = ceil($this->total_items / $this->per_page);
    }

    public function render_html_pagination($current_page) {
        $current_page = (int)$current_page;
        $num_display_pages = 5;
        $half_display_pages = (int)($num_display_pages / 2);
        $start_page = max(1, $current_page - $half_display_pages);
        $end_page = min($this->total_pages, $start_page + $num_display_pages - 1);

        $current_url = $_SERVER['REQUEST_URI'];
        $base_url = preg_replace('/\/\d+$/', '', $current_url);

        echo '<div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t rounded-b-lg bg-gray-100 sm:grid-cols-9">';
        echo '<span class="flex items-center col-span-3"></span>';
        echo '<span class="col-span-2"></span>';
        echo '<span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">';
        echo '<nav>';
        echo '<ul class="inline-flex items-center">';

        if ($start_page > 1) {
            echo '<li>';
            echo '<a href="' . $base_url . '/1" class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">1</a>';
            echo '</li>';
            echo '<li>...</li>';
        }

        for ($i = $start_page; $i <= $end_page; $i++) {
            echo '<li>';
            if ($i === $current_page) {
                echo '<span class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple text-white transition-colors duration-150 bg-blue-500">' . $i . '</span>';
            } else {
                echo '<a href="' . $base_url . '/' . $i . '" class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">' . $i . '</a>';
            }
            echo '</li>';
        }

        if ($end_page < $this->total_pages) {
            echo '<li>...</li>';
            echo '<li>';
            echo '<a href="' . $base_url . '/' . $this->total_pages . '" class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">' . $this->total_pages . '</a>';
            echo '</li>';
        }

        echo '</ul>';
        echo '</nav>';
        echo '</span>';
        echo '</div>';
    }
}
?>

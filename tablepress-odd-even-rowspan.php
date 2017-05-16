<?php
/*
Plugin Name: TablePress Extension: Odd / Even by first cells rowspan
Plugin URI: https://github.com/massamany/tablepress-odd-even-rowspan/
Description: Extension for TablePress to render odd / even depending on first cells rowspan
Version: 1.0
Author: MRules
Author URI: https://mrules.xyz
*/

// Prohibit direct script loading.
defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

/**
 * Class that contains the TablePress odd / even rowspan Filtering functionality
 * @author MRules
 * @since 1.0
 */
class TablePress_OddEvenRowspan_Filter {

    /**
     * current class odd / even value.
     *
     * @since 1.0
     *
     * @var string
     */
    protected $odd_even = 'odd';
	
	/**
	 * Init TablePress_OddEvenRowspan_Filter.
	 */
	public function __construct() {
        add_action( 'tablepress_run', array( $this, 'init' ) );
    }

    /**
     * Register necessary plugin filter hooks.
     *
     * @since 1.0
     */
    public function init() {
        add_filter( 'tablepress_row_css_class', array( $this, 'filter_classes' ), 10, 5);
    }

    /**
     * Filter the CSS classes that are given to a row (HTML tr element) of a table.
     *
     * @since 1.0
     *
     * @param string $row_classes The CSS classes for the row.
     * @param string $table_id    The current table ID.
     * @param array  $row_cells   The HTML code for the cells of the row.
     * @param int    $row_idx     The row number.
     * @param array  $row_data    The content of the cells of the row.
     */
    public function filter_classes($row_classes, $table_id, $row_cells, $row_idx, $row_data) {
	  if ( $this->odd_even === 'odd' ) {
        $row_classes = str_replace('even', 'odd', $row_classes);
      } else {
        $row_classes = str_replace('odd', 'even', $row_classes);
      }

	  if ( '#rowspan#' != $row_data[ 0 ] ) {
        if ( $this->odd_even === 'odd' ) {
          $this->odd_even = 'even';
        } else {
          $this->odd_even = 'odd';
        }
	  }
	  
	  return $row_classes;
    }
}

$oddEvenRowspan_Filter = new TablePress_OddEvenRowspan_Filter();

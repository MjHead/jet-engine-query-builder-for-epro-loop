<?php
/**
 * Plugin Name: JetEngine Query Builder & Elementor Pro Loop
 * Plugin URI:  https://crocoblock.com/plugins/jetengine/
 * Description: Allow to use Posts Queries from JetEngine Query Builder with Elementor Pro Loop.
 * Version:     1.0.0
 * Author:      Crocoblock
 * Author URI:  https://crocoblock.com/
 * Text Domain: jet-engine
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

class JE_Query_Builder_EPro_Loop {

	protected $base_id = 'query-builder-';

	public function __construct() {
		add_filter( 'elementor/query/query_args', [ $this, 'apply_query_args' ], 10, 2 );
	}

	/**
	 * Apply Query Builder arguments for EPro Queries
	 * 
	 * @param  array  $query_args 
	 * @param  object $widget     [description]
	 * @return array
	 */
	public function apply_query_args( $query_args, $widget ) {

		$query = $this->get_widget_query( $widget );

		if ( $query ) {
			$query_args = $this->maybe_add_paged( $query->get_query_args() );
		}

		return $query_args;
	}

	/**
	 * Try to get Query Builder query for given widget
	 * 
	 * @param  object $widget EPro posts widget
	 * @return mixed
	 */
	public function get_widget_query( $widget ) {

		$query_id = $widget->get_settings( 'post_query_query_id' );

		if ( ! $query_id ) {
			return false;
		}

		$query_builder_id = false;

		if ( $query_id && false !== strpos( $query_id, $this->base_id ) ) {
			$query_builder_id = absint( str_replace( $this->base_id, '', $query_id ) );
		}

		if ( ! $query_builder_id ) {
			return false;
		}

		return \Jet_Engine\Query_Builder\Manager::instance()->get_query_by_id( $query_builder_id );

	}

	/**
	 * Check if we need to add a paged argument to the query
	 * 
	 * @param  array  $query_args Current query args
	 * @return array
	 */
	public function maybe_add_paged( $query_args = [] ) {

		global $wp;

		if ( ! empty( $wp->query_vars['page'] ) ) {
			$query_args['paged'] = absint( $wp->query_vars['page'] );
		}

		return $query_args;

	}

}

new JE_Query_Builder_EPro_Loop();

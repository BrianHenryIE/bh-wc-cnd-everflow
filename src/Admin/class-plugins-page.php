<?php
/**
 * On plugins.php add a Settings link and links to Support and Login.
 *
 * @link       https://BrianHenryIE.com
 * @since      1.0.0
 *
 * @package    brianhenryie/bh-wc-cnd-everflow
 */

namespace BrianHenryIE\WC_CND_Everflow\Admin;

/**
 * Hooks into filters for the plugin's action links (first column) and meta links (second column).
 *
 * @see \WP_Plugins_List_Table::single_row()
 */
class Plugins_Page {

	/**
	 * Add link to Settings page in plugins.php list.
	 *
	 * @hooked plugin_action_links_{basename}
	 *
	 * @param array<int|string, string>  $links_array The existing plugin links (usually "Deactivate"). May or may not be indexed with a string.
	 * @param string                     $plugin_file The plugin basename.
	 * @param array<string, string|bool> $plugin_data The parsed plugin header data.
	 * @param string                     $context 'all'|'active'|'inactive'...
	 * @return array<int|string, string> The links to display below the plugin name on plugins.php.
	 */
	public function action_links( array $links_array, string $plugin_file, array $plugin_data, string $context ): array {

		if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			return $links_array;
		}

		$settings_url = admin_url( 'admin.php?page=wc-settings&tab=integration&section=bh_wc_cnd_everflow' );

		array_unshift( $links_array, '<a href="' . $settings_url . '">Settings</a>' );

		return $links_array;
	}

	/**
	 * Add a link to support and Everflow login.
	 *
	 * @hooked plugin_row_meta
	 *
	 * @see https://rudrastyh.com/wordpress/plugin_action_links-plugin_row_meta.html
	 *
	 * @param array<int|string, string>  $plugin_meta The meta information/links displayed by the plugin description.
	 * @param string                     $plugin_file_name The plugin filename to match when filtering.
	 * @param array<string, string|bool> $plugin_data Associative array including PluginURI, slug, Author, Version.
	 * @param string                     $status The plugin status, e.g. 'Inactive'.
	 *
	 * @return array<int|string, string> The filtered $plugin_meta.
	 */
	public function row_meta( array $plugin_meta, string $plugin_file_name, array $plugin_data, string $status ):array {

		if ( 'bh-wc-cnd-everflow/bh-wc-cnd-everflow.php' !== $plugin_file_name ) {
			return $plugin_meta;
		}

		$plugin_meta[] = '<a target="_blank" href="https://helpdesk.everflow.io/">Support</a>';
		$plugin_meta[] = '<a target="_blank" href="https://cndirect.everflowclient.io/login">Everflow Login</a>';

		return $plugin_meta;
	}
}

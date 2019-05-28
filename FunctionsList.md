## Functions list

If you like reading through long files, then you are in for a treat. This document holds all the functions and required parameters available in this package. Please refer to the Official Cloudways API Documentation for more information.

Activate add-on on your server

    activate_server_addon($server_id, $addon_id)

Activate an addon on account level

	activate_addon_account_lvl($server_id, $package_id)

Addon request for an application
	
	application_addon_request($addon_id, $server_id, $app_id, $version)

Deactivate add-on on your server

	deactivate_server_addon($server_id, $addon_id)

Deactivate an addon

	deactivate_addon($addon_id)

Get Rackspace mail boxes list

	get_rackspace_mailboxes()

Get add-ons List

	get_addons_list()

Upgrade an addon package

	upgrade_addon_package($addon_id, $package_id)

Change Application access state

	change_app_access_state($server_id, $app_id, $state)

Check Local Backup

	check_local_backup($server_id, $app_id)

Create App Credentials

	create_app_credentials($server_id, $app_id, $username, $password)

Delete App Credential

	delete_app_credential($server_id, $app_id, $app_cred_id)

Delete Cname

	delete_cname($server_id, $app_id)

Delete Local Backup
	
	delete_local_backup($server_id, $app_id)

Get App Credentials

	get_app_credentials($server_id, $app_id)

Get Application SSH Access status

	get_app_ssh_access_stats($server_id, $app_id)

Get Application access state

	get_app_access_stats($server_id, $app_id)

Get Cron List

	get_cron_list($server_id, $app_id)

Get FPM Settings

	get_fpm_settings($server_id, $app_id)

Get Varnish Settings
	
	get_varnish_settings($server_id, $app_id)

Reset File Permissions

	reset_file_permissions($server_id, $app_id)

Restore App

	restore_app($server_id, $app_id, $time)

Rollback Restore

	rollback_restore($server_id, $app_id)

Update App Aliases

	update_app_aliases($server_id, $app_id, $aliases)

Update App Cname

	
	update_app_cname($server_id, $app_id, $cname)

Update App Credential

	update_app_credential($server_id, $app_id, $username, $password, $app_cred_id)

Update Application SSH Access status

	update_app_ssh_access_stat($server_id, $app_id, $update_perms_action)


Update Cron List

	update_cron_list($server_id, $app_id, $crons, $is_script)


Update DB Password

	update_db_pass($server_id, $app_id, $password)


Update FPM Settings

	update_fpm_settings($server_id, $app_id, $fpm_setting)

Update Symlink

	update_symlink($server_id, $app_id, $symlink)

Update Varnish Settings

	update_varnish_settings($server_id, $app_id, $vcl_list)

Update Webroot

	update_webroot($server_id, $app_id, $webroot)

Synchronize Application

	sync_app($server_id, $app_id, $source_app_id, $source_server_id, $action, $appFiles, $dbFiles, $backup)

Htaccess Auth credentials

	htaccess_auth_credentials($server_id, $app_id, $action)

Htaccess Update credentials

	htaccess_update_credentials($server_id, $app_id, $username, $password)

Staging Application Deployment Logs

	staging_app_deployment_logs($server_id, $app_id)

Staging Backup Rollback

	staging_backup_rollback($server_id, $app_id)

Staging Delete Local Backup

	staging_delete_local_backup($server_id, $app_id)


Add App

	add_app($server_id, $application, $app_version, $app_label, $project_name)

Clone App	
	
		
	clone_app($server_id, $app_id, $app_label)

Clone App To Other Server
		
	clone_app_to_other_server($server_id, $app_id, $destination_server_id, $app_label)

Clone Staging App

	clone_staging_app($server_id, $app_id)

Clone Staging App To Other Server

	clone_staging_app_to_other_server($server_id, $app_id, $destination_server_id)

Delete App

	delete_app($server_id, $appId)

Update App Label

	update_app_label($appId, $server_id, $label)

Create an Alert Channel

	create_alert_channel($name, $channel, $events, $is_active, $to, $url)

Delete a CloudwaysBot Channel

	delete_channel($channel_id)

Get All Alert
	
	get_all_alert()

Get Paginated Alerts

	get_paginated_alerts($last_id)

Get list of all Alert Channels

	get_alert_channels_list()

Get list of user's Alert Channels

	get_user_alert_channels_list()

Mark All of the Alert as Read

	mark_all_alert_as_read()

Mark the Alert as Read

	mark_alert_as_read($alert_id)

Update a CloudwaysBot Integration

	update_cw_bot_intergration($channel_id, $name, $channel, $events, $is_active, $to, $link)

Activate CloudwaysCDN

	activate_cw_cdn($server_id, $app_id)

Get CloudwaysCDN BandWidth

	get_cw_cdn_bandwidth($server_id, $app_id)

Get CloudwaysCDN details

	get_cw_cdn_details($server_id, $app_id)

Purge assets from your CloudwaysCDN

	purge_assets_from_cw_cdn($server_id, $app_id)

Remove CloudwaysCDN Subscription

	remove_cw_cdn_subscription($server_id, $app_id)

Set up CloudwaysCDN for your Application

	setup_cw_cdn($server_id, $app_id, $link)

Update Website URL

	update_website_url($server_id, $app_id, $link)

Generate Git SSH

	generate_git_ssh($server_id, $app_id)

Get Branch Names

	get_branch_names($server_id, $app_id, $git_url)

Get Git Deployment History

	get_git_deployment_history($server_id, $app_id)

Get Git SSH

	get_git_ssh($server_id, $app_id)

Start Git Clone

	start_git_clone($server_id, $app_id, $git_url, $branch_name, $deploy_path)

Start Git Pull

	start_git_pull($server_id, $app_id, $git_url, $branch_name, $deploy_path)

Search for queries in Knowledge Base

	search_knowledge_base($kb_title)

Get App List

	get_app_list()

Get Backup Frequencies
	
	get_backup_frequencies()

Get Countries list

	get_countries_list()

Get Monitor Durations

	get_monitor_durations()

Get Monitor Targets

	get_monitor_targets()

Get Package List

	get_package_list()

Get Provider List

	get_provider_list()

Get Region List

	get_region_list()

Get Server Sizes list

	get_server_sizes_list()

Get Settings List

	get_settings_list()

Get Operation Status

	get_operation_status($id)

Create Project

	create_project($name, $app_ids)

Delete Project
	
	delete_project($id)

Get Project List

	get_project_list()

Update Project

	update_project($id, $name, $app_ids)

Create SSH key
	
	create_ssh_key($server_id, $ssh_key_name, $ssh_key, $app_creds_id)

Delete SSH key

	delete_ssh_key($server_id, $ssh_key_id)

Update SSH key

	update_ssh_key($server_id, $ssh_key_name, $ssh_key_id)

Allow Adminer

	allow_adminer($server_id, $ip)

Allow SIAB

	allow_siab($server_id, $ip)

Change Auto Renewal policy

	change_auto_renewal_policy($server_id, $app_id, $auto)

Check If IP Blacklisted

	check_if_ip_blacklisted($server_id, $ip)

Create CSR Certificate

	create_csr_certificate($server_id, $app_id, $ssl_country, $ssl_state, $ssl_locality, $ssl_organization, $ssl_organizational_unit, $ssl_email, $ssl_domain, $ssl_san, $domains)

Get CSR Certificate

	get_csr_certificate($server_id, $app_id)

Get Whitelisted IPs for MySQL conections

	get_mysql_whitelisted_ips($server_id)

Get Whitelisted IPs for SSH/SFTP

	get_ssh_sftp_whitelisted_ips($server_id)

Create your DNS

	create_dns($server_id, $app_id, $ssl_email, $wild_card, $ssl_domain)

Verifying your DNS

	verify_dns($server_id, $app_id, $ssl_email, $wild_card, $ssl_domain)

Install Lets Encrypt

	install_lets_encrypt($server_id, $app_id, $ssl_email, $wild_card, $ssl_domains)

Renew Lets Encrypt Manually

	renew_lets_encrypt_manually($server_id, $app_id, $wild_card, $domain)


Revoke LetsEncrypt

	
	revoke_lets_encrypt($server_id, $app_id, $wild_card, $ssl_domain)

Update SSL Certificate

	update_ssl_certificate($server_id, $app_id, $ssl_crt, $ca_crt)

Update Whitelisted IPs

	update_whitelisted_ips($server_id, $tab, $ip, $type)

Attach Block Storage

	attach_block_storage($server_id, $server_storage)

Clone Server

	clone_server($source_server_id, $cloud, $region, $instance_type, $app_label, $application_id, $db_volume_size, $data_volume_size, $server_storage)

Create Server

	create_server($cloud, $region, $instance_type, $application, $app_version, $server_label, $app_label, $project_name, $db_volume_size, $data_volume_size)


Delete Server

	delete_server($serverId)

Get Disk Usage

	get_disk_usage($server_id)

Get Servers List

	get_servers_list()

Restart Server

	restart_server($server_id)

Scale Block Storage

	scale_block_storage($server_id, $server_storage)

Scale Resources

	scale_server_resources($server_id, $memory_size, $instance_type, $volume_size)

Scale Volume Size

	scale_server_volume_size($server_id, $volume_size, $volume_type)

Set Autoscale Policy

	set_server_auto_scale_policy($server_id, $cpu, $cpu_max, $memory, $memory_max, $is_cpu_downscale, $is_mem_downscale)

Start Server

	start_server($server_id)

Stop Server

	stop_server($server_id)

Update Server Label

	update_server_label($serverId, $label)

Upgrade Server

	upgrade_server($server_id, $instance_type)

Backup Server

	backup_server($server_id)

Delete Local Server Backups

	delete_local_server_backups($server_id)

Get Monitoring Graph

	get_monitoring_graph($server_id, $target, $duration, $timezone, $output_format)

Get Server Settings

	get_server_settings($server_id)

Update Backup Settings

	update_backup_settings($server_id, $local_backups, $backup_frequency, $backup_retention)

Update Master Password

	update_master_password($server_id, $password)

Update Master Username

	update_master_username($server_id, $username)

Update Server Package

	update_server_package($server_id, $package_name, $package_version)

Update Server Settings

	update_server_settings($server_id, $execution_limit, $memory_limit, $date_timezone, $display_errors, $upload_size, $error_reporting, $mysql_timezone, $static_cache_expiry, $character_set_server, $max_connections, $max_input_vars, $apc_shm_size, $max_input_time, $new_default_app, $mod_waf, $mod_zendguard, $innodb_buffer_pool_size, $key_buffer_size, $innodb_lock_wait_timeout, $wait_timeout, $opcache_memory_size, $mod_xdebug, $nginx_http2, $sys_locale)

Update Snapshot frequency

	update_snapshot_frequency($server_id)

Change Service State

	change_service_state($server_id, $service, $state)

Get Services Status

	get_service_status($server_id)

Get Varnish State App Level

	get_app_lvl_varnish_state($server_id, $app_id)

Update Server Varnish State

	update_server_varnish_state($server_id, $action)

Update Varnish State App Level

	update_app_lvl_varnish_state($server_id, $app_id, $action)

Create a Supervisord queue

	create_supervisord_queue($server_id, $app_id, $queues_list_connection, $queues_list_procs, $queues_list_sleep, $queues_list_artisan_path, $queues_list_timeout, $queues_list_queue, $queues_list_tries, $queues_list_env)

Delete Supervisord queue

	delete_supervisord_queue($server_id, $app_id, $id)

Get Supervisord queue status

	get_supervisord_queue_status($server_id, $app_id)

Get Supervisord queues

	get_supervisord_queues($server_id, $app_id)

Restart Supervisord queue

	restart_supervisord_queue($server_id, $app_id, $queue_id)


Cancel server transfer process

	cancel_server_transfer_process($server_id)

Get server trasfer status

	get_server_transfer_status($server_id)

Request for server trasfer

	request_for_server_transfer($server_id, $email)

Summary

	server_monitor_summary($server_id, $type)

Get Monitoring Graph

	server_monitor_summary_graph($server_id, $timezone, $target, $duration, $storage, $server_type)

Disk Usage

	application_disk_usage($server_id, $app_id, $type)

Get Disk Usage Graph

	application_disk_usage_graph($server_id, $app_id, $timezone, $target, $duration)
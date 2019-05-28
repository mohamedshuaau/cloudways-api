<?php

namespace App\Http\Classes;

//require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

Class CloudwaysAPIClient
{
    private $client = null;
    const API_URL = "https://api.cloudways.com/api/v1";
    var $auth_key;
    var $auth_email;
    var $accessToken;

    public function __construct($email,$key)
    {
        $this->auth_email = $email;
        $this->auth_key = $key;
        $this->client = new Client();
        $this->prepare_access_token();
    }

    public function prepare_access_token()
    {
        try
        {
            $url = self::API_URL . "/oauth/access_token";
            $data = ['email' => $this->auth_email,'api_key' => $this->auth_key];
            $response = $this->client->post($url, ['query' => $data]);
            $result = json_decode($response->getBody()->getContents());
            $this->accessToken = $result->access_token;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }
    public function StatusCodeHandling($e)
    {
        if ($e->getResponse()->getStatusCode() == '400')
        {
            $this->prepare_access_token();
        }
        elseif ($e->getResponse()->getStatusCode() == '422')
        {
            $response = json_decode($e->getResponse()->getBody(true)->getContents());
            return $response;
        }
        elseif ($e->getResponse()->getStatusCode() == '500')
        {
            $response = json_decode($e->getResponse()->getBody(true)->getContents());
            return $response;
        }
        elseif ($e->getResponse()->getStatusCode() == '401')
        {
            $response = json_decode($e->getResponse()->getBody(true)->getContents());
            return $response;
        }
        elseif ($e->getResponse()->getStatusCode() == '403')
        {
            $response = json_decode($e->getResponse()->getBody(true)->getContents());
            return $response;
        }
        elseif ($e->getResponse()->getStatusCode() == '404')
        {
            $response = json_decode($e->getResponse()->getBody(true)->getContents());
            return $response;
        }
        else
        {
            $response = json_decode($e->getResponse()->getBody(true)->getContents());
            return $response;
        }
    }


    //START FUNCTIONS

    /**START ADDONS MANAGEMENT**/

    //Activate add-on on your server
    public function activate_server_addon($server_id, $addon_id)
    {
        try
        {
            $url = self::API_URL . "/addon/activateOnServer";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'addon_id' => $addon_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Activate an addon on account level
    public function activate_addon_account_lvl($server_id, $package_id)
    {
        try
        {
            $url = self::API_URL . "/addon/activate";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'package_id' => $package_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Addon request for an application
    public function application_addon_request($addon_id, $server_id, $app_id, $version)
    {
        try
        {
            $url = self::API_URL . "/addon/request";
            $option = array('exceptions' => false);
            $data = [
                'addon_id' => $addon_id,
                'server_id' => $server_id,
                'app_id' => $app_id,
                'version' => $version
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Deactivate add-on on your server
    public function deactivate_server_addon($server_id, $addon_id)
    {
        try
        {
            $url = self::API_URL . "/addon/deactivateOnServer";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'addon_id' => $addon_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Deactivate an addon
    public function deactivate_addon($addon_id)
    {
        try
        {
            $url = self::API_URL . "/addon/deactivateOnServer";
            $option = array('exceptions' => false);
            $data = [
                'addon_id' => $addon_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Rackspace mail boxes list
    public function get_rackspace_mailboxes()
    {
        try
        {
            $url = self::API_URL . "/addon/getRackspaceMailboxes";
            $option = array('exceptions' => false);
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get add-ons List
    public function get_addons_list()
    {
        try
        {
            $url = self::API_URL . "/addon";
            $option = array('exceptions' => false);
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Upgrade an addon package
    public function upgrade_addon_package($addon_id, $package_id)
    {
        try
        {
            $url = self::API_URL . "/addon/upgrade";
            $option = array('exceptions' => false);
            $data = [
                'addon_id' => $addon_id,
                'package_id' => $package_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    /**END ADDONS MANAGEMENT**/


    /**START APP MANAGEMENT**/

    //Change Application access state
    public function change_app_access_state($server_id, $app_id, $state)
    {
        try
        {
            $url = self::API_URL . "/app/state";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'state' => $state
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Check Local Backup
    public function check_local_backup($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/manage/backup";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Create App Credentials
    public function create_app_credentials($server_id, $app_id, $username, $password)
    {
        try
        {
            $url = self::API_URL . "/app/creds";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'username' => $username,
                'password' => $password
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Delete App Credential
    public function delete_app_credential($server_id, $app_id, $app_cred_id)
    {
        try
        {
            $url = self::API_URL . "/app/creds/".$app_cred_id."";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'app_cred_id' => $app_cred_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->delete($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Delete Cname
    public function delete_cname($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/app/manage/cname";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->delete($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Delete Local Backup
    public function delete_local_backup($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/app/manage/backup";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->delete($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get App Credentials
    public function get_app_credentials($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/app/creds";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Application SSH Access status
    public function get_app_ssh_access_stats($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/app/getAppSshPerms";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Application access state
    public function get_app_access_stats($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/app/getApplicationAccess";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Cron List
    public function get_cron_list($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/app/manage/cronList";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get FPM Settings
    public function get_fpm_settings($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/app/manage/fpm_setting";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Varnish Settings
    public function get_varnish_settings($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/app/manage/varnish_setting";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Reset File Permissions
    public function reset_file_permissions($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/app/manage/reset_permissions";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Restore App
    public function restore_app($server_id, $app_id, $time)
    {
        try
        {
            $url = self::API_URL . "/app/manage/restore";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'time' => $time
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Rollback Restore
    public function rollback_restore($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/app/manage/rollback";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update App Aliases
    public function update_app_aliases($server_id, $app_id, $aliases)
    {
        try
        {
            $url = self::API_URL . "/app/manage/aliases";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'aliases' => $aliases
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update App Cname
    public function update_app_cname($server_id, $app_id, $cname)
    {
        try
        {
            $url = self::API_URL . "/app/manage/cname";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'cname' => $cname
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update App Credential
    public function update_app_credential($server_id, $app_id, $username, $password, $app_cred_id)
    {
        try
        {
            $url = self::API_URL . "/app/creds/".$app_cred_id."";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'username' => $username,
                'password' => $password,
                'app_cred_id' => $app_cred_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->put($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update Application SSH Access status
    public function update_app_ssh_access_stat($server_id, $app_id, $update_perms_action)
    {
        try
        {
            $url = self::API_URL . "/app/updateAppSshPerms";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'update_perms_action' => $update_perms_action
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update Cron List
    public function update_cron_list($server_id, $app_id, $crons, $is_script)
    {
        try
        {
            $url = self::API_URL . "/app/manage/cronList";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'crons' => $crons,
                'is_script' => $is_script
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update DB Password
    public function update_db_pass($server_id, $app_id, $password)
    {
        try
        {
            $url = self::API_URL . "/app/manage/dbPassword";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'password' => $password
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update FPM Settings
    public function update_fpm_settings($server_id, $app_id, $fpm_setting)
    {
        try
        {
            $url = self::API_URL . "/app/manage/fpm_setting";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'fpm_setting' => $fpm_setting
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update Symlink
    public function update_symlink($server_id, $app_id, $symlink)
    {
        try
        {
            $url = self::API_URL . "/app/manage/symlink";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'symlink' => $symlink
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update Varnish Settings
    public function update_varnish_settings($server_id, $app_id, $vcl_list)
    {
        try
        {
            $url = self::API_URL . "/app/manage/varnish_setting";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'vcl_list' => $vcl_list
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update Webroot
    public function update_webroot($server_id, $app_id, $webroot)
    {
        try
        {
            $url = self::API_URL . "/app/manage/webroot";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'webroot' => $webroot
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Synchronize Application
    public function sync_app($server_id, $app_id, $source_app_id, $source_server_id, $action, $appFiles, $dbFiles, $backup)
    {
        try
        {
            $url = self::API_URL . "/sync/app";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'source_app_id' => $source_app_id,
                'source_server_id' => $source_server_id,
                'action' => $action,
                'appFiles' => $appFiles,
                'dbFiles' => $dbFiles,
                'backup' => $backup
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Htaccess Auth credentials
    public function htaccess_auth_credentials($server_id, $app_id, $action)
    {
        try
        {
            $url = self::API_URL . "/staging/auth/status";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'action' => $action
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Htaccess Update credentials
    public function htaccess_update_credentials($server_id, $app_id, $username, $password)
    {
        try
        {
            $url = self::API_URL . "/staging/htaccessUpdate";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'username' => $username,
                'password' => $password
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Staging Application Deployment Logs
    public function staging_app_deployment_logs($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/staging/app/logs";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Staging Backup Rollback
    public function staging_backup_rollback($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/staging/app/backupRollBack";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Staging Delete Local Backup
    public function staging_delete_local_backup($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/staging/app/deleteBackup";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    /** END APP MANAGEMENT **/

    /** START APPLICATION API MANAGEMENT **/

    //Add App
    public function add_app($server_id, $application, $app_version, $app_label, $project_name)
    {
        try
        {
            $url = self::API_URL . "/app";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'application' => $application,
                'app_version' => $app_version,
                'app_label' => $app_label,
                'project_name' => $project_name
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Clone App
    public function clone_app($server_id, $app_id, $app_label)
    {
        try
        {
            $url = self::API_URL . "/app/clone";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'app_label' => $app_label
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Clone App To Other Server
    public function clone_app_to_other_server($server_id, $app_id, $destination_server_id, $app_label)
    {
        try
        {
            $url = self::API_URL . "/app/cloneToOtherServer";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'destination_server_id' => $destination_server_id,
                'app_label' => $app_label
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Clone Staging App
    public function clone_staging_app($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/staging/app/cloneApp";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Clone Staging App To Other Server
    public function clone_staging_app_to_other_server($server_id, $app_id, $destination_server_id)
    {
        try
        {
            $url = self::API_URL . "/staging/app/cloneToOtherServer";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'destination_server_id' => $destination_server_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Delete App
    public function delete_app($server_id, $appId)
    {
        try
        {
            $url = self::API_URL . "/app/".$appId."";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'appId' => $appId
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->delete($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update App Label
    public function update_app_label($appId, $server_id, $label)
    {
        try
        {
            $url = self::API_URL . "/app/".$appId."";
            $option = array('exceptions' => false);
            $data = [
                'appId' => $appId,
                'server_id' => $server_id,
                'label' => $label
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->put($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    /** END APPLICATION API MANAGEMENT **/


    /** START CLOUDWAYS BOT API MANAGEMENT **/

    //Create an Alert Channel
    public function create_alert_channel($name, $channel, $events, $is_active, $to, $url)
    {
        try
        {
            $url = self::API_URL . "/integrations";
            $option = array('exceptions' => false);
            $data = [
                'name' => $name,
                'channel' => $channel,
                'events' => $events,
                'is_active' => $is_active,
                'to' => $to,
                'url' => $url
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Delete a CloudwaysBot Channel
    public function delete_channel($channel_id)
    {
        try
        {
            $url = self::API_URL . "/integrations/".$channel_id."";
            $option = array('exceptions' => false);
            $data = [
                'channel_id' => $channel_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->delete($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get All Alert
    public function get_all_alert()
    {
        try
        {
            $url = self::API_URL . "/alerts/";
            $option = array('exceptions' => false);
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Paginated Alerts
    public function get_paginated_alerts($last_id)
    {
        try
        {
            $url = self::API_URL . "/alerts/".$last_id."";
            $option = array('exceptions' => false);
            $data = [
                'last_id' => $last_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get list of all Alert Channels
    public function get_alert_channels_list()
    {
        try
        {
            $url = self::API_URL . "/integrations/create";
            $option = array('exceptions' => false);
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }


    //Get list of user's Alert Channels
    public function get_user_alert_channels_list()
    {
        try
        {
            $url = self::API_URL . "/integrations";
            $option = array('exceptions' => false);
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Mark All of the Alert as Read
    public function mark_all_alert_as_read()
    {
        try
        {
            $url = self::API_URL . "/alert/markAllRead/";
            $option = array('exceptions' => false);
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Mark the Alert as Read
    public function mark_alert_as_read($alert_id)
    {
        try
        {
            $url = self::API_URL . "/alert/markAsRead/".$alert_id."";
            $option = array('exceptions' => false);
            $data = [
                'alert_id' => $alert_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update a CloudwaysBot Integration
    public function update_cw_bot_intergration($channel_id, $name, $channel, $events, $is_active, $to, $link)
    {
        try
        {
            $url = self::API_URL . "/integrations/".$channel_id."";
            $option = array('exceptions' => false);
            $data = [
                'channel_id' => $channel_id,
                'name' => $name,
                'channel' => $channel,
                'events' => $events,
                'is_active' => $is_active,
                'to' => $to,
                'url' => $link
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->put($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    /** END CLOUDWAYS BOT API MANAGEMENT **/



    /** START CLOUDWAYS CDN API MANAGEMENT **/

    //Activate CloudwaysCDN
    public function activate_cw_cdn($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/app/cdn/activate";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get CloudwaysCDN BandWidth
    public function get_cw_cdn_bandwidth($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/app/cdn/bandwidth";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get CloudwaysCDN details
    public function get_cw_cdn_details($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/app/cdn";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Purge assets from your CloudwaysCDN
    public function purge_assets_from_cw_cdn($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/app/cdn/purge";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Remove CloudwaysCDN Subscription
    public function remove_cw_cdn_subscription($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/app/cdn/".$app_id."";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->delete($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Set up CloudwaysCDN for your Application
    public function setup_cw_cdn($server_id, $app_id, $link)
    {
        try
        {
            $url = self::API_URL . "/app/cdn";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'url' => $link
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update Website URL
    public function update_website_url($server_id, $app_id, $link)
    {
        try
        {
            $url = self::API_URL . "/app/cdn/".$app_id."";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'url' => $link
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->put($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    /** END CLOUDWAYS CDN API MANAGEMENT **/


    /** START GIT API MANAGEMENT **/

    //Generate Git SSH
    public function generate_git_ssh($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/git/generateKey";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Branch Names
    public function get_branch_names($server_id, $app_id, $git_url)
    {
        try
        {
            $url = self::API_URL . "/git/branchNames";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'git_url' => $git_url
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Git Deployment History
    public function get_git_deployment_history($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/git/history";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Git SSH
    public function get_git_ssh($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/git/key";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Start Git Clone
    public function start_git_clone($server_id, $app_id, $git_url, $branch_name, $deploy_path)
    {
        try
        {
            $url = self::API_URL . "/git/clone";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'git_url' => $git_url,
                'branch_name' => $branch_name,
                'deploy_path' => $deploy_path
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Start Git Pull
    public function start_git_pull($server_id, $app_id, $git_url, $branch_name, $deploy_path)
    {
        try
        {
            $url = self::API_URL . "/git/pull";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'git_url' => $git_url,
                'branch_name' => $branch_name,
                'deploy_path' => $deploy_path
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    /** END GIT API MANAGEMENT **/


    /** START KNOWLEDGEBASE API MANAGEMENT **/

    //Search for queries in Knowledge Base
    public function search_knowledge_base($kb_title)
    {
        try
        {
            $url = self::API_URL . "/kb/search";
            $option = array('exceptions' => false);
            $data = [
                'kb_title' => $kb_title
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    /** END KNOWLEDGEBASE API MANAGEMENT **/


    /** START LIST API MANAGEMENT **/

    //Get App List
    public function get_app_list()
    {
        try
        {
            $url = self::API_URL . "/apps";
            $option = array('exceptions' => false);
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Backup Frequencies
    public function get_backup_frequencies()
    {
        try
        {
            $url = self::API_URL . "/backup-frequencies";
            $option = array('exceptions' => false);
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Countries list
    public function get_countries_list()
    {
        try
        {
            $url = self::API_URL . "/countries";
            $option = array('exceptions' => false);
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Monitor Durations
    public function get_monitor_durations()
    {
        try
        {
            $url = self::API_URL . "/monitor_durations";
            $option = array('exceptions' => false);
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Monitor Targets
    public function get_monitor_targets()
    {
        try
        {
            $url = self::API_URL . "/monitor_targets";
            $option = array('exceptions' => false);
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Package List
    public function get_package_list()
    {
        try
        {
            $url = self::API_URL . "/packages";
            $option = array('exceptions' => false);
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Provider List
    public function get_provider_list()
    {
        try
        {
            $url = self::API_URL . "/providers";
            $option = array('exceptions' => false);
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Region List
    public function get_region_list()
    {
        try
        {
            $url = self::API_URL . "/regions";
            $option = array('exceptions' => false);
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Server Sizes list
    public function get_server_sizes_list()
    {
        try
        {
            $url = self::API_URL . "/server_sizes";
            $option = array('exceptions' => false);
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Settings List
    public function get_settings_list()
    {
        try
        {
            $url = self::API_URL . "/settings";
            $option = array('exceptions' => false);
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    /** END LIST API MANAGEMENT **/


    /** START OPERATION API MANAGEMENT **/

    //Get Operation Status
    public function get_operation_status($id)
    {
        try
        {
            $url = self::API_URL . "/operation/".$id."";
            $option = array('exceptions' => false);
            $data = [
                'id' => $id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    /** END OPERATION API MANAGEMENT **/


    /** START PROJECTS API MANAGEMENT **/

    //Create Project
    public function create_project($name, $app_ids)
    {
        try
        {
            $url = self::API_URL . "/project";
            $option = array('exceptions' => false);
            $data = [
                'name' => $name,
                'app_ids' => $app_ids
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Delete Project
    public function delete_project($id)
    {
        try
        {
            $url = self::API_URL . "/project/".$id."";
            $option = array('exceptions' => false);
            $data = [
                'id' => $id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->delete($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Project List
    public function get_project_list()
    {
        try
        {
            $url = self::API_URL . "/project";
            $option = array('exceptions' => false);
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update Project
    public function update_project($id, $name, $app_ids)
    {
        try
        {
            $url = self::API_URL . "/project/".$id."";
            $option = array('exceptions' => false);
            $data = [
                'id' => $id,
                'name' => $name,
                'app_ids' => $app_ids
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->put($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    /** END PROJECTS API MANAGEMENT **/


    /** START SSH KEY API MANAGEMENT **/

    //Create SSH key
    public function create_ssh_key($server_id, $ssh_key_name, $ssh_key, $app_creds_id)
    {
        try
        {
            $url = self::API_URL . "/ssh_key";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'ssh_key_name' => $ssh_key_name,
                'ssh_key' => $ssh_key,
                'app_creds_id' => $app_creds_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Delete SSH key
    public function delete_ssh_key($server_id, $ssh_key_id)
    {
        try
        {
            $url = self::API_URL . "/ssh_key/".$ssh_key_id."";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'ssh_key_id' => $ssh_key_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->delete($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update SSH key
    public function update_ssh_key($server_id, $ssh_key_name, $ssh_key_id)
    {
        try
        {
            $url = self::API_URL . "/ssh_key/".$ssh_key_id."";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'ssh_key_name' => $ssh_key_name,
                'ssh_key_id' => $ssh_key_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->put($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    /** END SSH KEY API MANAGEMENT **/


    /** START SECURITY API MANAGEMENT **/

    //Allow Adminer
    public function allow_adminer($server_id, $ip)
    {
        try
        {
            $url = self::API_URL . "/security/adminer";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'ip' => $ip
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Allow SIAB
    public function allow_siab($server_id, $ip)
    {
        try
        {
            $url = self::API_URL . "/security/siab";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'ip' => $ip
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Change Auto Renewal policy
    public function change_auto_renewal_policy($server_id, $app_id, $auto)
    {
        try
        {
            $url = self::API_URL . "/security/lets_encrypt_auto";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'auto' => $auto
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Check If IP Blacklisted
    public function check_if_ip_blacklisted($server_id, $ip)
    {
        try
        {
            $url = self::API_URL . "/security/isBlacklisted";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'ip' => $ip
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Create CSR Certificate
    public function create_csr_certificate($server_id, $app_id, $ssl_country, $ssl_state, $ssl_locality, $ssl_organization, $ssl_organizational_unit, $ssl_email, $ssl_domain, $ssl_san, $domains)
    {
        try
        {
            $url = self::API_URL . "/security/csr";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'ssl_country' => $ssl_country,
                'ssl_state' => $ssl_state,
                'ssl_locality' => $ssl_locality,
                'ssl_organization' => $ssl_organization,
                'ssl_organizational_unit' => $ssl_organizational_unit,
                'ssl_email' => $ssl_email,
                'ssl_domain' => $ssl_domain,
                'ssl_san' => $ssl_san,
                'domains' => $domains
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get CSR Certificate
    public function get_csr_certificate($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/security/csr";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Whitelisted IPs for MySQL conections
    public function get_mysql_whitelisted_ips($server_id)
    {
        try
        {
            $url = self::API_URL . "/security/whitelistedIpsMysql";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Whitelisted IPs for SSH/SFTP
    public function get_ssh_sftp_whitelisted_ips($server_id)
    {
        try
        {
            $url = self::API_URL . "/security/whitelisted";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Create your DNS
    public function create_dns($server_id, $app_id, $ssl_email, $wild_card, $ssl_domain)
    {
        try
        {
            $url = self::API_URL . "/security/createDNS";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'ssl_email' => $ssl_email,
                'wild_card' => $wild_card,
                'ssl_domain' => $ssl_domain
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Verifying your DNS
    public function verify_dns($server_id, $app_id, $ssl_email, $wild_card, $ssl_domain)
    {
        try
        {
            $url = self::API_URL . "/security/verifyDNS";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'ssl_email' => $ssl_email,
                'wild_card' => $wild_card,
                'ssl_domain' => $ssl_domain
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Install Lets Encrypt
    public function install_lets_encrypt($server_id, $app_id, $ssl_email, $wild_card, $ssl_domains)
    {
        try
        {
            $url = self::API_URL . "/security/lets_encrypt_install";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'ssl_email' => $ssl_email,
                'wild_card' => $wild_card,
                'ssl_domains' => $ssl_domains
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Renew Lets Encrypt Manually
    public function renew_lets_encrypt_manually($server_id, $app_id, $wild_card, $domain)
    {
        try
        {
            $url = self::API_URL . "/security/lets_encrypt_install";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'wild_card' => $wild_card,
                'domain' => $domain
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Revoke LetsEncrypt
    public function revoke_lets_encrypt($server_id, $app_id, $wild_card, $ssl_domain)
    {
        try
        {
            $url = self::API_URL . "/security/lets_encrypt_revoke";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'wild_card' => $wild_card,
                'ssl_domain' => $ssl_domain
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update SSL Certificate
    public function update_ssl_certificate($server_id, $app_id, $ssl_crt, $ca_crt)
    {
        try
        {
            $url = self::API_URL . "/security/crt";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'ssl_crt' => $ssl_crt,
                'ca_crt' => $ca_crt
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update Whitelisted IPs
    public function update_whitelisted_ips($server_id, $tab, $ip, $type)
    {
        try
        {
            $url = self::API_URL . "/security/whitelisted";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'tab' => $tab,
                'ip' => $ip,
                'type' => $type
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    /** END SECURITY API MANAGEMENT **/


    /** START SERVER API MANAGEMENT **/

    //Attach Block Storage
    public function attach_block_storage($server_id, $server_storage)
    {
        try
        {
            $url = self::API_URL . "/server/attachStorage";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'server_storage' => $server_storage
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Clone Server
    public function clone_server($source_server_id, $cloud, $region, $instance_type, $app_label, $application_id, $db_volume_size, $data_volume_size, $server_storage)
    {
        try
        {
            $url = self::API_URL . "/server/cloneServer";
            $option = array('exceptions' => false);
            $data = [
                'source_server_id' => $source_server_id,
                'cloud' => $cloud,
                'region' => $region,
                'instance_type' => $instance_type,
                'app_label' => $app_label,
                'application_id' => $application_id,
                'db_volume_size' => $db_volume_size,
                'data_volume_size' => $data_volume_size,
                'server_storage' => $server_storage
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Create Server
    public function create_server($cloud, $region, $instance_type, $application, $app_version, $server_label, $app_label, $project_name, $db_volume_size, $data_volume_size)
    {
        try
        {
            $url = self::API_URL . "/server";
            $option = array('exceptions' => false);
            $data = [
                'cloud' => $cloud,
                'region' => $region,
                'instance_type' => $instance_type,
                'application' => $application,
                'app_version' => $app_version,
                'server_label' => $server_label,
                'app_label' => $app_label,
                'project_name' => $project_name,
                'db_volume_size' => $db_volume_size,
                'data_volume_size' => $data_volume_size
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Delete Server
    public function delete_server($serverId)
    {
        try
        {
            $url = self::API_URL . "/server/".$serverId."";
            $option = array('exceptions' => false);
            $data = [
                'serverId' => $serverId
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->delete($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Disk Usage
    public function get_disk_usage($server_id)
    {
        try
        {
            $url = self::API_URL . "/server/".$server_id."/diskUsage";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Servers List
    public function get_servers_list()
    {
        try
        {
            $url = self::API_URL . "/server";
            $option = array('exceptions' => false);
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Restart Server
    public function restart_server($server_id)
    {
        try
        {
            $url = self::API_URL . "/server/restart";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Scale Block Storage
    public function scale_block_storage($server_id, $server_storage)
    {
        try
        {
            $url = self::API_URL . "/server/scaleStorage";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'server_storage' => $server_storage
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Scale Resources
    public function scale_server_resources($server_id, $memory_size, $instance_type, $volume_size)
    {
        try
        {
            $url = self::API_URL . "/server/scaleResources";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'memory_size' => $memory_size,
                'instance_type' => $instance_type,
                'volume_size' => $volume_size
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Scale Volume Size
    public function scale_server_volume_size($server_id, $volume_size, $volume_type)
    {
        try
        {
            $url = self::API_URL . "/server/scaleVolume";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'volume_size' => $volume_size,
                'volume_type' => $volume_type
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Set Autoscale Policy
    public function set_server_auto_scale_policy($server_id, $cpu, $cpu_max, $memory, $memory_max, $is_cpu_downscale, $is_mem_downscale)
    {
        try
        {
            $url = self::API_URL . "/server/autoScalePolicy";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'cpu' => $cpu,
                'cpu_max' => $cpu_max,
                'memory' => $memory,
                'memory_max' => $memory_max,
                'is_cpu_downscale' => $is_cpu_downscale,
                'is_mem_downscale' => $is_mem_downscale
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Start Server
    public function start_server($server_id)
    {
        try
        {
            $url = self::API_URL . "/server/start";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Stop Server
    public function stop_server($server_id)
    {
        try
        {
            $url = self::API_URL . "/server/stop";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update Server Label
    public function update_server_label($serverId, $label)
    {
        try
        {
            $url = self::API_URL . "/server/".$serverId."";
            $option = array('exceptions' => false);
            $data = [
                'serverId' => $serverId,
                'label' => $label
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->put($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Upgrade Server
    public function upgrade_server($server_id, $instance_type)
    {
        try
        {
            $url = self::API_URL . "/server/scaleServer";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'instance_type' => $instance_type
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    /** END SERVER API MANAGEMENT **/


    /** START SERVER MANAGEMENT API MANAGEMENT **/

    //Backup Server
    public function backup_server($server_id)
    {
        try
        {
            $url = self::API_URL . "/server/manage/backup";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Delete Local Server Backups
    public function delete_local_server_backups($server_id)
    {
        try
        {
            $url = self::API_URL . "/server/manage/remove_local_backup";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Monitoring Graph
    public function get_monitoring_graph($server_id, $target, $duration, $timezone, $output_format)
    {
        try
        {
            $url = self::API_URL . "/server/monitor/detail";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'target' => $target,
                'duration' => $duration,
                'timezone' => $timezone,
                'output_format' => $output_format
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Server Settings
    public function get_server_settings($server_id)
    {
        try
        {
            $url = self::API_URL . "/server/manage/settings";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update Backup Settings
    public function update_backup_settings($server_id, $local_backups, $backup_frequency, $backup_retention)
    {
        try
        {
            $url = self::API_URL . "/server/manage/backupSettings";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'local_backups' => $local_backups,
                'backup_frequency' => $backup_frequency,
                'backup_retention' => $backup_retention
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update Master Password
    public function update_master_password($server_id, $password)
    {
        try
        {
            $url = self::API_URL . "/server/manage/masterPassword";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'password' => $password
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update Master Username
    public function update_master_username($server_id, $username)
    {
        try
        {
            $url = self::API_URL . "/server/manage/masterUsername";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'username' => $username
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update Server Package
    public function update_server_package($server_id, $package_name, $package_version)
    {
        try
        {
            $url = self::API_URL . "/server/manage/package";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'package_name' => $package_name,
                'package_version' => $package_version
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update Server Settings
    public function update_server_settings($server_id, $execution_limit, $memory_limit, $date_timezone, $display_errors, $upload_size, $error_reporting, $mysql_timezone, $static_cache_expiry, $character_set_server, $max_connections, $max_input_vars, $apc_shm_size, $max_input_time, $new_default_app, $mod_waf, $mod_zendguard, $innodb_buffer_pool_size, $key_buffer_size, $innodb_lock_wait_timeout, $wait_timeout, $opcache_memory_size, $mod_xdebug, $nginx_http2, $sys_locale)

    {
        try
        {
            $url = self::API_URL . "/server/manage/settings";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'execution_limit' => $execution_limit,
                'memory_limit' => $memory_limit,
                'date_timezone' => $date_timezone,
                'display_errors' => $display_errors,
                'upload_size' => $upload_size,
                'error_reporting' => $error_reporting,
                'mysql_timezone' => $mysql_timezone,
                'static_cache_expiry' => $static_cache_expiry,
                'character_set_server' => $character_set_server,
                'max_connections' => $max_connections,
                'max_input_vars' => $max_input_vars,
                'apc_shm_size' => $apc_shm_size,
                'max_input_time' => $max_input_time,
                'new_default_app' => $new_default_app,
                'mod_waf' => $mod_waf,
                'mod_zendguard' => $mod_zendguard,
                'innodb_buffer_pool_size' => $innodb_buffer_pool_size,
                'key_buffer_size' => $key_buffer_size,
                'innodb_lock_wait_timeout' => $innodb_lock_wait_timeout,
                'wait_timeout' => $wait_timeout,
                'opcache_memory_size' => $opcache_memory_size,
                'mod_xdebug' => $mod_xdebug,
                'nginx_http2' => $nginx_http2,
                'sys_locale' => $sys_locale
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update Snapshot frequency
    public function update_snapshot_frequency($server_id)
    {
        try
        {
            $url = self::API_URL . "/server/manage/snapshotFrequency";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    /** END SERVER MANAGEMENT API MANAGEMENT **/


    /** START SERVICE API MANAGEMENT **/

    //Change Service State
    public function change_service_state($server_id, $service, $state)
    {
        try
        {
            $url = self::API_URL . "/service/state";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'service' => $service,
                'state' => $state
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Services Status
    public function get_service_status($server_id)
    {
        try
        {
            $url = self::API_URL . "/service";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Varnish State App Level
    public function get_app_lvl_varnish_state($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/service/appVarnish";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update Server Varnish State
    public function update_server_varnish_state($server_id, $action)
    {
        try
        {
            $url = self::API_URL . "/service/varnish";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'action' => $action
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Update Varnish State App Level
    public function update_app_lvl_varnish_state($server_id, $app_id, $action)
    {
        try
        {
            $url = self::API_URL . "/service/varnish";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'action' => $action
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    /** END SERVICE API MANAGEMENT **/



    /** START SUPERVISORD API MANAGEMENT **/

    //Create a Supervisord queue
    public function create_supervisord_queue($server_id, $app_id, $queues_list_connection, $queues_list_procs, $queues_list_sleep, $queues_list_artisan_path, $queues_list_timeout, $queues_list_queue, $queues_list_tries, $queues_list_env)
    {
        try
        {
            $url = self::API_URL . "/app/supervisor";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'queues_list[connection]' => $queues_list_connection,
                'queues_list[procs]' => $queues_list_procs,
                'queues_list[sleep]' => $queues_list_sleep,
                'queues_list[artisan_path]' => $queues_list_artisan_path,
                'queues_list[timeout]' => $queues_list_timeout,
                'queues_list[queue]' => $queues_list_queue,
                'queues_list[tries]' => $queues_list_tries,
                'queues_list[env]' => $queues_list_env
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Delete Supervisord queue
    public function delete_supervisord_queue($server_id, $app_id, $id)
    {
        try
        {
            $url = self::API_URL . "/app/supervisor/".$id."";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'id' => $id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->delete($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Supervisord queue status
    public function get_supervisord_queue_status($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/supervisor/queue/status";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Supervisord queues
    public function get_supervisord_queues($server_id, $app_id)
    {
        try
        {
            $url = self::API_URL . "/app/supervisor";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Restart Supervisord queue
    public function restart_supervisord_queue($server_id, $app_id, $queue_id)
    {
        try
        {
            $url = self::API_URL . "/supervisor/queue/restart";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'queue_id' => $queue_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    /** END SUPERVISORD API MANAGEMENT **/


    /** START TRANSFER SERVER API MANAGEMENT **/

    //Cancel server transfer process
    public function cancel_server_transfer_process($server_id)
    {
        try
        {
            $url = self::API_URL . "/server_transfer/cancel";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get server trasfer status
    public function get_server_transfer_status($server_id)
    {
        try
        {
            $url = self::API_URL . "/server_transfer/status";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Request for server trasfer
    public function request_for_server_transfer($server_id, $email)
    {
        try
        {
            $url = self::API_URL . "/server_transfer/request";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'email' => $email
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    /** END TRANSFER SERVER API MANAGEMENT **/



    /** START STAGING MANAGEMENT API MANAGEMENT **/

    //Synchronize Application
        //sync_app() function already exists in another segment. This function serves the same purpose

    //Htaccess Auth credentials
        //htaccess_auth_credentials() function already exists in another segment. This function serves the same purpose

    //Htaccess Update credentials
        //htaccess_update_credentials() function already exists in another segment. This function serves the same purpose

    //Staging Application Deployment Logs
        //staging_app_deployment_logs() function already exists in another segment. This function serves the same purpose

    //Staging Backup Rollback
        //staging_backup_rollback() function already exists in another segment. This function serves the same purpose

    //Staging Delete Local Backup
        //staging_delete_local_backup() function already exists in another segment. This function serves the same purpose

    /** END STAGING MANAGEMENT API MANAGEMENT **/


    /** START SERVER MONITOR API MANAGEMENT **/

    //Summary
    public function server_monitor_summary($server_id, $type)
    {
        try
        {
            $url = self::API_URL . "/server/monitor/summary";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'type' => $type
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Monitoring Graph
    public function server_monitor_summary_graph($server_id, $timezone, $target, $duration, $storage, $server_type)
    {
        try
        {
            $url = self::API_URL . "/server/monitor/detail";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'timezone' => $timezone,
                'target' => $target,
                'duration' => $duration,
                'storage' => $storage,
                'server_type' => $server_type
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    /** END SERVER MONITOR API MANAGEMENT **/


    /** START APPLICATION MONITOR API MANAGEMENT **/

    //Disk Usage
    public function application_disk_usage($server_id, $app_id, $type)
    {
        try
        {
            $url = self::API_URL . "/app/monitor/summary";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'type' => $type
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    //Get Disk Usage Graph
    public function application_disk_usage_graph($server_id, $app_id, $timezone, $target, $duration)
    {
        try
        {
            $url = self::API_URL . "/app/monitor/detail";
            $option = array('exceptions' => false);
            $data = [
                'server_id' => $server_id,
                'app_id' => $app_id,
                'timezone' => $timezone,
                'target' => $target,
                'duration' => $duration
            ];
            $header = array('Authorization'=>'Bearer ' . $this->accessToken);
            $response = $this->client->get($url, array('query' => $data, 'headers' => $header));
            $result = json_decode($response->getBody()->getContents());
            return $result;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    /** END APPLICATION MONITOR API MANAGEMENT **/



}
?>
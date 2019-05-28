# Cloudways API

This API is built to make your coding experience less stressful and help you get started without the hassle of extra codes. This package contains a class with all the functions which are available on the official API Documentation of Cloudways.

**Please bare in mind that some of these functions may not work as intended as Cloudways API is still on beta version. Some of the URL's does not output the expected results.**

# Usage
As mentioned earlier, the class contains all the RESTAPI calls available in Cloudways. To see the available functions, please visit the cloudways official documentation at: [https://developers.cloudways.com/docs/](https://developers.cloudways.com/docs/)
Here you will find all the information, required parameters and types of values required.

**Basic Usage:**

	//Here is where you define the email address and your API key from Cloudways  
	$CW_API = new CloudwaysAPIClient('example@gmail.com', '40tYp21iqEvwIVelOc4mZNeZkrRtdO');  
  
	//Magic
	$server_settings = $CW_API->get_server_settings('12345');  
  
	//object to json
	$json = json_encode($server_settings);  
  
	//json to json array
	$decode = json_decode($json, true);  
  
	return $decode;

**Expected Result:**

	{"settings":{"apc.shm_size":"32","character_set_server":"ascii","date.timezone":"","display_errors":"Off","error_reporting":"E_ALL & ~E_DEPRECATED & ~E_STRICT","execution_limit":"60","innodb_buffer_pool_size":"","innodb_lock_wait_timeout":"","key_buffer_size":"","max_connections":"150","max_input_time":"60","max_input_vars":"2500","memory_limit":"128","mod_xdebug":"disable","nginx_http2":"enable","package_versions":{"fpm":"enable","mariadb":"","mysql":"5.7","php":"7.3","redis":""},"short_open_tag":"off","static_cache_expiry":"43200","upload_size":"10","wait_timeout":""}}

The result originally comes as an object and we are using the `json_encode` to change it to a json. And afterwards we use the `json_decode` with the second parameter `true` to change it to a json array. And the output is as shown on the above example. 

There are approximately a 140 functions which are available from the Cloudways docs. The function names are respective to the names given in the Cloudways docs.

Please refer to the [Functions List](FunctionsList.md) for all the available functions and required parameters.
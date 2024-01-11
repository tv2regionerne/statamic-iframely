# Statamic Iframely

> Statamic Iframely is a Statamic addon that enables integration with Iframely API.  
> Be aware that [Iframely](https://iframely.com) requires a paid subscription.

## Features
Iframely is a uniform delivery service for all your various rich media embeds and URL data.  
This addon provides a tag for easy embedding for social media and most websites.  
The tag has a built in caching mechanism, to speed up requests and limit the API requests on Iframely.

## How to Install

Run the following command from your project root:

``` bash
composer require tv2regionerne/statamic-iframely
```

Publish the config
``` bash
php artisan vendor:publish --tag statamic-iframely-config
```
Add your API key to your ENV and optionally adjust the cache configuration
``` env
IFRAMELY_API_KEY="Your API Key"
IFRAMELY_CACHE_ENABLED=true
IFRAMELY_CACHE_FOR="1 hour"
```


## How to Use

Update the config to enable private API's.
Use the iframely antlers tag. The url parameter is required. 
```
{{ iframely url="your url here" }}
```

There's a bunch of optional parameters which will be passed into the Iframely API call.  
See the documentation for the below parameters on https://iframely.com/docs/iframely-api/

* iframe
* id
* omit_script
* omit_css
* import
* align
* lazy
* playerjs
* click_to_play
* consent
* theme
* language
* ssl
* media
* autoplay
* maxwidth
* maxheight
* origin
* title

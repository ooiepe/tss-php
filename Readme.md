# EPE Time-Series Service

The EPE Time-Series Service provides an easy way to access station information and time-series data from a number of popular oceanographic web services through a common web API.  It was developed to support the educational visualization tools of the Ocean Observatories Initiative (OOI) [Ocean Education Portal](http://education.oceanobservatories.org).  

The service includes two major components: 

1. A catalog service that aggregrates station information from the included data providers, allowing developers to query stations of interest using geographic, temporal and other search parameters.
2. A data service that provides a common way to access time-series data from all providers by standardizing the request URLs and response file formats.  In addition, this service also standardizes returned units, when possible (not yet implemented).

Instructions on how to access data from these services can be found by pointing your browser to the root directory of your installation.

This service can be accessed directly from the [EPE time-series server](http://epedata.oceanobservatories.org).  In addition, developers can download the source code and install the service on their own server.  Note, data aggregration is handled by a separate Python package.  If you find this service useful, please let us know.  We appreciate hearing about bugs and feature requests.  If you customize the codebase to include additional features or data sources, plase send us a pull-request.

## Installation

1. If you haven't already, install the Python library and use it to setup your database
2. Clone this repository to a web accessible directory or point your document root directly to ./webroot
2. Install composer:  `curl -sS https://getcomposer.org/installer | php`
3. Run the composer installer: `php composer.phar install`
4. Copy `Config/database.php.default` to `Config/database.php` and add your database info
5. Copy `Config/core.php.default` to `Config/core.php` and change the Security.salt and Security.cipherSeed seeds.  You can use this nifty [generator](http://www.sethcardoza.com/tools/random-password-generator/) to create random seeds.

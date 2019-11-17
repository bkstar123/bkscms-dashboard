# bkscms-dashboard

> A bkstar123/bkscms's package adding a basic dashboard for a **BKSCMS** project  

The following information is included in the dashboard:  
- Real time CPU utilization  
- Real time Memory usage
- Real time Diskspace usage
- Real time Network transmitting/receiveing throughput

For creating a **BKSCMS** project, run the following command:  
```composer create-project --prefer-dist bkstar123/bkscms <your-project>```  

## 1. Requirement
It is recommended to install this package with PHP version 7.1.3+ and Laravel Framework version 5.6+. The package support the host OS of either CentOS 6 or CentOS 7.  

## 2. Installation
    composer require bkstar123/bkscms-dashboard

Then, publish the package's configuration & assets:     
```php artisan vendor:publish --provider="Bkstar123\BksCMS\Dashboard\Providers\DashboardServiceProvider"```  

## 3. Usage

Update **config/bkstar123_bkscms_sidebarmenu** with Dashboard link. The package exposes the dashboard at the path ```/cms/dashboard``` with the route name of ```dashboard.index``` and protected under the middleware ```bkscms-auth:admins```.  

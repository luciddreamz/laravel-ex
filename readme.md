Laravel 5.2 Quickstart on OpenShift
===================================
[Laravel](http://laravel.com/) is a free, open source PHP web application framework, designed for the development of model–view–controller (MVC) web applications.

This quickstart was created to make it easy to get started with Laravel 5.2 on OpenShift v3.

The simplest way to install this application is to use the OpenShift quickstart template. To install the quickstart, follow [these directions](#installation).

## Installation ##

1. Create an account at [http://www.openshift.com/devpreview/register.html](http://www.openshift.com/devpreview/register.html)

2. [Install the OpenShift CLI tools](https://docs.openshift.com/online/getting_started/beyond_the_basics.html#btb-installing-the-openshift-cli)

3. Add the Laravel template(s) to your project:

    ```
    $ oc create -f https://raw.githubusercontent.com/luciddreamz/laravel-ex/master/openshift/templates/laravel-mysql.json
    ```
    or

    ```
    $ oc create -f https://raw.githubusercontent.com/luciddreamz/laravel-ex/master/openshift/templates/laravel-postgresql.json
    ```
    or

    ```
    $ oc create -f https://raw.githubusercontent.com/luciddreamz/laravel-ex/master/openshift/templates/laravel-sqlite.json
    ```

4. Fork this GitHub repo

5. From the [web console](https://console.preview.openshift.com/console/), select your project, click *Add to Project*, and select the Laravel template under the PHP heading

6. Replace the user name in the Git Repository URL parameter with your GitHub user name to point the template to your fork

7. Scroll to the bottom of the page and click *[ Create ]* to deploy your application

8. Follow [these instructions](https://docs.openshift.com/online/getting_started/basic_walkthrough.html#bw-configuring-automated-builds) to configure automated builds, allowing you to push your code to your GitHub repo and automatically trigger a new deployment

## OpenShift Considerations ##
These are some special considerations you may need to keep in mind when running your application on OpenShift.

### Local vs. Remote Development ###
This Laravel quickstart provides separate configuration files for both local and remote development. Use `.env` for local development, and `.s2i/environment` for remote development.

### Remote Development ###
Your application is configured to automatically use an OpenShift MySQL, PostgreSQL, or SQLite database in when deployed on OpenShift using the included templates (see `openshift/templates`).

Additionally, your `APP_ENV`, `APP_URL`, and `APP_KEY` can be set by following the [installation](#installation) instructions with the included templates.

### Laravel Migrations ###
The `php artisan migrate --force` command is automatically executed during deployment when using any of the included templates (see `openshift/templates`).

### Composer ###
During the build process, `composer install` is automatically executed over the root directory. See the [PHP 5.6 builder image](https://github.com/sclorg/s2i-php-container/tree/master/5.6) for more details, or more specifically see [here](https://github.com/sclorg/s2i-php-container/blob/master/5.6/s2i/bin/assemble#L9-L26).

### 'Development' Mode ###
By default, this Quickstart is configured in 'development' mode to make debugging your application easier.

When you develop your Laravel application in OpenShift, you can also enable the 'production' environment by setting environment variables, using the `oc` client, like:

```
$ oc get services
NAME                     CLUSTER-IP      EXTERNAL-IP   PORT(S)    AGE
laravel-mysql-example   172.30.79.234   <none>        8080/TCP   23m
$ oc set env dc/laravel-mysql-example LARAVEL_APP_ENV=production LARAVEL_APP_DEBUG=false OPCACHE_REVALIDATE_FREQ=2
```

Next, run `oc status` to confirm that an updated deployment has been kicked off.

For more information on environment variables impacting PHP behavior on OpenShift, see the [PHP 5.6 builder image](https://github.com/sclorg/s2i-php-container/tree/master/5.6#environment-variables).

For more information on Laravel environment variables, see the [Laravel environment configuration documentation](https://laravel.com/docs/5.2/configuration#environment-configuration).

### Log Files ###
Your application is configured to use the OpenShift log directory. You can use the `oc logs` command to stream the latest log file entries from your running pod:

```
$ oc get pods
NAME                             READY     STATUS      RESTARTS   AGE
laravel-mysql-example-1-build   0/1       Completed   0          26m
laravel-mysql-example-1-hj2k1   1/1       Running     0          23m
$ oc logs laravel-mysql-example-1-hj2k1
```

To stop tailing the logs, press *Ctrl + c*.

## Additional Resources ##
Documentation for the Laravel framework can be found on the [Laravel website](http://laravel.com/docs). Check out OpenShift's [Documentation](https://docs.openshift.com/online/using_images/s2i_images/php.html) for help running PHP on OpenShift.
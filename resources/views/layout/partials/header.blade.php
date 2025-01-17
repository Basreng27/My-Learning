<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="{{ template_gentelellaMaster() }}/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ template_gentelellaMaster() }}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ template_gentelellaMaster() }}/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ template_gentelellaMaster() }}/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{ template_gentelellaMaster() }}/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css"
        rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ template_gentelellaMaster() }}/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="{{ template_gentelellaMaster() }}/vendors/bootstrap-daterangepicker/daterangepicker.css"
        rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="{{ template_gentelellaMaster() }}/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet" />
    <!-- Select2 -->
    <link href="{{ template_gentelellaMaster() }}/vendors/select2/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Switchery -->
    <link href="{{ template_gentelellaMaster() }}/vendors/switchery/dist/switchery.min.css" rel="stylesheet" />
    <!-- starrr -->
    <link href="{{ template_gentelellaMaster() }}/vendors/starrr/dist/starrr.css" rel="stylesheet" />

    <!-- Custom Theme Style -->
    <link href="{{ template_gentelellaMaster() }}/build/css/custom.min.css" rel="stylesheet">

    @stack('style')
</head>

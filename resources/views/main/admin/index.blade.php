@extends('layout.app')
@section('title', 'Admin Dashboard')
@section('meta_search')
    <link rel="canonical" href="{{ urldecode(url()->full()) }}">
    <meta property="og:url" content="{{ urldecode(url()->full()) }}"/>
    <meta property="og:type" content="article"/>

    <meta property="og:title"
          content="Home | M FOOD"/>
    <meta property="og:description"
          content="M FOOD Admin Dashboard"/>
    <meta property="og:image" content="{{ url('/') }}/images/logo.png"/>

    <meta property="og:site_name" content="M FOOD">
    <meta property="og:image:height" content="630">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:type" content="image/png">

    <meta name="twitter:title"
          content="Home | M FOOD">
    <meta name="twitter:description"
          content="M FOOD Admin Dashboard">
    <meta name="twitter:image:src" content="{{ url('/') }}/assets/images/logo.png">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="M FOOD">
    <meta name="twitter:creator" content="M FOOD">
    <meta name="twitter:image" content="{{ url('/') }}/images/logo.png">
    <meta name="twitter:domain" content="{{ url('/') }}">

    <meta itemprop="name" content="Admin Dashboard | M FOOD">
    <meta itemprop="description"
          content="M FOOD Admin Dashboard">
    <meta itemprop="image" content="{{ url('/') }}/assets/images/logo.png">
@stop
@include('main.generated.admin.app-generated')


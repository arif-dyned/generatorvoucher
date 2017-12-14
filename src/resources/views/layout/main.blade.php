@extends('layout.template')

@section('title', $data['title'])

@section('class-body', 'hold-transition dyned-skins sidebar-mini')

@section('content')
<section id="container">
    <!--header start-->
    <header class="header fixed-top clearfix">
    <?php //========== Render header =========== ?>
    @include('layout.header')
    </header>
    <aside>
    <div id="sidebar" class="nav-collapse">
    <?php //========== Render sidebar =========== ?>
    @include('layout.sidebar')
    </div>
    </aside>

    <section id="main-content">
        <section class="wrapper">
        <?php //========== Start Content =========== ?>
        {!! $content !!}
        <?php //========== End Content ============= ?>
    </section>
    <br>
    </div>
        <div id="footer" class="nav-collapse">
    <?php //========== Render sidebar =========== ?>
    @include('layout.footer')
</div>
@stop
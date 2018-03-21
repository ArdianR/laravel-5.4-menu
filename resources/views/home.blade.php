@extends('layouts.menu')

@section('content')

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN DASHBOARD STATS 1-->
        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <strong>{{ $message }}</strong>
            <a href="" class="alert-link"></a>
        </div>
        @endif
        <div class="row">
                        <div class="form-actions">
                           <li><b>Posisi utama</b> : Apakah Lightbox dan Showcase/Meja/Wall bay ada di posisi utama .<br>Posisi utama adalah posisi paling depan menghadap arah arus orang ,biasanya area dinding sebelah kanan dan kiri paling depan toko，atau dinding tengah hadapi pintu masuk.<br>Harus semua item di posisi utama baru bisa pilih <b>yes</b>
                           </li><br>
                           <li><b>Ukuran utama</b> : Apakah Lightbox dan Wall bay ukurannya paling besar dari Lightbox Brand lain di toko tersebut. Dan apakah showcase dan meja paling banyak dari Brand lain di toko tersebut.<br>Jika toko hanya ada Lightbox dan sudah paling besar bisa pilih <b>yes</b>. 
                            </li><br>
                            <li><b>POP Material List</b> : Kalian harus input material POP standar dan custom yang ada di toko tersebut.<br><br>
                                POP Standar_Showcase_Standar<br>
                                POP Standar_Showcase_Corner/Lightbox Corner<br>
                                POP Standar_Showcase_Dealer(3 Level)<br>
                                POP Standar_Showcase_Dealer Corner<br><br>

                                POP Standar_Meja_800<br>
                                POP Standar_Meja_1200<br>
                                POP Standar_Meja_1600<br>

                                POP Standar_Lightbox_1600<br>
                                POP Standar_Lightbox_2400<br>
                                POP Standar_Lightbox_3600<br>
                                POP Standar_Lightbox_4800<br>

                                POP Custom_Showcase<br>
                                POP Custom_Meja<br>
                                POP Custom_Lightbox<br>
                                POP Custom_Wall Bay<br><br>
                                Misal di dalam toko ada 1 Lightbox ukuran 2400 berarti pilih POP Standar_Lightbox_2400 , QTY 1 dan ada 2 showcase custom berarti pilih POP Custom_Showcase , QTY 2 <br>
                                <b>More Info : Arga & Boni</b>
                           </li>
                        </div> 
{{--             <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="1349">0</span>
                        </div>
                        <div class="desc"> New Feedbacks </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="12,5">0</span>M$ </div>
                        <div class="desc"> Total Profit </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                    <div class="visual">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="549">0</span>
                        </div>
                        <div class="desc"> New Orders </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="number"> +
                            <span data-counter="counterup" data-value="89"></span>% </div>
                        <div class="desc"> Brand Popularity </div>
                    </div>
                </a>
            </div> --}}
        </div>
        <div class="clearfix"></div>
        <!-- END DASHBOARD STATS 1-->
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
@endsection

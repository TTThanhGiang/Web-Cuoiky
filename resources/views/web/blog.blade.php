@extends('layouts.mainWeb')

@section('title', 'Home Page')

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Blog Page</h1>
                <nav class="d-flex align-items-center">
                    <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="category.html">Blog</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->
<!--================Blog Categorie Area =================-->
<!--================Blog Area =================-->
<section class="ftco-section ftco-degree-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 order-lg-last ftco-animate">
                <div class="row">
                        <div class="col-md-12 d-flex ftco-animate">
                            <div class="blog-entry align-self-stretch d-md-flex">
                                <img src="assets/web/img/blog/c1.jpg" alt="" class="block-20">
                                <div class="text d-block pl-md-4">
                                    <div class="meta mb-3">
                                        <div><a href="#">23/11/2024</a></div>
                                        <div><a href="#">Thành Giang</a></div>
                                        <div><a href="#"><i class="lnr lnr-bubble"></i> 3</a></div>
                                    </div>
                                    <h3 class="heading"><a href="#">How to choose the most suitable shoes</a></h3>

                                      <p>Ok</p>
                                    <p><a href="#" class="btn btn-primary py-2 px-3">Read more</a></p>
                                </div>
                            </div>
                        </div>
                    
                </div>
            </div> <!-- .col-md-8 -->
            <div class="col-lg-4 sidebar ftco-animate">
                <div class="sidebar-box">
                    <form id="searchForm" action="#" method="post" class="search-form">
                        <div class="form-group">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Type a keyword and hit enter" name="text" id="searchInput">
                                <i class="lnr lnr-magnifier" id="searchIcon"></i>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="sidebar-box ftco-animate">
                    <h3 class="heading">Categories</h3>
                    <ul class="categories">
                        <li><a href="#">All <span>(20)</span></a></li>
                        <li><a href="#"> Blog <span>(16)</span></a></li>


                    </ul>
                </div>
            </div>

        </div>
    </div>
</section> <!-- .section -->
    <!--================End Blog Area =================-->
@endsection
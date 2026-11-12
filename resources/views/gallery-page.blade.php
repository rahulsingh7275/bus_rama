@extends('layouts.app')

@section('content')
<style>
.image{
    padding: 0px !important;
}

.main-box .popup-img{
    position: fixed;
    top:0;
    left: 0;
    background: rgba(0,0,0,.9);
    height: 100%;
    width: 100%;
    z-index: 9999999;
    display: none;
}
.main-box .popup-img span{
    position: absolute;
    top:0;
    right: 10px;
    font-size: 60px;
    font-weight: bolder;
    color: #fff;
    cursor: pointer;
    z-index: 100;
}
.main-box .popup-img img{
    position: absolute;
    top: 50%;
    left:50%;
    transform: translate(-50%,-50%);
    border: 5px solid #fff;
    border-radius: 5px;
    height: 70%;
    object-fit: cover;
}
.main-box .image-container .image:hover img{
    transform: scale(1.1);
}

@media (max-width:768px) {
    .main-box .popup-img img{
        width: 94%;
    }
}
</style>
<main>
        <section class="inner-banner bg_img" style="background: url({{asset('/')}}Content/Images/AboutBack.jpg) center">
            <div class="container">
                <div class="inner-banner-content">
                    <h2 class="title">Gallery</h2>
                </div>
            </div>
        </section>
    
    
    
        <section class="contact-section padding-top padding-bottom overflow-hidden">
            <div class="container main-box">

            <h3>Gallery</h3>

            <div class="row gallery-container image-container">
                <div class="col-md-3 image">
                    <img src="{{asset('gallery/img1.jpg')}}" class="img-thumbnail" alt="Cinque Terre">
                </div>
                <div class="col-md-3 image">
                    <img src="{{asset('gallery/img2.jpg')}}" class="img-thumbnail" alt="Cinque Terre">
                </div>
                <div class="col-md-3 image">
                    <img src="{{asset('gallery/img3.jpg')}}" class="img-thumbnail" alt="Cinque Terre">
                </div>
                <div class="col-md-3 image">
                    <img src="{{asset('gallery/img4.jpg')}}" class="img-thumbnail" alt="Cinque Terre">
                </div>
            </div>

            <div class="popup-img">
                <span>&times;</span>
                <img src="/Content/Images/AboutBack.jpg" />
            </div>

            </div>
        </section>
    </main>
    <script>
        document.querySelectorAll(".image-container img").forEach((image) => {
          image.onclick = () => {
            document.querySelector(".popup-img").style.display = "block";
            document.querySelector(".popup-img img").src =
              image.getAttribute("src");
          };
        });
        document.querySelector(".popup-img span").onclick = () => {
          document.querySelector(".popup-img").style.display = "none";
        };
      </script>

@endsection

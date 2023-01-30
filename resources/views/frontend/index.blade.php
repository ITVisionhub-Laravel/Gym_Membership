 <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ecommerce Slider Design</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="slider.css">
</head>
<body>
 
 <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  
  <div class="carousel-inner">
    @foreach ($sliders as $key=>$sliderItem)
    <div class="carousel-item {{$key == 0 ? 'active':''}} ">
        @if ($sliderItem->image)
            <img src="{{asset("$sliderItem->image")}}" class="d-block w-100 " alt="...">
        @endif
    <div class="carousel-caption d-none d-md-block">
                    <div class="custom-carousel-content">
                        <h1>
                           {!!$sliderItem->title!!}
                        </h1>
                        <p>
                            {!!$sliderItem->description!!}
                        </p>
                        <div>
                            <a href="#" class="btn btn-slider">
                                Get Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


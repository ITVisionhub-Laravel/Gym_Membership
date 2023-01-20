@extends('admin')

@section('content')

    <div class="col-md-12 row">
       @include('admin.dashboard.barchart',$attendencedMembers)
      
        <div class="card col-md-4">
            <div class="card-header">
                <h3 class="p-2">Member List
                    <a href="{{ url('admin/products') }}" class="btn btn-success btn-sm text-white float-end">View All</a>
                </h3>
            </div>

            <div class="card-body">
              <ul class="nav nav-pills mb-12" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pills-active-tab" data-bs-toggle="pill" data-bs-target="#pills-active" type="button" role="tab" aria-controls="pills-active" aria-selected="true">Active</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-register-tab" data-bs-toggle="pill" data-bs-target="#pills-register" type="button" role="tab" aria-controls="pills-register" aria-selected="false">Register</button>
                </li>
                
              </ul>
              <div class="tab-content " id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-active" role="tabpanel" aria-labelledby="pills-active-tab" tabindex="0">
                  <div class="container bg-grey p-2 my-2 border col-md-12">
                   @forelse ($attendencedMembers as $attendencedMember)
                        <div class="row col-md-12">
                      <div class="item-thumbnail col-md-5">
                        <img src="images/faces/face4.jpg" alt="image" class="profile-pic" style="border-radius: 100%;">
                      </div>
                      <div class="col-md-6 my-3">
                      <h5>{{ $attendencedMember->customer->name }}</h5>
                      <p>Slow Jogging</p>
                      <p>12-3-2023</p>
                      </div>
                    </div>   
                   @empty
                       <div>No Attended Member</div>
                   @endforelse
                  </div>
                </div>
                <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab" tabindex="0">
                  <div class="container bg-grey p-2 my-2 border col-md-12">
                   @forelse ($members as $member)
                        <div class="row col-md-12">
                      <div class="item-thumbnail col-md-5">
                        <img src="images/faces/face4.jpg" alt="image" class="profile-pic" style="border-radius: 100%;">
                      </div>
                      <div class="col-md-6 my-3">
                      <h5>{{ $member->name }}</h5>
                      <p>Slow Jogging</p>
                      <p>12-3-2023</p>
                      </div>
                    </div>   
                   @empty
                       <div>No Attended Member</div>
                   @endforelse
                  </div>
                </div>
                
              </div>

            </div>
        </div>
    </div>




@endsection
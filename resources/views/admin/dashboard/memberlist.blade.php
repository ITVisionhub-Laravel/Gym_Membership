
        <div class="card col-md-4">
            <div class="card-header">
                <h3 class="p-2">Member List
                    <a href="{{ url('admin/customers') }}" class="btn btn-success btn-sm text-white float-end">View All</a>
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
                   @forelse ($attendencedMembers
            ->take(3) as $attendencedMember)
                      @if($attendencedMember->member)
                        <div class="row col-md-12">
                          <div class="item-thumbnail col-md-5">
                            <img src="{{asset('/uploads/customer/'.$attendencedMember->member->image)}}" alt="image" class="img-fluid">
                          </div>
                          <div class="col-md-6 my-3">
                            <h5>{{ $attendencedMember->member->name }}</h5>
                            <p>Height : {{$attendencedMember->member->height }}cm</p>
                            <p>Weight : {{$attendencedMember->member->weight }}</p>
                          </div>
                        </div> 
                       @else
                          <div>No Attended Member</div>
                       @endif 
                   @empty
                        
                       <div>No Attended Member</div>
                   @endforelse
                  </div>
                </div>
                <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab" tabindex="0">
                  <div class="container bg-grey p-2 my-2 border col-md-12">
                   @forelse ($members
            ->take(3) as $member)
                      <a href="{{ url('members/'.$member->id) }}" target="_blank" style="text-decoration: none;">
                        <div class="row col-md-12 text-dark">
                          <div class="item-thumbnail col-md-5">
                            <img src="{{asset('/uploads/customer/'.$member->image)}}" alt="image" class="img-fluid">
                          </div>
                          <div class="col-md-6 my-3">
                          <h5>{{ $member->name }}</h5>
                          <p>Height : {{ $member->height }}cm</p>
                          <p>Weight : {{ $member->weight }}</p>
                          </div>
                        </div> 
                      </a>  
                   @empty
                       <div>No Registered Member</div>
                   @endforelse
                  </div>
                </div>
                
              </div>

            </div>
        </div>
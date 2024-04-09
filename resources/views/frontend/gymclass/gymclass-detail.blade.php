<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css
    ">
    <title>GymClass Details</title>
</head>

<body>
    <div class="container mt-4">
        <!-- Added mt-4 for margin-top -->
        <div class="row">
            <div class="col-md-4"> 
                <img src="{{ $gymClassInfo->image }}" width="70" style="width:70%"
                    class="d-inline-block bg-transparent ">

                <p class="mt-4">{{ $gymClassInfo->name }}</p>    
                <p>{{ $gymClassInfo->description }}</p>    
            </div>

            <div class="col-md-6">
                @foreach ($gymClassInfo->trainers as $gymTrainer)
                    <div class="card">
                        <div class="card-header">Trainer Informations </div>
                        <div class="card-body">
                            <p>Name : {{ $gymTrainer->name }}</p>
                            <p>Email : {{ $gymTrainer->email }}</p>
                            <p>Phone : {{ Auth::user()->phone_number }}</p>
                            <p>Facebook : {{ $gymTrainer->fb_name }}</p>
                            <p>Twitter : {{ $gymTrainer->twitter_name }}</p>
                            <p>Linked-in : {{ $gymTrainer->linkin_name }}</p> 
                            <?php $daysOfWeekString = $gymClassInfo->schedules->pluck('daysOfWeek.name')->implode(', ');?>
                            <?php 
                            $gymPlayTime = $gymClassInfo->schedules->pluck('hours_From', 'hours_To')
                                ->map(function ($from, $to) {
                                    return "$from - $to";
                                })
                                ->implode(', ');
                            ?>
                            <p>Schedule : {{ $daysOfWeekString }}</p> 
                            <p>Time : {{ $gymPlayTime }}</p> 
                        </div>
                    </div><br>
                @endforeach
                
            </div>
        </div>
    </div>
</body>



</html>

{{-- @endsection --}}
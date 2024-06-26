<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Trainer;
use App\Traits\UploadImageTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Http\Resources\TrainerResource;
use App\Http\Requests\TrainerFormRequest;

class TrainerController extends Controller
{
    use UploadImageTrait;
    public function index()
    {
        $trainers = Trainer::paginate(Config::get('variables.NUMBER_OF_ITEMS_PER_PAGE'));
        if (request()->expectsJson()) {
            return TrainerResource::collection($trainers);
        }
        return view('admin.trainer.index', compact('trainers'));
    }
    public function create()
    {
        return view('admin.trainer.create');
    }

    public function store(TrainerFormRequest $request)
    { 
        $trainer = new Trainer();
        $this->uploadImage($request, $trainer, "trainer");
        $validatedData = $request->validated(); 
        $trainer->create($validatedData);

        if (request()->expectsJson()) {
            return new TrainerResource($trainer);
        }
        return redirect('admin/trainers')->with(
            'message',
            'Trainer Added Successfully'
        );
    }

    public function edit(Trainer $trainer)
    {
        return view('admin.trainer.edit', compact('trainer'));
    }

    public function update(TrainerFormRequest $request, Trainer $trainer)
    {
        $validatedData = $request->validated();
        $trainer = Trainer::findOrFail($trainer->id);

        $trainer->name = $validatedData['name']?? $trainer->name;
        $trainer->description = $validatedData['description']?? $trainer->description;
        $trainer->fb_name = $validatedData['fb_name'] ?? $trainer->fb_name;
        $trainer->twitter_name = $validatedData['twitter_name'] ?? $trainer->twitter_name;
        $trainer->linkin_name = $validatedData['linkin_name'] ?? $trainer->linkin_name;
        if($this->deleteImage($trainer)){
            $this->uploadImage($request, $trainer, "trainer");
        }

        $trainer->update();

        if (request()->expectsJson()) {
            return new TrainerResource($trainer);
        }

        return redirect('admin/trainers')->with(
            'message',
            'Trainer Updated Successfully'
        );
    }
    public function destroy($trainer_id)
    {
        $trainer = Trainer::findOrFail($trainer_id);
        $this->deleteImage($trainer);
        $trainer->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'status' => 200,
                'message' => 'Gym Trainer has been deleted successfully',
            ]);
        }

        return redirect('admin/trainers')->with(
            'message',
            'Trainer has been Deleted Successfully'
        );
    }

    public function organizationChart()
    {
        $staffs = User::where('role_as', 5)->with('position')->get();
        return view('admin.dashboard.organization_chart',['staffs'=> $staffs]);
    }
}

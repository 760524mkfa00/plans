<?php

namespace Plans\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Plans\Models\Plan;
use Illuminate\Http\Request;
use JildertMiedema\LaravelPlupload\Facades\Plupload;

class PlanController extends Controller
{


    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadFile($id)
    {

        $file = Plan::findOrFail($id);

        // Check if it's stored locally, from original upload
        if(substr($file->path, 0, 3) === 'app')
        {
            return response()->download(storage_path("{$file->path}"), "{$file->name}.pdf");
        }

        $disk = Storage::disk('s3');
        $cloudFile = $disk->getDriver()->readStream($file->path);
        $size = $disk->size($file->path)

//        $size = Storage::disk('s3')->size($file->path);

        return \Response::stream(function() use($cloudFile, $size) {
            fpassthru($cloudFile);
        }, 200, [
            "Content-Type" => "application/pdf",
            "Content-Length" => $size,
            "Content-disposition" => "attachment; filename={$file->name}",
        ]);

    }

    public function uploadFile(Request $request)
    {

        return Plupload::receive('file', function ($file) use ($request)
        {

            $s3 = \Storage::disk('s3');

            $name = sha1(time() . $file->getClientOriginalName());
            $extension = $file->getClientOriginalExtension();
            $fileName = "{$name}.{$extension}";

            $filePath = "plans/$request->buildingName/$fileName";

            $s3->put($filePath, fopen($file, 'r+'));

            Plan::create([
                'building_id' => htmlspecialchars_decode($request->building_id),
                'name' => $file->getClientOriginalName(),
                'filename' => $fileName,
                'path' => $filePath,
                'file_type' => $file->getClientOriginalExtension(),
                'floor_id' => null,
                'type_id' => null
            ]);

            return $s3->url($filePath);
        });

//        $file = $request->file('diagram');
//
//        $s3 = \Storage::disk('local');
//

//
//        $s3->put($filePath . $fileName, fopen($file, 'r+'));
//
//        $path = $s3->url($filePath);
//
//        return back()->withMessage('Uploaded to' . $path);

    }

    public function edit(Plan $plan)
    {
        return view('plans.edit')
            ->withPlan($plan);
    }

    public function update(Request $request, Plan $plan)
    {

        $this->validate($request, [
            'name' => 'required',
            'floor_id' => 'required|numeric|min:1',
            'type_id' => 'required|numeric|min:1'
        ]);

        $plan->update($request->all());

        return redirect()->route('building.show', ['building' => $plan->building_id]);

    }
}

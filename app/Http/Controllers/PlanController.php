<?php

namespace Plans\Http\Controllers;

use Illuminate\Support\Facades\File;
use Plans\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

//        // Check if it's stored locally, from original upload
//        if(substr($file->path, 0, 3) === 'app')
//        {
//            return response()->download(storage_path("{$file->path}"), "{$file->name}.pdf");
//        }

        $disk = Storage::disk('s3');
//        $cloudFile = $disk->getDriver()->readStream($file->path);
        $size = $disk->size($file->path);
        $mimeType = $disk->mimeType($file->path);

        $headers = [
            'Content-Type'        => $mimeType,
            'Content-Length'      => $size,
            'Content-Disposition' => "attachment; filename={$file->name}.{$file->file_type}"
        ];

        return \Response::stream(function() use ($disk, $file) {
            $stream = $disk->getDriver()->readStream($file->path);
            fpassthru($stream);
            if (is_resource($stream)) {
                fclose($stream);
            }
        }, 200, $headers);

//
//        return \Response::stream(function() use($cloudFile, $size, $mimeType, $file) {
//            fpassthru($cloudFile);
//        }, 200, [
//            "Content-Type" => $mimeType,
//            "Content-Length" => $size,
//            "Content-disposition" => "attachment; filename={$file->name}.{$file->file_type}",
//        ]);

    }

    public function uploadFile(Request $request)
    {
        //Use Plupload for multiple uploads and larger files
        return Plupload::receive('file', function ($file) use ($request)
        {

            $s3 = Storage::disk('s3');

            $name = sha1(time() . $file->getClientOriginalName());
            $extension = $file->getClientOriginalExtension();
            $fileName = "{$name}.{$extension}";

            $path = "plans/$request->buildingName";

            if(!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            $filePath = "$path/$fileName";


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


    public function remove(Plan $plan)
    {

        // Check if it's stored locally, from original upload
        if(substr($plan->path, 0, 3) === 'app') {
            \File::delete(storage_path($plan->path));

        } else {
            Storage::disk('s3')->delete($plan->path);
        }

        $plan->delete();

        return  back()->withMessage('Plan removed.');
    }
}

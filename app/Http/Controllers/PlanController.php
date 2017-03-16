<?php

namespace Plans\Http\Controllers;

use Plans\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{


    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadFile($id)
    {
        $file = Plan::findOrFail($id)->download();

        return response()->download($file->path, $file->name);


    }

    public function uploadFile(Request $request)
    {
        $file = $request->file('diagram');

        $s3 = \Storage::disk('local');

        $fileName = time() . '-' . $file->getClientOriginalName();

        $filePath = "plans/$request->buildingName/";

        $s3->put($filePath . $fileName, fopen($file, 'r+'));

        $path = $s3->url($filePath);

        return back()->withMessage('Uploaded to' . $path);

    }
}

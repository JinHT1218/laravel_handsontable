<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\APIBaseController as APIBaseController;
use App\Employee;
use Validator;

class PostAPIController extends APIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();
        return $this->sendResponse($employee->toArray(), 'Posts retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'salary' => 'required',
            'month' => 'required'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }


        $employee = Employee::create($input);

        return $this->sendResponse($employee->toArray(), 'Post created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        if (is_null($employee)) {
            return $this->sendError('Post not found.');
        }
        return $this->sendResponse($employee->toArray(), 'Post retrieved successfully.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'salary' => 'required',
            'month' => 'required'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }


        $employee = Employee::find($id);
        if (is_null($employee)) {
            return $this->sendError('Post not found.');
        }


        $employee->name = $input['name'];
        $employee->salary = $input['salary'];
        $employee->month = $input['month'];
        $employee->save();


        return $this->sendResponse($employee->toArray(), 'Post updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);

        if (is_null($employee)) {
            return $this->sendError('Post not found.');
        }

        $employee->delete();
        return $this->sendResponse($id, 'Tag deleted successfully.');
    }
}
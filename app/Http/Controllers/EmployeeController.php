<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    // get data
    public function index()
    {
        $employees = Employees::whereNull('deleted_on')->get();

        return response()->json([
            'status_code' => 200,
            'message' => 'Data berhasil ditemukan',
            'data' => $employees
        ]);
    }

    // simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nomor' => 'required|unique:employees',
            'nama' => 'required',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nomor', 'nama', 'jabatan', 'talahir', 'created_by']);
        $data['created_on'] = now();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('employees', 'public');
            $data['photo_upload_path'] = asset('storage/' . $path);
        }

        $employee = Employees::create($data);

        return response()->json([
            'status_code' => 201,
            'message' => 'Data berhasil disimpan',
            'data' => $employee
        ]);
    }

    // update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor' => 'required|unique:employees,nomor,' . $id,
            'nama' => 'required',
            'photo' => 'nullable|image|max:2048',
        ]);

        $employee = Employees::findOrFail($id);

        $data = $request->only(['nomor', 'nama', 'jabatan', 'talahir']);
        $data['updated_on'] = now();
        $data['updated_by'] = $request->input('updated_by'); 
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('employees', 'public');

            $data['photo_upload_path'] = asset("storage/" . $path);
        }

        $employee->update($data);

        return response()->json([
            'status_code' => 200,
            'message' => 'Data berhasil diubah',
            'data' => $employee
        ]);
    }

    // hapus data 
   public function destroy($id)
    {
        $employee = Employees::findOrFail($id);
        $employee->delete();

        return response()->json([
            'status_code' => 200,
            'message' => 'Data berhasil dihapus'
        ]);
    }


}




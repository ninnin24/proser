<?php

namespace App\Http\Controllers;

use App\Models\Novel;
use Illuminate\Http\Request;
use App\Http\Resources\NovelResource;
use Illuminate\Support\Facades\Log;

class NovelController extends Controller
{
    

public function index()
{
    return NovelResource::collection(Novel::all());
}

public function store(Request $request)
{
    try {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255', 
            'author' => 'required|string|max:255', 
            'description' => 'nullable|string',
        ]);
        
        // สร้างสินค้าใหม่
        $Novel = Novel::create($validatedData);

        // ส่งการตอบกลับ JSON พร้อมข้อมูลสินค้าใหม่
        return response()->json($Novel, 201);

    } catch (\Exception $e) {
        // บันทึกข้อผิดพลาดลงใน log
        Log::error($e->getMessage());

        // ส่งการตอบกลับ JSON พร้อมรายละเอียดข้อผิดพลาด
        return response()->json(['error' => $e->getMessage()], 500); // เพิ่มการแสดงข้อผิดพลาดใน response
    }
}



    public function show($id)
    {
        return Novel::find($id);
    }

    public function update(Request $request, $id)
    {
        try {
            // ค้นหานวนิยายตามไอดี
            $novel = Novel::findOrFail($id);
    
            // ตรวจสอบข้อมูลที่ส่งเข้ามาว่าถูกต้องหรือไม่
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);
    
            // อัปเดตข้อมูลของนวนิยาย
            $novel->update($validatedData);
    
            // ส่งการตอบกลับ JSON พร้อมข้อมูลนวนิยายที่อัปเดต
            return response()->json($novel, 200);
    
        } catch (\Illuminate\Database\QueryException $e) {
            // แสดงข้อความข้อผิดพลาดจากฐานข้อมูล
            return response()->json(['error' => 'เกิดข้อผิดพลาดในการเข้าถึงข้อมูล: ' . $e->getMessage()], 500);
    
        } catch (\Exception $e) {
            // แสดงข้อความข้อผิดพลาดทั่วไป
            return response()->json(['error' => 'เกิดข้อผิดพลาดในการอัปเดตข้อมูล กรุณาลองใหม่อีกครั้ง'], 500);
        }
    }
    
    

    public function destroy($id)
{
    // ค้นหาสินค้าในฐานข้อมูล
    $Novel = Novel::find($id);

    // ตรวจสอบว่าสินค้ามีอยู่หรือไม่
    if (!$Novel) {
        return response()->json(['error' => 'Novel not found.'], 404);
    }

    // ลบสินค้า
    $Novel->delete();

    // ส่งการตอบกลับ JSON พร้อมข้อความสำเร็จ
    return response()->json(['success' => 'ลบเรียบร้อยแล้ว.'], 200);
}

}
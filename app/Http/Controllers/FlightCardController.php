<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FlightCardController extends Controller
{
    public function index(Request $request)
    {
        // 1. التجهيز: بدأ الاستعلام
        $flightsQuery = Flight::query();

        // 2. التحميل المسبق (Eager Loading)
        // ضروري جداً لجلب أسماء المدن والمطارات والبوابات دفعة واحدة لتسريع الأداء
        $flightsQuery->with([
            'departureAirport.city', // لجلب مدينة الإقلاع (Aleppo)
            'arrivalAirport.city',   // لجلب مدينة الوصول (Damascus)
            'airplane.company',      // لجلب اسم الشركة ورمزها
            'departureGate',      // لجلب رقم البوابة
            'ticket',                // لجلب التذاكر المرتبطة بالرحلة
        ]);


        // 3. الفلترة (Tabs: Local vs International)
        // إذا ضغط المستخدم على زر "Local Flights"
        if ($request->has('type') && $request->type == 'local') {
            // هنا نحتاج منطق لمقارنة الدول، سأشرحه في الملاحظات بالأسفل
        }

        $flights = $flightsQuery->get();
        // 4. تنسيق البيانات (Transformation)
        // هذه الخطوة تحول بيانات الداتابيز لشكل يناسب الواجهة تماماً
        $formattedFlights = $flights->map(function ($flight) {
            return [
                'id' => $flight->id,
                // تجميع رقم الرحلة: رمز الشركة + الرقم التسلسلي للطائرة
                'flight_number' => $flight->airplane->company->name . ' ' . $flight->airplane->serial_number,

                // التنوع (محلي/دولي) - افتراضياً
                'type' => 'Local',
                'status' => $flight->Scheduled, // On Time, Delayed...

                // المسار (أسماء المدن)
                'origin' => $flight->departureAirport->city->name,
                'destination' => $flight->arrivalAirport->city->name,

                // تنسيق الوقت ليظهر ساعات ودقائق فقط (10:30)
                'departure_time' => Carbon::parse($flight->departure_time)->format('H:i'),
                'arrival_time' => Carbon::parse($flight->arrival_time)->format('H:i'),

                // معلومات المطار
                'gate' => $flight->departureGate->gate_number ?? 'TBD',
                'terminal' => 'T1', // نحتاج لإضافة هذا العمود في الداتابيز

                // السعر (نحتاج لإضافته في جدول الرحلات)
                'price' => $flight->ticket[0]->price ?? 150.00,
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $formattedFlights
        ]);
    }


    // public function index()
    // {
    //     $tickets = Flight::tickets()->user_id();
    //     $data = Flight::all();
    //     return response()->json($data);
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Flight::create($request->all());
        return response()->json(['message' => 'Flight created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Flight $flight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flight $flight)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flight $flight)
    {
        Flight::findOrFail($flight->id);
        Flight::where('id', $flight->id)->update($request->all());
        return response()->json(['message' => 'Flight updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flight $flight)
    {
        Flight::findOrFail($flight->id);
        Flight::where('id', $flight->id)->delete();
        return response()->json(['message' => 'Flight deleted successfully'], 200);
    }
}

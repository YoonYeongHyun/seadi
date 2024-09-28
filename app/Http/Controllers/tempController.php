<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReservationRequest;
use App\Models\Reservation;

class RequestController extends Controller
{
    public function index(Request $request)
    {   
        // 모든 예약 요청을 조회하여 뷰로 전달
        $email = $request->input('email');
        $reservations = ReservationRequest::when($email, function ($query, $email) {
            return $query->where('email', 'like', '%' . $email . '%');
        })
        ->orderBy('no', 'desc')
        ->paginate(10);

        return view('admin', compact('reservations'));
    }

    public function getReservedTimes(Request $request)
    {
        // 요청된 날짜를 받아서 예약된 시간 조회
        $date = $request->query('date'); // YYYY-MM-DD 형식으로 전달됨
    
        // reservations 테이블에서 해당 날짜의 예약된 시간을 조회
        $reservedTimes = Reservation::where('reservation_date', $date)->pluck('reservation_time');

        // JSON 형식으로 예약된 시간 리스트 반환
        return response()->json($reservedTimes);
    }

    public function updateStatus(Request $request, $no)
    {
        // 예약 상태 업데이트
        $reservation = ReservationRequest::findOrFail($no);
        $reservation->status = $request->input('status');
        $reservation->save();
        
        // 예약이 확인되었다면 reservations 테이블에 추가
        if ($request->input('status') === 'confirmed') {
            Reservation::create([
                'no_reservation' => $reservation->no,  // 여기서 수정
                'status' => 'confirmed',
                'email' => $reservation->email,
                'reservation_date' => $reservation->request_date,
                'reservation_time' => $reservation->request_time,
                'confirmed_date' => now(),
            ]);
        }

        return back()->with('success', 'Reservation status updated successfully!');
    }
    
    // 예약 요청을 저장하는 메소드
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'request_date' => 'required|date',
            'request_time' => 'required|date_format:H:i',
            'service' => 'required|string'
        ]);

        $reservationRequest = new ReservationRequest([
            'email' => $request->email,
            'request_date' => $request->request_date,
            'request_time' => $request->request_time,
            'status' => 'pending', // 기본 상태 설정
            'service' => $request->service
        ]);

        $reservationRequest->save();

        return back()->with('success', 'Reservation request has been submitted successfully!');
    }
    public function adminStore(Request $request)
    {
        $request->validate([
            'request_date' => 'required|date', // Validation to ensure a date is selected
            'request_times' => 'required' // Validation to ensure times are selected
        ]);

        $times = explode(',', $request->input('request_times')); // Assuming the times are sent as a comma-separated string in 'request_times'

        foreach ($times as $time) {
            Reservation::create([
                'email' => 'default@example.com', // You need to modify or ensure this matches your requirements
                'reservation_date' => $request->input('request_date'),
                'reservation_time' => $time,
                'status' => 'confirmed' // Assuming 'booked' is a valid status
            ]);
        }

        return back()->with('success', 'Reservation request has been submitted successfully!');
    }
    
}
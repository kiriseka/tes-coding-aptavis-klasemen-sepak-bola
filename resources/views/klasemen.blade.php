@extends('layouts.app')

@section('content')
<h1>Hasil Klasemen </h1>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Klub</th>
      <th scope="col">Ma</th>
      <th scope="col">Me</th>
      <th scope="col">S</th>
      <th scope="col">K</th>
      <th scope="col">GM</th>
      <th scope="col">GK</th>
      <th scope="col">Point</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($clubs as $club)
    @php
        // Menghitung Kemenangan
        $home = DB::table('scores')
                    ->where('id_tim1', $club->id)
                    ->whereRaw('skor_tim1 > skor_tim2')
                    ->count();

        $away = DB::table('scores')
                    ->where('id_tim2', $club->id)
                    ->whereRaw('skor_tim2 > skor_tim1')
                    ->count();

        $me = $home + $away;

        // Menghitung seri
        $homes = DB::table('scores')
                    ->where('id_tim1', $club->id)
                    ->whereRaw('skor_tim1 = skor_tim2')
                    ->count();

        $aways = DB::table('scores')
                    ->where('id_tim2', $club->id)
                    ->whereRaw('skor_tim2 = skor_tim1')
                    ->count();

        $s = $homes + $aways;


        // Menghitung Kalah
        $homek = DB::table('scores')
                    ->where('id_tim1', $club->id)
                    ->whereRaw('skor_tim1 < skor_tim2')
                    ->count();

        $awayk = DB::table('scores')
                    ->where('id_tim2', $club->id)
                    ->whereRaw('skor_tim2 < skor_tim1')
                    ->count();

        $k = $homek + $awayk;

        
        // Menghitung Goal Menang
        $homegm = DB::table('scores')
                    ->where('id_tim1', $club->id)
                    ->select(DB::raw('SUM(skor_tim1) AS total'))
                    ->first()
                    ->total; 

        $awaygm = DB::table('scores')
                    ->where('id_tim2', $club->id)
                    ->select(DB::raw('SUM(skor_tim2) AS total'))
                    ->first()
                    ->total; 

        $gm = $homegm + $awaygm;


        // Menghitung Goal Kalah
        $homegk = DB::table('scores')
                    ->where('id_tim1', $club->id)
                    ->select(DB::raw('SUM(skor_tim2) AS total'))
                    ->first()
                    ->total; 

        $awaygk = DB::table('scores')
                    ->where('id_tim2', $club->id)
                    ->select(DB::raw('SUM(skor_tim1) AS total'))
                    ->first()
                    ->total; 

        $gk = $homegk + $awaygk;


        // Menghitung Point
        $point = ($me * 3) + ($s * 1) + ($k * 0); 




    @endphp
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $club->name }}</td>
            <td>   
                {{  
                    $count = DB::table('scores')
                    ->where('id_tim1', $club->id)
                    ->orWhere('id_tim2', $club->id)
                    ->count()
                }}
            </td>
            <td>{{ $me }}</td>
            <td>{{ $s }}</td>
            <td>{{ $k }}</td>
            <td>{{ $gm }}</td>
            <td>{{ $gk }}</td>
            <td>{{ $point }}</td>
        </tr>
    @endforeach
  </tbody>
</table>
@endsection
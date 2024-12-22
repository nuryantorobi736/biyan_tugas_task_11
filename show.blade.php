@extends('adminlte::page')
@section('title', 'Form mahasantri')
@section('content_header')
@stop
 

@section('content')

<h1 > Form mahasantri</h1>
@php
        $rs1 = App\Models\dosen::all();
        $rs2 = App\Models\matakuliah::all();
        $rs3 = App\Models\jurusan::all();
@endphp

@foreach($ar_mahasantri as $b)

<form action="#" >
    @csrf
    <div class="form-group">
    <label for="">NIM</label>
    <input type="text"placeholder="{{ $b->nim}}" class="form-control" disabled/>
    </div>

    <div class="form-group">
    <label for="">nama</label>
    <input type="text" placeholder="{{ $b->nama}}" class="form-control" disabled/>
    </div>

    <div class="form-group">
    <label for="">jurusan</label>
    <input type="text" placeholder="{{ $b->jurusan}}" class="form-control" disabled/>
    </div>


    <div>
        <div class="form-label">
            <label>dosen</label>
            <select name="iddosen" class="form-control" disabled>
                <option value="">--Pilih dosen--</option>
                @foreach($rs1 as $p)
                @php
                      $sel1 = ($p->id == $b->iddosen) ? 'selected' : ''; 
                @endphp
                   <option value="{{ $p->id }}" {{ $sel1}}>{{ $p->nama }}</option>
                @endforeach    
            </select>
        </div>
    </div>
    <div>
        <div class="form-label">
            <label>matakuliah</label>
            <select name="idmatakuliah" class="form-control" disabled>
                <option value="">--Pilih matakuliah--</option>
                @foreach($rs2 as $mk)
                @php
                      $sel2 = ($mk->id == $b->idmatakuliah) ? 'selected' : ''; 
                @endphp
                   <option value="{{ $p->id }}" {{ $sel2}}>{{ $mk->nama }}</option>
                @endforeach    
            </select>
        </div>
    </div>
    <div>
        <div class="form-label">
            <label>jurusan</label>
            <select name="idjurusan" class="form-control" disabled>
                <option value="">--Pilih jurusan--</option>
                @foreach($rs3 as $jrs)
                @php
                      $sel3 = ($jrs->id == $b->idjurusan) ? 'selected' : ''; 
                @endphp
                   <option value="{{ $jrs->id }}" {{ $sel3}}>{{ $jrs->nama }}</option>
                @endforeach    
            </select>
        </div>
    </div>

    <a class="btn btn-primary btn-md"
    href="{{ route('mahasantri.index') }}" role="button"><i class="fa fa-arrow-left"> Back</i></a>
    <!-- <button type="submit" class="btn btn-primary"><i class="fa fa-check"> Simpan</i></button>
     -->
</form>
@endforeach
@stop

@section('css')
<link rel="stylesheet" href="css/admin_custom.css">
@stop

@section('js')
<script> console.log('Hi'); </script>
@stop

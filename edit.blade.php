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

@foreach($data as $d)

<form action="{{ route('mahasantri.update',$d->id) }}" method="POST"  >
    @csrf
    @method('put')
    <div class="form-group">
    <label for="">NIM</label>
    <input type="text"placeholder="{{ $d->nim}}" class="form-control" />
    </div>

    <div class="form-group">
    <label for="">nama</label>
    <input type="text" placeholder="{{ $d->nama}}" class="form-control" />
    </div>

    
    <div>
        <div class="form-label">
            <label>dosen</label>
            <select name="iddosen" class="form-control" >
                <option value="">--Pilih dosen--</option>
                @foreach($rs1 as $d)
                @php
                      $sel1 = ($d->id == $d->iddosen) ? 'selected' : ''; 
                @endphp
                   <option value="{{ $d->id }}" {{ $sel1}}>{{ $d->nama }}</option>
                @endforeach    
            </select>
        </div>
    </div>
    <div>
        <div class="form-label">
            <label>matakuliah</label>
            <select name="idmatakuliah" class="form-control" >
                <option value="">--Pilih matakuliah--</option>
                @foreach($rs2 as $mk)
                @php
                      $sel2 = ($mk->id == $d->idmatakuliah) ? 'selected' : ''; 
                @endphp
                   <option value="{{ $d->id }}" {{ $sel2}}>{{ $mk->nama }}</option>
                @endforeach    
            </select>
        </div>
    </div>
    <div>
        <div class="form-label">
            <label>jurusan</label>
            <select name="idjurusan" class="form-control" >
                <option value="">--Pilih jurusan--</option>
                @foreach($rs3 as $jrs)
                @php
                      $sel3 = ($jrs->id == $d->idjurusan) ? 'selected' : ''; 
                @endphp
                   <option value="{{ $jrs->id }}" {{ $sel3}}>{{ $jrs->nama }}</option>
                @endforeach    
            </select>
        </div>
    </div>
   <br></br>
    <button type="submit" class="btn btn-primary"><i class="fa fa-check">Update</i></button>
    
</form>
@endforeach
@stop


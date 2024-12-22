
@extends('adminlte::page') 
@section('title', 'Form mahasantri') 
@section('content_header')
    <h1>Form mahasantri</h1>
    <br/><br/>
    <a href="{{ route('mahasantri.index') }}"class="btn btn-info btn-md"role="button"><i class="fa fa-arrow-left">Back</i></a>
@stop
@section('content') 

@if($errors->any())
    <div class="alert alert-danger">
    <ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li> 
    @endforeach
    </ul>
    </div>
    @endif

    @php
        $rs1 = App\Models\dosen::all();
        $rs2 = App\Models\matakuliah::all();
        $rs3 = App\Models\jurusan::all();
    @endphp
    <form action= "{{ route('mahasantri.store') }}"method ="POST">
        @csrf 
        
        <div class="form-group">
    <label for="">Nama</label>
    <input type="text" name="nama" class="form-control"/>
    </div>

    <div class="form-group">
    <label for="">NIM</label>
    <input type="text" name="nim" class="form-control"/>
    </div>


        <div class="form-group">
            <label>dosen</label>
            <select class="form-control" name="dosen_id">
                <option value="">-- Pilih dosen --</option>
                @foreach ($rs1 as $dsn)
                <option value="{{ $dsn->id }}">{{ $dsn->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
                <label>matakuliah</label>
                <select class="form-control" name="matakuliah_id">
                    <option value=
                    "">-- Pilih matakuliah --</option>
                    @foreach($rs2 as $mk)
                    <option value=
                    "{{ $mk->id }}">{{ $mk->nama }}</option> 
                    @endforeach
                </select>
        </div>

        <div class="form-group">
                <label>jurusan</label>
                <select class="form-control" name="jurusan_id">
                    <option value=
                    "">-- Pilih jurusan --</option>
                    @foreach($rs3 as $jrs)
                    <option value=
                    "{{ $jrs->id }}">{{ $jrs->nama }}</option> 
                    @endforeach
                </select>
        </div>
        <button type="submit" class="btn btn-primary"name="proses">Simpan</button>
    </form>
@stop
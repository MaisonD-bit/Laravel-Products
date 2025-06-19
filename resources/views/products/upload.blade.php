@extends('layouts.app')

@section('content')
<div>
    <form action="{{ route('products.storeFile') }}" method="post" enctype="multipart/form-data">
        @csrf
        Select a file to upload<br><input type="file" name="uploadFile" id=""></input>
        @error('uploadFile')
            <span style="color:red">{{ $message }}</span>
        @enderror
        <br>
        <button type="submit" class="btn btn-primary">Upload</button>
        @if( isset($path) )
            <img src="{{  asset($path) }}" alt="">
        @endif
    </form>
</div>
@endsection

@if(isset($url))
    <div class="mt-3">
        <img src="{{ $url }}" alt="Uploaded Image" style="max-width: 100%; height: auto;">
    </div>
@endif
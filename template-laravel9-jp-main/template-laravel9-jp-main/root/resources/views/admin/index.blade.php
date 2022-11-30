@extends('admin.base')

@section('title', 'ホーム')
@section('subtitle', 'ホームサブタイトル')
@section('css')

@endsection

@section('content')
<p>ホームです。</p>
@endsection

@section('script')
<form action="{{ route('admin.jobs.csv') }}" method="POST">
  @csrf
  <button type="submit" class="btn btn-primary">CSV</button>
</form>
<form action="{{ route('admin.jobs.tsv') }}" method="POST">
  @csrf
  <button type="submit" class="btn btn-primary">TSV</button>
</form>
@endsection

@extends('admin.master')
@section('css')
    
@endsection
@section('title')
    {{trans('admin_stitle_page_trans.Dashboard')}}
@endsection
@section('title_page')
    {{trans('admin_stitle_page_trans.Dashboard')}}
@endsection
@section('content')
{{Request::route()->getname() }}
    
   
@endsection



@section('js')
    
@endsection
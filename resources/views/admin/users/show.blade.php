@extends('adminlte::page')

@section('title', 'Member Detail')

@section('content_header')

    <h1>Add Login Account</h1>

@stop
 <style type="text/css" media="screen">
     td{
        width: 50%;
     }
 </style>
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="" align="center">
                <br>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('admin.users.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <br>

   <div class="card-body">
        <div class="row" align="center">
           <center>
            <img src="{{ asset('uploads/members/'.$member->pic) }}" alt="pic" width="20%" style="border: 1px solid;">
            </center>

             <table class="table table-bordered">

                    <tr>
                        <td>
                            <label class="unicode" for="1">Name</label>
                        </td>
                        <td class="unicode">
                            {!! zawuni( $member->name) !!}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label class="unicode" for="2">Email</label>

                        </td>
                        <td class="unicode">
                            {!! zawuni( $member->email) !!}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label class="unicode" for="3">NRC Number</label>

                        </td>
                        <td class="unicode"> 
                            {!! zawuni( $member->nrc) !!} 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="unicode" for="4">Phone</label>

                        </td>
                        <td class="unicode"> 
                            {!! zawuni( $member->phone) !!} 
                        </td>
                    </tr>

                     <tr>
                        <td>
                            <label class="unicode" for="3">
                                Address
                            </label>

                        </td>
                        <td class="unicode"> 
                             {!! zawuni( $member->address) !!} 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="unicode" for="4">NRC Front Photo</label>

                        </td>
                        <td class="unicode">
                            <img src="{{ asset('uploads/members/'.$member->nrc_front) }}" alt="nrc_front" width="50%" style="border: 1px;">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label class="unicode" for="4">NRC Back Photo</label>

                        </td>
                        <td class="unicode">
                            <img src="{{ asset('uploads/members/'.$member->nrc_back) }}" alt="nrc_back" width="50%" style="border: 1px;">
                        </td>
                    </tr>

                    <tr>
                        <td class="unicode" align="center" colspan="2">Business Informations</td>
                    </tr>
                    <tr>
                        <td>
                            <label class="unicode" for="4">Shop/Company Name</label>

                        </td>
                        <td class="unicode"> 
                            {!! zawuni( $member->business_name) !!} 
                        </td>
                    </tr>

                     <tr>
                        <td>
                            <label class="unicode" for="3">
                                Business Start Date
                            </label>

                        </td>
                        <td class="unicode"> 
                             {!! zawuni( $member->business_start_date) !!} 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="unicode" for="4">Business Contact Number</label>

                        </td>
                        <td class="unicode">
                           {!! zawuni( $member->business_contact_no) !!} 
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label class="unicode" for="4">Business Address</label>

                        </td>
                        <td class="unicode">
                            {!! zawuni( $member->business_address) !!} 
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label class="unicode" for="8">Account Status</label>

                        </td>
                        <td class="unicode">
                            {{-- @if($member[0]->status=0)
                                <p class="btn btn-sm btn-primary">Pending</p>
                            @else
                                <p class="btn btn-sm btn-success">Active</p>
                            @endif --}}
                        </td>
                    </tr>
                </table>
           
            </div>
        </div>
        
   </div>

@stop



@section('css')
 
   
@stop



@section('js')

   
@stop
@extends('layouts.master')
@section('content')

<link rel="stylesheet" href="{{ asset('css/my_css/admin.css') }}">

{{-- show table and hide it --}}
<button onclick="$('.notification_table').toggle();" style="float: right;margin-right: 100px;" class="show_notification">
        <i class="fas fa-bell fa-2xl"></i>
        <span>{{ $new_notification }}</span>
</button>
{{-- End show table and hide it --}}

{{--  first  --}}
<nav class="mnb navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <i class="ic fa fa-bars"></i>
        </button>
        <div style="padding: 15px 0;">
           <a href="#" id="msbo"><i class="ic fa fa-bars"></i></a>
        </div>
      </div>

  </nav>
  <!--msb: main sidebar-->
  <div class="msb" id="msb">
          <nav class="navbar navbar-default" role="navigation">

              <!-- Main Menu -->
              <div class="side-menu-container">
                  <ul class="nav navbar-nav">

                      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                      <li class="active"><a href="#"><i class="fa fa-puzzle-piece"></i> Components</a></li>
                      <li><a href="#"><i class="fa fa-heart"></i> Extras</a></li>
                      <li><a href="#"><i class="fas fa-bell"></i> Notifications</a></li>

                  </ul>
              </div><!-- /.navbar-collapse -->
          </nav>
  </div>
  <!--main content wrapper-->
  <div class="mcw">
    <!--navigation here-->
    <!--main content view-->
    <div class="cv">
      <div>
       <div class="inbox">
         <div class="inbox-sb">

         </div>
         <div class="inbox-bx container-fluid">
           <div class="row">

             <div class="col-md-10 uu">
               <table class="table table-stripped notification_table">
                 <tbody>
                    <tr>
                        <td><input type="checkbox"/></td>
                        <td><i class="fa fa-star"></i></td>
                        <td><b>title</b></td>
                        <td><b>latest notifications</b></td>
                        <td> Date</td>
                        <td></td>

                      </tr>
                    @foreach ($notifications  as $notification )

                    <tr>
                        <td><input type="checkbox"/></td>
                        <td>
                            @if($notification->unread())

                                <strong>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </strong>
                            </td>
                            @endif
                        <td><i class="{{ $notification->data['icon'] }}"></i></td>
                        <td>{{ $notification->data['title'] }}</td>
                        <td>{{ $notification->data['body'] }}</td>
                        {{-- <td><i class="fa fa-paperclip"></i></td> --}}
                        <td> {{ $notification->data['date']}}</td>
                        <td> <a href="{{$notification->data['url'] }}? notify_id={{ $notification->id }}"><i class="fa fa-paperclip"></i></a></td>

                      </tr>
                    @endforeach




                 </tbody>
               </table>
             </div>
           </div>
         </div>
       </div>
      </div>
    </div>
  </div>
  @endsection


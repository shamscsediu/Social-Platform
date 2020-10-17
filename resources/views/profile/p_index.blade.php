@extends('layouts.dash')
@section('title')
Profile
@stop
@section('script_head')
 <link rel="stylesheet" href="{{url('public/dash/profile/styleprofile.css')}}">
@stop
@section('dash_sect')
	<div class="container main-secction">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 image-section">
                <img src="https://png.pngtree.com/thumb_back/fw800/back_pic/00/08/57/41562ad4a92b16a.jpg">
            </div>
            <div class="row user-left-part">
                <div class="col-md-3 col-sm-3 col-xs-12 user-profil-part pull-left">
                    <div class="row ">
                        <div class="col-md-12 col-md-12-sm-12 col-xs-12 user-image text-center">
                            <img src="{{ asset('/public/storage/'.Auth::user()->image)}}" class="rounded-circle img-thumbnail">
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 user-detail-section1 text-center">
                            <button id="btn-contact" (click)="clearModal()" data-toggle="modal" data-target="#contact" class="btn btn-success btn-block follow">Contactarme</button> 
                            <button class="btn btn-warning btn-block">Descargar Curriculum</button>                               
                        </div>
                        <div class="row user-detail-row">
                            <div class="col-md-12 col-sm-12 user-detail-section2 pull-left">
                                <div class="border"></div>
                                <p>FOLLOWER</p>
                                <span>320</span>
                            </div>                           
                        </div>
                       
                    </div>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-12 pull-right profile-right-section">
                    <div class="row profile-right-section-row">
                        <div class="col-md-12 profile-header">
                            <div class="row">
                                <div class="col-md-8 col-sm-6 col-xs-6 profile-header-section1 pull-left">
                                    <h1>{{Auth::user()->name}}</h1>
                                    
                                </div>
                                @if($prf == '')
                                <div class="col-md-4 col-sm-6 col-xs-6 profile-header-section1 text-right pull-rigth">
                                    <a href="{{url('/profile/create')}}" class="btn btn-primary btn-block">Complete your profile</a>
                                </div>
                                @else
                                <div class="col-md-4 col-sm-6 col-xs-6 profile-header-section1 text-right pull-rigth">
                                    <a href="{{url('/profile')}}/{{$prf->id}}/edit" class="btn btn-primary btn-block">Update your profile</a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-8">
                                        <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                  <a class="nav-link active" href="#profile" role="tab" data-toggle="tab"><i class="fas fa-user-circle"></i>About</a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#buzz" role="tab" data-toggle="tab"><i class="fas fa-info-circle"></i>Basic information</a>
                                                </li>                                                
                                              </ul>
                                              
                                              <!-- Tab panes -->
                                              @if($prf != null)
                                              <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane fade show active" id="profile">
                                                        <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>Full Name</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    @if($prf->full_name !="")
                                                                      <p>  {{$prf->full_name}}
                                                                    </p>
                                                                    @else
                                                                    <p>Not updated yet</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>Date of birth</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    @if($prf->Dateofbirth !="")
                                                                      <p>  {{$prf->Dateofbirth}}
                                                                    </p>
                                                                    @else
                                                                    <p>Not updated yet</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>Email</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p>{{Auth::user()->email}}</p>
                                                                </div>
                                                            </div>                                                
                                                </div>
                                                <div role="tabpanel" class="tab-pane fade" id="buzz">
                                                        <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>School</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    @if($prf->school !="")
                                                                      <p>  {{$prf->school}}
                                                                    </p>
                                                                    @else
                                                                    <p>Not updated yet</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>College</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                 @if($prf->college !="")
                                                                      <p>  {{$prf->college}}
                                                                    </p>
                                                                    @else
                                                                    <p>Not updated yet</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>University</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    @if($prf->university !="")
                                                                      <p>  {{$prf->university}}
                                                                    </p>
                                                                    @else
                                                                    <p>Not updated yet</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>Working in</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    @if($prf->works_at !="")
                                                                      <p>  {{$prf->works_at}}
                                                                    </p>
                                                                    @else
                                                                    <p>Not updated yet</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            
                                                </div>
                                                
                                              </div>
                          
                                </div>
                                @else
                                Nothing to show
                                @endif
                              <!--   <div class="col-md-4 img-main-rightPart">
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="row image-right-part">
                                              <div class="col-md-6 pull-left image-right-detail">
                                                  <h6>PUBLICIDAD</h6>
                                              </div>
                                          </div>
                                      </div>
                                      <a href="http://camaradecomerciozn.com/">
                                          <div class="col-md-12 image-right">
                                              <img src="http://pluspng.com/img-png/bootstrap-png-bootstrap-512.png">
                                          </div>
                                      </a>
                                      <div class="col-md-12 image-right-detail-section2">
                              
                                      </div>
                                  </div>
                              </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contact">Contactarme</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p for="msj">Se enviará este mensaje a la persona que desea contactar, indicando que te quieres comunicar con el. Para esto debes de ingresar tu información personal.</p>
                    </div>
                    <div class="form-group">
                        <label for="txtFullname">Nombre completo</label>
                        <input type="text" id="txtFullname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txtEmail">Email</label>
                        <input type="text" id="txtEmail" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txtPhone">Teléfono</label>
                        <input type="text" id="txtPhone" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" (click)="openModal()" data-dismiss="modal">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@stop
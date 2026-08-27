@extends('layouts.admin')

@section('content')

    {{ Form::open(array('route' => $route.'.store', 'enctype' => 'multipart/form-data')) }}

    <div class="uk-grid">
        <div class="uk-width-1-1 uk-container-center">
            <div class="md-card">
                <div class="md-card-content large-padding">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-sm-6">
                            <table class="table">
                                <tr>
                                    <th>  CNI du locataire : </th>
                                    <td><span>{{$locataire->cin}}</span></td>

                                </tr>
                                <tr>

                                    <th>Prenom du locataire :</th>
                                    <td><span>{{$locataire->prenom}}</span></td>

                                </tr>
                                <tr>

                                    <th> Nom du locataire :</th>
                                    <td><span>{{$locataire->nom}}</span></td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            @include('pages.reglement.'.$form)
        </div>
    </div>

    <div class="md-fab-wrapper md-fab-speed-dial-horizontal fab-save" data-fab-hover>
        <div class="md-fab-wrapper-small">

            <button class="md-fab md-fab-small md-fab-success" type="submit" data-disable>
                <i class="material-icons">&#xe145;</i>
            </button>
        </div>
        <a class="md-fab md-fab-primary" href="javascript:void(0)"><i class="material-icons">&#xe896;</i></a>
    </div>

    {{ Form::close() }}

@endsection
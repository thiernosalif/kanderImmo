@extends('layouts.admin')

@section('content')

    {{ Form::model($model,array('route' => array($route.'.update', $model->id), 'method' => 'put', 'enctype' => 'multipart/form-data','liste_prop')) }}

    <div class="uk-grid">
        <div class="uk-width-1-1 uk-container-center">
            @include('pages.bien.'.$form)
        </div>
    </div>

    <div class="md-fab-wrapper md-fab-speed-dial-horizontal fab-save" data-fab-hover>
        <div class="md-fab-wrapper-small">
            {!! Html::decode(link_to_route($route.'.index', '<i class="material-icons">&#xe166;</i></a>', null, array('data-disable','class' => 'md-fab md-fab-small md-fab-default', 'title' => 'Annuler'))) !!}
            <a class="md-fab md-fab-small md-fab-danger" href="#"
               data-remote="false" data-confirm="Êtes-vous sûr de vouloir supprimer cet enregistrement ?" data-disable>
                <i class="material-icons">&#xe872;</i>
            </a>
            <button class="md-fab md-fab-small md-fab-warning" type="submit" data-disable>
                <i class="material-icons">&#xE161;</i>
            </button>
        </div>
        <a class="md-fab md-fab-primary" href="javascript:void(0)"><i class="material-icons">&#xe896;</i></a>
    </div>

    {{ Form::close() }}

@endsection

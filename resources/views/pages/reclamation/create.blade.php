@extends('layouts.admin')

@section('content')

    {{ Form::open(array('route' => $route.'.store', 'enctype' => 'multipart/form-data')) }}

    <div class="uk-grid">
        <div class="uk-width-1-1 uk-container-center">
            @include('pages.reclamation.'.$form)
        </div>
    </div>

    <div class="md-fab-wrapper md-fab-speed-dial-horizontal fab-save" data-fab-hover>
        <div class="md-fab-wrapper-small">
           {{-- <a class="md-fab md-fab-small md-fab-default" data-disable href="{{ route('categories.index', $boutique) }}" title="Annuler">
                <i class="material-icons">&#xe166;</i>
            </a>--}}
            <button class="md-fab md-fab-small md-fab-success" type="submit" data-disable>
                <i class="material-icons">&#xe145;</i>
            </button>
        </div>
        <a class="md-fab md-fab-primary" href="javascript:void(0)"><i class="material-icons">&#xe896;</i></a>
    </div>

    {{ Form::close() }}

@endsection
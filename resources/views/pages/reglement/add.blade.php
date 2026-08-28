<h3>
    {{--Article  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;--}}
    <span>
         {{ Form::hidden('locataires_id', $locataire->id) }}

    </span>
</h3>

<div class="md-card">
    <div class="md-card-content large-padding">
        <div class="uk-grid uk-grid-divider uk-margin-small-bottom" data-uk-grid-margin>
            <div class="uk-width-1-1">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1">

                        {{ Form::label('articles_id', 'Article *') }}
                        {{ Form::select('articles_id',$articles ?? [], null,array('id' => 'articles_id', 'class'=>'md-input label-fixed'.($errors->has('articles_id') ? ' md-input-danger' : ''), 'data-md-selectize', 'data-md-selectize-bottom', 'required')) }}
                        {!! $errors->first('articles_id', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1">

                        {{ Form::label('mois_paie', 'Mois paiement *') }}
                        {{ Form::select('mois_paie',$listes_mois ?? [], null,array('id' => 'mois_paie', 'class'=>'md-input label-fixed'.($errors->has('mois_paie') ? ' md-input-danger' : ''), 'data-md-selectize', 'data-md-selectize-bottom', 'required')) }}
                        {!! $errors->first('mois_paie', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                    </div>
                </div>

                <div class="uk-grid" data-uk-grid-margin>
                <!-- <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                        {{ Form::label('type_promo', 'Type promo *') }}
                        {{ Form::select('type_promo', $liste_type_promo ?? [], null,array('id' => 'type_promo', 'class'=>'md-input label-fixed'.($errors->has('type_promo') ? ' md-input-danger' : ''), 'data-md-selectize', 'data-md-selectize-bottom')) }}
                        {!! $errors->first('type_promo', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                    </div>
                </div> -->
                    <div class="uk-width-medium-1-2">

                        {{ Form::label('mode_reglement', 'Mode de reglement *') }}
                        {{ Form::select('mode_reglement',$mode ?? [], null,array('id' => 'mode_reglement', 'class'=>'md-input label-fixed'.($errors->has('mode_reglement') ? ' md-input-danger' : ''), 'data-md-selectize', 'data-md-selectize-bottom', 'required')) }}
                        {!! $errors->first('mode_reglement', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}


                    </div>

                    <div class="uk-width-medium-1-2">
                            {{ Form::label('montant', 'montant') }}
                            {{ Form::number('montant', old('montant'),array( 'class'=>'md-input'.($errors->has('montant') ? ' md-input-danger' : ''))) }}
                            {!! $errors->first('montant', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                        </div>
                </div>

                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                            {{ Form::label('taxe', 'Taxe (si applicable)') }}
                            {{ Form::number('taxe', old('taxe'), array('step' => 'any', 'class'=>'md-input'.($errors->has('taxe') ? ' md-input-danger' : ''))) }}
                            {!! $errors->first('taxe', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                        </div>
                </div>
                
                
               
                  <!--   <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            {{ Form::label('montant', 'montant') }}
                            {{ Form::number('montant', old('montant'),array( 'class'=>'md-input'.($errors->has('montant') ? ' md-input-danger' : ''))) }}
                            {!! $errors->first('montant', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                        </div>
                    </div> -->
                    <div class="uk-grid" data-uk-grid-margin style='display:none'>
                    <div class="uk-width-medium-1-2">
                    {{ Form::label('acompte', 'acompte') }}
                            {{ Form::number('acompte', old('acompte'),array( 'class'=>'md-input'.($errors->has('acompte') ? ' md-input-danger' : ''))) }}
                            {!! $errors->first('acompte', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                        </div>
                    <div class="uk-width-medium-1-2">
                    {{ Form::label('complement', 'complement') }}
                            {{ Form::number('complement', old('complement'),array( 'class'=>'md-input'.($errors->has('complement') ? ' md-input-danger' : ''))) }}
                            {!! $errors->first('complement', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                        </div>
                   
                </div>

                <div class="uk-grid" data-uk-grid-margin >
                        <div class="uk-width-medium-1-1">
                        {{ Form::label('transactionreference', 'Details Reglements *') }}
                        {{ Form::text('transactionreference', old('transactionreference'),array('class'=>'md-input'.($errors->has('transactionreference') ? ' md-input-danger' : ''))) }}
                        {!! $errors->first('transactionreference', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                    </div>
                    </div>

                  <!--   <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                        {{ Form::label('telephone', 'Téléphone *') }}
                        {{ Form::text('telephone', old('telephone'),array('class'=>'md-input'.($errors->has('telephone') ? ' md-input-danger' : ''))) }}
                        {!! $errors->first('telephone', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                    </div>
                    <div class="uk-width-medium-1-2">
                        {{ Form::label('coordonne_pro', 'Coordonnee Professionnelle') }}
                        {{ Form::text('coordonne_pro', old('coordonne_pro'),array('class'=>'md-input'.($errors->has('coordonne_pro') ? ' md-input-danger' : ''))) }}
                        {!! $errors->first('coordonne_pro', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                    </div>
                    modification pour ajout accompte et complement
                </div> -->



                </div>
            </div>
        </div>
    </div>

    @section('styles')

        <link rel="stylesheet" href="{{ asset('dist/assets/skins/dropify/css/dropify.css') }}">
        <style>
            .dropify-wrapper {
                height:100px !important;
            }
        </style>

        @endsection

@section('scripts')
    <!-- jquery ui -->
    <script src="{{ asset('public/dist/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- ionrangeslider -->
    <script src="{{ asset('public/dist/bower_components/ion.rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <!-- select2 -->
    <script src="{{ asset('public/dist/bower_components/select2/dist/js/select2.min.js') }}"></script>
    
                <!--  dropify -->
                <script src="{{ asset('dist/bower_components/dropify/dist/js/dropify.min.js') }}"></script>

<!--  form file input functions -->
<script src="{{ asset('dist/assets/js/pages/forms_file_input.min.js') }}"></script>

    <!--  forms advanced functions -->
{{--    <script src="{{ asset('public/dist/assets/js/pages/forms_advanced.min.js') }}"></script>--}}

    <!-- kendo UI -->
    <link rel="stylesheet" href="{{ asset('public/dist/bower_components/kendo-ui/styles/kendo.common-material.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('public/dist/bower_components/kendo-ui/styles/kendo.material.min.css') }}" id="kendoCSS"/>
        <!-- kendo UI -->
    <script src="{{ asset('public/dist/assets/js/kendoui_custom.min.js') }}"></script>

    <script>
        // var t=$("#uk_dp_start"),e=$("#uk_dp_end"),i=UIkit.datepicker(t,{format:"DD/MM/YYYY"}),n=UIkit.datepicker(e,{format:"DD/MM/YYYY"});
        // t.on("change",function(){
        //     n.options.minDate=t.val(),setTimeout(function(){e.focus()},300)
        // }),
        // e.on("change",function(){i.options.maxDate=e.val()})

   /*      window.onload = function(){

        var x = document.getElementById("refTransaction");
        var y = document.getElementById("mode_reglement");
        y.change(function(){
                if(y.value === "Transaction mobile") {
                    x.style.display = "block";
                   
                }

        

});} */

         $(function() {
            // $('#produits').children('option').remove();
            $('#refTransaction').hide();
          
           

            $('#mode_reglement').change(function(){
                var x = document.getElementById("refTransaction");
                var y = document.getElementById("mode_reglement").value;
                console.log(y);
                if(y === "Transaction mobile") {
                  
                    x.style.display = "block";
                    
                }
            }); 

               </script>
@endsection


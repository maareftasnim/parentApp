<div xmlns:wire="http://www.w3.org/1999/xhtml" xmlns:wire="http://www.w3.org/1999/xhtml"
     xmlns:wire="http://www.w3.org/1999/xhtml" xmlns:wire="http://www.w3.org/1999/xhtml">

    @if(!empty($successMessage))
        <div class="alert alert-success">
            {{ $successMessage }}
        </div>
    @endif

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
    <div class="text-center">
        <!-- progressbar -->
        <ul class="progressbar">
            <li class="{{ $currentStep != 1 ? '' : 'active' }}"><a href="#step-1" type="button">Step 1</a></li>
            <li class="{{ $currentStep != 2 ? '' : 'active' }}"><a href="#step-2" type="button">Step 2</a></li>
            <li class="{{ $currentStep != 3 ? '' : 'active' }}"><a href="#step-3" type="button" disabled="disabled">Step
                    3</a></li>
        </ul>
    </div>
    <div class="row setup-content {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">

        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Step 1</h3>
                <div class="form-group">
                    <label for="title">nom de pere:</label>
                    <input type="text" wire:model="nomP" class="form-control" id="nomP">
                    @error('nomP') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">prenom de pere:</label>
                    <input type="text" wire:model="prenomP" class="form-control" id="prenomP"/>
                    @error('prenomP') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">numero de tel:</label>
                    <input type="text" wire:model="numtelP" class="form-control" id="numtelP"/>
                    @error('numtelP') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">metier de pere:</label>
                    <input type="text" wire:model="metierP" class="form-control" id="taskDescription"/>
                    @error('metierP') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">CID de pere:</label>
                    <input type="text" wire:model="cidP" class="form-control" id="cidP"/>
                    @error('cidP') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="etatP">etat de pere:</label>
                    <input type="checkbox" wire:model="etatP" id="etatP"/>
                    <label for="etatP">non</label>
                    <label for="etatP">non</label>
                    @error('etatP') <span class="error">{{ $message }}</span> @enderror
                </div>

            </div>
            <hr>
            <div class="col-md-12">

                <div class="form-group">
                    <label for="title">nom de mere:</label>
                    <input type="text" wire:model="nomM" class="form-control" id="nomM">
                    @error('nomM') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">prenom de mere:</label>
                    <input type="text" wire:model="prenomM" class="form-control" id="prenomM"/>
                    @error('prenomM') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">numero de tel:</label>
                    <input type="text" wire:model="numtelM" class="form-control" id="numtelM"/>
                    @error('numtelM') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">metier de mere:</label>
                    <input type="text" wire:model="metierM" class="form-control" id="metierM"/>
                    @error('metierM') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">CID de mere:</label>
                    <input type="text" wire:model="cidM" class="form-control" id="cidM"/>
                    @error('cidM') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="etatM">etat de mere:</label>
                    <input type="checkbox" wire:model="etatM" id="etatM">
                    <label for="cidPCheckbox">non</label>
                    <label for="cidPCheckbox">non</label>
                    @error('etatM') <span class="error">{{ $message }}</span> @enderror
                </div>

                <br>
                <br>
                <div class="form-group">
                    <label for="description">numero de tel soeure:</label>
                    <input type="text" wire:model="numtelS" class="form-control" id="numtelS"/>
                    @error('numtelS') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">numero de tel soeure:</label>
                    <input type="text" wire:model="numtelF" class="form-control" id="numtelF"/>
                    @error('numtelF') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="description">email:</label>
                    <input type="email" wire:model="email" class="form-control" id="email"/>
                    @error('email') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">password:</label>
                    <input type="password" wire:model="password" class="form-control" id="password"/>
                    @error('password') <span class="error">{{ $message }}</span> @enderror
                </div>


                <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click="firstStepSubmit" type="button">
                    Next
                </button>
            </div>
        </div>
    </div>
        <div   class="row setup-content {{ $currentStep != 2  }}" id="step-2">





            <div id="form-container">

                <div id="etudiant">


                    <div  class="col-10 col-md-8 col-lg-6">


                        <h3>Add Etudiant</h3>






                        <div class="form-group">
                            <label for="description">prenom:</label>
                            <input type="text"  class="form-control"name="etudiantscol[][prenom]" id="prenom"/>
                            @error('prenom') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">nom:</label>
                            <input type="text"  class="form-control" name="etudiantscol[][nom]" id="nom"/>
                            @error('nom') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">date_naissance:</label>
                            <div class='input-group date' id='datetimepicker'>
                                <input type="date"  class="form-control" id="nom" name="etudiantscol[][date_naissance]"/>
                                @error('date_naissance') <span class="error">{{ $message }}</span> @enderror
                                <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <select name="niveau_id" id="niveau_id" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" >
                                    <?php
                                    $niveau=App\Models\Niveau::get()->all();
                                    ?>
                                <option value="">select niveau</option>
                                @foreach($niveau as $n)
                                    <option value="{{ $n->id }}" >{{ $n->niveauNom }}</option>
                                @endforeach
                            </select>

                        </div>



                    </div>
                </div>









</div>
            <div  class="col-10 col-md-8 col-lg-6">
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" wire:click="secondStepSubmit">Next</button>
                <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(1)">Back</button>
                <button type="button" id="addNewFormButton" >Ajouter un autre enfants</button>


            </div>

</div>





    <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Step 3</h3>
                <table class="table">
                    {{$email}}
                    <tr>
                        <td>nom de pere:</td>
                        <td><strong>{{$nomP}}</strong></td>
                    </tr>
                    <tr>
                        <td>CIN de pere:</td>
                        <td><strong>{{$cidP}}</strong></td>
                    </tr>
                    <tr>
                        <td>email:</td>
                        <td><strong>{{$email}}</strong></td>
                    </tr>
                    <tr>
                        <td>nom de l'enfant:</td>
                        <td><strong>{{$nomM}}</strong></td>
                    </tr>
                    <tr>
                        <td>numtel de pere:</td>
                        <td><strong>{{$numtelP}}</strong></td>
                    </tr>
                </table>
                <button class="btn btn-success btn-lg pull-right" wire:click="submitForm" type="button">Finish!</button>
                <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(2)">Back
                </button>
            </div>
        </div>
    </div>


</div>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker').datetimepicker();
    });
</script>
<script>
    $(document).ready(function () {
        var studentCount = 1;

        $(document).on("click", "#addNewFormButton", function () {
            addNewForm();
        });

        function addNewForm() {
            var newFormContainer = $("#etudiant:first").clone();

            newFormContainer.find('input').each(function () {
                var currentName = $(this).attr('name');
                this.name = currentName.replace('[0]', '[' + studentCount + ']');
            });

            $("#etudiant").append(newFormContainer);
            studentCount++;
        }
    });
</script>

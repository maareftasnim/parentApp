
<div xmlns:wire="http://www.w3.org/1999/xhtml">

    @if(!empty($successMessage))
        <div class="alert alert-success">
            {{ $successMessage }}
        </div>
    @endif

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
    <div class="text-center">

        <ul class="progressbar">
            <li class="{{ $currentStep != 1 ? '' : 'active' }}"><a href="#step-1" type="button">Step 1</a></li>
            <li class="{{ $currentStep != 2 ? '' : 'active' }}"><a href="#step-2" type="button">Step 2</a></li>
            <li class="{{ $currentStep != 3 ? '' : 'active' }}"><a href="#step-3" type="button" disabled="disabled">Step
                    3</a></li>
        </ul>
    </div>
    @if (session()->has('errorMessage'))
        <div class="alert alert-danger">
            {{ session('errorMessage') }}
        </div>
    @endif

    @if (session()->has('successMessage'))
        <div class="alert alert-success">
            {{ session('successMessage') }}
        </div>
    @endif
    <div class="row setup-content {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">

        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Step 1</h3>
                <div class="form-group">
                    <label for="title">nom de pere:</label>
                    <input type="text" wire:model="nomP" class="form-control" id="nomP">
                    @error('nomP') <span class="error" style="color: red">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">prenom de pere:</label>
                    <input type="text" wire:model="prenomP" class="form-control" id="prenomP"/>
                    @error('prenomP') <span class="error" style="color: red">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">numero de tel:</label>
                    <input type="text" wire:model="numtelP" class="form-control" id="numtelP" name="numtelP"/>
                    @error('numtelP') <span class="error" style="color: red">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">metier de pere:</label>
                    <input type="text" wire:model="metierP" class="form-control" id="taskDescription"/>
                    @error('metierP') <span class="error" style="color: red">{{ $message }}</span> @enderror
                </div>



            </div>
            <hr>
            <div class="col-md-12">

                <div class="form-group">
                    <label for="title">nom de mere:</label>
                    <input type="text" wire:model="nomM" class="form-control" id="nomM">
                    @error('nomM') <span class="error" style="color: red">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">prenom de mere:</label>
                    <input type="text" wire:model="prenomM" class="form-control" id="prenomM"/>
                    @error('prenomM') <span class="error" style="color: red">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">numero de tel:</label>
                    <input type="text" wire:model="numtelM" class="form-control" id="numtelM"/>
                    @error('numtelM') <span class="error" style="color: red">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">metier de mere:</label>
                    <input type="text" wire:model="metierM" class="form-control" id="metierM"/>
                    @error('metierM') <span class="error" style="color: red">{{ $message }}</span> @enderror
                </div>



                <br>
                <br>
                <div class="form-group">
                    <label for="description">numero de tel soeure:</label>
                    <input type="text" wire:model="numtelS" class="form-control" id="numtelS"/>
                    @error('numtelS') <span class="error" style="color: red">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">numero de tel soeure:</label>
                    <input type="text" wire:model="numtelF" class="form-control" id="numtelF"/>
                    @error('numtelF') <span class="error" style="color: red">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="description">email:</label>
                    <input type="email" wire:model="email" class="form-control" id="email"/>
                    @error('email') <span class="error" style="color: red" role="alert">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">password:</label>
                    <input type="password" wire:model="password" class="form-control" id="password"/>
                    @error('password') <span class="error" style="color: red">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">password:</label>
                    <input type="password"  wire:model="confirme_password" class="form-control" id="confirme_password"/>
                    @error('confirme_password') <span class="error" style="color: red">{{ $message }}</span> @enderror
                </div>



                <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click="firstStepSubmit" type="button">
                    Next
                </button>
            </div>
        </div>
    </div>
    <div   class="row setup-content {{ $currentStep != 2  ? 'displayNone' : ''  }}" id="step-2">





        <div id="form-container">

            @forelse($etudiantscol as $key => $etud)
                <div id="etudiant-{{ $key }}">
                    <div class="col-10 col-md-8 col-lg-6">
                        <h3>Add Etudiant</h3>

                        <label for="description">Nom:</label>
                        <input type="text" class="form-control" wire:model="etudiantscol.{{ $key }}.nom" name="etudiantscol[{{ $key }}][nom]" />
                        @error("etudiantscol.{$key}.nom") <span class="error" style="color: red">{{ $message }}</span> @enderror

                        <label for="description">Prénom:</label>
                        <input type="text" class="form-control" wire:model="etudiantscol.{{ $key }}.prenom" name="etudiantscol[{{ $key }}][prenom]" />
                        @error("etudiantscol.{$key}.prenom") <span class="error" style="color: red">{{ $message }}</span> @enderror

                        <label for="description">Date de Naissance:</label>
                        <input type="date" class="form-control" wire:model="etudiantscol.{{ $key }}.date_naissance" name="etudiantscol[{{ $key }}][date_naissance]" />
                        @error("etudiantscol.{$key}.date_naissance") <span class="error" style="color: red">{{ $message }}</span> @enderror

                        <div class="row mb-3">
                            <label for="avatar" class="col-md-4 col-form-label text-md-end">{{ __('Avatar') }}</label>
                            <div class="col-md-6">
                                <input id="avatar" type="file" class="form-control" wire:model="etudiantscol.{{ $key }}.avatar" name="etudiantscol[{{ $key }}][avatar]" />
                                @error("etudiantscol.{$key}.avatar")
                                <span class="error" style="color: red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <select wire:model="etudiantscol.{{ $key }}.niveau_id" name="etudiantscol[{{ $key }}][niveau_id]" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                    <?php $niveaux = App\Models\Niveau::get()->all(); ?>
                                <option value="">Select niveau</option>
                                @foreach($niveaux as $n)
                                    <option value="{{ $n->id }}">{{ $n->niveauNom }}</option>
                                @endforeach
                            </select>
                            @error("etudiantscol.{$key}.niveau_id")
                            <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            @empty
                <p>No etudiantscol added yet</p>
            @endforelse
        </div>
        <div  class="col-10 col-md-8 col-lg-6">
            <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" wire:click="secondStepSubmit">Next</button>
            <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(1)">Back</button>
            <button type="button" id="addNewFormButton"wire:click="addEtudiant"  >Ajouter un autre enfants</button>



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
            var newFormContainer = $("#etudiant-0:first").clone();

            newFormContainer.find('input').val('');

            newFormContainer.find('input, select').each(function () {
                var currentName = $(this).attr('name');
                $(this).attr('name', currentName.replace('[0]','['  + studentCount + ']'));

                var currentId = $(this).attr('id');
                $(this).attr('id', currentId.replace('[0]','['  + studentCount + ']'));

                var currentWireModel = $(this).attr('wire:model');
                if (currentWireModel) {
                    $(this).attr('wire:model', currentWireModel.replace('.0.', '.' + studentCount + '.'));
                }
                var currentWirekey = $(this).attr('wire:key');
                if (currentWirekey) {
                    $(this).attr('wire:key', currentWirekey.replace('.0.', '.' + studentCount + '.'));
                }
            });
            newFormContainer.attr('id', 'etudiant-' + studentCount);
            $("#etudiant-0").after(newFormContainer);


            // $("#etudiant").append(newFormContainer);


            studentCount++;
        }
    });

</script>

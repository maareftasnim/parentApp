@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.question.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("questions.store") }}" enctype="multipart/form-data">
                @csrf
                @if (Session::has('success'))
                    <div class="alert alert-success text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('success') }}</p>
                    </div>
                @endif
                <div class="form-group">
                    <label class="required" for="category_id">{{ trans('cruds.question.fields.category') }}</label>
                    <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                        @foreach($categories as $id => $category)
                            <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('category_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('category_id') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.question.fields.category_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="question_text">{{ trans('cruds.question.fields.question_text') }}</label>
                    <textarea class="form-control {{ $errors->has('question_text') ? 'is-invalid' : '' }}" name="question_text" id="question_text" required>{{ old('question_text') }}</textarea>
                    @if($errors->has('question_text'))
                        <div class="invalid-feedback">
                            {{ $errors->first('question_text') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.question.fields.question_text_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="points">time</label>
                    <input class="form-control {{ $errors->has('time') ? 'is-invalid' : '' }}" type="number" name="time" id="time" value="{{ old('time') }}" step="1">
                    @if($errors->has('time'))
                        <div class="invalid-feedback">
                            {{ $errors->first('time') }}
                        </div>
                    @endif

                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection

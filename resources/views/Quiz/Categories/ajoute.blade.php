@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">

        {{ trans('global.create') }} {{ trans('cruds.category.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("categories.store") }}" enctype="multipart/form-data">
            @csrf
            @if (Session::has('success'))
                <div class="alert alert-success text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.category.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.category.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="category_id">{{ trans('cruds.question.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="class_id" id="class_id" required>
                    @foreach($class as $id => $classe)
                        <option value="{{ $id }}" {{ old('class_id') == $id ? 'selected' : '' }}>{{ $classe }}</option>
                    @endforeach
                </select>
                @if($errors->has('class_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('class_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <input hidden class="form-control {{ $errors->has('teacher_id') ? 'is-invalid' : '' }}" type="text" name="teacher_id" id="teacher_id" value="{{ $id }}" >
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

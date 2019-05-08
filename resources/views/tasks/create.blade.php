@extends('layouts.app')

@section('content')

<div class="card bg-light mb-3">
    <div class="card-header">Task Create</div>
    <div class="card-body">
        <form>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="title" placeholder="Title">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" name="des"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Deadline</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="deadline">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">File</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control-file" name="file">
                </div>
            </div>
            <div class="float-right">
                <button type="button" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection
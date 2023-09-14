<!-- Connect to master template -->
@extends('template.master')

<!-- Title -->
@section('title', 'Synodev | Profile')

<!-- Content -->
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">User</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            @foreach ($user as $data)
                            <form action="{{ route('update.user', $data->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" value="{{ $data->name }}" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="email" value="{{ $data->email }}" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Username <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="username" value="{{ $data->username }}" />
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Profile</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            @foreach ($user as $data)
                            <form action="{{ route('update.profile', $data->profile->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">Title</label>
                                    <input class="form-control" type="text" name="title" value="{{ $data->profile->title }}" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Phone</label>
                                    <input class="form-control" type="text" name="phone" value="{{ $data->profile->phone }}" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    @if ($data->profile->desc != null)
                                        <textarea class="form-control" name="desc" rows="5">{{ $data->profile->desc }}</textarea>
                                    @else
                                        <textarea class="form-control" name="desc" rows="5"></textarea>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Address</label>
                                    <input class="form-control" type="text" name="address" value="{{ $data->profile->address }}" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Picture</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="picture">
                                        <label class="input-group-text" for="inputGroupFile01">Browse</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Years of Experience</label>
                                    <input class="form-control" type="number" name="years_experience" value="{{ $data->profile->years_experience }}" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Curriculum Vitae</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="curriculum_vitae">
                                        <label class="input-group-text" for="inputGroupFile01">Browse</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Social Media</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            @foreach ($user as $data)
                            <form action="{{ route('update.socmed', $data->sosmed->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">Instagram</label>
                                    <input class="form-control" type="text" name="instagram" value="{{ $data->sosmed->instagram }}" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Whatsapp</label>
                                    <input class="form-control" type="text" name="whatsapp" value="{{ $data->sosmed->whatsapp }}" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Linkedin</label>
                                    <input class="form-control" type="text" name="linkedin" value="{{ $data->sosmed->linkedin }}" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Github</label>
                                    <input class="form-control" type="text" name="github" value="{{ $data->sosmed->github }}" />
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->

@endsection

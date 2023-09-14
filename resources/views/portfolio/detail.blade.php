<!-- Connect to master template -->
@extends('template.master')

<!-- Title -->
@section('title', 'Synodev | Portfolio Detail')

<!-- Content -->
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Portfolio</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('portfolio') }}">Portfolio</a></li>
                        <li class="breadcrumb-item active">Portfolio Detail</li>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Portfolio Details</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="mb-3">
                                <div class="row">
                                    <a href="{{ route('portfolio') }}" class="btn btn-secondary btn-sm mr-2">
                                        <i class="fas fa-arrow-left"></i>
                                        Kembali
                                    </a>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addPortfolioImage">
                                        <i class="align-middle" data-feather="plus-square"></i>
                                        <span class="align-middle"> Add Image</span>
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover mb-5">
                                    @foreach ($portfolio as $data)
                                        <tbody>
                                            <tr>
                                                <td width="10%">Client</td>
                                                <td width="2%">:</td>
                                                <td>{{ $data->client }}</td>
                                            </tr>
                                            <tr>
                                                <td width="10%">Title</td>
                                                <td width="2%">:</td>
                                                <td>{{ $data->title }}</td>
                                            </tr>
                                            <tr>
                                                <td width="10%">Category</td>
                                                <td width="2%">:</td>
                                                <td>{{ $data->category }}</td>
                                            </tr>
                                            <tr>
                                                <td width="10%">Project Date</td>
                                                <td width="2%">:</td>
                                                <td>{{ $data->project_date }}</td>
                                            </tr>
                                            <tr>
                                                <td width="10%">Project URL</td>
                                                <td width="2%">:</td>
                                                <td>
                                                    <a href="{{ $data->project_url }}" target="_blank">{{ $data->project_url }}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="10%">Description</td>
                                                <td width="2%">:</td>
                                                <td>
                                                    @if ($data->desc === 'NULL' || is_null($data->desc))
                                                        Null
                                                    @else
                                                        {{ $data->desc }}
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                                <table class="table" id="portfolio">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Placement</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($portfolioImage as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>
                                                <a href="{{ asset('storage/portfolio/' . $row->image) }}" data-lightbox="image-1">
                                                    <img src="{{ asset('storage/portfolio/' . $row->image) }}" alt="{{ $row->image }}" width="250">
                                                </a>
                                            </td>
                                            <td>{{ $row->placement }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editImage{{ $row->id }}">
                                                    <i class="nav-icon fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteImage{{ $row->id }}">
                                                    <i class="nav-icon fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </section>
    <!-- /.content -->

    <!-- Start: Modal Add Portfolio Image -->
    <div class="modal fade" id="addPortfolioImage" tabindex="-1" aria-labelledby="addPortfolioImageLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Image Portfolio</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('store.portfolio-image') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Image <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="file" class="form-control" name="image">
                                    <label class="input-group-text" for="inputGroupFile01">Browse</label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Placement <span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="placement" value="{{ $placement }}" readonly />
                            </div>
                        </div>
                    </div>
                    <input class="form-control" type="hidden" name="portfolio_id" value="{{ $portfolioId }}" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn border" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Image</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <!-- End: Modal Add Portfolio Image -->

    <!-- Start: Modal Edit Portfolio Image -->
    @foreach ($portfolioImage as $data)
    <div class="modal fade" id="editImage{{ $data->id }}" tabindex="-1" aria-labelledby="editImageLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update Image Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('edit.portfolio-image', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Image <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="file" class="form-control" name="image">
                                    <label class="input-group-text" for="inputGroupFile01">Browse</label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Placement <span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="placement" value="{{ $data->placement }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <img src="{{ asset('storage/portfolio/' . $data->image) }}" alt="{{ $data->image }}" width="250">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn border" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Image</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    @endforeach
    <!-- End: Modal Edit Portfolio Image -->

    <!-- Start: Modal Delete Portfolio Image -->
    @foreach ($portfolioImage as $data)
    <div class="modal fade" id="deleteImage{{ $data->id }}" tabindex="-1" aria-labelledby="deleteImageLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Image Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('delete.portfolio-image', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <p>Are you sure you want to delete this image?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn border" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, delete</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    @endforeach
    <!-- End: Modal Delete Portfolio Image -->

</div>
<!-- /.content-wrapper -->

@endsection

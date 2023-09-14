<!-- Connect to master template -->
@extends('template.master')

<!-- Title -->
@section('title', 'Synodev | Portfolio')

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
                        <li class="breadcrumb-item active">Portfolio</li>
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
                            <h3 class="card-title">Table Portfolio</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="row">
                                <div class="mb-3">
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addPortfolio">
                                        <i class="align-middle" data-feather="plus-square"></i>
                                        <span class="align-middle"> Add Portfolio</span>
                                    </button>
                                </div>
                            </div>
                            <table class="table" id="portfolio">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Thumbnail</th>
                                        <th>Client</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Project Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($portfolio as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <a href="{{ asset('storage/portfolio/thumbnails/' . $row->thumbnail) }}" data-lightbox="image-1">
                                                <img src="{{ asset('storage/portfolio/thumbnails/' . $row->thumbnail) }}" alt="{{ $row->thumbnail }}" width="200">
                                            </a>
                                        </td>
                                        <td>{{ $row->client }}</td>
                                        <td>{{ $row->title }}</td>
                                        <td>{{ $row->category }}</td>
                                        <td>{{ $row->project_date }}</td>
                                        <td>
                                            <a href="{{ route('detail.portfolio', $row->id) }}" class="btn btn-success btn-sm">
                                                <i class="nav-icon fas fa-eye"></i>
                                            </a>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editPortfolio{{ $row->id }}">
                                                <i class="nav-icon fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletePortfolio{{ $row->id }}">
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
            <!-- /.row -->
        </div>
    </section>
    <!-- /.content -->

    <!-- Start: Modal Add Portfolio -->
    <div class="modal fade" id="addPortfolio" tabindex="-1" aria-labelledby="addPortfolioLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Portfolio Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('store.portfolio') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Client <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="client" placeholder="Enter client" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="title" placeholder="Enter title" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Category <span class="text-danger">*</span></label>
                                <select class="form-control" name="category">
                                    <option>Choose category...</option>
                                    <option value="Web Development">Web Development</option>
                                    <option value="Wordpress Development">Wordpress Development</option>
                                    <option value="Company Profile">Company Profile</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Project Date <span class="text-danger">*</span></label>
                                <input class="form-control" type="date" name="project_date" placeholder="Enter project date" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="desc" rows="3" placeholder="Enter full description"></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Project URL</label>
                                <input class="form-control" type="text" name="project_url" placeholder="Enter project url" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Thumbnail <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="file" class="form-control" name="thumbnail">
                                    <label class="input-group-text" for="inputGroupFile01">Browse</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn border" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Portfolio</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <!-- End: Modal Add Portfolio -->

    <!-- Start: Modal Update Portfolio -->
    @foreach ($portfolio as $data)
    <div class="modal fade" id="editPortfolio{{ $data->id }}" tabindex="-1" aria-labelledby="editPortfolioLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update Portfolio Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('edit.portfolio', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Client <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="client" value="{{ $data->client }}" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="title" value="{{ $data->title }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Category <span class="text-danger">*</span></label>
                                <select class="form-control" name="category">
                                    <option>Choose category...</option>
                                    <option value="Web Development" {{ $data->category === 'Web Development' ? 'selected' : '' }}>Web Development</option>
                                    <option value="Wordpress Development" {{ $data->category === 'Wordpress Development' ? 'selected' : '' }}>Wordpress Development</option>
                                    <option value="Company Profile" {{ $data->category === 'Company Profile' ? 'selected' : '' }}>Company Profile</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Project Date <span class="text-danger">*</span></label>
                                <input class="form-control" type="date" name="project_date" value="{{ $data->project_date }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="full_desc" rows="3">{{ $data->desc }}</textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Project URL</label>
                                <input class="form-control" type="text" name="project_url" value="{{ $data->project_url }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Thumbnail <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="file" class="form-control" name="thumbnail">
                                    <label class="input-group-text" for="inputGroupFile01">Browse</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <img src="{{ asset('storage/portfolio/thumbnails/' . $data->thumbnail) }}" alt="{{ $data->thumbnail }}" width="250">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn border" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Portfolio</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    @endforeach
    <!-- End: Modal Update Portfolio -->

    <!-- Start: Modal Delete Portfolio -->
    @foreach ($portfolio as $data)
    <div class="modal fade" id="deletePortfolio{{ $data->id }}" tabindex="-1" aria-labelledby="deletePortfolioLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Portfolio Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('delete.portfolio', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <p>Are you sure you want to delete this portfolio?</p>
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
    <!-- End: Modal Delete Portfolio -->

</div>
<!-- /.content-wrapper -->

@endsection

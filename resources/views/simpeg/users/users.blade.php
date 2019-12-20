@extends('simpeg.index')
@section('main')
<div class="row justify-content-center">
	<div class="col-lg">
		<div class="card">
			<div class="card-header bg-dark" style="color: white;"><i class="ti-user"></i>&nbsp; {{ __('Daftar User') }}</div>
				<div class="card-body">

						<table class="table table-bordered table-hover">
						<thead>
							<th class="bg-dark" style="color: white;">Username</th>
							<th class="bg-dark" style="color: white;">Email</th>
							<th class="bg-dark" style="color: white;">Role</th>
							@if (Auth::user()->role == 'admin')
							<th colspan="2" class="bg-dark" style="color: white;">Aksi</th>
							@endif
						</thead>
						<tbody>
							@foreach ($user as $s)
							<tr>
								<td>{{$s->name}}</td>
								<td>{{$s->email}}</td>
								<td>{{$s->role}}</td>
								@if (Auth::user()->role == 'admin')
								<td>
									<form action="{{route('user.destroy', $s->id)}}" method="POST">
										@csrf
										@method('DELETE')
									<button type="submit" class="btn btn-danger btn-sm">Hapus</button>
										</form>
								</td>
								<td><a href="{{route('user.edit', $s->id)}}" class="btn btn-warning btn-sm">Edit</a></td>
								@endif
							</tr>
							@endforeach
						</tbody>
						</table>
				</div>
		</div>
	</div>
</div>
@endsection
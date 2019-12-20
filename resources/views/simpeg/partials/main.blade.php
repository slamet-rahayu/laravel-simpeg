@extends('simpeg.index') 
@section('main')

          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="font-weight-bold mb-0">Dashboard</h4>
                </div>
                
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Pegawai Tetap</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                  <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$tetap->jumlah}}</h3>
                    <i class="ti-user icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                  <p class="mb-0 mt-2 text-black">Pegawai Total <span class="text-black ml-1"><small></small></span></p>
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Pegawai Tidak Tetap</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                  <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$tdk_tetap->jumlah}}</h3>
                    <i class="ti-user icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                  <p class="mb-0 mt-2 text-black">Pegawai Total <span class="text-black ml-1"><small></small></span></p>
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Total Pegawai</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                  <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$tot_pegawai->total}}</h3>
                    <i class="ti-agenda icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                  <p class="mb-0 mt-2 text-black">Keseluruhan<span class="text-black ml-1"><small></small></span></p>
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Total Jabatan/Bagian</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                  <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$tot_jab}}/{{$tot_bag}}</h3>
                    <i class="ti-layers-alt icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                  <p class="mb-0 mt-2 text-success"><span class="text-black ml-1"><small></small></span></p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            {{-- <div class="col-sm-12 grid-margin stretch-card"> 
              <div class="card position-relative">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <p class="card-title">Ringkasan bagian</p>
                        <div id="barchart_material1" style="width:100%; height:500px;"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div> --}}
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Ringkasan Bagian</p>
                  <div id="barchart_material" style="width:100%; height:500px;"></div>
                </div>
                
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card border-bottom-0">
                <div class="card-body pb-0">
                    <p class="card-title">Data Pendidikan Pegawai</p>
                  <div id="piechart" style="width:500px; height:500px"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            {{-- <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0">Top Products</p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>User</th>
                          <th>Product</th>
                          <th>Sale</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Jacob</td>
                          <td>Photoshop</td>
                          <td class="text-danger"> 28.76% <i class="ti-arrow-down"></i></td>
                          <td><label class="badge badge-danger">Pending</label></td>
                        </tr>
                        <tr>
                          <td>Messsy</td>
                          <td>Flash</td>
                          <td class="text-danger"> 21.06% <i class="ti-arrow-down"></i></td>
                          <td><label class="badge badge-warning">In progress</label></td>
                        </tr>
                        <tr>
                          <td>John</td>
                          <td>Premier</td>
                          <td class="text-danger"> 35.00% <i class="ti-arrow-down"></i></td>
                          <td><label class="badge badge-info">Fixed</label></td>
                        </tr>
                        <tr>
                          <td>Peter</td>
                          <td>After effects</td>
                          <td class="text-success"> 82.00% <i class="ti-arrow-up"></i></td>
                          <td><label class="badge badge-success">Completed</label></td>
                        </tr>
                        <tr>
                          <td>Dave</td>
                          <td>53275535</td>
                          <td class="text-success"> 98.05% <i class="ti-arrow-up"></i></td>
                          <td><label class="badge badge-warning">In progress</label></td>
                        </tr>
                        <tr>
                          <td>Messsy</td>
                          <td>Flash</td>
                          <td class="text-danger"> 21.06% <i class="ti-arrow-down"></i></td>
                          <td><label class="badge badge-info">Fixed</label></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-5 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">To Do Lists</h4>
									<div class="list-wrapper pt-2">
										<ul class="d-flex flex-column-reverse todo-list todo-list-custom">
											<li>
												<div class="form-check form-check-flat">
													<label class="form-check-label">
														<input class="checkbox" type="checkbox">
														Become A Travel Pro In One Easy Lesson
													</label>
												</div>
												<i class="remove ti-trash"></i>
											</li>
											<li class="completed">
												<div class="form-check form-check-flat">
													<label class="form-check-label">
														<input class="checkbox" type="checkbox" checked>
														See The Unmatched Beauty Of The Great Lakes
													</label>
												</div>
												<i class="remove ti-trash"></i>
											</li>
											<li>
												<div class="form-check form-check-flat">
													<label class="form-check-label">
														<input class="checkbox" type="checkbox">
														Copper Canyon
													</label>
												</div>
												<i class="remove ti-trash"></i>
											</li>
											<li class="completed">
												<div class="form-check form-check-flat">
													<label class="form-check-label">
														<input class="checkbox" type="checkbox" checked>
														Top Things To See During A Holiday In Hong Kong
													</label>
												</div>
												<i class="remove ti-trash"></i>
											</li>
											<li>
												<div class="form-check form-check-flat">
													<label class="form-check-label">
														<input class="checkbox" type="checkbox">
														Travelagent India
													</label>
												</div>
												<i class="remove ti-trash"></i>
											</li>
										</ul>
                  </div>
                  <div class="add-items d-flex mb-0 mt-4">
										<input type="text" class="form-control todo-list-input mr-2"  placeholder="Add new task">
										<button class="add btn btn-icon text-primary todo-list-add-btn bg-transparent"><i class="ti-location-arrow"></i></button>
									</div>
								</div>
							</div>
            </div> --}}
          </div>
          {{-- <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card position-relative">
                <div class="card-body">
                  <p class="card-title">ringkasan pegawai</p>
                  <div class="row">
                    <div class="col-md-6 col-xl-12">
                      <div class="row">
                        <div class="col-md-6 mt-6 col-xl-6">
                          <canvas id="north-america-chart"></canvas>
                          <div id="north-america-chart" style="width:600px; height:500px;"></div>
                        </div>
                        <div class="col-md-6 col-xl-6">
                          <div class="table-responsive mb-3 mb-md-0">
                            <table class="table table-borderless report-table">
                              <tr>
                                <td class="text-muted">Pegawai Laki-laki</td>
                                <td class="w-100 px-0">
                                  <div class="progress progress-md mx-4">
                                  <div class="progress-bar bg-danger" role="progressbar" style="width: {{$pl}}%" aria-valuenow="{{$pl}}" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                </td>
                              <td><h5 class="font-weight-bold mb-0">{{$pl}}</h5></td>
                              </tr>
                              <tr>
                                <td class="text-muted">pegawai Perempuan</td>
                                <td class="w-100 px-0">
                                  <div class="progress progress-md mx-4">
                                  <div class="progress-bar bg-info" role="progressbar" style="width: {{$pp}}%" aria-valuenow="{{$pp}}" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                </td>
                              <td><h5 class="font-weight-bold mb-0">{{$pp}}</h5></td>
                              </tr>
                              <tr>
                                <td class="text-muted">Lulusan SMP</td>
                                <td class="w-100 px-0">
                                  <div class="progress progress-md mx-4">
                                  <div class="progress-bar bg-success" role="progressbar" style="width: {{$smp}}%" aria-valuenow="{{$smp}}" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                </td>
                              <td><h5 class="font-weight-bold mb-0">{{$smp}}</h5></td>
                              </tr>
                              <tr>
                                <td class="text-muted">Lulusan SMA/K</td>
                                <td class="w-100 px-0">
                                  <div class="progress progress-md mx-4">
                                  <div class="progress-bar bg-warning" role="progressbar" style="width: {{$sma}}%" aria-valuenow="{{$sma}}" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                </td>
                              <td><h5 class="font-weight-bold mb-0">{{$sma}}</h5></td>
                              </tr>
                              <tr>
                                <td class="text-muted">Lulusan Diploma</td>
                                <td class="w-100 px-0">
                                  <div class="progress progress-md mx-4">
                                  <div class="progress-bar bg-primary" role="progressbar" style="width: {{$dpl}}%" aria-valuenow="{{$dpl}}" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                </td>
                              <td><h5 class="font-weight-bold mb-0">{{$dpl}}</h5></td>
                              </tr>
                              <tr>
                                <td class="text-muted">Lulusan Sarjana</td>
                                <td class="w-100 px-0">
                                  <div class="progress progress-md mx-4">
                                  <div class="progress-bar bg-info" role="progressbar" style="width: {{$srj}}%" aria-valuenow="{{$srj}}" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                </td>
                                <td><h5 class="font-weight-bold mb-0">{{$srj}}</h5></td>
                              </tr>
                              <tr>
                                <td class="text-muted">Lulusan Magister</td>
                                <td class="w-100 px-0">
                                  <div class="progress progress-md mx-4">
                                  <div class="progress-bar bg-primary" role="progressbar" style="width: {{$mgr}}%" aria-valuenow="{{$mgr}}" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                </td>
                                <td><h5 class="font-weight-bold mb-0">{{$mgr}}</h5></td>
                              </tr>
                              <tr>
                                  <td class="text-muted">Lulusan Doktor</td>
                                  <td class="w-100 px-0">
                                    <div class="progress progress-md mx-4">
                                      <div class="progress-bar bg-primary" role="progressbar" style="width: {{$dr}}%" aria-valuenow="{{$dr}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                  </td>
                                  <td><h5 class="font-weight-bold mb-0">{{$dr}}</h5></td>
                                </tr>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        {{-- <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 <a href="https://www.templatewatch.com/" target="_blank">Templatewatch</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
          </div>
        </footer> --}}
        <!-- partial -->
@endsection
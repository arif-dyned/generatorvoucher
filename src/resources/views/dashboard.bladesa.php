	<section class="container is12">
		<section class="content-header">
			<h1 class="header-c">
				Dashboard
			</h1>
		</section>
	</section>
		<section class="container is12">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="btn info-box">
					<a href="#">
						<div class="info-box-content">
							<span class="info-box-text">Certification Plan</span>

							<span class="info-box-number">

								<div id="myCarousel" class="carousel slide" data-ride="carousel"style="max-height:58px;top:-25px;" >
								  	<div class="carousel-inner" style="max-height:58px;" role="listbox">
								  		<?php $i=1; ?>
								  		@foreach($data['certification'] as $cert)
										<div class="item {{ $i == 1 ? 'active' : null }}" data-level="{{ $cert->name }}">
											  <img class="first-slide" src="{{asset('img/'.$cert->name)}}.svg" style="max-height:58px;">
											  <div class="container">
											  </div>
	    								</div>
	    								<?php $i+=1; ?>
	    								@endforeach
									  </div>
									  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev" style="text-align:left;">
										<span class="fa fa-angle-left" aria-hidden="true"></span>
										<span class="sr-only">Previous</span>
									</a>
									<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
										<span class="fa fa-angle-right" aria-hidden="true"></span>
										<span class="sr-only">Next</span>
									</a>
								</div>

							</span>

						</div>
						<!-- /.info-box-content -->
					</a>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box btn">
					<a href="#">
						<div class="info-box-content">
							<span class="info-box-text">Courses</span>
							<span class="info-box-number" name="total_course">?</span>
						</div>
						<!-- /.info-box-content -->
					</a>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box btn">
					<a href="#">
						<div class="info-box-content">
							<span class="info-box-text">Units</span>
							<span class="info-box-number" name="total_unit">?</span>
						</div>
						<!-- /.info-box-content -->
					</a>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box btn">
					<a href="#">
						<div class="info-box-content">
							<span class="info-box-text">Lessons</span>
							<span class="info-box-number" name="total_lesson">?</span>
						</div>
						<!-- /.info-box-content -->
					</a>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box btn">
					<a href="#">
						<div class="info-box-content">
							<span class="info-box-text">Images</span>
							<span class="info-box-number">{{ App\Http\Models\Asset::where('type', 'image')->count() }}</span>
						</div>
						<!-- /.info-box-content -->
					</a>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box btn">
					<a href="#">
						<div class="info-box-content">
							<span class="info-box-text">Audios</span>
							<span class="info-box-number">{{ App\Http\Models\Asset::where('type', 'like', 'audio%')->count() }}</span>
						</div>
						<!-- /.info-box-content -->
					</a>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box btn">
					<a href="#">
						<div class="info-box-content">
							<span class="info-box-text">Videos</span>
							<span class="info-box-number">{{ App\Http\Models\Asset::where('type', 'like', 'video%')->count() }}</span>
						</div>
						<!-- /.info-box-content -->
					</a>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box btn">
					<a href="#">
						<div class="info-box-content">
							<span class="info-box-text">Total Users</span>
							<span class="info-box-number">100K</span>
						</div>
						<!-- /.info-box-content -->
					</a>
				</div>
			</div>
		</section>
		<!--		graph start-->
		<section class="container is12">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">User Activity</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse">	<i class="fa fa-minus"></i>
               				</button>
							<div class="btn-group">
								<button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                    				<i class="fa fa-wrench"></i>
                    			</button>

								<ul class="dropdown-menu" role="menu">
									<li><a href="#">Action</a></li>
									<li><a href="#">Another action</a></li>
									<li><a href="#">Something else here</a></li>
									<li class="divider"></li>
									<li><a href="#">Separated link</a></li>
								</ul>

							</div>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
								<p class="text-center">
									<strong>Sales: 1 Jan, 2014 - 30 Jan, 2014</strong>
								</p>
								<div id="chart">
									<!-- User Data Chart -->
								</div>
								<!-- /.chart-responsive -->
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->
					</div>
					<!-- ./box-body -->
				</div>
				<!-- /.box -->
			</div>
		</section>

@section('footer_script')
	<!-- Morris Js reuqire raphael Js -->
	<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

	<script>
		$(document).ready(function() {
			var countContent = {!! json_encode($data['count']) !!}

			$('[name=total_course]').text(countContent['A1'].course)
			$('[name=total_unit]').text(countContent['A1'].unit)
			$('[name=total_lesson]').text(countContent['A1'].lesson)

			$('.carousel').carousel('pause');

			$('#myCarousel').on('slid.bs.carousel', function (index, value) {
			  	var level = $('.item.active').data('level')
			  	$('[name=total_course]').text(countContent[level].course)
			  	$('[name=total_unit]').text(countContent[level].unit)
			  	$('[name=total_lesson]').text(countContent[level].lesson)

			  	$('.carousel').carousel('pause');
			})

			Morris.Line({
			element: 'chart', // <— element id
			data: [{
			    m: '2015-1-1', // <-- valid timestamp strings
			    a: 0,
			    b: 270
			}, {
			    m: '2015-1-2',
			    a: 54,
			    b: 256
			}, {
			    m: '2015-1-3',
			    a: 243,
			    b: 334
			}, {
			    m: '2015-1-4',
			    a: 206,
			    b: 282
			}, {
			    m: '2015-1-5',
			    a: 161,
			    b: 58
			}, {
			    m: '2015-1-6',
			    a: 187,
			    b: 0
			}, {
			    m: '2015-1-7',
			    a: 210,
			    b: 0
			}, {
			    m: '2015-1-8',
			    a: 204,
			    b: 0
			}, {
			    m: '2015-1-9',
			    a: 224,
			    b: 0
			}, {
			    m: '2015-1-10',
			    a: 50,
			    b: 23
			}, {
			    m: '2015-1-11',
			    a: 262,
			    b: 0
			}, {
			    m: '2015-1-12',
			    a: 199,
			    b: 0
			},{
			    m: '2015-1-13',
			    a: 35,
			    b: 21
			},{
			    m: '2015-1-14',
			    a: 35,
			    b: 121
			},{
			    m: '2015-1-15',
			    a: 135,
			    b: 21
			  },{
			    m: '2015-1-16',
			    a: 30,
			    b: 21
			  },{
			    m: '2015-1-17',
			    a: 135,
			    b: 121
			  },
			  {
			    m: '2015-1-18',
			    a: 243,
			    b: 21
			  },{
			    m: '2015-1-19',
			    a: 50,
			    b: 211
			  },{
			    m: '2015-1-20',
			    a: 135,
			    b: 121
			  },{
			    m: '2015-1-21',
			    a: 20,
			    b: 21
			  },{
			    m: '2015-1-22',
			    a: 135,
			    b: 98
			  },{
			    m: '2015-1-23',
			    a: 44,
			    b: 32
			  },{
			    m: '2015-1-24',
			    a: 135,
			    b: 40
			  },{
			    m: '2015-1-25',
			    a: 180,
			    b: 50
			  },{
			    m: '2015-1-26',
			    a: 200,
			    b: 52
			  },{
			    m: '2015-1-27',
			    a: 220,
			    b: 40
			  },{
			    m: '2015-1-28',
			    a: 135,
			    b: 100
			  },{
			    m: '2015-1-29',
			    a: 178,
			    b: 75
			  },{
			    m: '2015-1-30',
			    a: 300,
			    b: 60
			  }, ],
			xkey: 'm',
			ykeys: ['a', 'b'],
			smooth: false,
			resize: true,
			hideHover: 'auto',
			lineWidth: 2,
			pointSize: 5,
			lineColors: ['#26d10c', '#787f84'],
			labels: ['User Active', 'User Passive'],
			xLabelFormat: function(x) { // <--- x.getDate() returns valid index
			    return x.getDate();
			},
			dateFormat: function(x) {
			    return new Date(x).getDate();
			  	},
			});
		});
	</script>
@stop
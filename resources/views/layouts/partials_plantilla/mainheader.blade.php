<div class="header">
		<div class="w3ls-header"><!--header-one--> 
			<div class="w3ls-header-left">
				<p><a href="#">Nombre de E-Commerce</a></p>
			</div>
			<div class="w3ls-header-right">
				<ul>
					<li class="dropdown head-dpdn">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i> Mi Cuenta<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="{{ url('/login') }}">Login</a></li> 
							<li><a href="signup.html">Registro</a></li> 
							<li><a href="login.html">Mis Compras</a></li>  
						</ul> 
					</li>
					<li class="dropdown head-dpdn">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-percent" aria-hidden="true"></i> Ofertas del Día<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="offers.html">Descuentos por Producto</a></li>
							<li><a href="offers.html">Ofertas Especiales</a></li> 
						</ul> 
					</li> 
					<li class="dropdown head-dpdn">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gift" aria-hidden="true"></i> Tarjetas de Regalo<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="offers.html">Tarjeta 1</a></li> 
						</ul> 
					</li> 
					<li class="dropdown head-dpdn">
						<a href="contact.html" class="dropdown-toggle"><i class="fa fa-map-marker" aria-hidden="true"></i> Encuéntranos</a>
					</li> 
					<li class="dropdown head-dpdn">
						<a href="card.html" class="dropdown-toggle"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Tarjetas de Crédito</a>
					</li> 
					<li class="dropdown head-dpdn">
						<a href="help.html" class="dropdown-toggle"><i class="fa fa-question-circle" aria-hidden="true"></i> Ayuda</a>
					</li>
				</ul>
			</div>
			<div class="clearfix"> </div> 
		</div>
		<div class="header-two"><!-- header-two -->
			<div class="container">
				<div class="header-logo">
					<h1><a href="index.html"><span>S</span>tore <i>Commerce</i></a></h1>
					<h6>Tu tienda. Tu lugar.</h6> 
				</div>	
				<div class="header-search">
					<form action="#" method="post">
						<input type="search" name="Search" placeholder="Buscar producto" required="">
						<button type="submit" class="btn btn-default" aria-label="Left Align">
							<i class="fa fa-search" aria-hidden="true"> </i>
						</button>
					</form>
				</div>
				<div class="header-cart"> 
					<div class="my-account">
						<a href="contact.html"><i class="fa fa-map-marker" aria-hidden="true"></i> CONTÁCTANOS</a>
					</div>
					<div class="cart"> 
						<form action="#" method="post" class="last"> 
							<input type="hidden" name="cmd" value="_cart" />
							<input type="hidden" name="display" value="1" />
							<button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
						</form>  
					</div>
					<div class="clearfix"> </div> 
				</div> 
				<div class="clearfix"> </div>
			</div>		
		</div><!-- //header-two -->
		<div class="header-three"><!-- header-three -->
			<div class="container">
				<div class="menu">
					<div class="cd-dropdown-wrapper">
						<a class="cd-dropdown-trigger" href="#0">Categorías</a>
						<nav class="cd-dropdown"> 
							<a href="#0" class="cd-close">Close</a>
							<ul class="cd-dropdown-content"> 
									@foreach($categorias as $cat)
										@if($cat->id_menu==1)
										  <li class="has-children">
											<a href="#">{{$cat->Nombre}}</a>
												<ul class="cd-secondary-dropdown is-hidden">
												@foreach($categorias as $ca)
												  @if($ca->id_menu==2 && $cat->ID_Categoria==$ca->ID_General)
													  <li class="has-children">
														<a href="#">{{$ca->Nombre}}</a>
														<ul>
														  @foreach($categorias as $c)
														  	@if($c->id_menu==3 && $cat->ID_Categoria==$c->ID_General && $ca->ID_Categoria==$c->ID_Nivel)
														  		<li> <a href="products.html">{{$c->Nombre}}</a> </li>
														  	@endif
														  @endforeach
													    </ul>
													  </li>
												  @endif
												@endforeach
												</ul>
										  </li>
										@endif
									@endforeach
							</ul> <!-- .cd-dropdown-content -->
						</nav> <!-- .cd-dropdown -->
					</div> <!-- .cd-dropdown-wrapper -->	 
				</div>
				<div class="move-text">
					<div class="marquee"><a href="offers.html"> Nuevos productos aquí...... <span>Recién empiezo, no sé que poner</span></a></div>
					<script type="text/javascript" src="{{asset('/js/plantilla/js/jquery.marquee.min.js')}}"></script>
					<script>
					  $('.marquee').marquee({ pauseOnHover: true });
					  //@ sourceURL=pen.js
					</script>
				</div>
			</div>
		</div>
	</div>
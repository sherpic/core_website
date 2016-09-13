<div class="container">
	<div class="link-breadcrumb">
		<a href="{{URL::route('site.home')}}" title="Trang chủ">Trang chủ</a>
		<i class="fa fa-angle-double-right"></i>
		<a href="{{URL::route('shop.home',array('shop_id' => $product->user_shop_id,'shop_name' => FunctionLib::safe_title($product->user_shop_name)))}}" title="{{$product->user_shop_name}}">{{$product->user_shop_name}}</a>
		<i class="fa fa-angle-double-right"></i>
		<a href="{{URL::route('site.listProduct', array('name'=>strtolower(FunctionLib::safe_title($product->category_name)),'id'=>$product->category_id))}}" title="{{$product->category_name}}">{{$product->category_name}}</a>
		<i class="fa fa-angle-double-right"></i>
		<a href="{{FunctionLib::buildLinkDetailProduct($product->product_id, $product->product_name, $product->category_name)}}" title="{{$product->product_name}}">{{$product->product_name}}</a>
	</div>
	
	<div class="main-view-post .box-detail-product">
		<div class="wrap-main-view">
			<div class="top-content-view">
				<script type="text/javascript">
					    $(document).ready(function(){
					    	$("#slick").slick({
						        dots: false,
						        infinite: true,
						        slidesToShow: 5,
						        slidesToScroll: 3,
						        vertical: true,
						     });
						});
					</script>
				<div class="left-slider-img">
					<div class="list-thumb-img">
						<div id="slick">
							<?php 
							if($product->product_image_other != ''){
							$product_image_other = unserialize($product->product_image_other);
							if(is_array($product_image_other)){
							?>
							@foreach($product_image_other as $img)
							<div class="item-slick" data="{{ThumbImg::getImageThumb(CGlobal::FOLDER_PRODUCT, $product->product_id, $img, CGlobal::sizeImage_600, '', true, CGlobal::type_thumb_image_product)}}">
								<a href="javascript:void(0)">
									<img src="{{ThumbImg::getImageThumb(CGlobal::FOLDER_PRODUCT, $product->product_id, $img, CGlobal::sizeImage_300, '', true, CGlobal::type_thumb_image_product)}}" alt="{{$product->product_name}}">
								</a>
							</div>
							@endforeach
							<?php } }?>
						</div>
					</div>
					@if($product->product_image != '')
					<div class="max-thumb-img">
						<a href="javascript:void(0)" title="{{$product->product_name}}">
							<img src="{{ThumbImg::getImageThumb(CGlobal::FOLDER_PRODUCT, $product->product_id, $product->product_image, CGlobal::sizeImage_600, '', true, CGlobal::type_thumb_image_product)}}" alt="{{$product->product_name}}">
						</a>
					</div>
					@endif
				</div>
				<div class="center-des-product">
					<h1>{{$product->product_name}}</h1>
					@if($product->product_type_price == 1)
					
					@if($product->product_price_market > 0)
					<div class="row-price">
						<div class="lbl-row">Giá thị trường:</div>
						<div class="price-origin">{{FunctionLib::numberFormat($product->product_price_market)}}đ</span></div>
					</div>
					@endif
					
					@if($product->product_price_sell > 0)
					<div class="row-price">
						<div class="lbl-row lbl-price-sale">Giá bán:</div>
						<div class="price-sale">{{FunctionLib::numberFormat($product->product_price_sell)}}<span class="td-border">đ</span></div>
					</div>
					@endif
					
					@else
					<div class="lbl-row lbl-price-sale">Giá bán:</div>
						<div class="price-sale">Liên hệ</div>
					@endif
					
					<div class="features-point">
						<div class="lbl-point">Mô tả sản phẩm</div>
						@if($product->product_sort_desc != '')
						<div class="des-point">{{$product->product_sort_desc}}</div>
						@endif
						@if($product->product_selloff != '')
						<div class="box-promotion">
							<div class="lbl-point">Thông tin khuyến mãi</div>
							<div class="box-content-promotion">{{$product->product_selloff}}</div>
						</div>
						@endif
					</div>
					
				</div>
				<div class="right-des-product">
					<div class="content-right-product">
						<div id="fb-root"></div>
							<script>(function(d, s, id) {
							  var js, fjs = d.getElementsByTagName(s)[0];
							  if (d.getElementById(id)) return;
							  js = d.createElement(s); js.id = id;
							  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6";
							  fjs.parentNode.insertBefore(js, fjs);
							}(document, 'script', 'facebook-jssdk'));</script>
						<div class="fb-like" data-href="{{FunctionLib::buildLinkDetailProduct($product->product_id, $product->product_name, $product->category_name)}}"
							data-layout="button_count" data-action="like" 
							data-show-faces="false" data-share="true">
						</div>
					</div>
					<div class="content-right-product">
						<div class="order-number">
							<label for="buy-number">Số lượng</label>
							<select class="sl-num" id="buy-num" name="buy-num">
                            	@for($i=1; $i<=10; $i++)
                            	<option value="{{$i}}">{{$i}}</option>
                            	@endfor
							</select>
						</div>
						<div id="buttonFormBuySubmit" data-pid="702" class="buynow btn">Mua ngay</div>
					</div>
					<div class="content-right-product">
						<div class="order-number-phone">
						<p><b>Đặt nhanh qua điện thoại</b></p>
						<div class="number-phone">
							<div class="fa fa-phone"></div>
							<span>{{$user_shop->shop_phone}}</span>
						</div>
						<p><a href="{{Config::get('config.WEB_ROOT')}}shop-{{$user_shop->shop_id}}/{{FunctionLib::safe_title($user_shop->shop_name)}}.html" title="Shop: {{$user_shop->shop_name}}">{{$user_shop->shop_name}}</a></p>
						<p><b>Thông tin liên hệ: </b></p>
						<p>{{$user_shop->shop_email}}</p>
						<p>{{$user_shop->shop_address}}</p>
					</div>
					</div>
				</div>
			</div>
			<div class="center-content-view">
				<div class="title-center-content-view">Sản phẩm bạn có thể quan tâm</div>
				<div class="content-center-content-view">
					<ul>
					@if(!empty($dataProVip))
					@foreach($dataProVip as $item)
						<li class="item">
								@if($item->product_type_price == 1)
									@if((float)$item->product_price_market > (float)$item->product_price_sell)
									<span class="sale-off">
										-{{ number_format(100 - ((float)$item->product_price_sell/(float)$item->product_price_market)*100, 1) }}%
									</span>
									@endif
								@endif
								<div class="post-thumb">
									<a title="{{$item->product_name}}" href="{{FunctionLib::buildLinkDetailProduct($item->product_id, $item->product_name, $item->category_name)}}">
										<img alt="{{$item->product_name}}" src="{{ThumbImg::getImageThumb(CGlobal::FOLDER_PRODUCT, $item['product_id'], $item['product_image'], CGlobal::sizeImage_300)}}"
											data-other-src="{{ThumbImg::getImageThumb(CGlobal::FOLDER_PRODUCT, $item['product_id'], $item['product_image_hover'], CGlobal::sizeImage_300)}}">
									</a>
								</div>
								<div class="item-content">
									<div class="title-info">
										<h4 class="post-title">
											<a title="{{$item->product_name}}" href="{{FunctionLib::buildLinkDetailProduct($item->product_id, $item->product_name, $item->category_name)}}">{{$item->product_name}}</a>
										</h4>
										<div class="item-price">
											@if($item->product_price_sell > 0)
											<span class="amount-1">{{FunctionLib::numberFormat($item->product_price_sell)}}đ</span>
											@endif
											@if($item->product_price_market > 0)
											<span class="amount-2">{{FunctionLib::numberFormat($item->product_price_market)}}đ</span>
											@endif
											@if($item->product_price_sell == 0 && $item->product_price_market == 0)
												<span class="amount-1">Liên hệ</span>
											@endif
										</div>
									</div>
									@if($item->user_shop_id > 0 && $item->user_shop_name != '')
									<div class="mgt5 amount-call">
					                	<a title="{{$item->user_shop_name}}" class="link-shop" href="{{Config::get('config.WEB_ROOT')}}shop-{{$item->user_shop_id}}/{{$item->user_shop_name}}.html">{{$item->user_shop_name}}</a>
					            	</div>
					            	@endif
								</div>
							</li>
						@endforeach
						@endif
					</ul>
				</div>
			</div>
			<div class="bottom-content-view">
				<div class="left-bottom-content-view">
					<ul class="tab">
						<li class="act" data-tab="1">Chi tiết sản phẩm</li>
						<li data-tab="2" class="">Bình luận</li>
						<li data-tab="3" class="">Chính sách giao nhận</li>
						<li data-tab="4" class="">Giới thiệu Shop</li>
					</ul>
					<div class="content-bottom-content-view">
						<div class="show-tab show-tab-1 act">{{$product->product_content}}</div>
						<div class="show-tab show-tab-2">
							<div class="social-comment">
								<div class="content-comment-facebook">
									<div class="socialFacebook">
										<div id="fb-root"></div>
										<script>(function(d, s, id) {
										  var js, fjs = d.getElementsByTagName(s)[0];
										  if (d.getElementById(id)) return;
										  js = d.createElement(s); js.id = id;
										  js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1&appId=342626259177944";
										  fjs.parentNode.insertBefore(js, fjs);
										}(document, 'script', 'facebook-jssdk'));</script>
										<div class="fb-comments" data-href="{{FunctionLib::buildLinkDetailProduct($item->product_id, $item->product_name, $item->category_name)}}" data-width="800px" data-num-posts="10"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="show-tab show-tab-3">@if($user_shop->shop_transfer != '') {{$user_shop->shop_transfer}} @else Đang cập nhật... @endif</div>
						<div class="show-tab show-tab-4">@if($user_shop->shop_about != '') {{$user_shop->shop_about}} @else Đang cập nhật... @endif</div>
					</div>
				</div>
				<div class="right-bottom-content-view">
					<div class="title-hot"><span>Sản phẩm nổi bật</span></div>
					<div class="content-right-bottom-content-view">
						<ul>
						@if(!empty($dataProVip))
						@foreach($dataProVip as $item)
							<li class="item">
									@if($item->product_type_price == 1)
										@if((float)$item->product_price_market > (float)$item->product_price_sell)
										<span class="sale-off">
											-{{ number_format(100 - ((float)$item->product_price_sell/(float)$item->product_price_market)*100, 1) }}%
										</span>
										@endif
									@endif
									<div class="post-thumb">
										<a title="{{$item->product_name}}" href="{{FunctionLib::buildLinkDetailProduct($item->product_id, $item->product_name, $item->category_name)}}">
											<img alt="{{$item->product_name}}" src="{{ThumbImg::getImageThumb(CGlobal::FOLDER_PRODUCT, $item['product_id'], $item['product_image'], CGlobal::sizeImage_300)}}"
												data-other-src="{{ThumbImg::getImageThumb(CGlobal::FOLDER_PRODUCT, $item['product_id'], $item['product_image_hover'], CGlobal::sizeImage_300)}}">
										</a>
									</div>
									<div class="item-content">
										<div class="title-info">
											<h4 class="post-title">
												<a title="{{$item->product_name}}" href="{{FunctionLib::buildLinkDetailProduct($item->product_id, $item->product_name, $item->category_name)}}">{{$item->product_name}}</a>
											</h4>
											<div class="item-price">
												@if($item->product_price_sell > 0)
												<span class="amount-1">{{FunctionLib::numberFormat($item->product_price_sell)}}đ</span>
												@endif
												@if($item->product_price_market > 0)
												<span class="amount-2">{{FunctionLib::numberFormat($item->product_price_market)}}đ</span>
												@endif
												@if($item->product_price_sell == 0 && $item->product_price_market == 0)
													<span class="amount-1">Liên hệ</span>
												@endif
											</div>
										</div>
										@if($item->user_shop_id > 0 && $item->user_shop_name != '')
										<div class="mgt5 amount-call">
						                	<a title="{{$item->user_shop_name}}" class="link-shop" href="{{Config::get('config.WEB_ROOT')}}shop-{{$item->user_shop_id}}/{{$item->user_shop_name}}.html">{{$item->user_shop_name}}</a>
						            	</div>
						            	@endif
									</div>
								</li>
							@endforeach
							@endif
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>